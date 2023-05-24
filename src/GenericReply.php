<?php

namespace Goosfraba\Kontomatik;

final class GenericReply extends Reply
{
    /**
     * Creates a copy with reply data set
     *
     * @param mixed $replyData
     * @return self
     * @internal To be used be the serializer
     */
    public function withReplyData(mixed $replyData): self
    {
        return new self(
            $this->getStatus(),
            $this->getUser(),
            $this->getOwnerExternalId(),
            $this->getResponseTimestamp(),
            $replyData
        );
    }
}