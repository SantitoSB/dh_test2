<?php

declare(strict_types=1);

namespace App\UI\Http;

/**
 * ParamsExtractor.
 */
class ParamsExtractor
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function has(string $name): bool
    {
        return array_key_exists($name, $this->data);
    }

    public function getString(string $name): string
    {
        return array_key_exists($name, $this->data) ? (string)$this->data[$name] : '';
    }

    public function getStringOrNull(string $name): ?string
    {
        return array_key_exists($name, $this->data) && $this->data[$name] !== null
            ? (string)$this->data[$name]
            : null;
    }

    public function getInt(string $name): int
    {
        return array_key_exists($name, $this->data) ? (int)$this->data[$name] : 0;
    }

    public function getIntOrNull(string $name): ?int
    {
        return array_key_exists($name, $this->data) && $this->data[$name] !== null
            ? (int)$this->data[$name]
            : null;
    }

    public function getFloat(string $name): float
    {
        return array_key_exists($name, $this->data) ? (float)$this->data[$name] : 0.0;
    }

    public function getFloatOrNull(string $name): ?float
    {
        return array_key_exists($name, $this->data) && $this->data[$name] !== null
            ? (float)$this->data[$name]
            : null;
    }

    /**
     * @param string $name
     * @return ParamsExtractor[]
     */
    public function getArray(string $name): array
    {
        return array_key_exists($name, $this->data)
            ? array_map(
                function ($item) {
                    return new self($item);
                },
                $this->data[$name]
            )
            : [];
    }

    public function getBool(string $name): bool
    {
        return array_key_exists($name, $this->data) ? (bool)$this->data[$name] : false;
    }

    public function getSimpleArray(string $name): array
    {
        return array_key_exists($name, $this->data) ? $this->data[$name] : [];
    }
}
