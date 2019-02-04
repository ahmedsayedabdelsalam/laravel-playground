<?php

namespace App\Filters\Course\Ordering;

use Illuminate\Database\Eloquent\Builder;
use App\Filters\FilterAbstract;


class ViewsOrder extends FilterAbstract
{
    public function filter(Builder $builder, $value)
    {
        return $builder->orderBy('views', $this->resolveOrderDirection($value));
    }
}
