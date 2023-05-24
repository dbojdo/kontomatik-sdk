<?php

namespace Goosfraba\Kontomatik\Lending;

use JMS\Serializer\Annotation as JMS;

final class StringScore
{
    public function __construct(
        #[JMS\XmlElement]
        private ?string $value = null
    ) {
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }
}