<?php

namespace App\Exception;

use Throwable;

class AppErrorsWithDataException extends \Exception
{
    /**
     * AppErrorsException constructor.
     *
     * @param array          $data
     * @param array          $errors
     * @param int            $code
     * @param Throwable|null $previous
     */
    function __construct(array $data, array $errors = [], $code = 400, Throwable $previous = null)
    {
        $data = [
            'data' => $data,
            'errors' => $errors,
        ];

        parent::__construct(serialize($data), $code, $previous);
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return unserialize($this->getMessage());
    }
}