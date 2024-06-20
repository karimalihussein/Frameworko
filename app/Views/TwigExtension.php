<?php

namespace App\Views;
use Twig\TwigFunction;

final class TwigExtension extends \Twig\Extension\AbstractExtension
{
    public function getFunctions(): array
    {
        return [
           new TwigFunction('config', [TwigRuntimeExtension::class, 'config']),
        ];
    }
}