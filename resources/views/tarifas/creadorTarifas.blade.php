@extends('layouts.main')
@include('includes.navbars.assNavbar')
@section('content')
<div class="container">
    <h1 style="text-align: center; margin-top:20px">Creador de tarifes</h1>
    <form id="createTarifaForm">
        <input type="hidden" name="_token" id="token-edit" value="{{ csrf_token() }}">
        <div class="row justify-content-center">
            <div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
                <label>Títol Tarifa</label>
                <input required type="text" class="form-control justify-content-center" id="form-title" placeholder="Títol">
            </div>
            <div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
                <label>Preu Tarifa</label>
                <input required type="number" step=".01" class="form-control" id="form-preu" placeholder="1.0">
            </div>
            <div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
                <label>Duració tarifa mesos</label>
                <select class="form-control" id="form-duracio">
                    <option value="1">1 mes</option>
                    <option value="2">2 mesos</option>
                    <option value="3">3 mesos</option>
                    <option value="4">4 mesos</option>
                    <option value="5">5 mesos</option>
                    <option value="6">6 mesos</option>
                    <option value="7">7 mesos</option>
                    <option value="8">8 mesos</option>
                    <option value="9">9 mesos</option>
                    <option value="10">10 mesos</option>
                    <option value="11">11 mesos</option>
                    <option value="12">12 mesos</option>
                  </select>
            </div>
            <div class="form-group col-12">
                <label>Breu descripció de la tarifa uns 100 cracters</label>
                <textarea required class="col-12" id="form-descripcio" rows="3"></textarea>
            </div>
           
            @for ($i = 1; $i < 7; $i++)
            <div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
                <label>Caracteristica {{$i}}</label>
                <input type="text" class="form-control justify-content-center" id="form-car{{$i}}" placeholder="Caracteristica">
            </div>
            @endfor     
            <button style="margin-bottom: 20px" style="width:70% !important" type="submit"
        class="btn btn-primary col-xs-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">Crear Tarifa</button>
        </div>
    </form>
</div>
@include('includes.footer')
@stop
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
  $(document).ready(function () {
      $('.container #createTarifaForm button:submit').on('click', function (e) {
          e.preventDefault();
          var caracteristiques = [$('#form-car1').val(), $('#form-car2').val(), $('#form-car3').val(), $('#form-car4').val(), $('#form-car5').val(), $('#form-car6').val()];
          $.ajax({
              type: "POST",
              url: "/tarifes/crearTarifa/crear",
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
