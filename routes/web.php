<?php


use League\Route\RouteGroup;
use League\Route\Router;
use Psr\Container\ContainerInterface;

return static function(Router $router, ContainerInterface $container) {
    $router->middleware($container->get('csrf'));
    $router->map('GET', '/', \App\Http\Controllers\HomeController::class)->middleware(new \App\Http\Middleware\RedirectIfGuestMiddleware());
    $router->map('GET', '/about', \App\Http\Controllers\AboutController::class);
    $router->map('GET', '/users/{user}', \App\Http\Controllers\UserController::class);

    $router->group('/', function (RouteGroup $route) {
        $route->map('GET', '/auth/register', [\App\Http\Controllers\Auth\RegisterController::class, 'index']);
        $route->map('POST', '/auth/register', [\App\Http\Controllers\Auth\RegisterController::class, 'store']);
        $route->map('GET', '/auth/login', [\App\Http\Controllers\Auth\LoginController::class, 'index']);
        $route->map('POST', '/auth/login', [\App\Http\Controllers\Auth\LoginController::class, 'store']);
    })->middleware(new \App\Http\Middleware\RedirectIfAuthenticatedMiddleware());

    $router->map('POST', '/auth/logout', App\Http\Controllers\Auth\LogoutController::class);
};