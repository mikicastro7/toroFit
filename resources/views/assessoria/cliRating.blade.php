<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css"> 
<link href="{{ asset('css/cliRating.css') }}" rel="stylesheet">
<link href="{{ asset('css/assCard.css') }}" rel="stylesheet">

@extends('layouts.main')
@include('includes.navbars.cliNavbar')

@section('content')
<div class="container">
    <h1>Puntuacións i comentaris</h1>

    <div class='assessors'>
    <div class='assessor row'>
        <div class='usu-data col-lg-1 col-md-2 col-sm-2 col-xs-12'>
            <img class='img-perf' src="{{ url('/perf_image/'.$assessor->user->perfil_image) }}" alt="">
            <br>
            <span class='us-name'>{{$assessor->user->name}}</span>
        </div>
        <span class='descrip col-lg-6 col-md-7 col-sm-10 col-xs-12'>{{$assessor->description}}</span>
        <div class='ets col-lg-2 col-md-3 col-sm-4 col-8'>
            @for ($i = 0; $i < 3; $i++)
                <span>{{$assessor->etiquetas[$i]->name}}</span> <br>
                @if(!!!isset($assessor->etiquetas[$i + 1]))
                @break
                @endif
                
            @endfor


        </div>
        <div class='pun col-lg-1 col-md-2 col-sm-3 col-4'>
            <i class="pun-star fa fa-star" aria-hidden="true"></i>
            <br>
            <span>{{$assessor->avgRating}}</span>
        </div>
        <div class='puntu col-lg-2 col-md-10 col-sm-5 col-12'>
            <div id="rateYo"></div>
        </div>

    </div>

    </div>
</div>

    


<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script> 
<script> 
    
    
    $("#rateYo").rateYo({ 
        starWidth: "20px",
        rating: data, 
        spacing: "0px", 
        numStars: 5, 
        minValue: 0, 
        maxValue: 5, 
        normalFill: 'black', 
        ratedFill: 'orange', 
        halfStar: true
    }) 
    var data = {!! json_encode($rating) !!};
    $("#rateYo").rateYo("option", "rating", data);
    
    
    $(function () {
        $("#rateYo").rateYo()
            .on("rateyo.set", function (e, data) {
                $.ajax({
              type: "POST",
              url: "/cliAssessoria/rating/editar",
              data: {
                  rating: data,
                  "_token": "{{ csrf_token() }}"
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
        });
    });
</script> 


@include('includes.footer')
@stop
