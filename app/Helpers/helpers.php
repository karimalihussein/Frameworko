<?php

use App\Core\Container;
use App\Views\View;
use Laminas\Diactoros\Response;

function app(string $abstract)
{
    return Container::getInstance()->get($abstract);
}

function view(string $view, array $data = [])
{
    $response = new Response();
    $response->getBody()->write(
        app(View::class)->render($view, $data)
    );
    return $response;
}

function config(string $key, $default = null)
{
    return app(\App\Config\Config::class)->get($key, $default);
}

function route(string $name, array $params = [])
{
    return app(\League\Route\Router::class)->getNamedRoute($name)->getPath($params);
}