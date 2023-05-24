<?php

namespace Goosfraba\Kontomatik\Importing;

use Goosfraba\Kontomatik\GenericReply;
use Goosfraba\Kontomatik\Reply;

final class CommandReply extends Reply
{
    public function __construct(
        GenericReply $reply
    ) {
        parent::__construct(
            $reply->getStatus(), $reply->getUser(), $reply->getOwnerExternalId(), $reply->getResponseTimestamp(), $reply->getReplyData()
        );
        $this->assertDataType(Command::class);
    }

    /**
     * Gets the command
     *
     * @return Command|null
     */
    public function getCommand(): ?Command
    {
        return $this->getReplyData();
    }
}
