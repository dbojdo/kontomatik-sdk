<?php

namespace Goosfraba\Kontomatik\Importing;

use JMS\Serializer\Annotation as JMS;

final class Label
{
    public function __construct(
        #[JMS\XmlValue]
        private ?string $label
    ) {
    }

    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }
}