<?php


namespace App\Http\Controllers\Auth;

use App\Views\View;
use Cartalyst\Sentinel\Sentinel;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;
use Respect\Validation\Validator as v;
use Symfony\Component\HttpFoundation\Session\Session;

final class RegisterController
{
    public function __construct(
        protected View $view,
        protected Sentinel $auth,
        protected Session $session
    ){}
    public function index(ServerRequestInterface $request): Response
    {
        $response = new Response();
        $response->getBody()->write($this->view->render('auth/register', [
            'errors' => $this->session->getFlashBag()->get('errors')[0] ?? null
        ]));
        return $response;
    }

    public function store(ServerRequestInterface $request)
    {        
        try {
            v::key('first_name', v::stringType()->notEmpty())
                ->key('last_name', v::stringType()->notEmpty())
                ->key('email', v::email()->notEmpty()->email()->not(v::existsInDatabase('users', 'email')))
                ->key('password', v::stringType()->notEmpty())
                ->keyValue('password_confirmation', 'equals', 'password')
                ->assert($request->getParsedBody());
        } catch (\Respect\Validation\Exceptions\ValidationException $e) {
            $this->session->getFlashBag()->add('errors', $e->getMessages());
            return new Response\RedirectResponse('/auth/register');
        }

        if($user = $this->auth->registerAndActivate($request->getParsedBody()))
        {
            $this->auth->login($user);
        }

        return new Response\RedirectResponse('/');
    }
}