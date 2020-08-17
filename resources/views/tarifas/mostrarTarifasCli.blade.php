@extends('layouts.main')
@include('includes.navbars.cliNavbar')
@section('content')
<link href="{{ asset('css/cards.css') }}" rel="stylesheet">
<div class="container">
    <h1 style="text-align: center; margin-top:20px">Tarifes de {{$user->name}} </h1>
    <div class="row justify-content-center">  
        @if($user->assessor->tarifas == "[]")
        <h4 style="text-align: center; margin-top:40px">Aquest assessor de moment no te tarifes</h6>
        @endif
        @foreach ($user->assessor->tarifas as $t)
        <div class="card" style="width: 18rem;">
            <h5 class="card-titol">{{$t->title}}</h5>
            <h6 class="card-duration">Duracio {{$t->duration}}
                @if ($t->duration > 1)
                mesos
            @else
                mes
            @endif 
            <h6>
                    <h6 class="card-price">{{$t->price}}€</h6>
                    <div>

                        <p class="card-description">{{$t->description}}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach (unserialize($t->caracteristiques) as $car)
                        @if($car != null)
                        <li class="list-group-item">{{$car}}</li>
                        @endif
                        @endforeach
                    </ul>

                    <div class="margin-auto">
                        <form action="/contractarTarifa/{{$t->id}}">
                            <button class="btn-con">Contractar</button>
                        </form>
                    </div>


        </div>
        @endforeach
    </div>

</div>
@include('includes.footer')
@stop