<?php

namespace Goosfraba\Kontomatik\Lending;

use Goosfraba\Kontomatik\AbstractApiTestCase;

class LendingHttpApiTest extends AbstractApiTestCase
{
    private LendingHttpApi $api;

    protected function setUp(): void
    {
        $this->api = $this->apiFactory()->lendingApi($this->dsn());
    }

    /**
     * @test
     * @dataProvider scoresOwnerExternalIds
     */
    public function itGetScores(string $ownerExternalId): void
    {
        $scoresReply = $this->api->getScore($ownerExternalId);
        $this->assertInstanceOf(OwnerScores::class, $scoresReply->getOwnerScores());
    }

    public static function scoresOwnerExternalIds(): array
    {
        // provide known sessions to run the test
        return [
//            ["kontomatik-34cb892d-3db4-407a-bc94-0eeb6ce58721"]
        ];
    }
}