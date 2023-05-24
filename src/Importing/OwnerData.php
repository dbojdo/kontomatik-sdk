<?php

namespace Goosfraba\Kontomatik\Importing;

use JMS\Serializer\Annotation as JMS;

final class OwnerData
{
    public function __construct(
        #[JMS\XmlAttribute]
        #[JMS\SerializedName("externalId")]
        private ?string $externalId = null,

        #[JMS\XmlAttribute]
        #[JMS\SerializedName("createdAt")]
        #[JMS\Type("DateTimeImmutable<'Y-m-d\TH:i:s.uP'>")]
        private ?\DateTimeInterface $createdAt = null,

        #[JMS\XmlAttribute]
        #[JMS\SerializedName("updatedAt")]
        #[JMS\Type("DateTimeImmutable<'Y-m-d\TH:i:s.uP'>")]
        private ?\DateTimeInterface $updatedAt = null,

        #[JMS\XmlAttribute]
        private ?string $origin = null,

        #[JMS\XmlAttribute]
        #[JMS\SerializedName("lastChange")]
        #[JMS\Type("DateTimeImmutable<'Y-m-d\TH:i:s.uP'>")]
        private ?\DateTimeInterface $lastChange = null,

        #[JMS\XmlElement]
        private ?Target $target = null
    ) {
    }

    /**
     * @return string|null
     */
    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @return string|null
     */
    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getLastChange(): ?\DateTimeInterface
    {
        return $this->lastChange;
    }

    /**
     * @return Target|null
     */
    public function getTarget(): ?Target
    {
        return $this->target;
    }
}