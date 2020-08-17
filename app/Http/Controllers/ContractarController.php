<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Assessor;
use App\Tarifa;
use App\Etiqueta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DB;
use App\Assessoria;
use App\Factura;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use App\Orders;
use App\OrderItems;
use Carbon\Carbon;


class ContractarController extends Controller
{
    
    public function resumContractar(Request $request){
        $request->session()->forget('tarifa');
        $tar = Tarifa::where('id', $request->route('id'))->first();
        $request->session()->put('tarifa', $tar);
        //dd($tar->assessors->user);
        Log::debug($request->session()->get('tarifa'));

        return view('resumContr')->with(array('tar' => $tar));
    }
    private $_api_context;
	public function __construct()
	{
        $this->middleware('auth');
		// setup PayPal api context
		$paypal_conf = \Config::get('paypal');
		$this->_api_context = new ApiContext(new OauthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
		$this->_api_context->setConfig($paypal_conf['settings']);
    }
    
    public function postPayment(Request $request){
        $tar = $request->session()->get('tarifa');
        log::debug($tar);
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $subtotal = $tar->price;
        $currency = 'EUR';
        $items = array();
        $item = new Item();
        $item->setName($tar->title)
        ->setCurrency($currency)
		->setDescription('Tarifa Contractada')
		->setQuantity(1)
        ->setPrice($tar->price);
        $items[] = $item;
        $item_list = new ItemList();
        $item_list->setItems($items);
        $details = new Details();
        $details->setSubtotal($subtotal);
        $total = $subtotal;
        $amount = new Amount();
        $amount->setCurrency($currency)
            ->setTotal($total)
            ->setDetails($details);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Contractació de la tarifa '. $tar->title . " a l'assessor " . $tar->assessors->user->name);

            $redirect_urls = new RedirectUrls();
            $redirect_urls->setReturnUrl(\URL::route('payment.status'))
                ->setCancelUrl(\URL::route('payment.status'));
            $payment = new payment();
            $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));
                try {
                    $payment->create($this->_api_context);
                } catch (\PayPal\Exception\PPConnectionException $ex) {
                    if (\Config::get('app.debug')) {
                        echo "Exception: " . $ex->getMessage() . PHP_EOL;
                        $err_data = json_decode($ex->getData(), true);
                        exit;
                    } else {
                        die('Error! Quelcom ha eixit malament');
                    }
                }
                foreach($payment->getLinks() as $link) {
                    if($link->getRel() == 'approval_url') {
                        $redirect_url = $link->getHref();
                        break;
                    }
                }
                // add payment ID to session
            $request->session()->put('paypal_payment_id', $payment->getId());
            if(isset($redirect_url)) {
                // redirect to paypal
                \Log::debug($redirect_url);
                return \Redirect::away($redirect_url);
            }
    
            return \Redirect::route('cart-show')
                ->with('error', 'Error desconegut.');
    
        } //clau de final de mètode.

        public function getPaymentStatus(Request $request)
		{
            Log::debug("hola");
			// Get the payment ID before session clear
			$payment_id = \Session::get('paypal_payment_id');
			// clear the session payment ID
            \Session::forget('paypal_payment_id');

            $payerId = $request->get('PayerID');
			$token = $request->get('token');
			//if (empty($request->get('PayerID')) || empty($request->get('token'))) {
			if (empty($payerId) || empty($token)) {
				return  redirect()->action('HomeController@indexCli', ['message' => "
                Has cancel·lat la contractació", 'messageType' => 'danger']);
            }
            $payment = Payment::get($payment_id, $this->_api_context);
            // PaymentExecution object includes information necessary
            // to execute a PayPal account payment.
            // The payer_id is added to the request query parameters
            // when the user is redirected from paypal back to your site
            $execution = new PaymentExecution();
            $execution->setPayerId($request->get('PayerID'));
            //Execute the payment
            $result = $payment->execute($execution, $this->_api_context);
            if ($result->getState() == 'approved') { // payment made
                $tar = $request->session()->get('tarifa');
                $factura = new Factura;
                $factura->price = $tar->price;
                $factura->user_id = auth()->user()->id;
                $factura->dades_Tarifa = serialize($tar);
                $factura->assessor_id = $tar->assessor_id;
                $factura->save();
               
                for($i = 0; $i < $tar->duration; $i++){
                    $ass = new Assessoria;
                    $ass->data_inici = Carbon::today()->addMonths($i); //addMinuts
                    $ass->data_fi = Carbon::today()->addMonths($i + 1); //addMonths
                    $ass->dades_Tarifa = serialize($tar);
                    $ass->user_id = auth()->user()->id;
                    $ass->assessor_id = $tar->assessor_id;
                    $ass->save();
                }
                

                \Session::forget('tarifa');
                return  redirect()->action('HomeController@indexCli', ['message' => "
                Contractació completada", 'messageType' => 'success']);
            }
            return  redirect()->action('HomeController@indexCli', ['message' => "
            The purchase has been canceled", 'messageType' => 'danger']);
        } //finalització del mètode getPaymentStatus

    
    }

