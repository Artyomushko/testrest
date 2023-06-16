<?php

namespace App\Http;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

class Request extends Message implements RequestInterface
{
    protected string $method;
    protected string $target = '/';
    protected UriInterface $uri;

    public function getRequestTarget(): string
    {
        return $this->target;
    }

    public function withRequestTarget(string $requestTarget): RequestInterface
    {
        $this->target = $requestTarget;

        return $this;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function withMethod(string $method): RequestInterface
    {
        $this->method = $method;

        return $this;
    }

    public function getUri(): UriInterface
    {
        return $this->uri;
    }

    public function withUri(UriInterface $uri, bool $preserveHost = false): RequestInterface
    {
        $this->uri = $uri;

        return $this;
    }
}