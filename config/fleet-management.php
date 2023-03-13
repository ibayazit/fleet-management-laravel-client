<?php

return [
    'service_url' => env('FLEET_SERVICE_URL'),
    'session_life_span' => 1800,

    'statuses' => [
        'waiting',
        'started',
        'charging',
        'stopping',
        'stoppped',
        'done',
        'fail'
    ]
];
