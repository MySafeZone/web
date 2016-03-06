<!-- Navigation -->
<div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header page-scroll">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
            <img src="/img/logo_rond.svg" alt="My safe zone" />
            @if (Auth::check())
                <a  href="{{ secure_url('/home') }}">My Safe Zone</a>
            @else
                <a  href="{{ secure_url('/') }}">My Safe Zone</a>
            @endif
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
            <li class="hidden">
                <a href="#page-top"></a>
            </li>
            @if (Auth::check())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->email }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="page-scroll" href="{{ secure_url('settings') }}">Settings</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="page-scroll" href="{{ secure_url('home') }}"></a>
                </li>
                <li>
                    <a class="page-scroll" href="{{ secure_url('logout') }}">
                        Sign-out
                        <i class="fa fa-sign-out "></i>
                    </a>
                </li>
            @else
                <li>
                    <a class="page-scroll" href="{{ secure_url('login') }}">Login</a>
                </li>
                <li>
                    <a class="page-scroll" href="{{ secure_url('register') }}">Register</a>
                </li>
            @endif
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</div>
<!-- /.container-fluid -->
