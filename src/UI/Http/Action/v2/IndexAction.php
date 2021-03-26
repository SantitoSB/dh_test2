<?php

declare(strict_types=1);

namespace App\UI\Http\Action\v2;

use App\UI\Http\Action\AbstractAction;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * IndexAction.
 */
class IndexAction extends AbstractAction
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->asJson(['version' => 2]);
    }
}
