<?php

namespace Goosfraba\Kontomatik\Importing;

use Goosfraba\Kontomatik\Common\AbstractApi;
use Goosfraba\Kontomatik\Common\Serializer\ReplyTypes;

final class ImportingHttpApi extends AbstractApi implements ImportingApi
{
    /**
     * @inheritDoc
     */
    public function defaultImport(DefaultImportRequest $request): CommandReply
    {
        return new CommandReply(
            $this->post(
                "/v1/command/default-import.xml",
                [
                    "sessionId" => $request->getSession()->getId(),
                    "sessionIdSignature" => $request->getSession()->getSignature(),
                    "since" => $request->getSince()->format("Y-m-d")
                ],
                ReplyTypes::COMMAND
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function getCommand(string $id): CommandReply
    {
        return new CommandReply(
            $this->get(
                sprintf("/v1/command/%s.xml", $id),
                ReplyTypes::COMMAND
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function getData(string $ownerExternalId): OwnerDataReply
    {
        return new OwnerDataReply(
            $this->get(
                sprintf("/v1/data.xml?ownerExternalId=%s", $ownerExternalId),
                ReplyTypes::OWNER_DATA
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function removeData(string $ownerExternalId): void
    {
        $this->delete(
            sprintf("/v1/data.xml?ownerExternalId=%s", $ownerExternalId),
            null
        );
    }

    /**
     * @inheritDoc
     */
    public function signOut(Session $session): void
    {
        $this->post(
            "/v1/command/sign-out.xml",
            ["sessionId" => $session->getId(), "sessionIdSignature" => $session->getSignature()],
            null
        );
    }
}
