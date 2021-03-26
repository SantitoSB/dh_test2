<?php

declare(strict_types=1);

use App\UI\Http\ErrorHandler;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Slim\App;
use Slim\Factory\AppFactory;

return static function (ContainerInterface $container): App {
    $app = AppFactory::createFromContainer($container);

    (require __DIR__ . '/routes.php')($app);

    /** @var LoggerInterface $logger */
    $logger = $container->get(LoggerInterface::class);

    $displayErrorDetails = $container->get('settings')['displayErrorDetails'];
    $errorHandler = new ErrorHandler($app->getCallableResolver(), $app->getResponseFactory(), $logger);

    //$shutdownHandler = new ShutdownHandler($request, $errorHandler, $displayErrorDetails);
    //register_shutdown_function($shutdownHandler);

    $app->addRoutingMiddleware();

    $errorMiddleware = $app->addErrorMiddleware(
        $displayErrorDetails,
        true,
        true,
        $logger
    );
    $errorMiddleware->setDefaultErrorHandler($errorHandler);

    return $app;
};
