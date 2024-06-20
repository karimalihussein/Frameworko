<?php

namespace App\Providers;

use App\Config\Config;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\DatabaseManager;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

final class DatabaseServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    protected Manager $capsule;

    public function boot(): void
    {
        $config = $this->getContainer()->get(Config::class);

        $capsule = new Manager;
        $driver = $config->get('database.driver');
        $connections = $config->get('database.connections');
        if (!isset($connections[$driver])) {
            throw new \InvalidArgumentException("Database connection [{$driver}] not configured.");
        }

        $capsule->addConnection($connections[$driver], $driver);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        $capsule->getDatabaseManager()->setDefaultConnection($driver);

        $this->capsule = $capsule;
    }

    public function register(): void
    {
        $this->getContainer()->add(DatabaseManager::class, fn() => $this->capsule->getDatabaseManager())->setShared(true);
    }

    public function provides(string $id): bool
    {
        $services = [
            DatabaseManager::class,
        ];

        return in_array($id, $services);
    }
}
