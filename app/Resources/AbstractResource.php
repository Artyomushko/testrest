<?php

namespace App\Resources;

use App\Models\Model;

abstract class AbstractResource implements Resourse
{
    public function __construct(protected Model $resource) {}

    /**
     * @param Model[] $models
     *
     * @return array
     */
    public static function collect(array $models): array
    {
        return array_map(fn ($model) => (new static($model))->toArray(), $models);
    }

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}