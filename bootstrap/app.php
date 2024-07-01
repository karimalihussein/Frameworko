<?php

use App\Providers\ConfigServiceProvider;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use App\Config\Config;
use App\Core\Container;
use League\Container\ReflectionContainer;
use App\Core\App;
use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// Initialize the container
$container = Container::getInstance();
$container->delegate(new ReflectionContainer());
$container->addServiceProvider(new ConfigServiceProvider());

// Load configuration
$config = $container->get(Config::class);

// Register service providers
foreach ($config->get('app.providers') as $provider) {
    $container->addServiceProvider(new $provider());
}

// Create and run the application
$app = new App($container);
(require __DIR__ . '/../routes/web.php')($app->getRouter(), $container);
$app->run();
