<?php

namespace Goosfraba\Kontomatik\Importing;

use JMS\Serializer\Annotation as JMS;

final class CreditCard
{
    public function __construct(
        #[JMS\XmlElement]
        #[JMS\SerializedName("cardId")]
        private ?string $cardId = null,

        #[JMS\XmlElement]
        private ?string $iban = null,

        #[JMS\XmlElement]
        private ?string $number = null,

        #[JMS\XmlElement]
        #[JMS\SerializedName("currencyBalance")]
        private ?float $currencyBalance = null,

        #[JMS\XmlElement]
        #[JMS\SerializedName("currencyFundsAvailable")]
        private ?float $currencyFundsAvailable = null,

        #[JMS\XmlElement]
        #[JMS\SerializedName("currencyName")]
        private ?string $currencyName = null,

        #[JMS\XmlElement]
        private ?string $owner = null,

        #[JMS\XmlElement]
        private ?float $limit = null,

        #[JMS\XmlElement]
        private ?float $interests = null,

        #[JMS\XmlElement]
        #[JMS\SerializedName("dueDate")]
        #[JMS\Type("DateTimeImmutable<'Y-m-d'>")]
        private ?\DateTimeInterface $dueDate = null,

        #[JMS\XmlElement]
        #[JMS\XmlList(entry: "owner")]
        #[JMS\Type("array<Goosfraba\Kontomatik\Importing\CreditCardOwner>")]
        private array $owners = [],

        #[JMS\XmlElement]
        #[JMS\SerializedName("moneyTransactions")]
        #[JMS\XmlList(entry: "moneyTransaction")]
        #[JMS\Type("array<Goosfraba\Kontomatik\Importing\CreditCardTransaction>")]
        private array $transactions = [],

        #[JMS\XmlAttribute]
        #[JMS\SerializedName("partialDueToTimeout")]
        private ?bool $partial = false
    ) {
    }

    /**
     * @return string|null
     */
    public function getCardId(): ?string
    {
        return $this->cardId;
    }

    /**
     * @return string|null
     */
    public function getIban(): ?string
    {
        return $this->iban;
    }

    /**
     * @return string|null
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * @return float|null
     */
    public function getCurrencyBalance(): ?float
    {
        return $this->currencyBalance;
    }

    /**
     * @return float|null
     */
    public function getCurrencyFundsAvailable(): ?float
    {
        return $this->currencyFundsAvailable;
    }

    /**
     * @return string|null
     */
    public function getCurrencyName(): ?string
    {
        return $this->currencyName;
    }

    /**
     * @return string|null
     */
    public function getOwner(): ?string
    {
        return $this->owner;
    }

    /**
     * @return float|null
     */
    public function getLimit(): ?float
    {
        return $this->limit;
    }

    /**
     * @return float|null
     */
    public function getInterests(): ?float
    {
        return $this->interests;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDueDate(): ?\DateTimeInterface
    {
        return $this->dueDate;
    }

    /**
     * @return CreditCardOwner[]
     */
    public function getOwners(): array
    {
        return $this->owners;
    }

    /**
     * @return array
     */
    public function getTransactions(): array
    {
        return $this->transactions;
    }

    /**
     * @return bool
     */
    public function isPartial(): bool
    {
        return (bool)$this->partial;
    }
}
