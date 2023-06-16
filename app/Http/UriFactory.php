<?php

namespace App\Http;

use Psr\Http\Message\UriInterface;

class UriFactory implements \Psr\Http\Message\UriFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createUri(string $uri = ''): UriInterface
    {
        return new Uri($uri);
    }
}