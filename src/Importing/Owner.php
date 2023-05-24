<?php

namespace Goosfraba\Kontomatik\Importing;

use JMS\Serializer\Annotation as JMS;

final class Owner
{
    public function __construct(
        #[JMS\XmlElement]
        private ?string $name = null,

        #[JMS\XmlElement]
        private ?string $address = null,

        #[JMS\XmlElement]
        #[JMS\SerializedName("polishPesel")]
        private ?string $polishPesel = null,

        #[JMS\XmlElement]
        private ?string $phone = null,

        #[JMS\XmlElement]
        private ?string $email = null,

        #[JMS\XmlElement]
        private ?string $citizenship = null,

        #[JMS\XmlElement]
        private ?string $nationality = null,

        #[JMS\XmlElement]
        #[JMS\SerializedName("personalDocumentType")]
        private ?string $personalDocumentType = null,

        #[JMS\XmlElement]
        #[JMS\SerializedName("personalDocumentNumber")]
        private ?string $personalDocumentNumber = null,

        #[JMS\XmlElement]
        #[JMS\SerializedName("birthDate")]
        private ?string $birthDate = null,

        #[JMS\XmlElement]
        #[JMS\SerializedName("birthPlace")]
        private ?string $birthPlace = null,

        #[JMS\XmlElement]
        private ?string $kind = null
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
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @return string|null
     */
    public function getPolishPesel(): ?string
    {
        return $this->polishPesel;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getCitizenship(): ?string
    {
        return $this->citizenship;
    }

    /**
     * @return string|null
     */
    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    /**
     * @return string|null
     */
    public function getPersonalDocumentType(): ?string
    {
        return $this->personalDocumentType;
    }

    /**
     * @return string|null
     */
    public function getPersonalDocumentNumber(): ?string
    {
        return $this->personalDocumentNumber;
    }

    /**
     * @return string|null
     */
    public function getBirthDate(): ?string
    {
        return $this->birthDate;
    }

    /**
     * @return string|null
     */
    public function getBirthPlace(): ?string
    {
        return $this->birthPlace;
    }

    /**
     * @return string|null
     */
    public function getKind(): ?string
    {
        return $this->kind;
    }
}
