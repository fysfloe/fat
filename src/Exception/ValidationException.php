<?php

namespace App\Exception;

use Exception;

class ValidationException extends Exception
{
    /**
     * @var iterable
     */
    protected $errors;

    /**
     * ValidationException constructor.
     * @param iterable $errors
     */
    public function __construct(iterable $errors)
    {
        parent::__construct();
        $this->errors = $errors;
    }

    /**
     * @return iterable
     */
    public function getErrors(): iterable
    {
        return $this->errors;
    }
}