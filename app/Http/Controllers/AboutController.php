<?php

namespace App\Http\Controllers;

use App\Config\Config;
use App\Views\View;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;

final class AboutController
{
    public function __construct(
        protected View $view
    ){}

    public function __invoke(ServerRequestInterface $request): Response
    {
        $response = new Response();
        $response->getBody()->write($this->view->render('about'));
        return $response;
    }
}