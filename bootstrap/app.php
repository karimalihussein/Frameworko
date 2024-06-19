<?php
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
error_reporting(0);


use App\Config\Config;
use App\Core\Container;
use League\Container\ReflectionContainer;


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




use App\Core\App;
use Laminas\Diactoros\Request;
use League\Route\Router;

$app = new App();

$router = $container->get(Router::class);
$router->get('/', function() {
   $response = new \Laminas\Diactoros\Response();
    $response->getBody()->write('Hello World');
    return $response;
});

$response = $router->dispatch($container->get(Request::class));

(new SapiEmitter)->emit($response);

$app->run();