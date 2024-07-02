<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laminas\Diactoros\Response;

final class HomeController
{
    public function __construct(
    ) {
    }

    public function __invoke(): Response
    {
        $response = new Response();
        $response->getBody()->write(
            view('home', [
                'users' =>  User::get()
            ])
        );
        return $response;
    }
}
