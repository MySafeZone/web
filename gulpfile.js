var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
	mix.styles(['fonts_app.css', 'bootstrap.min.css', 'font-awesome.min.css', 'app.css', 'buttonLoader.css', 'Supernice.css'], 'public/css/app.css');
	mix.styles(['fonts_home.css', 'bootstrap.min.css', 'font-awesome.min.css', 'home.css'], 'public/css/home.css');
	
    mix.scripts(['jquery-2.2.0.min.js', 'bootstrap.min.js', 'jquery.buttonLoader.js', 'leter.js'], 'public/js/app.js');
    mix.scripts(['jquery-2.2.0.min.js', 'bootstrap.min.js', 'jquery.easing.1.3.js', 'classie.js', 'cbpAnimatedHeader.js'], 'public/js/home.js');
    mix.scripts(['openpgp.min.js', 'secrets.min.js', 'leter_crypto.js', 'md5.min.js'], 'public/js/crypto.js');
});
