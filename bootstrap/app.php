<?php

// Require the Composer autoloader

use App\Config\Config;
use App\Core\Container;
use League\Container\ReflectionContainer;

error_reporting(0);

require __DIR__ . '/../vendor/autoload.php';


$container = Container::getInstance();
$container->delegate(new ReflectionContainer());
$container->addServiceProvider(new App\Providers\ConfigServiceProvider());


$config = $container->get(Config::class);

foreach($config->get('app.providers') as $provider) {
    $container->addServiceProvider(new $provider());
}

// Set Up the Application
use App\Core\App;
$app = new App();


// Register the Application Services and Providers and Routes


// Run the Application
$app->run();