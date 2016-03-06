<!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
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
                    <a  href="{{ secure_url('/') }}">My Safe Zone</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    @if (Auth::check())
                        <li>
                            <a class="page-scroll" href="{{ secure_url('home') }}">{{ Auth::user()->email }}</a>
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
    </nav>
