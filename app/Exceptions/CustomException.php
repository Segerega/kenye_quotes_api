<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    protected int $errorCode;

    /**
     * Construct the exception.
     *
     * @param string $message
     * @param int $errorCode
     * @param \Throwable|null $previous
     */
    public function __construct(string $message, int $errorCode, \Throwable $previous = null)
    {
        $this->errorCode = $errorCode;
        parent::__construct($message, 0, $previous);
    }

    /**
     * Get the error code associated with the exception.
     *
     * @return int
     */
    public function getErrorCode(): int
    {
        return $this->errorCode;
    }

    /**
     * Custom string representation of the exception.
     */
    public function __toString(): string
    {
        return __CLASS__ . ": [{$this->errorCode}]: {$this->message}\n";
    }
}
