<?php

declare(strict_types=1);

namespace App\parser;

interface ParserInterface
{
    public function parse(string $filePath): array;
}
