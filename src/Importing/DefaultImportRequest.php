<?php

namespace Goosfraba\Kontomatik\Importing;

final class DefaultImportRequest
{
    public function __construct(
        private Session $session,
        private \DateTimeInterface $since
    ) {
    }

    /**
     * @return Session
     */
    public function getSession(): Session
    {
        return $this->session;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getSince(): \DateTimeInterface
    {
        return $this->since;
    }
}
