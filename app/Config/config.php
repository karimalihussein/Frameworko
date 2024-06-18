<?php

namespace App\Config;

final class Config
{
    protected array $config = [
        'app' => [
            'name' => 'Frameworko',
        ],
    ];
    public function get(string $key, $default = null)
    {
        return dot($this->config)->get($key, $default);
    }
}