<?php


use League\Route\Router;
use Psr\Container\ContainerInterface;

return static function(Router $router, ContainerInterface $container) {
    $router->middleware($container->get('csrf'));
    $router->map('GET', '/', \App\Http\Controllers\HomeController::class)->middleware(new \App\Http\Middleware\ExampleMiddleware());
    $router->map('GET', '/about', \App\Http\Controllers\AboutController::class);
    $router->map('GET', '/users/{user}', \App\Http\Controllers\UserController::class);
    $router->map('GET', '/auth/register', [\App\Http\Controllers\Auth\RegisterController::class, 'index']);
    $router->map('POST', '/auth/register', [\App\Http\Controllers\Auth\RegisterController::class, 'store']);
    $router->map('GET', '/auth/login', [\App\Http\Controllers\Auth\LoginController::class, 'index']);
    $router->map('POST', '/auth/login', [\App\Http\Controllers\Auth\LoginController::class, 'store']);
    $router->map('POST', '/auth/logout', App\Http\Controllers\Auth\LogoutController::class);
};