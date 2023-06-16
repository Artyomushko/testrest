<?php

namespace App\Controllers;

use App\Http\ResponseFactory;
use App\Http\StreamFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class Controller
{
    public function call(string $method, ServerRequestInterface $request, array $args = []): ResponseInterface
    {
        $result = $this->$method($request, ...$args);

        if ($result instanceof ResponseInterface) {
            return $result;
        }

        $response = (new ResponseFactory())->createResponse();
        $responseStream = (new StreamFactory())->createStream($result);
        $response->withBody($responseStream);

        return $response;
    }
}