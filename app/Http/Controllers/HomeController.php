<?php

namespace App\Http\Controllers;

use App\Config\Config;
use Laminas\Diactoros\Request;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;

final class HomeController
{
    public function __construct(
        protected Config $config
    ){}

    public function __invoke(ServerRequestInterface $request): Response
    {
        $response = new Response();
        $response->getBody()->write($this->config->get('app.name'));
        return $response;
    }
}