# Laravel Analytics

> 🚧 This package is still a work in progress

A simple, extremely lightweight analytics package.

## Requirements

- Laravel 10+

## Installation

Install using Composer:

```shell
composer require rvxlab/laravel-analytics
```

Publish and run the migrations:

```shell
php artisan vendor:publish --tag="analytics-migrations"

php artisan migrate
```

**Optional**: Publish the config file:

```shell
php artisan vendor:publish --tag="analytics-config"
```

## Setting up

There are 2 ways of setting up analytics:

1. Globally
2. In a route group

### Globally (Laravel 11)

Add the `RVxLab\Analytics\Middleware\RecordPageView` middleware by calling `append` or `appendToGroup` on the `Illuminate\Foundation\Configuration\Middlewares` parameter of the `withMiddleware` call:

```php
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
use RVxLab\Analytics\Middleware\RecordPageView;

return Application::configure(basePath: dirname(__DIR__))
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append([RecordPageView::class]);
        // OR
        $middleware->appendToGroup('<middlewareGroup>', [RecordPageView::class]);
    })->create();
```

### Globally (Laravel 10 and 11 without the new slim skeleton)

Add the `RVxLab\Analytics\Middleware\RecordPageView` middleware to the end of your `middleware` array or the relevant group in your `middlewareGroups` array of your `App\Http\Kernel`:

```php
namespace App\Http;

use RVxLab\Analytics\Middleware\RecordPageView;

class Kernel 
{
    protected $middleware = [
        // --snip--
        RecordPageView::class,
    ];

    protected $middlewareGroups = [
        'web' => [
            // --snip--
            RecordPageView::class,
        ],
    ];
}
```

### Per route

You can add the `RVxLab\Analytics\Middleware\RecordPageView` middleware to a single route or to a group of routes:

```php
use App\Http\Controllers\HomeController;
use RVxLab\Analytics\Middleware\RecordPageView;

Route::get('/', HomeController::class)->middleware([RecordPageView::class]);

// OR

Route::middleware([RecordPageView::class])->group(function () {
    Route::get('/', HomeController::class);
});
```

### Dealing with proxies

If your application is behind a proxy, make sure that proxy is defined in the trusted proxies.

Not doing so will cause the address in your analytics to always be `127.0.0.1`.

For example, if you use a simple site provisioned through Laravel Forge, you will want to add `'127.0.0.1'` to your trusted proxies. If you're behind a load balance through AWS or go through CloudFlare, you may not know what IP the request will come from. In that case, just add `'*'` to your trusted proxies.

See [the Laravel documentation on trusted proxies](https://laravel.com/docs/11.x/requests#configuring-trusted-proxies) for more information.

## Using a separate database

If you wish to use a separate database for analytics, add an `ANALYTICS_DB_CONNECTION` environment variable and set it to the connection you want to use. Make sure it exists in your `config/database.php` file.

## Changelog

Please see the [Changelog](./CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see the [License File](./LICENSE.md) for more information.

