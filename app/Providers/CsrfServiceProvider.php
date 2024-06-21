<?php

namespace App\Providers;

use Laminas\Diactoros\ResponseFactory;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Slim\Csrf\Guard;

final class CsrfServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    public function boot(): void
    {
        
    }

    public function register(): void
    {
        $this->getContainer()->add('csrf', function() {
            return new Guard(new ResponseFactory());
         })->setShared(true);
    }

    public function provides(string $id): bool
    {
        $services = [
            'csrf'
        ];

        return in_array($id, $services);
    }
}