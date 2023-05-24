<?php

namespace Goosfraba\Kontomatik\Importing;

use JMS\Serializer\Annotation as JMS;

final class CommandProgress
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