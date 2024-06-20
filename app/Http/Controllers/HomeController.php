<?php

namespace App\Http\Controllers;

use App\Config\Config;
use App\Views\View;
use Illuminate\Database\DatabaseManager;
use Laminas\Diactoros\Request;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;

final class HomeController
{
    public function __construct(
        protected Config $config,
        protected View $view,
        protected DatabaseManager $db
    ){}

    public function __invoke(ServerRequestInterface $request): Response
    {
        $response = new Response();
        $response->getBody()->write($this->view->render('home', [
            'name' => $this->config->get('app.name'),
            'users' => $this->db->connection()->table('users')->get()
        ]));
        return $response;
    }
}