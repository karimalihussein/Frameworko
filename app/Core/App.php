<?php

namespace App\Core;


use Laminas\Diactoros\Request;
use Laminas\Diactoros\Response;
use League\Route\Router;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ServerRequestInterface;

final class App
{
    protected  ServerRequestInterface $request;
    protected Router $router;


    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __construct(protected ContainerInterface $container)
    {
        $this->request = $this->container->get(Request::class);
        $this->router = $this->container->get(Router::class);
    }

    public function getRouter(): Router
    {
        return $this->router;
    }

    public function run(): void
    {
        $response = new Response();
        try {
            $response = $this->router->dispatch($this->request);
        } catch (\Throwable $e) {
            throw $e;
        }
        (new \Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit(
            $response
        );
    }
}