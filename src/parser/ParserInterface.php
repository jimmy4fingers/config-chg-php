<?php

namespace App\parser;

interface ParserInterface
{
    public function parse(string $filePath): array;
}
