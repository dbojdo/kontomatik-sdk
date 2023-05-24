<?php

namespace Goosfraba\Kontomatik\Common\Serializer;

use Goosfraba\Kontomatik\Exception;
use Goosfraba\Kontomatik\GenericReply;
use Goosfraba\Kontomatik\Importing\Command;
use Goosfraba\Kontomatik\Importing\OwnerData;
use Goosfraba\Kontomatik\Importing\Target;
use Goosfraba\Kontomatik\Lending\OwnerScores;
use Goosfraba\Kontomatik\Reply;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\Visitor\DeserializationVisitorInterface;

final class KontomatikHandler implements SubscribingHandlerInterface
{

    /**
     * @inheritDoc
     */
    public static function getSubscribingMethods(): array
    {
        return [
            [
                'direction' =>  GraphNavigatorInterface::DIRECTION_DESERIALIZATION,
                'format' => 'xml',
                'type' => 'Reply',
                'method' => 'deserializeReply'
            ],
            [
                'direction' =>  GraphNavigatorInterface::DIRECTION_DESERIALIZATION,
                'format' => 'xml',
                'type' => 'Command',
                'method' => 'deserializeCommand'
            ]
        ];
    }

    /**
     * Deserializes given XML into Reply object
     *
     * @param DeserializationVisitorInterface $visitor
     * @param $data
     * @param array $type
     * @param DeserializationContext $context
     * @return Reply
     */
    public function deserializeReply(
        DeserializationVisitorInterface $visitor,
        $data,
        array $type,
        DeserializationContext $context
    ): Reply {
        /** @var GenericReply $reply */
        $reply = $context->getNavigator()->accept($data, ['name' => GenericReply::class]);

        @list($element, $innerType) = $this->resolveReplyInnerTypeAndElement($type);;
        if (!($innerType && $element)) {
            return $reply->withReplyData(null);
        }

        return $reply->withReplyData(
            $data->{$element} ? $context->getNavigator()->accept($data->{$element}, $innerType) : null
        );
    }

    /**
     * Resolves the inner type and the XML element of the response content
     * @param array $type
     * @return array
     */
    private function resolveReplyInnerTypeAndElement(array $type): array
    {

        $innerType = $type['params']['0'];
        $extractedType = is_array($innerType) ? $innerType['name'] : $innerType;
        return match ($extractedType) {
            ReplyTypes::UNAUTHORIZED_EXCEPTION => ["comment", ['name' => 'string', $innerType['params'] ?? []]],
            ReplyTypes::EXCEPTION => ["exception", ['name' => Exception::class, 'params' => $innerType['params'] ?? []]],
            ReplyTypes::COMMAND => ["command", ['name' => 'Command', 'params' => $innerType['params'] ?? []]],
            ReplyTypes::OWNER_DATA => ['owner', ['name' => OwnerData::class, 'params' => $innerType['params'] ?? []]],
            ReplyTypes::OWNER_SCORES => ["models", ['name' => OwnerScores::class, 'params' => $innerType['params'] ?? []]],
            default => []
        };
    }

    /**
     * Deserializes given XML into Command object
     *
     * @param DeserializationVisitorInterface $visitor
     * @param $data
     * @param array $type
     * @param DeserializationContext $context
     * @return Command
     */
    public function deserializeCommand(
        DeserializationVisitorInterface $visitor,
        $data,
        array $type,
        DeserializationContext $context
    ): Command {
        /** @var Command $command */
        $command = $context->getNavigator()->accept($data, ['name' => Command::class]);
        $commandName = @$type['params'][0];
        $resultType = $this->commandResultType($commandName ?? $command->getName());

        return $command->withResult(
            $resultType && $data->result ? $context->getNavigator()->accept($data->result, $resultType) : null
        );
    }

    /**
     * Resolves the command result type based on the command name
     *
     * @param string|null $commandName
     * @return array|string[]
     */
    private function commandResultType(?string $commandName): array
    {
        return match ($commandName) {
            "DefaultImportCommand" => ['name' => Target::class],
            default => []
        };
    }
}
