@extends('layouts.main')
@if ($user->type === 1)
  @include('includes.navbars.cliNavbar')
@else
  @include('includes.navbars.assNavbar')
@endif

@section('content')



<div class="container" style="margin-top:30px">
    <h1 style="text-align:center">Configuració de Usuari</h1>

    <form id="editUserForm" >
    <input type="hidden" name="_token" id="token-edit" value="{{ csrf_token() }}">
  <div class="row justify-content-center">
    <div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
      <label>Correu Electronic</label>
      <input type="email" class="form-control justify-content-center" id="form-email" aria-describedby="emailHelp" placeholder="Correu Electronic" value="{{$user->email}}">
    </div>
 
  
    <div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
      <label>Nom Usuari</label>
      <input type="text" class="form-control" id="form-name" aria-describedby="emailHelp" placeholder="Nom Usuari" value="{{$user->name}}">
    </div>
  </div>
  
  <div class="row justify-content-center">
    <div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
      <label>Contrasenya</label>
      <input type="password" class="form-control" id="form-password" placeholder="Contrasenya">
    </div>

    <div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
      <label>Confirmar Contrasenya</label>
      <input type="password" class="form-control" id="form-confirm-password" placeholder="Contrasenya">
    </div>
  </div>

  
  <div class="row justify-content-center">
    <button type="submit" class="btn btn-primary">Confirmar Canvis</button>
  </div>
    </form>
    <br>
    <h1 style="text-align:center">Imatge de perfil</h1>
  <form action="/userConfiguration/uploadImage" enctype="multipart/form-data" method="POST">
    {{ method_field('PUT') }}
    {{csrf_field()}}
    <div class="row justify-content-center">
      <div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
        <label>Selecciona una imatge de perfil recomanablament quadrada</label>
            <div class="custom-file">
              <input name="perfil_image" type="file" class="custom-file-input" id="perfil_image">
              <label class="custom-file-label" for="perfil_image" data-browse="Seleccionar">Penjar imatge</label>
            </div>
      </div>
    </div>
    <h5 style="text-align: center">Imatge actual</h5>
    
    <div class="row justify-content-center">
      <div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
        <img class='img-perf' src="/storage/perfil_image/{{$user->perfil_image}}" alt="">
      </div>
    </div>
    <div class="row justify-content-center">
      <button style="margin-bottom: 20px" type="submit" class="btn btn-primary">Confirmar Imatge</button>
    </div>
  </form>
</div>
@include('includes.footer')

<script>
   $('#perfil_image').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                var cleanFileName = fileName.replace('C:\\fakepath\\', " ");
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(cleanFileName);
            })
</script>
@stop

<style>
  .img-perf{
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 20%;
    border: 1px solid #0787ff2c;
    
  }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
  
  $(document).ready(function () {
      $('.container #editUserForm button:submit').on('click', function (e) {
          e.preventDefault();
          $.ajax({
              type: "PUT",
              url: "/userConfiguration/edit",
              data: {
                  name: $('#form-name').val(),
                  email: $('#form-email').val(),
                  password: $('#form-password').val(),
                  confirmPassword: $('#form-confirm-password').val(),
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

