<link href="{{ asset('css/cliCard.css') }}" rel="stylesheet">
<div class="container">
    <h1>Assessorias disponibles</h1>
    @if($asse == "[]")
    <h4 style="text-align: center; margin-top:40px">No tens cap assessoria disponible</h6>
    @else
    @foreach ($asse as $ass)
    <div class='assessor row'>
        <div class='usu-data col-lg-2 col-md-2 col-sm-6 col-xs-12'>
            <img class='img-perf' src="/storage/perfil_image/{{$ass->user->perfil_image}}" alt="">
            <br>
            <span class='us-name'>{{$ass->user->name}}</span>
        </div>
        <div class='data col-lg-3 col-md-5 col-sm-6 col-xs-12'>
            <span><strong>Data inici:</strong> {{date('d-m-Y', strtotime($ass->data_inici))}}</span>
            <br>
            <span><strong>Data fi:</strong> {{date('d-m-Y', strtotime($ass->data_fi))}}</span>
        </div>
        <div class=' tar col-lg-2 col-md-5 col-sm-6 col-xs-12'>
            <p style="text-align: center; margin-bottom:5px"><span><strong>Tarifa Contractada</strong></span></p>
            
            <p style="text-align: center">{{unserialize($ass->dades_Tarifa)->title}}</p>
        </div>
        <div class='dades col-lg-3 col-md-6 col-sm-6 col-xs-12'>
            <p style="margin-bottom:5px"><span><strong>L'usuari ha entrat dades
            @if($ass->pes != null || $ass->altura != null || $ass->image != null)    
            <i class="fa fa-check" aria-hidden="true"></i>
            @else
            <i class="fa fa-times" aria-hidden="true"></i>
            @endif
            </strong></span></p>
            
            <p style="margin-bottom:5px"><span><strong>Has assessorat a l'usuari
                @if($ass->fiitxer_rutina != null || $ass->fitxer_dieta != null)    
                <i class="fa fa-check" aria-hidden="true"></i>
                @else
                <i class="fa fa-times" aria-hidden="true"></i>
                @endif    
            </strong></span></p>
        </div>
        <div class='btns col-lg-2 col-md-6 col-sm-12 col-xs-12'>
            <form action="/assAssessoria/entrarDades/{{$ass->id}}">
                <button class='btn-conperf btn-con'>Assessorar</button>
            </form>
            <form action="/cliHistorial/{{$ass->user_id}}">
                <button class='btn-conperf btn-perf'>Historial</button>
            </form>
        </div>
    </div>           
    @endforeach
    @endif
</div>

<style>
    .fa-times{
        color: red;
    }
    .fa-check{
        color: green;
    }
</style>