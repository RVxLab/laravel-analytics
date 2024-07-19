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

**Optional**: Publish the migrations and config file. Unless you have a reason to do this, you should skip this.

```shell
php artisan vendor:publish --tag="analytics-config" --tag="analytics-migrations"
```
Run the migrations:

```shell
php artisan migrate
```

## Setting up

Add the `\RVxLab\Analytics\Middleware\RecordPageView` middleware to the route(s) you wish to record pageviews for or apply it globally.

## Using a separate database

If you wish to use a separate database for analytics, add an `ANALYTICS_DB_CONNECTION` environment variable and set it to the connection you want to use. Make sure it exists in your `config/database.php` file.


## Changelog

Please see the [Changelog](./CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see the [License File](./LICENSE.md) for more information.

