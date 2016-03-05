<!DOCTYPE html>
<html lang="en">
@include('layouts.head')

<body id="app-layout">   
    <nav class="navbar navbar-default navbar-static-top navbar-background">
        @include('layouts.navbar')
	</nav>

    <div class="container">
        @yield('content')
    </div>
    
    <!-- JavaScripts -->
    <script src="/js/app.js"></script>
    @yield('javascripts')
</body>
</html>
