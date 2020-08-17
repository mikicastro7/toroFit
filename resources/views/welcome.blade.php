@extends('layouts.main')
@include('includes.navbars.iniNavbar')
@section('content')
<div class="full-container">
    <h1 style="text-align: center; margin-top: 20px">Toro fit assessorias</h1>
    <!--<img class="center" src="{{ URL::to('/') }}/images/logonoback.png"> -->
    <div id="carouselExampleIndicators" class="carousel slide caro" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="{{ URL::to('/') }}/images/torofit-1.png" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>Inicia de sessió i registra de usuaris</h5>
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{ URL::to('/') }}/images/torofit-2.png" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
              <h5>Guardar, mostrar dades i imatges</h5>
          </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{ URL::to('/') }}/images/torofit-3.png" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
              <h5>Gràfiques i descarregar fitxers</h5>
          </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{ URL::to('/') }}/images/torofit-4.png" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
              <h5>Panell simple amb botons funcionals</h5>
          </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{ URL::to('/') }}/images/torofit-5.png" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
              <h5>Pagament amb API de Paypal</h5>
          </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{ URL::to('/') }}/images/torofit-6.png" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
              <h5>Formularis amb AJAX</h5>
          </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
</div>


@include('includes.footer')
@stop
<style>
    .carousel-inner{
        height: 100%;
        margin-bottom: 150px;
    }
    .caro{
        margin: 30px;
    }
    .caro img{
        border: 1px solid black;
        width: 100%;
        height: 90%;
        
    }
    .carousel-caption h5{
        color: black;
        font-weight: bolder;
        font-size: 24px;
    }
    .full-container{
        width: 95%;
        margin: auto;
        padding-bottom: 100px;
    }
    .
</style>