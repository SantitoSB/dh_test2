<?php

declare(strict_types=1);

namespace App\UI\Http\Action\v2\Language;

use App\Language\Model\Language\Language;
use App\UI\Http\Action\AbstractAction;

/**
 * AbstractLanguageAction.
 */
abstract class AbstractLanguageAction extends AbstractAction
{
    protected function serializeList(Language $model): array
    {
        $serializer = $this->serializer;
        return [
            'id' => $model->getId(),
            'name' => $serializer->asString($model->getName()),
            'new_field' => $serializer->asInt($model->getNewField())
        ];
    }

    protected function serializeItem(Language $model): array
    {
        return $this->serializeList($model);
    }
}
