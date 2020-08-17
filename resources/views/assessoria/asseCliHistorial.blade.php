
@extends('layouts.main')
@if(Auth::user()->type == 2)
@include('includes.navbars.assNavbar')
@else
@include('includes.navbars.cliNavbar')
@endif
@section('content')
<div class="container">
    @if($asse == "[]")
    <h1 class="col-12" style="text-align: center; margin-top:20px; padding:0px">Historial de assessorias</h1>
    <h4 class="col-12" style="text-align: center; margin-top:20px; padding:0px">De moment no has contractat mai cap assessoria</h4>
    
    @else
    <div class="row justify-content-center">
    <button id="pre" style="text-align: center;" class="col-2  arrow"><i class=" fa fa-arrow-left" aria-hidden="true"></i></button>
        <h1 class="col-8" style="text-align: center; margin-top:20px; padding:0px">Historial de {{$asse->last()->user->name}}</h1>
    <button id="next" class=" disabled col-2 arrow"><i class=" fa fa-arrow-right" aria-hidden="true"></i></button>
    </div>
    <div class="row ">
        <div class="table-center col-md-7 col-sm-12">
            <h4 style="text-align: center; margin-top:20px">Dades assessoria</h4>
            <table class="table-text-center table table-bordered  ">
                <tbody>
                    <tr>
                        <th scope="row">Tarifa Contractada</th>
                        <td id="tar-name">{{$asse->last()->dades_Tarifa->title}}</td>
                    </tr>
                    <tr>
                    <tr>
                        <th scope="row">Assessor</th>
                        <td id="ass-name">{{$asse->last()->assessor->user->name}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Pes</th>
                        <td id="pes">{{$asse->last()->pes}} kg</td>
                    </tr>
                    <tr>
                        <th scope="row">Altura</th>
                        <td id="altura">{{$asse->last()->altura}} m</td>
                    </tr>
                    <tr>
                        <th scope="row">Edat</th>
                        <td>{{$asse->last()->user->age()}} anys</td>
                    </tr>
                    <tr>
                        <th scope="row">Sexe</th>
                        <td>{{$asse->last()->user->sexe}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Data inici</th>
                        <td id="data">{{date('d/m/y', strtotime($asse->last()->data_inici))}}</td>
                    </tr>
                </tbody>
            </table>
            @if($asse->last()->comentari_client != null)
                <h4 style="text-align: center; margin-top:20px">Comentari del client</h4>
                <p id="cli">{{$asse->last()->comentari_client}}</p>
            @endif
            @if($asse->last()->comentari_assessor != null)
                <h4 style="text-align: center; margin-top:20px">Comentari de l'assessor</h4>
                <p id="ass">{{$asse->last()->comentari_assessor}}</p>
            @endif
        </div>
        <div class="col-md-5 col-sm-12">
            <h4 style="text-align: center; margin-top:20px">Imatge actual</h4>
            @if($asse->last()->image != null)
            <img id="img" class="img-actual" src="{{ url('/progress/'.$asse->last()->image) }}" alt="">
            @else
            <img id="img" style="display: none" class="img-actual" src="{{ url('/progress/'.$asse->last()->image) }}" alt="">
            @endif

        </div>
    </div>
    <h4 style="text-align: center; margin-top:20px">Documents</h4>
        <div class="row justify-content-center">
            <a id="rutina" class="download col-md-4 col-sm-5"  {{$asse->last()->fitxer_rutina != null ? "href=/descarregarRutina/" . $asse->last()->fitxer_rutina : ""}}>Descarregar rutina</a>
            <a id="dieta" class="download col-md-4 col-sm-5"{{$asse->last()->fitxer_dieta != null ? "href=/descarregarDieta/" . $asse->last()->fitxer_dieta : ""}} >Descarregar dieta</a>
        </div>
    <h4 style="text-align: center; margin-top:20px">Estadistiques de progres</h4>
        <div id="chart_div"></div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="{{URL::asset('js/charts.js')}}"></script>
<script>
    
    var data = {!! json_encode($asse) !!};
    console.log(data);
    var i = data.length;
    function canviarDades(data, i){
        $("#tar-name").html(data[i - 1].dades_Tarifa.title)
            if(data[i - 1].image == null){
                $("#img").css("display", "none")
            } else{
                $("#img").show();
            }
            src = "/progress/" + data[i - 1].image;
            $("#img").attr('src', src)
            $("#ass-name").html(data[i - 1].assessor.user.name)
            $("#pes").html((data[i - 1].pes != null) ? data[i - 1].pes + " kg" : "")
            $("#altura").html((data[i - 1].altura != null) ? data[i - 1].altura + " m" : "")
            formatData = data[i - 1].data_inici.split(" ")[0].split("-")
            $("#data").html(formatData[2] + "/" + formatData[1] + "/" + formatData[0][2] + formatData[0][3])
            $("#cli").html((data[i - 1].comentari_client != null) ? data[i - 1].comentari_client : "")
            $("#ass").html((data[i - 1].comentari_assessor != null) ? data[i - 1].comentari_assessor : "")
            if(data[i - 1].fitxer_rutina != null){
                $("#rutina").attr('href', "/descarregarRutina/" + data[i - 1].fitxer_rutina);
            } else{
                $("#rutina").removeAttr('href')
            }
            if(data[i - 1].fitxer_dieta != null){
                $("#dieta").attr('href', "/descarregardieta/" + data[i - 1].fitxer_dieta)
            } else {
                $("#dieta").removeAttr('href')
            }

    }
    
        $( "#next" ).click(function() {
            if(i < data.length){
                i++;
                canviarDades(data, i)

                if(i == data.length){
                    $('#next').addClass("disabled");
                }
                if(i !== 1){
                    $('#pre').removeClass("disabled");
                }
            }
        });
    
    
    $( "#pre" ).click(function() {
        if(i > 1){
            i--;
           canviarDades(data, i)
            

            if(i == 1){
                $('#pre').addClass("disabled");
            }
            if(data.length > i){
                $('#next').removeClass("disabled");
            }
        }
    });
var dataChart = [];
for( var i = 0; i < data.length; i++){
    formatData = data[i].data_inici.split(" ")[0].split("-");
    var pes = data[i].pes;
    dataChart.push([formatData[2] + "/" + formatData[1], parseFloat(pes)]);
}
    
var chartwidth = $('.container').width();
  // Load the Visualization API and the corechart package.
  google.charts.load('current', {'packages':['corechart']});
  function drawChart() {
    // Define the chart to be drawn.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Month');
    data.addColumn('number', 'Pes');
    data.addRows(dataChart);
       
    // Set chart options
    var options = {'title' : 'Pes per cada mes',
    vAxis: {
            viewWindowMode:'explicit',
            viewWindow: {
              min:0
            }
        },
       hAxis: {
          title: 'Data'
       },
       'width':chartwidth,
       'height':400	  
    };

    // Instantiate and draw the chart.
    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
    chart.draw(data, options);
 }
 google.charts.setOnLoadCallback(drawChart);

    
</script>

@endif
@include('includes.footer')
@stop

<style>
    .footer{
        left: 0px !important;
        right: 0px !important;
    }
    .img-actual{
        display: block;
        margin: auto;
        width: 80%;
        border: 2px solid #0787ff2c;
    }
    .download{
    text-align: center;
    text-decoration: none;
    color: white;
    display:block;
    background-color: #2dd4fa;
    border: 2px solid #044d92;
    padding: 5px !important;
    margin: 5px;
}
.download:hover{
    text-decoration: none;
    background-color: #2db2fa;
}
.arrow{
    color: #0061bd;
    margin-top: 10px;
    font-size: 40px;
    padding: 0px;
    padding: 0px;
    border: none;
    background-color: #f8fafc;;
}
.arrow:focus{
    outline: none;
}
.arrow:hover{
    color: #00417e;;
    margin-top: 10px;
    font-size: 40px;
    padding: 0px;
    padding: 0px;
}
.disabled{
    color: #1c436896 !important;
}
</style>
