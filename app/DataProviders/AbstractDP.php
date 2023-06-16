<?php

namespace App\DataProviders;

use App\Models\Model;

abstract class AbstractDP implements DataProvider
{
    protected array $data;

    public function getAll(): array
    {
        return $this->data;
    }

    public function getByKey(string $key, string $field): ?array
    {
        $result = array_filter($this->data, fn (array $item) => $item[$field] == $key);
        return array_pop($result);
    }
}