<?php

namespace App\Filters\Course;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class DiffecultyFilter extends FilterAbstract
{
    public function mappings()
    {
        return [
            'easy' => 'easy',
            'medium' => 'medium',
            'diffecult' => 'diffecult'
        ];
    }

    public function filter(Builder $builder, $value)
    {
        $value = $this->resolveFilterValue($value);

        if ($value === null) {
            return $builder;
        }

        return $builder->where('diffeculty', $value);
    }
}
