<?php

declare(strict_types=1);

use Slim\Views\Twig;

return [
    Twig::class => function () {
        return Twig::create(
            __DIR__ . '/../templates',
            [
                'cache' => __DIR__ . '/../var/cache/twig',
                'debug' => getenv('APP_ENV') === 'test' || getenv('APP_ENV') === 'dev'
            ]
        );
    }
];
