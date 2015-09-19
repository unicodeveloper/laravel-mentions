# Laravel Mentions

[![Latest Stable Version](https://poser.pugx.org/busayo/laravel-mentions/v/stable.svg)](https://packagist.org/packages/busayo/laravel-mentions)
[![Latest Unstable Version](https://poser.pugx.org/busayo/laravel-mentions/v/unstable.svg)](https://packagist.org/packages/busayo/laravel-mentions)
[![License](https://poser.pugx.org/busayo/laravel-mentions/license.svg)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/busayo/laravel-mentions.svg)](https://travis-ci.org/busayo/laravel-mentions)
[![Quality Score](https://img.shields.io/scrutinizer/g/busayo/laravel-mentions.svg?style=flat-square)](https://scrutinizer-ci.com/g/busayo/laravel-mentions)
[![Total Downloads](https://img.shields.io/packagist/dt/busayo/laravel-mentions.svg?style=flat-square)](https://packagist.org/packages/busayo/laravel-mentions)

This package makes it possible to create text/textarea fields that enable **mentioning** by using [At.js](https://github.com/ichord/At.js).

The data for the autocomplete is loaded from a route which will load data based on predefined key-value pairs of an alias and a model in the config.

## Installation

First, pull in the package through Composer.

```js
"require": {
    "busayo/laravel-mentions": "1.0.*"
}
```

And then include these service providers within `config/app.php`.

```php
'providers' => [
    Busayo\Mention\MentionServiceProvider::class,
    Collective\Html\HtmlServiceProvider::class,
];
```

If you need to modify the configuration or the views, you can run:

```bash
php artisan vendor:publish
```

The package views will now be located in the `app/resources/views/vendor/mentions/` directory and the configuration will be located at `config/mentions.php`.

## Configuration

To make it possible for At.js to load data we need to define key-value pairs that consist of an alias and a corresponding model.

```php
return [

    'users'    => 'App\User',      // responds to /api/mentions/users
    'friends'  => 'App\Friend',    // responds to /api/mentions/friends
    'clients'  => 'App\Client',    // responds to /api/mentions/clients
    'supports' => 'App\Supporter', // responds to /api/mentions/supports

];
```

So now with these `aliases` configured we could create a new textfield which will send a request to the `users` route and search for matching data in the `name` column.

```php
{!! mention()->asText('recipient', old('recipient'), 'users', 'name') !!}
```

## Example

```html
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Laravel PHP Framework</title>
        <link rel="stylesheet" type="text/css" href="/css/jquery.atwho.min.css">
         <!-- Requirements -->
        <script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="/js/jquery.atwho.min.js"></script>
        <script src="/js/jquery.caret.min.js"></script>
        <!-- Laravel Mentions -->
        @include('mentions::assets')
    </head>

    <body>
        <div class="container">
            {!! mention()->asText('recipient', old('recipient'), 'users', 'name') !!}
            {!! mention()->asTextArea('message', old('message'), 'users', 'name') !!}
        </div><!-- /.container -->
    </body>
</html>
```


## Install

Via Composer

``` bash
$ composer require busayo/laravel-mentions
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.


## Credits

- [Prosper Otemuyiwa](https://twitter.com/unicodeveloper)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

