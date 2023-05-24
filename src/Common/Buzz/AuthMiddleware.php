<?php

namespace Goosfraba\Kontomatik\Common\Buzz;

use Buzz\Middleware\MiddlewareInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Adds the Api-Key header to every request
 */
final class AuthMiddleware implements MiddlewareInterface
{
    public function __construct(private string $apiKey)
    {
    }

    /**
     * @inheritDoc
     */
    public function handleRequest(RequestInterface $request, callable $next)
    {
        $request = $request->withAddedHeader('X-Api-Key', $this->apiKey);

        return $next($request);
    }

    /**
     * @inheritDoc
     */
    public function handleResponse(RequestInterface $request, ResponseInterface $response, callable $next)
    {
        return $next($request, $response);
    }
}