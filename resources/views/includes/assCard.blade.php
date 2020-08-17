<link href="{{ asset('css/assCard.css') }}" rel="stylesheet">
<div class='container'>
    <h1>Els nostres assesors per estar com un toro</h1>
    @if (!empty($message))
    <div class="alert alert-{{$messageType}}" role="alert">
        <span>{{$message}}</span>
    </div>
    @endif
    <div class='assessors'>
        @if($users == "[]")
        <h4 style="text-align: center; margin-top:70px">No s'han trobat assessors que coincideixin amb els paràmetres
            </h6>
            @endif
            @foreach ($users as $ass)
            @if (isset($ass->assessor))
            <div class='assessor row'>
                <div class='usu-data col-lg-1 col-md-2 col-sm-2 col-xs-12'>
                    <img class='img-perf' src="/storage/perfil_image/{{$ass->perfil_image}}" alt="">
                    <br>
                    <span class='us-name'>{{$ass->name}}</span>
                </div>
                <span class='descrip col-lg-6 col-md-7 col-sm-10 col-xs-12'>{{$ass->assessor->description}}</span>
                <div class='ets col-lg-2 col-md-3 col-sm-4 col-8'>
                    @for ($i = 0; $i < 3; $i++)
                        <span>{{$ass->assessor->etiquetas[$i]->name}}</span> <br>
                        @if(!!!isset($ass->assessor->etiquetas[$i + 1]))
                        @break
                        @endif
                        
                    @endfor


                </div>
                <div class='pun col-lg-1 col-md-2 col-sm-3 col-4'>
                    <i class="pun-star fa fa-star" aria-hidden="true"></i>
                    <br>
                    <span>{{$ass->assessor->avgRating}}</span>
                </div>
                <div class='btns col-lg-2 col-md-10 col-sm-5 col-12'>
                    <form action="/tarifes/{{$ass->id}}">
                        <button class='btn-conperf btn-con'>Contractar</button>
                    </form>
                    <form action="/perfilAss/{{$ass->id}}">
                        <button class='btn-conperf btn-perf'>Perfil</button>
                    </form>
                </div>

            </div>
            @endif

            @endforeach
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    var cmrespon =  $('.alert');
    cmrespon.fadeTo(5000, 0.8, function(){
    cmrespon.stop(true)
    cmrespon.css('opacity', '1')
    cmrespon.css('display', 'none')
});
</script>