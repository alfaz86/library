<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class CentsCast implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return $value / 100;
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return $value * 100;
    }
}
