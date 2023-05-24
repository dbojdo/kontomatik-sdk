<?php

namespace Goosfraba\Kontomatik\Common\Buzz;

use Buzz\Middleware\MiddlewareInterface;
use Nyholm\Psr7\Uri;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Prepends the URI with the base URL for every request
 */
final class BaseUrlMiddleware implements MiddlewareInterface
{
    public function __construct(private string $baseUrl)
    {
    }

    /**
     * @inheritDoc
     */
    public function handleRequest(RequestInterface $request, callable $next)
    {
        return $next(
            $request->withUri(
                new Uri(
                    sprintf('%s/%s', $this->baseUrl, ltrim($request->getUri(), '/'))
                )
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function handleResponse(RequestInterface $request, ResponseInterface $response, callable $next)
    {
        return $next($request, $response);
    }
}