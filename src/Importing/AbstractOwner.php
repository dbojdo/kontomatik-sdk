<?php

namespace Goosfraba\Kontomatik\Importing;

use JMS\Serializer\Annotation as JMS;

abstract class AbstractOwner
{
    private function __construct(
        #[JMS\XmlElement]
        private ?string $name = null,

        #[JMS\XmlElement]
        private ?string $address = null,

        #[JMS\XmlElement]
        private ?string $kind = null
    ) {
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @return string|null
     */
    public function getKind(): ?string
    {
        return $this->kind;
    }
}