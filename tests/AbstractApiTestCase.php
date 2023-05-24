<?php

namespace Goosfraba\Kontomatik;

use Goosfraba\Kontomatik\Common\ApiFactory;
use Goosfraba\Kontomatik\Common\Dsn;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;

abstract class AbstractApiTestCase extends TestCase
{
    protected function apiFactory(): ApiFactory
    {
        $logger = new Logger("kontomatik");
        $logger->pushHandler(new StreamHandler('php://stdout', Level::Debug));

        return new ApiFactory($logger);
    }

    protected function dsn(): Dsn
    {
        $dsn = getenv("KONTOMATIK_DSN");
        if (!$dsn) {
            $this->markTestSkipped("KONTOMATIK_DSN must be set in your phpunit.xml");
        }

        return Dsn::parse($dsn);
    }
}
