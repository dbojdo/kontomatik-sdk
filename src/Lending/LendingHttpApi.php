<?php

namespace Goosfraba\Kontomatik\Lending;

use Goosfraba\Kontomatik\Common\AbstractApi;
use Goosfraba\Kontomatik\Common\Serializer\ReplyTypes;

final class LendingHttpApi extends AbstractApi implements LendingApi
{
    /**
     * @inheritDoc
     */
    public function getScore(string $ownerExternalId): OwnerScoreReply
    {
        return new OwnerScoreReply(
            $this->get(
                sprintf("/v1/owner-scores.xml?ownerExternalId=%s", $ownerExternalId),
                ReplyTypes::OWNER_SCORES
            )
        );
    }
}
