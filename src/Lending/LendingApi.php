<?php

namespace Goosfraba\Kontomatik\Lending;

interface LendingApi
{
    /**
     * Gets the score for given owner external ID
     *
     * @param string $ownerExternalId
     * @return OwnerScoreReply
     */
    public function getScore(string $ownerExternalId): OwnerScoreReply;
}
