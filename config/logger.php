<?php

declare(strict_types=1);

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Log\LoggerInterface;

return [
    LoggerInterface::class => function () {
        $logger = new Logger('app');

        $processor = new UidProcessor();
        $logger->pushProcessor($processor);

        $handler = new StreamHandler(__DIR__ . '/../var/logs/debug.log', Logger::DEBUG);
        $logger->pushHandler($handler);

        $handler = new StreamHandler(__DIR__ . '/../var/logs/info.log', Logger::INFO);
        $logger->pushHandler($handler);

        return $logger;
    }
];