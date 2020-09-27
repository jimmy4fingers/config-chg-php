<?php

namespace App\exception;

use Throwable;

class InvalidFileException extends \Exception
{
    public function __construct($message = "Unable to parse file.", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
