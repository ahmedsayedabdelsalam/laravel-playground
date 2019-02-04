<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

abstract class FilterAbstract
{
    abstract public function filter(Builder $builder, $value);

    public function mappings()
    {
        return [];
    }

    public function resolveFilterValue($key)
    {
        return array_get($this->mappings(), $key);
    }
}
