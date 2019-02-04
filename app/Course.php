<?php

namespace App;

use Illuminate\Database\Eloquent\{Model, Builder};
use App\Filters\Course\CourseFilters;
use Illuminate\Http\Request;

class Course extends Model
{
    public function scopeFilter(Builder $builder, Request $reqeust, array $filters = [])
    {
        return (new CourseFilters($reqeust))->addFilters($filters)->filter($builder);
    }

}
