<?php

declare(strict_types=1);

namespace App\parser;

use App\exception\InvalidFileException;
use App\exception\MissingFileException;

class JsonFileParser extends AbstractParser implements ParserInterface
{
    /**
     * @param string $filePath
     * @return array
     * @throws InvalidFileException
     * @throws MissingFileException
     */
    public function parse(string $filePath): array
    {
        $this->validateFileExists($filePath);

        $parsedData = json_decode(file_get_contents($filePath), true);

        if ($parsedData === null) {
            $this->throwInvalidFileException();
        }

        return $parsedData;
    }
}
