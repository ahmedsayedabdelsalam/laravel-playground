<?php

namespace App\Filters\Course;

use App\Filters\FiltersAbstract;


class CourseFilters extends FiltersAbstract
{
    protected $filters = [
        'access' => AccessFilter::class,
        'type' => TypeFilter::class
    ];
}
