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
        var_dump('booted');
    }

    public function register(): void
    {
        // $this->getContainer()->add(Exmaple::class, fn() => new Exmaple());
    }

    public function provides(string $id): bool
    {
        $services = [
            // Exmaple::class
        ];

        return in_array($id, $services);
    }
}