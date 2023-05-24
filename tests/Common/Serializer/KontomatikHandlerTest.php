<?php

namespace Goosfraba\Kontomatik\Common\Serializer;

use Goosfraba\Kontomatik\Exception;
use Goosfraba\Kontomatik\GenericReply;
use Goosfraba\Kontomatik\Importing\Command;
use Goosfraba\Kontomatik\Importing\CommandProgress;
use Goosfraba\Kontomatik\Importing\OwnerData;
use Goosfraba\Kontomatik\Importing\Target;
use Goosfraba\Kontomatik\Lending\OwnerScores;
use JMS\Serializer\Handler\HandlerRegistryInterface;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\TestCase;

class KontomatikHandlerTest extends TestCase
{
    private SerializerInterface $serializer;

    protected function setUp(): void
    {
        $serializerBuilder = SerializerBuilder::create();
        $serializerBuilder->addDefaultHandlers();
        $serializerBuilder->addDefaultListeners();
        $serializerBuilder->configureHandlers(function (HandlerRegistryInterface $registry) {
            $registry->registerSubscribingHandler(
                new KontomatikHandler()
            );
        });

        $this->serializer = $serializerBuilder->build();
    }

    /**
     * @test
     */
    public function itDeserializesUnauthorizedReply(): void
    {
        /** @var GenericReply $reply */
        $reply = $this->serializer->deserialize(
            file_get_contents(__DIR__ . '/xml/unauthorized-reply.xml'),
            ReplyTypes::unauthorizedException(),
            "xml"
        );

        $this->assertInstanceOf(GenericReply::class, $reply);
        $this->assertIsString($reply->getReplyData());
    }

    /**
     * @test
     */
    public function itDeserializesUnauthorizedReplyWithArrayType(): void
    {
        /** @var GenericReply $reply */
        $reply = $this->serializer->deserialize(
            file_get_contents(__DIR__ . '/xml/unauthorized-reply.xml'),
            sprintf("Reply<%s>", ReplyTypes::UNAUTHORIZED_EXCEPTION),
            "xml"
        );

        $this->assertInstanceOf(GenericReply::class, $reply);
        $this->assertIsString($reply->getReplyData());
    }

    /**
     * @test
     */
    public function itDeserializesCommandNotAvailableReply(): void
    {
        /** @var GenericReply $reply */
        $reply = $this->serializer->deserialize(
            file_get_contents(__DIR__ . '/xml/command-not-available-reply.xml'),
            ReplyTypes::exception(),
            "xml"
        );

        $this->assertInstanceOf(GenericReply::class, $reply);
        $this->assertInstanceOf(Exception::class, $reply->getReplyData());
    }

    /**
     * @test
     */
    public function itDeserializesCommandNotAvailableReplyWithArrayType(): void
    {
        /** @var GenericReply $reply */
        $reply = $this->serializer->deserialize(
            file_get_contents(__DIR__ . '/xml/command-not-available-reply.xml'),
            sprintf("Reply<%s>", ReplyTypes::EXCEPTION),
            "xml"
        );

        $this->assertInstanceOf(GenericReply::class, $reply);
        $this->assertInstanceOf(Exception::class, $reply->getReplyData());
    }

    /**
     * @test
     */
    public function itDeserializesCommand(): void
    {

        /** @var GenericReply $reply */
        $reply = $this->serializer->deserialize(
            file_get_contents(__DIR__ . '/xml/v1.default-import-reply.xml'),
            ReplyTypes::command(),
            'xml'
        );

        $this->assertInstanceOf(GenericReply::class, $reply);
        $this->assertInstanceOf(Command::class, $reply->getReplyData());
    }

    /**
     * @test
     */
    public function itDeserializesCommandWithArrayType(): void
    {

        /** @var GenericReply $reply */
        $reply = $this->serializer->deserialize(
            file_get_contents(__DIR__ . '/xml/v1.default-import-reply.xml'),
            "Reply<Command<'DefaultImportCommand'>>",
            'xml'
        );

        $this->assertInstanceOf(GenericReply::class, $reply);
        $this->assertInstanceOf(Command::class, $reply->getReplyData());
    }

    /**
     * @test
     */
    public function itDeserializesCommandWithException(): void
    {
        /** @var GenericReply $result */
        $result = $this->serializer->deserialize(
            file_get_contents(__DIR__.'/xml/v1.command-reply.exception.xml'),
            ReplyTypes::command(),
            'xml'
        );

        $this->assertEquals('200 OK', $result->getStatus());

        $this->assertEquals(
            new Command(
                '000000',
                'error',
                'SomeName',
                null,
                null,
                new CommandProgress(20),
                null,
                new Exception(
                    "SessionExpired",
                    "Exception message",
                    "Exception message in local language"
                )
            ),
            $result->getReplyData()
        );
    }

    /**
     * @test
     */
    public function itDeserializesReplyWithCommand(): void
    {
        /** @var GenericReply $result */
        $result = $this->serializer->deserialize(
            file_get_contents(__DIR__ . '/xml/v1.command-reply.default-import.xml'),
            ReplyTypes::command(),
            'xml'
        );

        /** @var Command $command */
        $command = $result->getReplyData();
        $this->assertInstanceOf(Command::class, $command);
        $this->assertInstanceOf(Target::class, $command->getResult());
    }

    /**
     * @test
     */
    public function itDeserializedDataReply(): void
    {
        /** @var GenericReply $result */
        $result = $this->serializer->deserialize(
            file_get_contents(__DIR__ . '/xml/v1.data-reply.xml'),
            ReplyTypes::ownerData(),
            'xml'
        );

        /** @var OwnerData $ownerResponse */
        $ownerResponse = $result->getReplyData();
        $this->assertInstanceOf(OwnerData::class, $ownerResponse);
    }

    /**
     * @test
     */
    public function itDeserializesOwnerScoresReply(): void
    {
        /** @var GenericReply $result */
        $result = $this->serializer->deserialize(
            file_get_contents(__DIR__ . '/xml/v1.owner-scores-reply.xml'),
            ReplyTypes::ownerScores(),
            'xml'
        );
        $this->assertInstanceOf(OwnerScores::class, $result->getReplyData());
    }
}