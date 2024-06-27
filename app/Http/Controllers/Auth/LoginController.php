<?php

namespace App\Http\Controllers\Auth;

use App\Views\View;
use Cartalyst\Sentinel\Sentinel;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Laminas\Diactoros\Response\RedirectResponse;
use Respect\Validation\Validator as v;

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
        $response->getBody()->write($this->view->render('auth/login'));
        return $response;
    }

    public function store(ServerRequestInterface $request): Response
    {
        $errorMessage = 'Invalid login credentials.';
    
        try {
            v::key('email', v::email())
                ->key('password', v::stringType()->notEmpty())
                ->assert($request->getParsedBody());
        } catch (\Respect\Validation\Exceptions\ValidationException $e) {
            $this->session->getFlashBag()->add('error', $errorMessage);
            return new RedirectResponse('/auth/login');
        }
    
        $credentials = $request->getParsedBody();
    
        if (!$this->auth->authenticate($credentials)) {
            $this->session->getFlashBag()->add('error', $errorMessage);
            return new RedirectResponse('/auth/login');
        }
        $this->session->getFlashBag()->add('success', 'You are now logged in.');
        return new RedirectResponse('/');
    }
    
}
