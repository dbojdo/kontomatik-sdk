<?php

namespace Goosfraba\Kontomatik\Common;

use Buzz\Browser;
use Buzz\Client\Curl;
use Buzz\Middleware\LoggerMiddleware;
use Goosfraba\Kontomatik\Common\Buzz\AuthMiddleware;
use Goosfraba\Kontomatik\Common\Buzz\BaseUrlMiddleware;
use Goosfraba\Kontomatik\Common\Serializer\KontomatikHandler;
use Goosfraba\Kontomatik\Importing\ImportingApi;
use Goosfraba\Kontomatik\Importing\ImportingHttpApi;
use Goosfraba\Kontomatik\Lending\LendingApi;
use Goosfraba\Kontomatik\Lending\LendingHttpApi;
use JMS\Serializer\Handler\HandlerRegistryInterface;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Factory for the supported APIs
 */
final class ApiFactory
{
    public function __construct(private ?LoggerInterface $logger = null)
    {
        $this->logger = $this->logger ?? new NullLogger();
    }

    /**
     * Creates ImportinApi instance
     *
     * @param Dsn $dsn
     * @return ImportingApi
     */
    public function importingApi(Dsn $dsn): ImportingApi
    {
        $serializerBuilder = SerializerBuilder::create();
        $serializerBuilder->addDefaultHandlers();
        $serializerBuilder->addDefaultListeners();
        $serializerBuilder->configureHandlers(function (HandlerRegistryInterface $registry) {
            $registry->registerSubscribingHandler(
                new KontomatikHandler()
            );
        });

        return new ImportingHttpApi(
            $this->createBrowser($dsn),
            $serializerBuilder->build(),
            $this->logger
        );
    }

    /**
     * Creates LendingApi instance
     *
     * @param Dsn $dsn
     * @return LendingApi
     */
    public function lendingApi(Dsn $dsn): LendingApi
    {

        return new LendingHttpApi(
            $this->createBrowser($dsn),
            $this->createSerializer(),
            $this->logger
        );
    }

    /**
     * Creates the browser
     *
     * @param Dsn $dsn
     * @return Browser
     */
    private function createBrowser(Dsn $dsn): Browser
    {
        $factory = new Psr17Factory();
        $browser = new Browser(
            new Curl($factory),
            $factory
        );
        $browser->addMiddleware(
            new BaseUrlMiddleware($dsn->env()->url())
        );
        $browser->addMiddleware(
            new AuthMiddleware($dsn->apiKey())
        );
        $browser->addMiddleware(
            new LoggerMiddleware($this->logger)
        );

        return $browser;
    }

    /**
     * Creates the serializer
     *
     * @return SerializerInterface
     */
    private function createSerializer(): SerializerInterface
    {
        $serializerBuilder = SerializerBuilder::create();
        $serializerBuilder->addDefaultHandlers();
        $serializerBuilder->addDefaultListeners();
        $serializerBuilder->configureHandlers(function (HandlerRegistryInterface $registry) {
            $registry->registerSubscribingHandler(
                new KontomatikHandler()
            );
        });

        return $serializerBuilder->build();
    }
}