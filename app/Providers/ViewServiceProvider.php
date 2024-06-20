<?php

namespace App\Providers;

use App\Config\Config;
use App\Views\TwigRuntimeLoader;
use App\Views\View;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

final class ViewServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    public function boot(): void
    {

    }

    public function register(): void
    {
        $this->getContainer()->add(View::class, function(){
            $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../../resources/views');
            $isDebugEnabled = $this->getContainer()->get(Config::class)->get('app.debug');
            
            $twig = new \Twig\Environment($loader, [
                'cache' => false,
                'debug' => $isDebugEnabled
            ]);

            $twig->addRuntimeLoader(new TwigRuntimeLoader($this->getContainer()));
            $twig->addExtension(new \App\Views\TwigExtension());
            $twig->addExtension(new \Twig\Extension\DebugExtension());

            return new View($twig);
        })->setShared(true);
    }

    public function provides(string $id): bool
    {
        $services = [
            View::class
        ];
        return in_array($id, $services);
    }
}