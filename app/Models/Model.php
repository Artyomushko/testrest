<?php

namespace App\Models;

use App\Helpers\Str;

abstract class Model
{
    protected string $key = 'id';

    /**
     * Get provider file name
     *
     * @return string
     */
    abstract public static function getFileName(): string;

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function __get(string $name): mixed
    {
        $name = ucfirst(Str::snakeToCamel($name));
        $method = "get{$name}";

        return $this->$method();
    }

    /**
     * @param string $name
     * @param mixed  $value
     *
     * @return mixed
     */
    public function __set(string $name, mixed $value): void
    {
        $name = ucfirst(Str::snakeToCamel($name));
        $method = "set{$name}";

        $this->$method($value);
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }
}