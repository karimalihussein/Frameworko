<?php


namespace App\Http\Controllers\Auth;

use App\Views\View;
use Cartalyst\Sentinel\Sentinel;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;

final class LoginController
{
    public function __construct(
        protected View $view,
        protected Sentinel $auth
    ){}
    public function index(ServerRequestInterface $request): Response
    {
        $response = new Response();
        $response->getBody()->write($this->view->render('auth/login'));
        return $response;
    }

    public function store(ServerRequestInterface $request)
    {        
        if(!$this->auth->authenticate($request->getParsedBody()))
        {
            return new Response\RedirectResponse('/auth/login');
        } 

        return new Response\RedirectResponse('/');
    }
}