<?php

declare(strict_types=1);

use App\UI\Http\Action\v2 as ActionV2;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return static function (App $app): void {
    $app->options('/v2/{routes:.+}', function ($request, $response, $args) {
        return $response;
    });

    $app->get('/v2', ActionV2\IndexAction::class);

    $app->get('/api/v2/doc', ActionV2\SwaggerAction::class);

    $app->group('/v2/language', function (Group $group) {
        $group->get('', ActionV2\Language\IndexAction::class);
        $group->post('', ActionV2\Language\CreateAction::class);
        $group->group('/{id}', function (Group $group2) {
            $group2->patch('', ActionV2\Language\UpdateAction::class);
            $group2->delete('', ActionV2\Language\DeleteAction::class);
        });
    });
};
