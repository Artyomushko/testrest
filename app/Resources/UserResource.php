<?php

namespace App\Resources;

class UserResource extends AbstractResource implements Resourse
{
    public function toArray(): array
    {
        return [
            'full_name' => $this->resource->fullName,
            'email'     => $this->resource->email,
        ];
    }
}