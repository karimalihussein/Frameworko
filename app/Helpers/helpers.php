<?php

use App\Core\Container;
use App\Views\View;

function app(string $abstract)
{
    return Container::getInstance()->get($abstract);
}

function view(string $view, array $data = [])
{
    return app(View::class)->render($view, $data);
}