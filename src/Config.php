<?php

namespace App;

use App\exception\InvalidKeyException;
use App\parser\ParserInterface;

class Config
{
    /** @var string */
    private string $currentDir;

    /** @var ParserInterface  */
    private ParserInterface $parser;

    /** @var array  */
    private array $data = [];

    /**
     * Config constructor.
     * @param string $currentDir
     * @param ParserInterface $parser
     */
    public function __construct(string $currentDir, ParserInterface $parser)
    {
        $this->currentDir = $currentDir . '/';
        $this->parser = $parser;
    }

    /**
     * @param string $file
     * @param string $optionalFile
     */
    public function load(string $file, string $optionalFile = ''): void
    {
        $this->set($this->parser->parse($this->currentDir . $file));

        if (!empty($optionalFile)) {
            $this->set($this->parser->parse($this->currentDir . $optionalFile));
        }
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->data;
    }

    /**
     * get value via string
     * @example 'config.data.myValue'
     * @param string $key
     * @return mixed|string
     * @throws InvalidKeyException
     */
    public function get(string $key)
    {
        return $this->extractValue($key);
    }

    /**
     * @param array $data
     */
    private function set(array $data): void
    {
        $this->data = array_replace_recursive($this->data, $data);
    }

    /**
     * @param string $path
     * @param string $separator
     * @return mixed|string
     * @throws InvalidKeyException
     */
    private function extractValue(string $path, string $separator = '.')
    {
        // if separator used in path
        if (strpos($path, $separator) !== false) {
            return $this->extractNestedValue(explode($separator, $path));
        }

        if ((!empty($path) && array_key_exists($path, $this->data))) {
            return $this->data[$path];
        }

        throw new InvalidKeyException();
    }

    /**
     *
     * @param array $keys
     * @return mixed|string
     * @throws InvalidKeyException
     */
    private function extractNestedValue(array $keys)
    {
        $data = $this->data;
        foreach ($keys as $key) {
            if (!array_key_exists($key, $data)) {
                throw new InvalidKeyException();
            }
            // reset array to found value
            $data = $data[$key];
        }

        return $data;
    }
}
