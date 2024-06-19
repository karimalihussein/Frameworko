<?php

// Require the Composer autoloader

use App\Config\Config;
use App\Core\Container;
use Laminas\Diactoros\Request;
use League\Container\ReflectionContainer;

error_reporting(0);

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();


$container = Container::getInstance();
$container->delegate(new ReflectionContainer());
$container->addServiceProvider(new App\Providers\ConfigServiceProvider());


$config = $container->get(Config::class);

foreach($config->get('app.providers') as $provider) {
    $container->addServiceProvider(new $provider());
}

$var = $container->get(Request::class)->getQueryParams();

var_dump($var);


die;

use App\Core\App;
$app = new App();



$app->run();