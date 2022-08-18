	<!-- Navbar -->
    @include('layouts.navbar')
    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper" class="sidebar-wrapper">
            <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
 
                <li id="profile" class="sidebar-item">
                    <a href="{{ url('users/'.Auth::user()->id) }}"><span class="fa-stack fa-lg pull-left"><i class="fa fa-child fa-stack-1x "></i></span> {{ Auth::user()->name }}</a>
                </li>
                @if (!Auth::user()->teacher)
                <li class="active sidebar-item" id="adventure">
                    <a href="{{ url('/home') }}"><span class="fa-stack fa-lg pull-left"><i class="fa fa-exclamation fa-stack-1x "></i></span>Aventura</a>
                </li>
                <li id="achievements" class="sidebar-item">
                    <a href="{{ url('/achievements') }}"><span class="fa-stack fa-lg pull-left"><i class="fa fa-shield fa-stack-1x "></i></span>Classes</a>
                </li>
                @endif
                @if (Auth::user()->teacher)
                <li id="library" class="sidebar-item">
                    <a href="{{ url('/library') }}"><span class="fa-stack fa-lg pull-left"><i class="fa fa-book fa-stack-1x "></i></span>Biblioteca</a>
                </li>

                <li id="classroom" class="sidebar-item">
                    <a href="{{ url('/classroom') }}"><span class="fa-stack fa-lg pull-left"><i class="fa fa-users fa-stack-1x "></i></span>Turma</a>
                </li>
                @endif
                <li id="contact" class="sidebar-item">
                    <a href="{{ url('contacts/create') }}"><span class="fa-stack fa-lg pull-left"><i class="fa fa-envelope fa-stack-1x "></i></span>Contato</a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ url('/logout') }}"><span class="fa-stack fa-lg pull-left"><i class="fa fa-sign-out fa-stack-1x "></i></span>Sair</a>
                </li>
            </ul>
        </div><!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-11 col-md-offset-1">
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
</body>
</html>
