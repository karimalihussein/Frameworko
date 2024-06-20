<?php

namespace App\Providers;

use App\Config\Config;
use Cartalyst\Sentinel\Native\Facades\Sentinel as SentinelFacade;
use Cartalyst\Sentinel\Native\SentinelBootstrapper;
use Cartalyst\Sentinel\Sentinel;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

final class AuthServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    protected Sentinel $sentinel;

    public function boot(): void
    {
        $config = $this->getContainer()->get(Config::class)->get('auth');
        $bootstrapper = new SentinelBootstrapper($config);

        $sentinel = SentinelFacade::instance($bootstrapper);
        $this->sentinel = $sentinel->getSentinel();
    }

    public function register(): void
    {
        $this->getContainer()->add(Sentinel::class, fn() => $this->sentinel)->setShared(true);
    }

    public function provides(string $id): bool
    {
        $services = [
            Sentinel::class,
        ];

        return in_array($id, $services);
    }
}
