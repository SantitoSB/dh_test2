<?php

declare(strict_types=1);

namespace App\UI\Http\Action\v2;

use App\UI\Http\Action\AbstractAction;
use Fig\Http\Message\StatusCodeInterface;
use League\Tactician\CommandBus;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use OpenApi\Annotations as OA;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;
use function OpenApi\scan;

/**
 * @OA\OpenApi(
 *     security={
 *          {"token": {}}
 *     }
 * )
 *
 * @OA\Info(
 *     title="Rosakhutor REST API",
 *     version="2"
 * )
 *
 * @OA\Server(url=APP_HOST)
 *
 * @OA\Components(
 *     @OA\SecurityScheme(
 *         securityScheme="bearerAuth",
 *         in="header",
 *         name="bearerAuth",
 *         type="http",
 *         scheme="bearer",
 *         bearerFormat="JWT",
 *     ),
 *     @OA\Schema(
 *          schema="error",
 *          @OA\Property(property="status", type="string", description="Статус ответа", enum={"error"}),
 *          @OA\Property(property="data", type="object", nullable=true, example="{}"),
 *          @OA\Property(
 *              property="errors",
 *              type="array",
 *              nullable=true,
 *              @OA\Items(
 *                  @OA\Property(property="code", type="integer"),
 *                  @OA\Property(property="message", type="string"),
 *             ),
 *          ),
 *          @OA\Property(property="warning", type="string", nullable=true, description="Текст уведомления", example="string"),
 *      ),
 *     responses={
 *          @OA\Response(response="BadRequest", description="400 Bad request", @OA\JsonContent(ref="#/components/schemas/error")),
 *          @OA\Response(response="Unauthorized", description="401 Unauthorized", @OA\JsonContent(ref="#/components/schemas/error")),
 *          @OA\Response(response="ServerError", description="500 Server error", @OA\JsonContent(ref="#/components/schemas/error")),
 *     }
 * )
 */
class SwaggerAction extends AbstractAction
{
    private Twig $twig;

    public function __construct(
        Twig $twig,
        CommandBus $bus,
        LoggerInterface $logger
    ) {
        parent::__construct($bus, $logger);
        $this->twig = $twig;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $scan = scan(__DIR__, [
            'servers' => APP_HOST
        ]);

        $response = $this->response;

        switch (true) {
            case isset($request->getQueryParams()['yaml']):
                $response->getBody()->write($scan->toYaml());

                $responseBody =  $response->withStatus(StatusCodeInterface::STATUS_OK)
                    ->withHeader('Content-Type', 'application/yaml;charset=utf-8');

                break;
            case isset($request->getQueryParams()['json']):
                $response->getBody()->write($scan->toJson());

                $responseBody = $response->withStatus(StatusCodeInterface::STATUS_OK)
                    ->withHeader('Content-Type', 'application/json;charset=utf-8');

                break;
            case isset($request->getQueryParams()['html']):
            default:
                $responseBody =  $this->twig->render($response, 'swagger/index.twig', [
                    'data' => $scan->toJson(),
                ]);
        }

        return $responseBody;
    }
}
