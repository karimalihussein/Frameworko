<?php


namespace App\Http\Controllers\Auth;

use App\Views\View;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;

final class RegisterController
{
    public function __construct(
        protected View $view
    ){}
    public function index(ServerRequestInterface $request): Response
    {
        $response = new Response();
        $response->getBody()->write($this->view->render('auth/register'));
        return $response;
    }

    public function store(ServerRequestInterface $request)
    {
        dd($request->getParsedBody());die;
    }
}