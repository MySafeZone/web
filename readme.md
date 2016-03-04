# Leter

## About

Leter is a secure sensitive information disclosure system.  

You can try it at [leter.io](https://leter.io).

## Requirements

Leter is based on the [Laravel framework](https://github.com/laravel/laravel) and thus shares its requirements:

 * PHP >= 5.5.9
 * OpenSSL PHP Extension
 * PDO PHP Extension
 * Mbstring PHP Extension
 * Tokenizer PHP Extension
 * MySQL

## Installation

```
> git clone git@github.com:Letersecure/leter.git
> cd leter
> mkdir -p bootstrap/cache
> composer install
> cp .env.example .env
> vi .env
> php artisan migrate
> php artisan serve
```

## Third-party

* [Laravel](https://github.com/laravel/laravel) - MIT License
* [ramsey/uuid](https://github.com/ramsey/uuid) - MIT License
* [pragmarx/google2fa](https://github.com/antonioribeiro/google2fa) - BSD 3-Clause License
* [graham-campbell/markdown](https://github.com/GrahamCampbell/Laravel-Markdown) - MIT License
* [OpenPGP.js](https://github.com/openpgpjs/openpgpjs) - GPL 3 License
* [secrets.js](https://github.com/amper5and/secrets.js/) - MIT License
* [JavaScript MD5](https://github.com/blueimp/JavaScript-MD5) - MIT Licence
* [Bootstrap](http://getbootstrap.com) - MIT License
* [jQuery](https://jquery.com) - MIT License
* [jQuery Easing](http://gsgd.co.uk/sandbox/jquery/easing/) - BSD License
* [jQuery ButtonLoader](http://www.jqueryscript.net/loading/jQuery-Plugin-For-Built-In-Loading-Indicator-In-Buttons-Button-Loader.html) - MIT License
* [classie](https://github.com/desandro/classie) - MIT License
* [cbpAnimatedHeader](http://www.codrops.com) - MIT License
* [Start Bootstrap - Agency](https://github.com/BlackrockDigital/startbootstrap-agency) - MIT License


## Security Vulnerabilities

If you discover a security vulnerability within Leter, please send an e-mail to [admin@leter.io](mailto:admin@leter.io). All security vulnerabilities will be promptly addressed.


## Issues

Bug reports and feature requests can be submitted on the [Github Issue Tracker](https://github.com/Letersecure/leter/issues).

## Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md) for information.


## License

Leter is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).