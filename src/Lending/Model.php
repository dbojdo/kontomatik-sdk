<?php

namespace Goosfraba\Kontomatik\Lending;

use JMS\Serializer\Annotation as JMS;

final class Model
{
    public function __construct(
        #[JMS\XmlAttribute]
        private ?string $id = null,

        #[JMS\XmlAttribute]
        #[JMS\SerializedName("retrainedAt")]
        private ?\DateTimeInterface $retrainedAt = null,

        #[JMS\XmlElement]
        private ?Scores $scores = null
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
     * @return \DateTimeInterface|null
     */
    public function getRetrainedAt(): ?\DateTimeInterface
    {
        return $this->retrainedAt;
    }

    /**
     * @return Scores|null
     */
    public function getScores(): ?Scores
    {
        return $this->scores;
    }
}
