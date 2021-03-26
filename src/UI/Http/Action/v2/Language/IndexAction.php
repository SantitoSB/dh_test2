<?php

declare(strict_types=1);

namespace App\UI\Http\Action\v2\Language;

use App\Language\Repository\LanguageRepository;
use League\Tactician\CommandBus;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;

/**
 * IndexAction.
 *
 * @OA\Get(
 *     path="/v2/language",
 *     tags={"Язык"},
 *     description="Список языков",
 *     @OA\Response(
 *         response="200",
 *         description="",
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(
 *                  @OA\Property(property="name", type="string")
 *              ),
 *          ),
 *     )
 * )
 */
class IndexAction extends AbstractLanguageAction
{
    private LanguageRepository $languageRepository;

    public function __construct(
        LanguageRepository $languageRepository,
        CommandBus $bus,
        LoggerInterface $logger
    ) {
        parent::__construct($bus, $logger);
        $this->languageRepository = $languageRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $items = $this->languageRepository->fetchAll();
        $data = array_map([$this, 'serializeItem'], $items);

        return $this->asJson($data);
    }
}
