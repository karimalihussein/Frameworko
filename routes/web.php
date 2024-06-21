<?php


use League\Route\Router;
use Psr\Container\ContainerInterface;

return static function(Router $router, ContainerInterface $container) {
    $router->map('GET', '/', \App\Http\Controllers\HomeController::class);
    $router->map('GET', '/about', \App\Http\Controllers\AboutController::class);
    $router->map('GET', '/users/{user}', \App\Http\Controllers\UserController::class);
    $router->map('GET', '/auth/register', [\App\Http\Controllers\Auth\RegisterController::class, 'index']);
    $router->map('POST', '/auth/register', [\App\Http\Controllers\Auth\RegisterController::class, 'store']);
};