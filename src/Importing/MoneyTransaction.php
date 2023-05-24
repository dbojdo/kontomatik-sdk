<?php

namespace Goosfraba\Kontomatik\Importing;

use JMS\Serializer\Annotation as JMS;

abstract class MoneyTransaction
{
    public function __construct(
        #[JMS\XmlElement]
        #[JMS\SerializedName("transactionOn")]
        #[JMS\Type("DateTimeImmutable<'Y-m-d'>")]
        private ?\DateTimeInterface $transactionOn = null,

        #[JMS\XmlElement]
        #[JMS\SerializedName("bookedOn")]
        #[JMS\Type("DateTimeImmutable<'Y-m-d'>")]
        private ?\DateTimeInterface $bookedOn = null,

        #[JMS\XmlElement]
        #[JMS\SerializedName("currencyAmount")]
        private ?float $currencyAmount = null,

        #[JMS\XmlElement]
        #[JMS\SerializedName("currencyBalance")]
        private ?float $currencyBalance = null,

        #[JMS\XmlElement]
        private ?string $title = null,

        #[JMS\XmlElement]
        private ?string $party = null,

        #[JMS\XmlElement]
        #[JMS\SerializedName("partyIban")]
        private ?string $partyIban = null,

        #[JMS\XmlElement]
        private ?string $kind = null,

        #[JMS\XmlElement]
        private ?string $status = null,

        #[JMS\XmlElement]
        #[JMS\XmlList(entry: "label")]
        #[JMS\Type("array<string>")]
        private ?array $labels = [],
    ) {
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getTransactionOn(): ?\DateTimeInterface
    {
        return $this->transactionOn;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getBookedOn(): ?\DateTimeInterface
    {
        return $this->bookedOn;
    }

    /**
     * @return float|null
     */
    public function getCurrencyAmount(): ?float
    {
        return $this->currencyAmount;
    }

    /**
     * @return float|null
     */
    public function getCurrencyBalance(): ?float
    {
        return $this->currencyBalance;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getParty(): ?string
    {
        return $this->party;
    }

    /**
     * @return string|null
     */
    public function getPartyIban(): ?string
    {
        return $this->partyIban;
    }

    /**
     * @return string|null
     */
    public function getKind(): ?string
    {
        return $this->kind;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @return array|null
     */
    public function getLabels(): ?array
    {
        return $this->labels;
    }
}
