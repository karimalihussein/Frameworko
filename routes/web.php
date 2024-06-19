<?php


use League\Route\Router;
use Psr\Container\ContainerInterface;

return static function(Router $router, ContainerInterface $container) {
    $router->map('GET', '/', function() {
        $response = new \Laminas\Diactoros\Response();
        $response->getBody()->write('Home');
        return $response;
    });

    $router->map('GET', '/about', function() {
        $response = new \Laminas\Diactoros\Response();
        $response->getBody()->write('About');
        return $response;
    });
};