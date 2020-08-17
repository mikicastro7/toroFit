@extends('layouts.main')
@include('includes.navbars.assNavbar')
@section('content')
<div class="container">
    <h1 style="text-align: center; margin-top:20px">Assessoria per a {{$asse->user->name}}</h1>
    <div class="row ">
        <div class="table-center col-md-7 col-sm-12">
            <h4 style="text-align: center; margin-top:20px">Dades usuari</h4>
            <table class="table-text-center table table-bordered  ">
                <tbody>
                    <tr>
                        <th scope="row">Tarifa Contractada</th>
                        <td>{{unserialize($asse->dades_Tarifa)->title}}</td>
                    </tr>
                    <tr>
                    <tr>
                        <th scope="row">Pes</th>
                        <td>{{$asse->pes}} kg</td>
                    </tr>
                    <tr>
                        <th scope="row">Altura</th>
                        <td>{{$asse->altura}} m</td>
                    </tr>
                    <tr>
                        <th scope="row">Edat</th>
                        <td>{{$asse->user->age()}} anys</td>
                    </tr>
                    <tr>
                        <th scope="row">Sexe</th>
                        <td>{{$asse->user->sexe}}</td>
                    </tr>
                </tbody>
            </table>
            @if($asse->comentari_client != null)
                <h4 style="text-align: center; margin-top:20px">Comentari del client</h4>
                <p>{{$asse->comentari_client}}</p>
            @endif
        </div>
        <div class="col-md-5 col-sm-12">
            <h4 style="text-align: center; margin-top:20px">Imatge actual</h4>
            @if($asse->image != null)
            <img class="img-actual" src="{{ url('/progress/'.$asse->image) }}" alt="">
            @endif
        </div>
    </div>
    <h4 style="text-align: center; margin-top:30px">Documents i comentari</h4>
    <form action="/assAssessoria/entrarDades/edit/{{$asse->id}}" method="POST" enctype="multipart/form-data">
    {{ method_field('PUT') }}
    <input type="hidden" name="_token" id="token-edit" value="{{ csrf_token() }}">
    <div style="margin-top: 15px" class="row justify-content-center">
        <div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
            <label>Selecciona un document pdf, excel, word per penjar la rutina de exercisis d'aquest client</label>
            <div class="custom-file">
              <input name="rutina" type="file" class="custom-file-input" id="rutina">
              <label class="custom-file-label" for="rutina" data-browse="Seleccionar">{{isset($asse->fitxer_rutina) ? $asse->fitxer_rutina : "Penja un document amb la rutina"}}</label>
            </div>
          </div>
          <div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
            <label>Selecciona un document pdf, word, excel etc. per penjar la dieta d'aquest client</label>
            <div class="custom-file">
              <input name="dieta" type="file" class="custom-file-input" id="dieta">
              <label class="custom-file-label" for="dieta" data-browse="Seleccionar">{{isset($asse->fitxer_dieta) ? $asse->fitxer_dieta : "Penja un document amb la dieta"}}</label>
            </div>
          </div>
          <div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-10 col-xl-8">
            <label>Comentari</label>
            <textarea name="comentari" rows="4" cols="50"
            class="form-control justify-content-center">{{ isset($asse->comentari_assessor) ? $asse->comentari_assessor : "Comentari" }}</textarea>
        </div>
    </div>
    <div class="col text-center">
        <button style="margin-bottom:20px !important; width:70% !important; margin:auto" type="submit" class="btn btn-primary col-xs-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">Guardar dades</button>
    </div>
</form>
</div>
<script>
    $('#dieta').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                var cleanFileName = fileName.replace('C:\\fakepath\\', " ");
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(cleanFileName);
            })
    $('#rutina').on('change',function(){
        //get the file name
        var fileName = $(this).val();
        var cleanFileName = fileName.replace('C:\\fakepath\\', " ");
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(cleanFileName);
    })
    var sites = {!! json_encode(unserialize($asse->dades_Tarifa)) !!};
    console.log(sites);
</script>
@include('includes.footer')
@stop
<style>
    .img-actual{
        display: block;
        margin: auto;
        width: 80%;
        border: 2px solid #0787ff2c;
    }
</style>