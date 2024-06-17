<?php

// Require the Composer autoloader

use Spatie\Ignition\Ignition;

error_reporting(0);

require __DIR__ . '/../vendor/autoload.php';


Ignition::make()->register();

// Set Up the Application
use App\Core\App;
$app = new App();


// Register the Application Services and Providers and Routes


// Run the Application
$app->run();