<?php

namespace App\Views;
use Twig\TwigFunction;

final class TwigExtension extends \Twig\Extension\AbstractExtension
{
    public function getFunctions(): array
    {
        return [
           new TwigFunction('config', [TwigRuntimeExtension::class, 'config']),
           new TwigFunction('auth', [TwigRuntimeExtension::class, 'auth']),
           new TwigFunction('csrf', [TwigRuntimeExtension::class, 'csrf']),
           new TwigFunction('flash', [TwigRuntimeExtension::class, 'flash']),
           new TwigFunction('session', [TwigRuntimeExtension::class, 'session']),
           new TwigFunction('old', [TwigRuntimeExtension::class, 'old']),
           new TwigFunction('route', [TwigRuntimeExtension::class, 'route']),
        ];
    }
}