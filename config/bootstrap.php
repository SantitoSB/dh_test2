<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;

define('APP_ROOT', dirname(dirname(__FILE__)));

require_once APP_ROOT . '/vendor/autoload.php';

/** @var ContainerInterface $container */
$container = (require_once __DIR__ . '/container.php')();

if (getenv('SENTRY_ENABLED') === 'true') {
    Sentry\init(['dsn' => getenv('SENTRY_DSN')]);
}

return $container;