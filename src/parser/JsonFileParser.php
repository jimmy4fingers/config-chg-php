<?php

namespace App\parser;

use App\exception\InvalidFileException;
use App\exception\MissingFileException;

class JsonFileParser implements ParserInterface
{
    /**
     * @param string $filePath
     * @return array
     * @throws InvalidFileException
     * @throws MissingFileException
     */
    public function parse(string $filePath): array
    {
        if (!file_exists($filePath)) {
            throw new MissingFileException();
        }

        $parsedData = json_decode(file_get_contents($filePath), true);

        if ($parsedData === null) {
            throw new InvalidFileException();
        }

        return $parsedData;
    }
}
