<?php

declare(strict_types=1);

use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use Psr\Container\ContainerInterface;
use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\Locator\CallableLocator;
use League\Tactician\Handler\MethodNameInflector\HandleInflector;

return [
    CommandBus::class => function (ContainerInterface $container) {
        $commandHandlerMiddleware = new CommandHandlerMiddleware(
            new class extends ClassNameExtractor {
                public function extract($command)
                {
                    $commandClassName = parent::extract($command);
                    return substr($commandClassName, 0, strlen($commandClassName) - 7) . 'Handler';
                }
            },
            new CallableLocator([$container, 'get']),
            new HandleInflector()
        );

        return new CommandBus([$commandHandlerMiddleware]);
    }
];