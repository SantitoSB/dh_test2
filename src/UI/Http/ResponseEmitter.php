<?php

declare(strict_types=1);

namespace App\UI\Http;

use Psr\Http\Message\ResponseInterface;

/**
 * ResponseEmitter.
 */
class ResponseEmitter extends \Slim\ResponseEmitter
{
    public function emit(ResponseInterface $response): void
    {
        $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';

        $response = $response
            ->withHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->withAddedHeader('Cache-Control', 'post-check=0, pre-check=0')
            ->withHeader('Pragma', 'no-cache')
            ->withHeader('Access-Control-Allow-Credentials', 'true')
            ->withHeader('Access-Control-Allow-Origin', $origin)
            ->withHeader(
                'Access-Control-Allow-Headers',
                'X-Requested-With, Content-Type, Accept, Origin, X-Auth-Token, Authorization'
            )
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
            ->withHeader('Access-Control-Expose-Headers', 'X-Auth-Token')
        ;

        if (ob_get_contents()) {
            ob_clean();
        }

        parent::emit($response);
    }
}
