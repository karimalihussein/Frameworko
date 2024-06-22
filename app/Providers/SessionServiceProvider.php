<?php

namespace App\Providers;

use App\Config\Config;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Spatie\Ignition\Ignition;
use Symfony\Component\HttpFoundation\Session\Session;

final class SessionServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    public function boot(): void
    {
        
    }

    public function register(): void
    {
        $this->getContainer()->add(Session::class, fn() => new Session())->setShared(true);
    }

    public function provides(string $id): bool
    {
        $services = [
            Session::class
        ];

        return in_array($id, $services);
    }
}