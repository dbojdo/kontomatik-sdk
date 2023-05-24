<?php

namespace Goosfraba\Kontomatik\Importing;

use Goosfraba\Kontomatik\AbstractApiTestCase;

class ImportingApiTest extends AbstractApiTestCase
{
    private ImportingHttpApi $api;

    protected function setUp(): void
    {
        $this->api = $this->apiFactory()->importingApi($this->dsn());
    }

    /**
     * @test
     * @dataProvider commandIds
     */
    public function itGetsCommandById(string $commandId): void
    {
        $this->api->getCommand($commandId);
    }

    public static function commandIds(): array
    {
        // provide known command IDs to run test
        return [
//            ["455164989"]
        ];
    }

    /**
     * @test
     * @dataProvider importSessions
     */
    public function itSchedulesDefaultImport(Session $session): void
    {
        $request = new DefaultImportRequest(
            $session,
            date_create_immutable("now - 6 months")
        );

        $commandReply = $this->api->defaultImport($request);
        $this->assertEquals("setup", $commandReply->getCommand()->getState());
    }

    public static function importSessions(): array
    {
        // provide known session IDs to run the test
        return [
//            [
//                new Session(
//                    "455164974",
//                    "9621ab329e6e13a6d0ef05eb240de462921228e001a0200c53ef8af286a281e4"
//                )
//            ]
        ];
    }

    /**
     * @test
     * @dataProvider ownerExternalIds
     */
    public function itGetsAggregatedData(string $ownerExternalId): void
    {
        $dataReply = $this->api->getData($ownerExternalId);
        $this->assertInstanceOf(DataReply::class, $dataReply);
    }

    public static function ownerExternalIds(): array
    {
        // provide known owner external IDs to run the test
        return [
//            ["kontomatik-34cb892d-3db4-407a-bc94-0eeb6ce58721"]
        ];
    }

    /**
     * @test
     * @dataProvider signOutSessions
     */
    public function itSignsOut(Session $session): void
    {
        $this->api->signOut($session);
    }

    public static function signOutSessions(): array
    {
        // provide known sessions to run the test
        return [];
    }
}