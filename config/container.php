<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Symfony\Component\Dotenv\Dotenv;

return static function (): ContainerInterface {
    if (file_exists(__DIR__ . '/../.env')) {
        (new Dotenv(true))->load(__DIR__ . '/../.env');
    }

    define('APP_HOST', sprintf('%1$s://%2$s/', $_ENV['HTTP_SCHEMA'], $_SERVER['HTTP_HOST']));

    $containerBuilder = new ContainerBuilder();

    if (!(getenv('APP_ENV') === 'test' || getenv('APP_ENV') === 'dev')) {
        $containerBuilder->enableCompilation(__DIR__ . '/../var/cache');
    }

    $setting = require __DIR__ . '/setting.php';
    $containerBuilder->addDefinitions($setting);

    $logger = require __DIR__ . '/logger.php';
    $containerBuilder->addDefinitions($logger);

    $bus = require __DIR__ . '/bus.php';
    $containerBuilder->addDefinitions($bus);

    $database = require __DIR__ . '/database.php';
    $containerBuilder->addDefinitions($database);

    $dependencies = require __DIR__ . '/dependencies.php';
    $containerBuilder->addDefinitions($dependencies);

    $twig = require __DIR__ . '/twig.php';
    $containerBuilder->addDefinitions($twig);

    $validator = require __DIR__ . '/validator.php';
    $containerBuilder->addDefinitions($validator);

    return $containerBuilder->build();
};

