<?php

namespace Goosfraba\Kontomatik\Importing;

use JMS\Serializer\Annotation as JMS;

final class Account
{
    public function __construct(
        #[JMS\XmlElement]
        private ?string $name = null,

        #[JMS\XmlElement]
        private ?string $iban = null,

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
        #[JMS\SerializedName("activeSinceAtLeast")]
        #[JMS\Type("DateTimeImmutable<'Y-m-d'>")]
        private ?\DateTimeInterface $activeSinceAtLeast = null,

        #[JMS\XmlElement]
        #[JMS\XmlList(entry: "owner")]
        #[JMS\Type("array<Goosfraba\Kontomatik\Importing\AccountOwner>")]
        private array $owners = [],

        #[JMS\XmlElement]
        #[JMS\SerializedName("moneyTransactions")]
        #[JMS\XmlList(entry: "moneyTransaction")]
        #[JMS\Type("array<Goosfraba\Kontomatik\Importing\AccountTransaction>")]
        private array $transactions = [],

        #[JMS\XmlAttribute]
        #[JMS\SerializedName("partialDueToTimeout")]
        private ?bool $partial = false
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
    public function getIban(): ?string
    {
        return $this->iban;
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
     * @return \DateTimeInterface|null
     */
    public function getActiveSinceAtLeast(): ?\DateTimeInterface
    {
        return $this->activeSinceAtLeast;
    }

    /**
     * @return AccountOwner[]
     */
    public function getOwners(): array
    {
        return $this->owners;
    }

    /**
     * @return AccountTransaction[]
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