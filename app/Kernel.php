<?php

namespace App;

use App\Http\ServerRequestFactory;

final readonly class Kernel
{
    /**
     * Application initialization
     *
     * @return void
     */
    public function __construct()
    {
        $request = (new ServerRequestFactory())->createServerRequest(
            $_SERVER['REQUEST_METHOD'],
            $_SERVER['REQUEST_URI'],
        );
        $response = (new Handler())->handle($request);

        http_response_code($response->getStatusCode());
        foreach ($response->getHeaders() as $headerName => $headers) {
            foreach ($headers as $header) {
                header("{$headerName}: {$header}");
            }
        }
        print $response->getBody();
    }
}