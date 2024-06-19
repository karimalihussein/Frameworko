<?php

use App\Providers\ConfigServiceProvider;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

error_reporting(0);


use App\Config\Config;
use App\Core\Container;
use League\Container\ReflectionContainer;
use App\Core\App;


require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();


$container = Container::getInstance();
$container->delegate(new ReflectionContainer());
$container->addServiceProvider(new ConfigServiceProvider());


$config = $container->get(Config::class);

foreach($config->get('app.providers') as $provider) {
    $container->addServiceProvider(new $provider());
}


$app = new App($container);
(require __DIR__ . '/../routes/web.php')($app->getRouter(), $container);
$app->run();