<?php

namespace Goosfraba\Kontomatik\Lending;

use JMS\Serializer\Annotation as JMS;

final class Scores
{
    public function __construct(
        #[JMS\XmlElement]
        private ?FloatScore $score = null,

        #[JMS\XmlElement]
        #[JMS\SerializedName("scorePercentile")]
        private ?FloatScore $percentile = null,

        #[JMS\XmlElement]
        #[JMS\SerializedName("scoreTier")]
        private ?StringScore $tier = null
    ) {
    }

    /**
     * @return float|null
     */
    public function getScore(): ?float
    {
        return $this->score?->getValue();
    }

    /**
     * @return float|null
     */
    public function getPercentile(): ?float
    {
        return $this->percentile?->getValue();
    }

    /**
     * @return string|null
     */
    public function getTier(): ?string
    {
        return $this->tier?->getValue();
    }
}