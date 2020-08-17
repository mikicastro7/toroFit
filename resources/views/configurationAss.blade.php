@extends('layouts.main')
@include('includes.navbars.assNavbar')
@section('content')

<div class="container" style="margin-top:30px">
    <h1 style="text-align:center">Configuració bàsica Assessor</h1>

    <form id="editAssForm">
        <input type="hidden" name="_token" id="token-edit" value="{{ csrf_token() }}">
        <div class="row justify-content-center">
            <div class="form-group col-xs-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
                <label for="exampleInputEmail1">Breu Descripció de 140 caràcters màxim</label>
                <textarea id="form-description" rows="4" cols="50"
                    class="form-control justify-content-center">{{ isset($user->assessor->description) ? $user->assessor->description : 'descripcio' }}</textarea>
            </div>
        </div>
        <p style="text-align:center">Selecciona les etiquetes que t'identifiquen</p>
        <div style="margin:auto" class="row justify-content-center col-xs-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">

            @foreach ($etiquetes as $et)
            <div class="form-check form-check-inline ">
                @if (isset($user->assessor->etiquetas))
                @foreach($user->assessor->etiquetas as $ets)
                @if ($ets->id == $et->id)
                <input checked class="form-check-input" type="checkbox" id="form-etiquetes" value="{{$et->id}}">
                <label class="form-check-label" for="inlineCheckbox1">{{$et->name}}</label>
                @php ($i = 1)
                @break
                @else
                @php ($i = 0)
                @endif
                @endforeach
                @if($i == 0)
                <input class="form-check-input" type="checkbox" id="form-etiquetes" value="{{$et->id}}">
                <label class="form-check-label" for="inlineCheckbox1">{{$et->name}}</label>

                @endif
            </div>
            @else
            <input class="form-check-input" type="checkbox" id="form-etiquetes" value="{{$et->id}}">
            <label class="form-check-label" for="inlineCheckbox1">{{$et->name}}</label>
        </div>
        @endif
        @endforeach
</div>
<div style="margin-top:15px" class="row justify-content-center">
    <button style="width:70% !important" type="submit"
        class="btn btn-primary col-xs-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">Submit</button>
</div>
</form>
</div>

@stop
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>

  
  $(document).ready(function () {
      $('.container #editAssForm button:submit').on('click', function (e) {
          e.preventDefault();
          var etiquetes = [];
          $(':checkbox:checked').each(function(i){
            etiquetes[i] = $(this).val();
          });
          $.ajax({
              type: "PUT",
              url: "/assConfiguration/edit",
              data: {
                  description: $('#form-description').val(),
                  etiquetes: etiquetes,
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