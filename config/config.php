<?php

declare(strict_types=1);

return [
    /*
     * The connection to use for analytics
     *
     * By default, the default connection of the application is used.
     */
    'db_connection' => env('ANALYTICS_DB_CONNECTION', config('database.default')),
];
