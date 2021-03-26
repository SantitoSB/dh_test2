<?php

declare(strict_types=1);

namespace App\UI\Http;

//use Assert\InvalidArgumentException;
//use Assert\LazyAssertionException;
use App\Application\Exception\DomainException;
use App\Application\Exception\ValidationException;
use App\Exception\AppErrorsException;
use App\Exception\AppErrorsWithDataException;
use Assert\InvalidArgumentException;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Exception\HttpMethodNotAllowedException;
use Slim\Exception\HttpNotFoundException;
use Symfony\Component\Validator\ConstraintViolationInterface;

/**
 * ErrorHandler.
 */
class ErrorHandler extends \Slim\Handlers\ErrorHandler
{
    protected function respond(): ResponseInterface
    {
        $exception = $ex = $this->exception;

        switch (true) {
            case $this->exception instanceof AppErrorsException:
                /** @var AppErrorsException $ex*/
                $response = $this->asJson($ex->getErrors(), $ex->getCode());

                break;
            case $this->exception instanceof AppErrorsWithDataException:
                /** @var AppErrorsWithDataException $ex*/
                $response = $this->asJson($ex->getErrors(), $ex->getCode());

                break;

            case $exception instanceof ValidationException:
                $errors = [];
                /** @var ConstraintViolationInterface $violation */
                foreach ($exception->getViolations() as $violation) {
                    $errors[] = [
                        'property' => $violation->getPropertyPath(),
                        'message' => $violation->getMessage()
                    ];
                }
                return $this->asJson0(['errors' => $errors], 400);

            case $exception instanceof InvalidArgumentException:
                $errors = [
                    [
                        'property' => $exception->getPropertyPath(),
                        'message' => $exception->getMessage(),
                        'code' => $exception->getCode()
                    ]
                ];
                return $this->asJson0(['errors' => $errors], 400);

            case $exception instanceof DomainException:
            case $exception instanceof \App\Application\Exception\InvalidArgumentException:
                $errors = [
                    [
                        'property' => null,
                        'message' => $exception->getMessage(),
                        'code' => $exception->getCode()
                    ]
                ];
                return $this->asJson0(['errors' => $errors], 400);

            // @todo refactor and remove
            case $ex instanceof \InvalidArgumentException:
            case $ex instanceof \DomainException:
                $response = $this->asJson(['errors' => [$this->buildError($ex->getMessage())]], StatusCodeInterface::STATUS_BAD_REQUEST);

                break;

            default:
                $response = parent::respond();
        }

        return $response;

        /*if ($exception instanceof LazyAssertionException) {
            $errors = [];
            foreach ($exception->getErrorExceptions() as $errorException) {
                $errors[] = $this->buildError($errorException->getMessage(), $errorException->getPropertyPath());
            }
            return $this->asJson(['errors' => $errors], 400);
        } elseif ($exception instanceof LazyAssertionException) {

        } elseif ($exception instanceof InvalidArgumentException) {
            return $this->asJson(['errors' => [$this->buildError($exception->getMessage(), $exception->getPropertyPath())]], 400);
        } else*/

    }

    protected function logError(string $error): void
    {
        if ($this->exception instanceof HttpNotFoundException ||
            $this->exception instanceof HttpMethodNotAllowedException
        ) {
            return;
        }

        parent::logError($error);
    }

    private function buildError(string $message, ?string $property = null): array
    {
        if ($property !== null) {
            $error['property'] = $property;
        }
        $error['message'] = $message;

        return $error ?? [];
    }

    private function asJson(array $data, int $status): ResponseInterface
    {
        $response = $this->responseFactory->createResponse($status);

        $response->getBody()->write(json_encode([
            'status'  => $status,
            'data'    => $data['data'] ?? null,
            'errors'  => $data['errors'] ?? null,
            'warning' => null,
        ], getenv('APP_ENV') === 'dev' ? JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE : 0));

        return $response->withHeader('Content-Type', 'application/json');
    }

    private function asJson0(array $data, int $status): ResponseInterface
    {
        $json = json_encode($data, getenv('APP_ENV') === 'dev' ? JSON_PRETTY_PRINT : 0);
        $response = $this->responseFactory->createResponse($status);
        $response->getBody()->write($json);

        return $response->withHeader('Content-Type', 'application/json');
    }
}
