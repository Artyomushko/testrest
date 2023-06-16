<?php

namespace App\Repositories;

use App\DataProviders\DataProvider;
use App\Models\Model;
use App\Settings;

abstract class AbstractRepository implements Repository
{
    protected DataProvider $provider;

    public function __construct()
    {
        $this->provider = new (Settings::$dataProviderClass)(static::getModel()::getFileName());
    }

    abstract public static function getModel(): string;

    public function getAll(): array
    {
        return array_map(fn ($model) => $this->map($model), $this->provider->getAll());
    }

    protected function map(array $model): Model
    {
        $object = new (static::getModel());
        foreach ($model as $key => $value) {
            $object->$key = $value;
        }

        return $object;
    }

    public function getByKey(string $id, string $key = 'id'): ?Model
    {
        $modelArray = $this->provider->getByKey($id, $key);

        if (!$modelArray) {
            return null;
        }

        return $this->map($modelArray);
    }
}