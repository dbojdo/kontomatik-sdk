<?php

namespace Goosfraba\Kontomatik\Importing;

final class Session
{
    public function __construct(
        private ?string $id = null,
        private ?string $signature = null
    ) {
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getSignature(): ?string
    {
        return $this->signature;
    }
}