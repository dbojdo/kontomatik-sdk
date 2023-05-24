<?php

namespace Goosfraba\Kontomatik\Exception;

use Goosfraba\Kontomatik\Exception;
use Goosfraba\Kontomatik\ExceptionReply;
use Goosfraba\Kontomatik\UnauthorizedReply;

/**
 * A base class for specific API exceptions
 */
abstract class ApiException extends \RuntimeException
{
    protected ExceptionReply|UnauthorizedReply|null $reply = null;

    /**
     *
     * @param ExceptionReply|UnauthorizedReply $reply
     * @return static
     */
    public static function fromReply(ExceptionReply|UnauthorizedReply $reply): static
    {
        list($exceptionClass, $message) = self::resolveException($reply->getException());
        $e = new $exceptionClass($message);
        $e->reply = $reply;

        return $e;
    }

    /**
     * Resolves the class and the message of the exception based on the Exception DTO
     *
     * @param mixed $exception
     * @return array
     */
    private static function resolveException(mixed $exception): array
    {
        $exceptionClass = GenericException::class;
        $message = "Kontomatik API error";
        if ($exception instanceof Exception) {
            $exceptionClass = sprintf("%s\\%sException", __NAMESPACE__, $exception->getName());
            $message = $exception->getMessage();
        }

        return class_exists($exceptionClass) ? [$exceptionClass, $message] : [GenericException::class, $message];
    }

    /**
     * Gets the original reply causing the error
     *
     * @return ExceptionReply|UnauthorizedReply|null
     */
    public function getReply(): ExceptionReply|UnauthorizedReply|null
    {
        return $this->reply;
    }
}
