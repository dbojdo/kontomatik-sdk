<?php

namespace Goosfraba\Kontomatik\Lending;

use Goosfraba\Kontomatik\GenericReply;
use Goosfraba\Kontomatik\Reply;

final class OwnerScoreReply extends Reply
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
        $this->assertDataType(OwnerScores::class);
    }

    /**
     * Gets the OwnerScores result
     *
     * @return OwnerScores|null
     */
    public function getOwnerScores(): ?OwnerScores
    {
        return $this->getReplyData();
    }
}