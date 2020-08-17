@extends('layouts.main')
@include('includes.navbars.assNavbar')
@section('content')
<div class="container">
    <h1 style="text-align: center; margin-top:20px">Creador de tarifes</h1>
    <form id="createTarifaForm">
        <input type="hidden" name="_token" id="token-edit" value="{{ csrf_token() }}">
        <input type="hidden" value="{{$tar->id}}" id="form-id">
        <input type="hidden" value="{{$tar->duration}}" id="form-duration-hiden">
        <div class="row justify-content-center">
            <div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
                <label>Títol Tarifa</label>
                <input required type="text" class="form-control justify-content-center" id="form-title" placeholder="Títol" value="{{$tar->title}}">
            </div>
            <div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
                <label>Preu Tarifa</label>
                <input required type="number" step=".01" class="form-control" id="form-preu" placeholder="1.0" value="{{$tar->price}}">
            </div>
            <div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
                <label>Duració tarifa mesos</label>
                <select value="{{$tar->duration}}" class="form-control" id="form-duracio">
                  </select>
            </div>
            <div class="form-group col-12">
                <label>Breu descripció de la tarifa uns 100 cracters</label>
                <textarea required class="col-12" id="form-descripcio" rows="3">{{$tar->description}}</textarea>
            </div>
            @php
            $car = unserialize($tar->caracteristiques)
            @endphp
            @for ($i = 0; $i < 6; $i++)
            <div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
                <label>Caracteristica {{$i + 1}}</label>
                <input value="{{$car[$i]}}" type="text" class="form-control justify-content-center" id="form-car{{$i + 1}}" val placeholder="Caracteristica">
            </div>
            @endfor  
            
            <button style="margin-bottom: 20px" style="width:70% !important" type="submit"
        class="btn btn-primary col-xs-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">Editar Tarifa</button>
        </div>
    </form>
</div>
@include('includes.footer')
@stop

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
  $(document).ready(function () {
    for(var i = 1; i < 12; i++){
        if(i === 1) {
            var mes = "mes";
        } else {
            mes = "mesos";
        }
        if (i == $('#form-duration-hiden').val()){
            $('#form-duracio').append('<option selected value=' + i + '>' + i + ' ' + mes + '</option>')
        } else {
            $('#form-duracio').append('<option value=' + i + '>' + i + ' ' + mes + '</option>')
        }
        
    }

      $('.container #createTarifaForm button:submit').on('click', function (e) {
          e.preventDefault();
          var caracteristiques = [$('#form-car1').val(), $('#form-car2').val(), $('#form-car3').val(), $('#form-car4').val(), $('#form-car5').val(), $('#form-car6').val()];
          $.ajax({
              type: "PUT",
              url: "/tarifes/editarTarifa/"+$('#form-id').val()+"/editar",
              data: {
                  titol: $('#form-title').val(),
                  preu: $('#form-preu').val(),
                  duracio: $('#form-duracio').val(),
                  descripcio: $('#form-descripcio').val(),
                  preu: $('#form-preu').val(),
                  carac : caracteristiques, 
                  "_token": $('#token-edit').val(),
              },
              success: function (response) {
                  toastr.success(response.notification.message, "Success");
              },
              error: function (error) {
                  if (error.responseJSON.error == undefined) {
                      toastr.error("error", "Error")
                  } else {
                      toastr.error(error.responseJSON.error, "Error")
                  }
              }
          })
      })
  })

</script>