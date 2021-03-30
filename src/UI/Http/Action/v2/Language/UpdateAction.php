<?php

declare(strict_types=1);

namespace App\UI\Http\Action\v2\Language;

use App\Language\Command\Language\Update\Command;
use App\Language\Model\Language\Language;
use App\UI\Http\ParamsExtractor;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @OA\Patch(
 *     path="/v2/language/{id}",
 *     @OA\Parameter(required=true, name="id", in="path"),
 *     tags={"Язык"},
 *     security={{"bearerAuth":{}}},
 *     description="Редактирование языка",
 *     @OA\Response(
 *         response="200",
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
class UpdateAction extends AbstractLanguageAction
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        $command = $this->deserialize($request);


        /** @var Language $result */
        $result = $this->bus->handle($command);
        $data = $this->serializeItem($result);

        return $this->asJson($data);
    }

    private function deserialize(ServerRequestInterface $request): Command
    {
        $paramsExtractor = new ParamsExtractor($request->getParsedBody() ?? []);

        return new Command(
            (int)$this->resolveArg('id'),
            $paramsExtractor->getString('name'),
            $paramsExtractor->getInt('new_field')
        );
    }
}
