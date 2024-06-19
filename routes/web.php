<?php


use League\Route\Router;
use Psr\Container\ContainerInterface;

return static function(Router $router, ContainerInterface $container) {
    $router->map('GET', '/', \App\Http\Controllers\HomeController::class);

    $router->map('GET', '/about', function() {
        $response = new \Laminas\Diactoros\Response();
        $response->getBody()->write('About');
        return $response;
    });
};