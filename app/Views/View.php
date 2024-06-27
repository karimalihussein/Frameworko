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
     * @param string $view
     * @param array $data
     * @return string
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function render(string $view, array $data = []): string
    {
        return $this->twig->render($view . '.twig', $data);
    }

    /**
     * @param string $view
     * @return bool
     */
    public function exists(string $view): bool
    {
        return $this->twig->getLoader()->exists($view . '.twig');
    }
}