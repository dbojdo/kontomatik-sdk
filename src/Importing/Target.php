<?php

namespace Goosfraba\Kontomatik\Importing;

use JMS\Serializer\Annotation as JMS;

final class Target
{
    public function __construct(
        #[JMS\XmlAttribute]
        private ?string $name = null,

        #[JMS\XmlAttribute]
        #[JMS\SerializedName("officialName")]
        private ?string $officialName = null,

        #[JMS\XmlAttribute]
        private ?string $institution = null,
        #[JMS\XmlElement]
        #[JMS\XmlList(entry: "owner")]
        #[JMS\Type("array<Goosfraba\Kontomatik\Importing\Owner>")]
        private array $owners = [],

        #[JMS\XmlElement]
        #[JMS\XmlList(entry: "account")]
        #[JMS\Type("array<Goosfraba\Kontomatik\Importing\Account>")]
        private array $accounts = [],

        #[JMS\XmlElement]
        #[JMS\SerializedName("creditCards")]
        #[JMS\XmlList(entry: "creditCard")]
        #[JMS\Type("array<Goosfraba\Kontomatik\Importing\CreditCard>")]
        private array $creditCards = []
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
    public function getOfficialName(): ?string
    {
        return $this->officialName;
    }

    /**
     * @return string|null
     */
    public function getInstitution(): ?string
    {
        return $this->institution;
    }

    /**
     * @return Owner[]
     */
    public function getOwners(): array
    {
        return $this->owners;
    }

    /**
     * @return Account[]
     */
    public function getAccounts(): array
    {
        return $this->accounts;
    }

    /**
     * @return CreditCard[]
     */
    public function getCreditCards(): array
    {
        return $this->creditCards;
    }
}
