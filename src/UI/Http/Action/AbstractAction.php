<?php

declare(strict_types=1);

namespace App\UI\Http\Action;

use App\UI\Http\Serializer;
use InvalidArgumentException;
use League\Tactician\CommandBus;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Slim\Psr7\Stream;

/**
 * AbstractAction.
 */
abstract class AbstractAction
{
    protected CommandBus $bus;
    protected LoggerInterface $logger;
    protected ServerRequestInterface $request;
    protected ResponseInterface $response;
    protected Serializer $serializer;

    private array $args = [];

    public function __construct(
        CommandBus $bus,
        LoggerInterface $logger
    ) {
        $this->bus = $bus;
        $this->logger = $logger;
        $this->serializer = new Serializer();
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {


        $this->request = $request;
        $this->response = $response;
        $this->args = $args;

        return $this->handle($request);
    }

    abstract public function handle(ServerRequestInterface $request): ResponseInterface;

    protected function resolveArg(string $name): string
    {
        if (!isset($this->args[$name])) {
            throw new InvalidArgumentException("Could not resolve argument `{$name}`.");
        }

        return $this->args[$name];
    }

    protected function asJson(array $data, int $status = 200, array $headers = []): ResponseInterface
    {
        $json = json_encode($data, getenv('APP_ENV') === 'dev' ? JSON_PRETTY_PRINT : 0);
        $this->response->getBody()->write($json);

        $response = $this->response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($status)
        ;

        foreach ($headers as $name => $value) {
            $response = $response->withHeader($name, $value);
        }

        return $response;
    }

    protected function asEmpty(int $status = 204): ResponseInterface
    {
        return $this->response->withStatus($status);
    }

    protected function asFile(string $filePath, string $fileName): ResponseInterface
    {
        $fh = fopen($filePath, 'rb');
        $stream = new Stream($fh);

        return $this->response
            ->withHeader('Content-Description', 'File Transfer')
            ->withHeader('Content-Type', 'application/octet-stream')
            ->withHeader('Content-Disposition', 'attachment;filename="' . $fileName . '"')
            ->withHeader('Expires', '0')
            ->withHeader('Cache-Control', 'must-revalidate')
            ->withHeader('Pragma', 'public')
            ->withHeader('Content-Length', filesize($filePath))
            ->withBody($stream);
    }
}
