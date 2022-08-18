@include('layouts.meta')
    <nav class="navbar navbar-default navbar-fixed-top navbar-sam">
        <div class="container nav-buttons">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                @if (!Auth::guest())
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"  id="menu-toggle">
                      <span class="fa fa-th-large" aria-hidden="true"></span>
                </button>
                <button id="navbarHome" type="button" class="navbar-toggle collapsed navbarButton">
                      Início
                </button>
                @else
                <button id="navbarRegister" type="button" class="navbar-toggle collapsed navbarButton">
                      Registrar
                </button>
                <button id="navbarLogin" type="button" class="navbar-toggle collapsed navbarButton">
                      Entrar
                </button>
                @endif

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">SAM</a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Início</a></li>
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Entrar</a></li>
                        <li><a href="{{ url('/register') }}">Registrar</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>