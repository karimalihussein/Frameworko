<?php


use League\Route\RouteGroup;
use League\Route\Router;
use Psr\Container\ContainerInterface;

return static function(Router $router, ContainerInterface $container) {

    $router->middleware($container->get('csrf'));

    $router->group('/auth', function (RouteGroup $route) {
        $route->map('GET', '/register', [\App\Http\Controllers\Auth\RegisterController::class, 'index']);
        $route->map('POST', '/register', [\App\Http\Controllers\Auth\RegisterController::class, 'store']);
        $route->map('GET', '/login', [\App\Http\Controllers\Auth\LoginController::class, 'index']);
        $route->map('POST', '/login', [\App\Http\Controllers\Auth\LoginController::class, 'store']);
    })->middleware(new \App\Http\Middleware\RedirectIfAuthenticatedMiddleware());

    $router->group('/', function (RouteGroup $route) {
        $route->map('GET', '/', \App\Http\Controllers\HomeController::class);
        $route->map('GET', '/about', \App\Http\Controllers\AboutController::class);
        $route->map('GET', '/users/{user}', \App\Http\Controllers\UserController::class);
        $route->map('POST', '/auth/logout', \App\Http\Controllers\Auth\LogoutController::class);
    })->middleware(new \App\Http\Middleware\RedirectIfGuestMiddleware());
};