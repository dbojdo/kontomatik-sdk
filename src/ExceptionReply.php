<?php

namespace Goosfraba\Kontomatik;

final class ExceptionReply extends Reply
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
        $this->assertDataType(Exception::class);
    }

    /**
     * Gets the exception
     *
     * @return Exception|null
     */
    public function getException(): ?Exception
    {
        return $this->getReplyData();
    }
}
