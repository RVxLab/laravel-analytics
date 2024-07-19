<?php

declare(strict_types=1);

namespace RVxLab\Analytics\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use RVxLab\Analytics\AnalyticsServiceProvider;
use RVxLab\Analytics\Middleware\RecordPageView;

abstract class TestCase extends BaseTestCase
{
    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array<int, class-string<\Illuminate\Support\ServiceProvider>>
     */
    protected function getPackageProviders($app)
    {
        return [
            AnalyticsServiceProvider::class,
        ];
    }

    /**
     * Define routes setup.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    protected function defineRoutes($router)
    {
        $router->get('/')->middleware(RecordPageView::class);
    }
}
