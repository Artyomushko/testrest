<?php

namespace App;

use App\Exceptions\PageNotFoundException;
use App\Http\ResponseFactory;
use App\Http\StreamFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Handler implements RequestHandlerInterface
{
    /**
     * @inheritDoc
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            return (new Router)->call($request);
        } catch (\Exception $e) {
            $response = (new ResponseFactory)->createResponse();
            $response->withStatus($e->getCode(), $e->getMessage());
            $responseStream = (new StreamFactory())->createStream($e->getMessage());
            $response->withBody($responseStream);
            return $response;
        }
    }
}