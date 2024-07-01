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


    public function index(ServerRequestInterface $request): Response
    {
        $users = User::paginate(1);
        $response = new Response();
        $response->getBody()->write($this->view->render('users/index', ['users' => $users]));
        return $response;
    }

    public function show(ServerRequestInterface $request, array $args): Response
    {
        ['user' => $userId] = $args;
        $user = User::findOrFail($userId);
        $response = new Response();
        $response->getBody()->write($this->view->render('users/show', ['user' => $user]));
        return $response;
    }
}