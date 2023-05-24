<?php

namespace Goosfraba\Kontomatik\Common;

/**
 * Represents the Kontomatik environment
 */
final class Env
{
    private string $url;

    private function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Test environment
     *
     * @return self
     */
    public static function test(): self
    {
        return new self(
            "https://test.api.kontomatik.com"
        );
    }

    /**
     * Production environement
     *
     * @return self
     */
    public static function prod(): self
    {
        return new self(
            "https://api.kontomatik.com"
        );
    }

    /**
     * Creates an instance from given string
     *
     * @param string $env
     * @return self
     * @throws \OutOfBoundsException
     */
    public static function parse(string $env): self
    {
        return match (strtolower($env)) {
            "test" => self::test(),
            "prod" => self::prod(),
            default => throw new \OutOfBoundsException(sprintf("Unsupported env \"%s\" given.", $env))
        };
    }

    /**
     * Gets the API URL associated with the environment
     *
     * @return string
     */
    public function url(): string
    {
        return $this->url;
    }
}