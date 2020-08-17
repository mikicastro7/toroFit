@extends('layouts.main')
@include('includes.navbars.cliNavbar')
@section('content')
    <div class="container">
        @if($asse == null)
        <h4 style="text-align: center; margin-top:40px">No tens cap assessoria contractada</h6>
        @else
        <h1 style="text-align: center; margin-top:20px">Entrar dades assessoria</h1>
        <form action="/cliAssessoria/entrarDades/edit" enctype="multipart/form-data" method="POST" id="form-dades">
            {{ method_field('PUT') }}
            <input type="hidden" name="_token" id="token-edit" value="{{ csrf_token() }}">
            <div class="row justify-content-center">
                <div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
                    <label>Pes (kg)</label>
                    <input step="0.01" min="0" value="{{$asse->pes}}" name="pes" type="number" class="form-control justify-content-center" id="form-title" placeholder="Pes">
                </div>
                <div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
                    <label>Altura (m)</label>
                    <input step="0.01" min="0" value="{{$asse->altura}}" name="altura" type="number" class="form-control justify-content-center" id="form-title" placeholder="Altura">
                </div>
                <div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-10 col-xl-8">
                    <label>Comentari</label>
                    <textarea name="comentari" rows="4" cols="50"
                    class="form-control justify-content-center">{{ isset($asse->comentari_client) ? $asse->comentari_client : "comentari per fer a l'assessor si ja has fet alguna assessoria amb ell comenta com t'ha anat com t'has trobat etc. si encara no has fet mai cap assessoria amb ell comental els teus objectius i coses sobre tu" }}</textarea>
                </div>
                
            </div>
            <div class="row justify-content-center">
                <div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
                  <label>Selecciona una imatge per mostrar el teu progress</label>
                  <div class="custom-file">
                    <input name="image" type="file" class="custom-file-input" id="img">
                    <label class="custom-file-label" for="img" data-browse="Seleccionar">Penja una imatge</label>
                  </div>
                </div>
            </div>
            <div class="col text-center">
                <button style="margin-bottom:20px; width:70% !important; margin:auto" type="submit" class="btn btn-primary col-xs-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">Guardar dades</button>
            </div>
        </form>
        
            @if ($asse->image != null)
            <h3 style="text-align: center; margin-top:20px; margin-bottom:20px">Imatge actual</h3>
            <div class="row justify-content-center">
            <div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
                <img class="img-actual" src="{{ url('/progress/'.$asse->image) }}" alt="">
            </div>
            @endif
            
         </div>
        @endif
    </div>
    <script>
        $('#img').on('change',function(){
                    //get the file name
                    var fileName = $(this).val();
                    var cleanFileName = fileName.replace('C:\\fakepath\\', " ");
                    //replace the "Choose a file" label
                    $(this).next('.custom-file-label').html(cleanFileName);
                })
    </script>
    @include('includes.footer')
@stop
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<style>
    .container img{
        width: 100%;
        display: block;
    }
    .img-actual{
        display: block;
    }
</style>
