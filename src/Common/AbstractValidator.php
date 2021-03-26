<?php

namespace App\Common;

use App\Exception\AppValidateException;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Server\MiddlewareInterface;
use Slim\Psr7\Response;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

abstract class AbstractValidator implements MiddlewareInterface
{
    /**
     * @param array             $params
     * @param Assert\Collection $collection
     *
     * @return array
     */
    public function validate(array $params, Assert\Collection $collection): array
    {
        $validator = Validation::createValidator();

        $violations = $validator->validate($params, $collection);

        foreach ($violations as $error) {
            /** @var ConstraintViolationInterface $error */
            $errors[] = [
                'code'    => 400,
                'message' => $error->getMessage(),
            ];
        }

        return $errors ?? [];
    }

    /**
     * @param array $errors
     * @param int   $statusCode
     *
     * @throws AppValidateException
     */
    protected function handlerError(array $errors, $statusCode = 400)
    {
        throw new AppValidateException($errors, $statusCode);
    }
}