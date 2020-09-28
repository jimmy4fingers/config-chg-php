<?php

declare(strict_types=1);

namespace App\parser;

use App\adapter\Yaml;
use App\exception\InvalidFileException;
use App\exception\MissingFileException;

class YamlFileParser extends AbstractParser implements ParserInterface
{
    /** @var Yaml  */
    private Yaml $parser;

    /**
     * YamlFileParser constructor.
     * @param Yaml $parser
     */
    public function __construct(Yaml $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param string $filePath
     * @return array
     * @throws InvalidFileException
     * @throws MissingFileException
     */
    public function parse(string $filePath): array
    {
        $this->validateFileExists($filePath);

        $parsedData = $this->parser->parseFile($filePath);

        if ($parsedData === null) {
            $this->throwInvalidFileException();
        }

        return $parsedData;
    }
}
