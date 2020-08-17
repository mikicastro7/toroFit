<link href="{{ asset('css/ininav.css') }}" rel="stylesheet">
<nav class="navbar navback navbar-expand-md">
    <a class="navbar-brand" href="/assHome">
        <img src="{{ URL::to('/') }}/images/logonoback.png" width="60" height="60" alt="">
        <span class="toroFit">ToroFit</span>
    </a>
    <button class="navbar-toggler button-drop" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <i class="fa dropdown-icon fa-chevron-circle-down" aria-hidden="true"></i>
  </button>
    
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link hover-weight" href="/tarifes">Tarifes</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link hover-weight" href="/perfilAss">Perfil</a>
        </li>
    </ul>
      <ul class="navbar-nav navbar-right nav-actions drop-resp-usu">
        
        <li class="nav-item dropdown">
            <a id="navbarDropdown drop-resp" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            

            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <a class="dropdown-item" href="/userConfiguration">Usuari</a>
                <a class="dropdown-item" href="/assConf">Dades Assessor</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</div>

    
</nav>

<style>
#sticky_navigation .navbar-toggler
{
 z-index: 10000;
}

</style>