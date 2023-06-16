<?php

namespace App\Http;

use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;

class ServerRequestFactory implements ServerRequestFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createServerRequest(string $method, $uri, array $serverParams = []): ServerRequestInterface
    {
        if (gettype($uri) === 'string') {
            $uri = (new UriFactory())->createUri($uri);
        }

        return (new ServerRequest($serverParams))
            ->withMethod($method)
            ->withUri($uri);
    }
}