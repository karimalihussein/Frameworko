<?php

namespace App\Http\Controllers\Auth;

use App\Views\View;
use Cartalyst\Sentinel\Sentinel;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Laminas\Diactoros\Response\RedirectResponse;

final class LoginController
{
    public function __construct(
        protected View $view,
        protected Sentinel $auth,
        protected Session $session
    ){}

    public function index(ServerRequestInterface $request): Response
    {
        $response = new Response();
        $response->getBody()->write($this->view->render('auth/login', [
            'error' => $this->session->getFlashBag()->get('error'),
            'success' => $this->session->getFlashBag()->get('success')
        ]));
        return $response;
    }

    public function store(ServerRequestInterface $request): Response
    {
        $credentials = $request->getParsedBody();

        if (!$this->auth->authenticate($credentials)) {
            $this->session->getFlashBag()->add('error', 'Invalid login credentials.');
            return new RedirectResponse('/auth/login');
        }

        return new RedirectResponse('/');
    }
}
