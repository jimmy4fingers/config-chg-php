<?php

declare(strict_types=1);

namespace App\exception;

use Throwable;

class MissingFileException extends \Exception
{
    public function __construct($message = "File not found.", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
