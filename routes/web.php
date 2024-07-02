<?php


use League\Route\RouteGroup;
use League\Route\Router;
use Psr\Container\ContainerInterface;

return static function(Router $router, ContainerInterface $container) {

    $router->middleware($container->get('csrf'));
    $router->middleware(new \App\Http\Middleware\FlashOldDataMiddleware());

    $router->group('/auth', function (RouteGroup $route) {
        $route->map('GET', '/register', [\App\Http\Controllers\Auth\RegisterController::class, 'index'])->setName('register');
        $route->map('POST', '/register', [\App\Http\Controllers\Auth\RegisterController::class, 'store'])->setName('register.store');
        $route->map('GET', '/login', [\App\Http\Controllers\Auth\LoginController::class, 'index'])->setName('login');
        $route->map('POST', '/login', [\App\Http\Controllers\Auth\LoginController::class, 'store'])->setName('login.store');
    })->middleware(new \App\Http\Middleware\RedirectIfAuthenticatedMiddleware());

    $router->group('/', function (RouteGroup $route) {
        $route->map('GET', '/', \App\Http\Controllers\HomeController::class)->setName('home');
        $route->map('GET', '/users', [\App\Http\Controllers\UserController::class, 'index'])->setName('users');
        $route->map('GET', '/users/{user}', [\App\Http\Controllers\UserController::class, 'show'])->setName('users.show');
        $route->map('POST', '/auth/logout', \App\Http\Controllers\Auth\LogoutController::class)->setName('logout');
    })->middleware(new \App\Http\Middleware\RedirectIfGuestMiddleware());

    
};