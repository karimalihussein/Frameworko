<?php

return [
    'name' => env('APP_NAME', 'App'),
    'debug' => env('APP_DEBUG', false),
    'providers' => [
        App\Providers\AppServiceProvider::class,
        App\Providers\RequestServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        App\Providers\PaginationServiceProvider::class,
        App\Providers\ViewServiceProvider::class,
        App\Providers\DatabaseServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        App\Providers\CsrfServiceProvider::class,
        App\Providers\SessionServiceProvider::class,
    ],
];