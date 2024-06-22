<?php

namespace App\Views;

use App\Config\Config;
use Cartalyst\Sentinel\Sentinel;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Twig\Extension\AbstractExtension;

final class TwigRuntimeExtension extends AbstractExtension
{
    public function __construct(protected ContainerInterface $container){}
    public function config(): Config
    {
        return $this->container->get(Config::class);
    }

    public function auth(): Sentinel
    {
        return $this->container->get(Sentinel::class);
    }

    public function csrf(): string
    {
        $guard = $this->container->get('csrf');
        return '<input type="hidden" name="' . $guard->getTokenNameKey() . '" value="' . $guard->getTokenName() . '">
                <input type="hidden" name="' . $guard->getTokenValueKey() . '" value="' . $guard->getTokenValue() . '">';
    }

    public function flash($key): string
    {
        return $this->container->get(Session::class)->getFlashBag()->get($key)[0] ?? '';
    }

    public function session(): Session
    {
        return $this->container->get(Session::class);
    }
}