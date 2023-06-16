<?php

namespace App\Http;

use Psr\Http\Message\UriInterface;

class Uri implements UriInterface
{
    private string $scheme;
    private string $authority = '';
    private string $user = '';
    private string $host = '';
    private ?int $port = null;
    private string $path = '/';
    private string $query = '';
    private string $fragment = '';

    public function __construct(string $uri) {
        $parsed = parse_url($uri);
        $this->path = $parsed['path'];
    }

    /**
     * @inheritDoc
     */
    public function getScheme(): string
    {
        return $this->scheme;
    }

    /**
     * @inheritDoc
     */
    public function getAuthority(): string
    {
        return $this->authority;
    }

    /**
     * @inheritDoc
     */
    public function getUserInfo(): string
    {
        return $this->user;
    }

    /**
     * @inheritDoc
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @inheritDoc
     */
    public function getPort(): ?int
    {
        return $this->port;
    }

    /**
     * @inheritDoc
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @inheritDoc
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @inheritDoc
     */
    public function getFragment(): string
    {
        return $this->fragment;
    }

    /**
     * @inheritDoc
     */
    public function withScheme(string $scheme): UriInterface
    {
        $this->scheme = $scheme;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function withUserInfo(string $user, ?string $password = null): UriInterface
    {
        $this->user = $user;
        if ($password) {
            $this->user .= ":{$password}";
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function withHost(string $host): UriInterface
    {
        $this->host = $host;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function withPort(?int $port): UriInterface
    {
        $this->port = $port;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function withPath(string $path): UriInterface
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function withQuery(string $query): UriInterface
    {
        $this->query = $query;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function withFragment(string $fragment): UriInterface
    {
        $this->fragment = $fragment;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        $str = '';

        if ($this->scheme) {
            $str .= "{$this->scheme}:";
        }
        if ($this->authority) {
            $str .= "//{$this->authority}";
        }
        if ($this->host) {
            $str .= "{$this->host}";
        }
        if ($this->path) {
            $str .= "{$this->path}";
        }
        if ($this->port) {
            $str .= ":{$this->port}";
        }
        if ($this->user) {
            $str .= "@{$this->user}";
        }
        if ($this->query) {
            $str .= "?{$this->query}";
        }
        if ($this->fragment) {
            $str .= "#{$this->fragment}";
        }

        return $str;
    }
}