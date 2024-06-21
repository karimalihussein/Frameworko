<?php


namespace App\Http\Controllers\Auth;

use Cartalyst\Sentinel\Sentinel;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;

final class LogoutController
{
    public function __construct(
        protected Sentinel $auth
    ){}
   
    public function __invoke(): Response
    {
        $this->auth->logout();
        return new Response\RedirectResponse('/auth/login');
    }
}