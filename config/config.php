<?php

declare(strict_types=1);

return [
    'database' => [
        /*
         * The connection to use for analytics
         *
         * By default, the default connection of the application is used.
         */
        'connection' => env('ANALYTICS_DB_CONNECTION'),

        /*
         * The names of the tables
         */
        'table_names' => [
            'analytics_events' => 'analytics_events',
        ],
    ],
];
