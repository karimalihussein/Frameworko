<?php

namespace App\Views;

use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

final class View
{
    public function __construct(
        protected \Twig\Environment $twig
    ){}

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function render(string $view, array $data = []): string
    {
        return $this->twig->render($view . '.twig', $data);
    }
}