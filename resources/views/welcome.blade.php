<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Secure sensitive information disclosure system for whistleblowers.">
    <title>Leter.io - Secure sensitive information disclosure system for whistleblowers.</title>
    <link href="/css/home.css" rel="stylesheet" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">

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
                    <img src="/img/logo.svg" alt="Leter Logo" />
                    <a  href="{{ secure_url('/') }}">LETER</a>
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

    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Secure sensitive information disclosure system to</div>
                <div class="intro-heading">protect whistleblowers</div>
                <a href="{{ secure_url('register') }}" class="page-scroll btn btn-xl">I'm interested</a>
            </div>
        </div>
    </header>

    <!-- Services Section -->
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Features You'll Find</h2>
                    <h3 class="section-subheading text-muted"></h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-lock fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Zero-knowledge</h4>
                    <p class="text-muted">We'll never know your secrets and certainly don't want to. Every document is encrypted client side on the fly.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-heartbeat fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Check-ups</h4>
                    <p class="text-muted">Leter lets you set a disclosure trigger pulled if your signs of activity suddenly stop : daily, weekly, monthly...</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-paper-plane fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Disclosure workflow</h4>
                    <p class="text-muted">Choose who you'll share your information with and how many of them are required to decrypt it. Stay in control. Release whenever you're ready, or delete the whole case.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Clients Aside -->
    <aside class="clients bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-6">
                    <a href="https://clever-cloud.com">
                        <img src="/img/logo_clever_cloud.png" class="img-responsive img-centered" alt="">
                    </a>
                </div>
            </div>
        </div>
    </aside>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; Leter.io 2016</span>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <li><a href="https://twitter.com/letersecure"><i class="fa fa-twitter"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li><a href="{{ secure_url('privacy') }}">Privacy Policy</a>
                        </li>
                        <li><a href="{{ secure_url('terms') }}">Terms of Use</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="/js/home.js"></script>
</body>
</html>