@extends('layouts.main')
@include('includes.navbars.cliNavbar')
@section('content')
<div class="container">
    <h1 style="text-align: center; margin: 20px">Resum de contractació</h1>
<div class="table-center">
    <table class="table-text-center table table-bordered col-md-6 col-sm-12 ">
        <tbody>
            <tr>
                <th scope="row">Nom de l'assessor</th>
                <td>{{$tar->assessors->user->name}}</td>
              </tr>
            <tr>
            <tr>
                <th scope="row">Nom de la Tarifa</th>
                <td>{{$tar->title}}</td>
              </tr>
            <tr>
            <th scope="row">Preu:</th>
            <td>{{$tar->price}} €</td>
          </tr>
          <tr>
            <th scope="row">duració</th>
          <td>{{$tar->duration}} mesos</td>
          </tr>
        </tbody>
      </table>
</div class="row center-button">
<a class="create-tarifa col-md-6 col-sm-12" href="/payment">Confirmar Tarifa i fer el pagament</a>
</div>
@include('includes.footer')
@stop

<style>
    .table-center{
        display: flex;
        align-items: center;
        justify-content: center;
    }
    table{
        text-align: center
    }
    .create-tarifa{
    text-align: center;
    text-decoration: none;
    color: white;
    display:block;
    background-color: #2dd4fa;
    border: 2px solid #044d92;
    padding: 5px !important;
    margin: auto;
}
    .create-tarifa:hover{
        text-decoration: none;
        background-color: #2db2fa;
    }
</style>