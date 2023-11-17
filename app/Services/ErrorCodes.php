<?php

namespace App\Services;

class ErrorCodes
{
    // Error codes for the KanyeRestService
    public const ERROR_FETCH_QUOTE              = 1000;
    public const ERROR_API_RESPONSE_INVALID     = 1001;
    public const ERROR_API_CONNECTION_FAILED    = 1002;

    // Other service-specific error codes can be added here


    // Error messages corresponding to the error codes
    protected static array $errorMessages = [
        self::ERROR_FETCH_QUOTE             => 'Failed to fetch quote from the API.',
        self::ERROR_API_RESPONSE_INVALID    => 'The API response was invalid or unexpected.',
        self::ERROR_API_CONNECTION_FAILED   => 'Failed to establish a connection to the API.',
    ];

    /**
     * Retrieve an error message based on an error code.
     *
     * @param int $errorCode
     * @return string
     */
    public static function getErrorMessage(int $errorCode): string
    {
        return self::$errorMessages[$errorCode] ?? 'An unknown error occurred.';
    }
}
