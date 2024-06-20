<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Views\View;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;

final class UserController
{
    public function __construct(
        protected View $view
    ){}

    public function __invoke(ServerRequestInterface $request, array $args): Response
    {
        ['user' => $userId] = $args;
        $user = User::findOrFail($userId);
        $response = new Response();
        $response->getBody()->write($this->view->render('user', ['user' => $user]));
        return $response;
    }
}