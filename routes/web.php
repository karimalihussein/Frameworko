<?php


use League\Route\Router;
use Psr\Container\ContainerInterface;

return static function(Router $router, ContainerInterface $container) {
    $router->map('GET', '/', \App\Http\Controllers\HomeController::class);
    $router->map('GET', '/about', \App\Http\Controllers\AboutController::class);
    $router->map('GET', '/users/{user}', \App\Http\Controllers\UserController::class);
};