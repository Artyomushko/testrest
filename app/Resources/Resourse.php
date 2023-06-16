<?php

namespace App\Resources;

interface Resourse
{
    public function toArray(): array;
    public function toJson(): string;
}