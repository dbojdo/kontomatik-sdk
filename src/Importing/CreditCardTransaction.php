<?php

namespace Goosfraba\Kontomatik\Importing;

use JMS\Serializer\Annotation as JMS;

final class CreditCardTransaction extends MoneyTransaction
{
    public function __construct(
        ?\DateTimeInterface $transactionOn = null,
        ?\DateTimeInterface $bookedOn = null,
        ?float $currencyAmount = null,
        ?float $currencyBalance = null,
        ?string $title = null,
        ?string $party = null,
        ?string $partyIban = null,
        ?string $kind = null,
        ?string $status = null,
        ?array $labels = [],

        #[JMS\XmlElement]
        #[JMS\SerializedName("variableSymbol")]
        private ?string $variableSymbol = null,

        #[JMS\XmlElement]
        #[JMS\SerializedName("constantSymbol")]
        private ?string $constantSymbol = null
    ) {
        parent::__construct($transactionOn, $bookedOn, $currencyAmount, $currencyBalance, $title, $party, $partyIban, $kind, $status, $labels);
    }

    /**
     * @return string|null
     */
    public function getVariableSymbol(): ?string
    {
        return $this->variableSymbol;
    }

    /**
     * @return string|null
     */
    public function getConstantSymbol(): ?string
    {
        return $this->constantSymbol;
    }
}