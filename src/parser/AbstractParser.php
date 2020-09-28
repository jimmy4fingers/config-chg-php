<?php

declare(strict_types=1);

namespace App\parser;

use App\exception\InvalidFileException;
use App\exception\MissingFileException;

abstract class AbstractParser
{
    /**
     * @param string $filePath
     * @throws MissingFileException
     */
    protected function validateFileExists(string $filePath)
    {
        if (!file_exists($filePath)) {
            throw new MissingFileException();
        }
    }

    /**
     * @throws InvalidFileException
     */
    protected function throwInvalidFileException()
    {
        throw new InvalidFileException();
    }
}
