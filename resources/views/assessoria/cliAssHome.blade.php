@extends('layouts.main')
@include('includes.navbars.cliNavbar')
@section('content')
<div class="container">
    <div class="row">

            <a class="img-container col-md-5 col-sm-12" href="/cliAssessoria/entrarDades">
                <i class="fa icona fa-pencil" aria-hidden="true"></i>
                <h3>Entrar dades</h3>
            </a>
            
        
            <a class="img-container col-md-5 col-sm-12" href="/cliHistorial/">
                <i class="fa icona fa-history" aria-hidden="true"></i>
                <h3>Progress i historial</h3>
            </a>
    </div>
</div>
@include('includes.footer')
@stop

<style>
    a{
        text-align: center
    }
    .imgs{
        width: 100%;
    }
    .img-container{
        background-color: white;
        margin: 30px;
        border: 1px solid #0787ff2c;
    }
    .img-container:hover{
        border: 4px solid #0787ff2c;
    }
    .icona{
        color: #009de5;
        font-size: 200px !important;
        margin: auto !important;
        display: inline-block !important;
        width: 100% !important;
    }
    a h3{
        color: black;
        font-weight: bold
    }
</style>
