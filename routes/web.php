<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cliHome', 'HomeController@indexCli');
Route::get('/assHome', 'HomeController@indexAss')->middleware('isAss');
Route::get('/userConfiguration', 'UsersConfigurationController@userConfig');
Route::put('/userConfiguration/edit', 'UsersConfigurationController@editUser');
Route::put('/assConfiguration/edit', 'UsersConfigurationController@editAss')->middleware('isAss');
Route::put('/userConfiguration/uploadImage', 'UsersConfigurationController@editUserImage');


Route::get('/assConf', 'UsersConfigurationController@assConf')->middleware('isAss');

//Tarifes
Route::get('/tarifes', 'TarifasController@indexTarifes')->middleware('isAss');
Route::get('/tarifes/crearTarifa', 'TarifasController@creadorTarifes')->middleware('isAss');
Route::post('/tarifes/crearTarifa/crear', 'TarifasController@crearTarifa')->middleware('isAss');
Route::get('/tarifes/editarTarifa/{id}', 'TarifasController@editadorTarifa')->middleware('isAss', 'tarAssessor');
Route::put('/tarifes/editarTarifa/{id}/editar', 'TarifasController@editarTarifa')->middleware('isAss', 'tarAssessor');
Route::delete('/tarifes/eliminarTarifa', 'TarifasController@eliminarTarifa');
Route::get('/tarifes/{id}', 'TarifasController@mostrarTarifaCli');
// Perfil Assessor
Route::get('/perfilAss', 'PerfilAssController@perfilAss')->middleware('isAss');
Route::get('/perfilAss/editor', 'PerfilAssController@perfilAssEditor')->middleware('isAss');
Route::put('/perfilAss/editor/editar', 'PerfilAssController@perfilAssEditorEditar')->middleware('isAss');
Route::get('/perfilAss/{id}', 'PerfilAssController@perfilAssClient');
// Buscar Assessor
Route::post('/search', 'HomeController@searchAss');

// contractar tarifa
Route::get('/contractarTarifa/{id}', 'ContractarController@resumContractar');
//pagament
Route::get('/payment', array(
	'as' => 'payment',
	'uses' => 'ContractarController@postPayment',
));
Route::get('/payment/status', array(
	'as' => 'payment.status',
	'uses' => 'ContractarController@getPaymentStatus',
));
//cli asssessoria
Route::get('/cliAssessoria', 'AssessoriaController@cliAssessoriaHome');
Route::get('/cliAssessoria/entrarDades', 'AssessoriaController@cliAssessoriaEntrarDades');
Route::put('/cliAssessoria/entrarDades/edit', 'AssessoriaController@cliAssessoriaEntrarDadesEdit');
//ass assessoria 
Route::get('/assAssessoria/entrarDades/{id}', 'AssessoriaController@assAssessoriaEntrarDades')->middleware('isAss', 'assAssessoria');
Route::put('/assAssessoria/entrarDades/edit/{id}', 'AssessoriaController@assAssessoriaEntrarDadesEdit')->middleware('isAss', 'assAssessoria');

//Historial client
Route::get('/cliHistorial/{id}', 'AssessoriaController@cliHistorial')->middleware('AssessorGetHistory');
Route::get('/cliHistorial', 'AssessoriaController@cliHistorial');

//files
Route::get('/progress/{file}','FileController@getImage')->middleware('fileAcces');
Route::get('/descarregarRutina/{file}', 'FileController@getRutina');
Route::get('/descarregarDieta/{file}', 'FileController@getDieta');


Auth::routes();


