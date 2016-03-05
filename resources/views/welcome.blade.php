<!DOCTYPE html>
<html lang="en">
    @include('layouts.head')

<body id="page-top" class="index">
    <nav class="navbar navbar-default navbar-fixed-top">
        @include('layouts.navbar')
   </nav>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                <div class="intro-heading">Protect your data</div>
                <div class="intro-lead-in">Keep calm and keep you safe</div>
                <a href="{{ secure_url('register') }}" class="page-scroll btn btn-xl">I'm interested</a>
<a href="https://localhost:8000/register" class="btn mobile-app"><img src="/img/Download_on_the_App_Store_Badge_US-UK_135x40.svg" alt="My safe zone ios application">
                      </a>
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
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-lock fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Locker</h4>
                    <p class="text-muted">You own your data</p>
                    <p class="text-muted">Share your data with trusted third party</p>
                    <p class="text-muted">Choose who you'll share your information with and how many of them are required to decrypt it. Stay in control. Release whenever you're ready, or delete the whole case.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-shield fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Encrypted data</h4>
                    <p class="text-muted">Every document is encrypted client side on the fly</p>
                    <p class="text-muted">Document is deleted from the device after upload</p>
                    <p class="text-muted">You're the only owner of your key</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-cloud fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Secure cloud</h4>
                    <p class="text-muted">Only encrypted data are stored on the cloud</p>
                    <p class="text-muted">Your key is needed to to decrypt data</p>
                </div>
            </div>
        </div>
        
        <div class="container">
            <div class="jumbotron">
                <div class="row">
                    <div class="nonprofit">
                        <div class="col-md-10 nonprofit-align">
                             <h3>We are a nonprofit organization</h3>
                             <p>We will never make money upon your life</p>
                        </div>
                        <div class="col-md-2 nonprofit-align">
                            <button class="btn btn-default btn-lg" type="submit">Donate now</button>
                        </div>
                    </div>
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

    @include('layouts.footer')
    <script src="/js/home.js"></script>
</body>
</html>
