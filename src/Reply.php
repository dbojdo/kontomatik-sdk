<?php

namespace Goosfraba\Kontomatik;

use JMS\Serializer\Annotation as JMS;

abstract class Reply
{
    public function __construct(
        #[JMS\XmlAttribute]
        private ?string $status = null,

        #[JMS\XmlAttribute]
        private ?string $user = null,

        #[JMS\XmlAttribute]
        #[JMS\SerializedName("ownerExternalId")]
        private ?string $ownerExternalId = null,

        #[JMS\XmlAttribute]
        #[JMS\SerializedName("responseTimestamp")]
        #[JMS\Type("DateTimeImmutable")]
        private ?\DateTimeInterface $responseTimestamp = null,

        #[JMS\Exclude]
        private mixed $replyData = null
    ) {
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @return string|null
     */
    public function getUser(): ?string
    {
        return $this->user;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getResponseTimestamp(): ?\DateTimeInterface
    {
        return $this->responseTimestamp;
    }

    /**
     * @return string|null
     */
    public function getOwnerExternalId(): ?string
    {
        return $this->ownerExternalId;
    }

    /**
     * @return mixed
     */
    public function getReplyData(): mixed
    {
        return $this->replyData;
    }

    /**
     * @param string $type
     * @return void
     */
    protected function assertDataType(string $type): void
    {
        if ($this->replyData === null) {
            return;
        }

        // object
        if (class_exists($type) && $this->replyData instanceof $type) {
            return;
        }

        // scalar
        if (gettype($this->replyData) === $type) {
            return;
        }

        throw new \InvalidArgumentException(
            sprintf("Reply data must be an instance of \"%s\"", $type)
        );
    }
}
