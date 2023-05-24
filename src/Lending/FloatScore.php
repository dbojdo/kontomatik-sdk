<?php

namespace Goosfraba\Kontomatik\Lending;

use JMS\Serializer\Annotation as JMS;

final class FloatScore
{
    public function __construct(
        #[JMS\XmlElement]
        private ?float $value = null
    ) {
    }

    /**
     * @return float|null
     */
    public function getValue(): ?float
    {
        return $this->value;
    }
}