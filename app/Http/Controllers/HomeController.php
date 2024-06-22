<?php

namespace App\Http\Controllers;

use App\Config\Config;
use App\Models\User;
use App\Views\View;
use Cartalyst\Sentinel\Sentinel;
use Illuminate\Database\DatabaseManager;
use Laminas\Diactoros\Request;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;

final class HomeController
{
    public function __construct(
        protected View $view,
        protected Sentinel $auth,
        protected Session $session,
    ){}

    public function __invoke(ServerRequestInterface $request): Response
    {
        $response = new Response();
        $response->getBody()->write($this->view->render('home', [
            'users' =>  User::get()
        ]));
        return $response;
    }
}