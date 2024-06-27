<?php

namespace App\Exceptions;

use App\Views\View;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

final class ExceptionHandler
{
    public function __construct(protected View $view) {}

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function handle(ServerRequestInterface $request, ResponseInterface $response, Throwable $exception): ResponseInterface
    {
        $response->getBody()->write(
            $this->view->render(
                $this->getErrorView($exception),
                ['exception' => $exception]
            )
        );
        return $response;
    }

    protected function getErrorView(Throwable $exception): ?string
    {
        return match (get_class($exception)) {
            \League\Route\Http\Exception\NotFoundException::class => 'errors/404',
            \App\Validation\Exceptions\CsrfTokenException::class => 'errors/403',
            default => 'errors/500',
        };
    }
}