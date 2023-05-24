<?php

namespace Goosfraba\Kontomatik;

use JMS\Serializer\Annotation as JMS;

final class Exception
{
    public function __construct(
        #[JMS\XmlAttribute]
        private ?string $name = null,

        #[JMS\XmlElement]
        private ?string $message = null,

        #[JMS\XmlElement]
        #[JMS\SerializedName("friendlyMessage")]
        private ?string $friendlyMessage = null
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
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @return string|null
     */
    public function getFriendlyMessage(): ?string
    {
        return $this->friendlyMessage;
    }
}