<?php

declare(strict_types=1);

namespace App\UI\Http\Action\v2\Language;

use App\Language\Command\Language\Delete\Command;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @OA\Delete (
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
 *                  @OA\Property(property="message", type="string"),
 *              ),
 *          ),
 *     ),
 * )
 */
class DeleteAction extends AbstractLanguageAction
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $command = $this->deserialize($request);

        $result = $this->bus->handle($command);
        $data = $result;

        return $this->asJson($data);
    }

    private function deserialize(ServerRequestInterface $request): Command
    {
        return new Command(
            (int)$this->resolveArg('id')
        );
    }
}
