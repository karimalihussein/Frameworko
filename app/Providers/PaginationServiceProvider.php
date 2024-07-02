<?php

namespace App\Providers;

use App\Views\View;
use Illuminate\Pagination\Paginator;
use Laminas\Diactoros\Request;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

final class PaginationServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    public function boot(): void
    {
        Paginator::currentPathResolver(function () {
            return (string) strtok(app(Request::class)->getUri(), '?');
        });

        Paginator::queryStringResolver(function () {
            return app(Request::class)->getQueryParams();
        });

        Paginator::currentPageResolver(function ($pageName = 'page') {
            return app(Request::class)->getQueryParams()[$pageName] ?? 1;
        });

        Paginator::viewFactoryResolver(function () {
            return app(View::class);
        });

        Paginator::defaultView('pagination/default');
    }

    public function register(): void
    {
    }

    public function provides(string $id): bool
    {
        $services = [];

        return in_array($id, $services);
    }
}