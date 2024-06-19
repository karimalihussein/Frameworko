<?php

namespace App\Http\Controllers;

use Laminas\Diactoros\Request;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;

final class HomeController
{
    public function __invoke(ServerRequestInterface $request): Response
    {
        $response = new Response();
        $response->getBody()->write('Hello, World!');
        return $response;
    }
}