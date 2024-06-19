<?php

namespace App\Providers;

use App\Config\Config;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

final class ConfigServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    public function boot(): void
    {
        
    }

    public function register(): void
    {
        $this->getContainer()->add(Config::class, function () {
            $config = new Config();
            return $this->mergeConfigFromFiles($config);
        });
    }

    public function provides(string $id): bool
    {
        $services = [
            Config::class
        ];
        return in_array($id, $services);
    }

    protected function mergeConfigFromFiles(Config $config): Config
    {
       $path = __DIR__ . '/../../Config';
       $files = scandir($path);
       
       foreach(array_diff($files, ['.', '..']) as $file) {
           $config->merge(
               [explode('.', $file)[0] => require $path . '/' . $file]
           );
       }

      return $config;
    }
}