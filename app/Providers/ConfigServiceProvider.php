<?php

namespace App\Providers;

use App\Config\Config;
use App\Core\Exmaple;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Spatie\Ignition\Ignition;

final class ConfigServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    public function boot(): void
    {
        
    }

    public function register(): void
    {
        $this->getContainer()->add(Config::class, fn() => new Config());
    }

    public function provides(string $id): bool
    {
        $services = [
            Config::class
        ];
        return in_array($id, $services);
    }
}