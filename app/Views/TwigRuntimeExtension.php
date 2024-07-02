<?php

namespace App\Views;

use App\Config\Config;
use Cartalyst\Sentinel\Sentinel;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Twig\Extension\AbstractExtension;

final class TwigRuntimeExtension extends AbstractExtension
{
    public function __construct(protected ContainerInterface $container){}

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function config(): Config
    {
        return app(Config::class);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function auth(): Sentinel
    {
        return app(Sentinel::class);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function csrf(): string
    {
        $guard = $this->container->get('csrf');
        return '<input type="hidden" name="' . $guard->getTokenNameKey() . '" value="' . $guard->getTokenName() . '">
                <input type="hidden" name="' . $guard->getTokenValueKey() . '" value="' . $guard->getTokenValue() . '">';
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function flash($key): string
    {
        return app(Session::class)->getFlashBag()->get($key)[0] ?? '';
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function session(): Session
    {
        return app(Session::class);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function old(string $key): ?string
    {
        return $this->session()->getFlashBag()->peek('old')[$key] ?? null;
    }

    public function route(string $name, array $parameters = []): string
    {
        return route($name, $parameters);
    }

}