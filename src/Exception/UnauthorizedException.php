<?php

namespace Goosfraba\Kontomatik\Exception;

use Goosfraba\Kontomatik\ExceptionReply;
use Goosfraba\Kontomatik\UnauthorizedReply;

final class UnauthorizedException extends ApiException
{
    public static function fromReply(ExceptionReply|UnauthorizedReply $reply): static
    {
        $e = new self($reply->getComment() ?? "Unauthorized");
        $e->reply = $reply;

        return $e;
    }
}