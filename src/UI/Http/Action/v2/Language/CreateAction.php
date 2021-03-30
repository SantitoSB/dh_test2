<?php

declare(strict_types=1);

namespace App\UI\Http\Action\v2\Language;

use App\Language\Model\Language\Language;
use App\Language\Command\Language\Create\Command;
use App\UI\Http\ParamsExtractor;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @OA\Post(
 *     path="/v2/language",
 *     tags={"Язык"},
 *     security={{"bearerAuth":{}}},
 *     description="Добавление языка",
 *     @OA\Response(
 *         response="201",
 *         description="",
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(
 *                  @OA\Property(property="name", type="string"),
 *                  @OA\Property(property="new_field", type="integer")
 *              ),
 *          ),
 *     ),
 *     @OA\RequestBody(
 *          required=true,
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(
 *                  @OA\Property(property="name", type="string"),
 *                  @OA\Property(property="new_field", type="integer")
 *              ),
 *          ),
 *     )
 * )
 */
class CreateAction extends AbstractLanguageAction
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $command = $this->deserialize($request);

        /** @var Language $result */
        $result = $this->bus->handle($command);
        $data = $this->serializeItem($result);

        return $this->asJson($data, 201);
    }

    private function deserialize(ServerRequestInterface $request): Command
    {
        $paramsExtractor = new ParamsExtractor($request->getParsedBody() ?? []);

        return new Command(
            $paramsExtractor->getString('name'),
            $paramsExtractor->getInt('new_field')
        );
    }
}
