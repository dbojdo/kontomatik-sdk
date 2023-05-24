<?php

namespace Goosfraba\Kontomatik\Importing;

use Goosfraba\Kontomatik\GenericReply;
use Goosfraba\Kontomatik\Reply;

final class DataReply extends Reply
{
    public function __construct(
        GenericReply $reply
    ) {
        parent::__construct(
            $reply->getStatus(), $reply->getUser(), $reply->getOwnerExternalId(), $reply->getResponseTimestamp(), $reply->getReplyData()
        );
        $this->assertDataType(OwnerData::class);
    }

    /**
     * Gets the command
     *
     * @return OwnerData|null
     */
    public function getOwnerResponse(): ?OwnerData
    {
        return $this->getReplyData();
    }
}