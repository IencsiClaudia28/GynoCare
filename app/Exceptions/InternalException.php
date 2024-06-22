<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class InternalException extends Exception {
    private static string $DEFAULT_ERROR_MESSAGE = 'Internal error';

    public function __construct(string $message = null, int $code = 500, Throwable $previous = null) {
        $errorMessage = empty($message) ? self::$DEFAULT_ERROR_MESSAGE : $message;
        parent::__construct($errorMessage, $code, $previous);
    }
}
