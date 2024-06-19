<?php

namespace App\Providers;

use App\Core\Exmaple;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Spatie\Ignition\Ignition;

final class AppServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    public function boot(): void
    {
        Ignition::make()->register();
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