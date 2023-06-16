<?php

namespace App;

use App\Exceptions\MethodNotAllowedException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Route
{
    private string $regExp;
    private array $availableMethods;
    private array $params = [];

    public function __construct(private readonly string $route, private readonly array $callbacks)
    {
        $this->regExp = $this->transformToRegExp();
        $this->availableMethods = array_keys($this->callbacks);
    }

    /**
     * Transform route to regexp
     *
     * @return string
     */
    public function transformToRegExp(): string
    {
        $regExp = preg_replace('/\{.+\}/', '(.+)', trim($this->route, '/'));

        return '/^' . str_replace('/', '\/', $regExp) . '$/';
    }

    /**
     * Check if provided path does fit the route
     *
     * @param string $path
     * @param string $method
     *
     * @return bool
     * @throws MethodNotAllowedException
     */
    public function checkPath(string $path, string $method): bool
    {
        $method = strtolower($method);
        if (!in_array($method, $this->availableMethods)) {
            throw new MethodNotAllowedException();
        }
        $result = preg_match($this->regExp, trim($path, '/'), $this->params);
        array_shift($this->params);

        return $result;
    }

    /**
     * Call endpoint's callback
     *
     * @param RequestInterface $request
     *
     * @return string
     */
    public function call(RequestInterface $request): ResponseInterface
    {
        $callback = $this->callbacks[strtolower($request->getMethod())];
        $controller = new $callback['callback'][0];
        $method = $callback['callback'][1];
        if (isset($callback['middleware'])) {
            return (new $callback['middleware'])->handle($request, [$controller, 'call'], [$method, $request, $this->params]);
        }

        return $controller->call($method, $request, ...$this->params);
    }
}