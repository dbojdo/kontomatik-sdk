<?php

namespace Goosfraba\Kontomatik\Common;

/**
 * Represents the DSN for Kontomatik API
 */
final class Dsn
{
    private const SCHEME = "kontomatik";

    private function __construct(
        private string $apiKey,
        private Env $env
    ) {
    }

    /**
     * Parses the DSN from string of format: kontomatik://your-api-key@env
     *
     * @param string $dsn
     * @return self
     * @throws \InvalidArgumentException
     */
    public static function parse(string $dsn): self
    {
        $arDsn = parse_url($dsn);
        if (strtolower($arDsn['scheme'] !== self::SCHEME)) {
            throw new \InvalidArgumentException(
                "Ten scheme must be only \"%s\" but \"%s\" given.",
                self::SCHEME
            );
        }

        return new self(
            $arDsn['user'],
            Env::parse($arDsn['host'])
        );
    }

    /**
     * Gets the API key
     *
     * @return string
     */
    public function apiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * Gets the API environment
     *
     * @return Env
     */
    public function env(): Env
    {
        return $this->env;
    }
}