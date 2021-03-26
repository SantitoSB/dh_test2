<?php

namespace App\Exception;

use Throwable;

class AppErrorsException extends \Exception
{
    /**
     * AppErrorsException constructor.
     *
     * @param array          $errors
     * @param int            $code
     * @param Throwable|null $previous
     */
    function __construct(array $errors = [], $code = 400, Throwable $previous = null)
    {
        parent::__construct(serialize(['errors' => $errors]), $code, $previous);
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return unserialize($this->getMessage());
    }
}