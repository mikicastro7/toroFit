<script src="https://cdn.ckeditor.com/4.14.0/full-all/ckeditor.js"></script>
@extends('layouts.main')
@include('includes.navbars.assNavbar')
@section('content')
<div class="container">
    <h1 style="text-align: center; margin-top: 20px">Editor de perfil</h1>
    <h3 style="text-align: center; margin-top: 10px; margin-bottom: 20px">Pots editar el teu perfil per afegir-hi text amb aquest editor</h3>
    <form id="form-edit-perf">
    <input type="hidden" name="_token" id="token-edit" value="{{ csrf_token() }}">
    @if(isset($user->assessor->perfilAssessors))
    <input type="hidden" id="data-body" value='{!!$user->assessor->perfilAssessors->body!!}'>
    @endif
    <textarea id="editor1" name="editor1"></textarea>
    <button style="width:100% !important; margin-top:20px !important; margin-bottom:20px !important; margin:auto" type="submit" class="btn btn-primary col-xs-12">Guardar Canvis</button>
    </form>
</div>
@include('includes.footer')
@stop

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        CKEDITOR.replace( 'editor1' );
        var dataPut = $('#data-body').val();
        CKEDITOR.instances['editor1'].setData(dataPut);
       $('.container #form-edit-perf button:submit').on('click', function (e) {
            e.preventDefault();
            var data = CKEDITOR.instances['editor1'].getData();
            
            $.ajax({
                type: "PUT",
                url: "/perfilAss/editor/editar",
                data: {
                    body : data, 
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