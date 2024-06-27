<?php

namespace App\Http\Middleware;

use App\Core\Container;
use Cartalyst\Sentinel\Sentinel;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Component\HttpFoundation\Session\Session;

final class RedirectIfGuestMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $container = Container::getInstance();

        if (!$container->get(Sentinel::class)->check()) {
            $container->get(Session::class)->getFlashBag()->add('error', 'You must be logged in to access this page.');
            return new RedirectResponse('/auth/login');
        }

        return $handler->handle($request);
    }
}