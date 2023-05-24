<?php

namespace Goosfraba\Kontomatik\Common;

use Buzz\Browser;
use Goosfraba\Kontomatik\Common\Serializer\ReplyTypes;
use Goosfraba\Kontomatik\Exception;
use Goosfraba\Kontomatik\ExceptionReply;
use Goosfraba\Kontomatik\GenericReply;
use Goosfraba\Kontomatik\UnauthorizedReply;
use JMS\Serializer\SerializerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * A base class for specific APis
 */
abstract class AbstractApi
{
    public function __construct(
        private Browser $browser,
        private SerializerInterface $serializer,
        private ?LoggerInterface $logger = null
    ) {
        $this->logger = $this->logger ?? new NullLogger();
    }

    /**
     * Executes the POST request and interpret the response for the result
     *
     * @param string $url
     * @param array $data
     * @param string|null $responseType
     * @return GenericReply
     * @throws Exception\ApiException
     */
    protected function post(string $url, array $data, ?string $responseType): GenericReply
    {
        $response = $this->browser->submitForm($url, $data);
        return $this->hydrate($response, $responseType);
    }

    /**
     * Executes the GET request and interpret the response for the result
     *
     * @param string $url
     * @param string $responseType
     * @return GenericReply
     * @throws Exception\ApiException
     */
    protected function get(string $url, string $responseType): GenericReply
    {
        $response = $this->browser->get($url);

        return $this->hydrate($response, $responseType);
    }

    /**
     * Executes the DELETE request and interpret the response for the result
     *
     * @param string $url
     * @param string|null $responseType
     * @return GenericReply
     * @throws Exception\ApiException
     */
    protected function delete(string $url, ?string $responseType): GenericReply
    {
        $response = $this->browser->get($url);

        return $this->hydrate($response, $responseType);
    }

    /**
     * Hydrates the HTTP response to the required type
     *
     * @param ResponseInterface $response
     * @param string|null $responseType
     * @return GenericReply
     * @throws Exception\ApiException
     */
    private function hydrate(ResponseInterface $response, ?string $responseType): GenericReply
    {
        $content = $response->getBody()->getContents();

        $this->logger->debug($response->getStatusCode());
        $this->logger->debug($content);

        if ($response->getStatusCode() < 400) {
            return $this->serializer->deserialize(
                $content, ReplyTypes::ofType($responseType), 'xml'
            );
        }

        throw match ($response->getStatusCode()) {
            401 => Exception\UnauthorizedException::fromReply(
                new UnauthorizedReply(
                    $this->serializer->deserialize(
                        $content, ReplyTypes::unauthorizedException(), 'xml'
                    )
                )
            ),
            default => Exception\ApiException::fromReply(
                new ExceptionReply(
                    $this->serializer->deserialize(
                        $content, ReplyTypes::exception(), 'xml'
                    )
                )
            )
        };
    }
}