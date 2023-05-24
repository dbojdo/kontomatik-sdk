<?php

namespace Goosfraba\Kontomatik\Common\Serializer;

final class ReplyTypes
{
    public const COMMAND = "Command";
    public const EXCEPTION = "Exception";
    public const UNAUTHORIZED_EXCEPTION = "UnauthorizedException";
    public const OWNER_DATA = "OwnerData";
    public const OWNER_SCORES = "OwnerScores";

    private function __construct() {
    }

    public static function command(): string
    {
        return self::ofType(self::COMMAND);
    }

    public static function exception(): string
    {
        return self::ofType(self::EXCEPTION);
    }

    public static function unauthorizedException(): string
    {
        return self::ofType(self::UNAUTHORIZED_EXCEPTION);
    }

    public static function ownerData(): string
    {
        return self::ofType(self::OWNER_DATA);
    }

    public static function ownerScores(): string
    {
        return self::ofType(self::OWNER_SCORES);
    }

    public static function ofType(string $type): string
    {
        return sprintf("Reply<'%s'>", $type);
    }
}