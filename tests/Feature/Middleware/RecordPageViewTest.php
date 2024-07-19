<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Exceptions;
use RVxLab\Analytics\Models\AnalyticsEvent;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseEmpty;
use function Pest\Laravel\get;
use function Pest\Laravel\withoutExceptionHandling;

it('can record a page view', function () {
    assertDatabaseEmpty(config('analytics.database.table_names.analytics_events'));

    get('/')->assertOk();

    assertDatabaseCount(config('analytics.database.table_names.analytics_events'), 1);
});

it('does not crash when adding a page view fails', function () {
    withoutExceptionHandling();

    AnalyticsEvent::saving(fn () => throw new Exception('Whoops!'));

    get('/');
})->throwsNoExceptions();

it('reports any thrown exceptions', function () {
    Exceptions::fake();
    AnalyticsEvent::saving(fn () => throw new Exception('Whoops!'));

    assertDatabaseEmpty(config('analytics.database.table_names.analytics_events'));

    get('/')->assertOk();

    assertDatabaseEmpty(config('analytics.database.table_names.analytics_events'));

    Exceptions::assertReported(fn (Exception $e) => $e->getMessage() === 'Whoops!');
})->skip(function () {
    [$major, $minor] = array_map(intval(...), explode('.', app()->version()));

    return !($major >= 11 && $minor >= 4);
});
