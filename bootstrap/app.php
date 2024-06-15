<?php

// Require the Composer autoloader
require __DIR__ . '/../vendor/autoload.php';

// Set Up the Application
use App\Core\App;
$app = new App();


// Register the Application Services and Providers and Routes


// Run the Application
$app->run();