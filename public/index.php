<?php

declare(strict_types=1);

use App\UI\Http\ResponseEmitter;
use Slim\Factory\ServerRequestCreatorFactory;

$container = require_once __DIR__. '/../config/bootstrap.php';
$app = (require_once __DIR__. '/../config/app.php')($container);


$serverRequestCreator = ServerRequestCreatorFactory::create();
$request = $serverRequestCreator->createServerRequestFromGlobals();



$response = $app->handle($request);

$responseEmitter = new ResponseEmitter();
$responseEmitter->emit($response);

