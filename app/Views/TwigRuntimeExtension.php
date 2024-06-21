<?php

namespace App\Views;

use App\Config\Config;
use Cartalyst\Sentinel\Sentinel;
use Psr\Container\ContainerInterface;
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
}