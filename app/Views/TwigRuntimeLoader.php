<?php

namespace App\Views;

use Psr\Container\ContainerInterface;
use Twig\RuntimeLoader\RuntimeLoaderInterface;

final class TwigRuntimeLoader implements RuntimeLoaderInterface
{
    public function __construct(protected ContainerInterface $container){}

    public function load(string $class)
    {
        if (TwigRuntimeExtension::class === $class) {
            return new TwigRuntimeExtension($this->container);
        }
    }
}