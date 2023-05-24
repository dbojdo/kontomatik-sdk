<?php

namespace Goosfraba\Kontomatik\Importing;

use Goosfraba\Kontomatik\Exception\ApiException;

/**
 * Provides data importing related operations
 */
interface ImportingApi
{
    /**
     * Schedules the default import job
     *
     * @param DefaultImportRequest $request
     * @return CommandReply
     * @throws ApiException
     */
    public function defaultImport(DefaultImportRequest $request): CommandReply;

    /**
     * Gets the command status
     *
     * @param string $id
     * @return CommandReply
     * @throws ApiException
     */
    public function getCommand(string $id): CommandReply;

    /**
     * Gets the aggregated data for given owner
     *
     * @param string $ownerExternalId
     * @return DataReply
     * @throws ApiException
     */
    public function getData(string $ownerExternalId): DataReply;

    /**
     * Removes the imported data for given owner
     *
     * @param string $ownerExternalId
     * @return void
     * @throws ApiException
     */
    public function removeData(string $ownerExternalId): void;

    /**
     * Signs out
     *
     * @param Session $session
     * @return void
     */
    public function signOut(Session $session): void;
}
