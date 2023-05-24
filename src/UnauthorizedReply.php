<?php

namespace Goosfraba\Kontomatik;

final class UnauthorizedReply extends Reply
{
    public function __construct(
        GenericReply $reply
    ) {
        parent::__construct(
            $reply->getStatus(),
            $reply->getUser(),
            $reply->getOwnerExternalId(),
            $reply->getResponseTimestamp(),
            $reply->getReplyData()
        );
        $this->assertDataType("string");
    }

    /**
     * Gets the comment
     *
     * @return string|null
     */
    public function getComment(): ?string
    {
        return $this->getReplyData();
    }
}
