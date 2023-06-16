<?php

namespace App\Http;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

class ResponseFactory implements ResponseFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createResponse(int $code = 200, string $reasonPhrase = ''): ResponseInterface
    {
        return (new Response())->withStatus($code, $reasonPhrase);
    }

    public function createRedirectResponse(string $location, int $code = 302, string $reasonPhrase = ''): ResponseInterface
    {
        return $this->createResponse($code, $reasonPhrase)
            ->withHeader('Location', $location);
    }

    public function createLoginResponse(int $code = 401, string $reasonPhrase = ''): ResponseInterface
    {
        return $this->createResponse($code, $reasonPhrase)
            ->withHeader('WWW-Authenticate', 'Basic realm="Test REST"');
    }
}