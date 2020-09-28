<?php

declare(strict_types=1);

namespace App\adapter;

use App\exception\InvalidFileException;
use Symfony\Component\Yaml\Yaml as ThirdPartyYaml;

class Yaml
{
    /** @var ThirdPartyYaml  */
    private ThirdPartyYaml $yaml;

    public function __construct()
    {
        // this should be refactored to use a container rather than create a new object.
        $this->yaml = new ThirdPartyYaml();
    }

    /**
     * @param string $filePath
     * @return array
     * @throws InvalidFileException
     */
    public function parseFile(string $filePath): array
    {
        try {
            $parsed = $this->yaml::parseFile($filePath);
            if (!is_array($parsed)) {
                throw new InvalidFileException();
            }
            return $parsed;
        } catch (\Exception $exception) {
            throw new InvalidFileException();
        }
    }
}
