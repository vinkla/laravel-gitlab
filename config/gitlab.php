<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | GitLab Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'main' => [
            'token' => 'your-token',
            'base_url' => 'http://git.yourdomain.com/api/v3/',
        ],

        'alternative' => [
            'token' => 'your-token',
            'base_url' => 'http://git.yourdomain.com/api/v3/',
        ],

    ]

];
