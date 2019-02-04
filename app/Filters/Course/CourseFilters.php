<?php

namespace App\Filters\Course;

use App\Filters\Course\Ordering\ViewsOrder;
use App\Filters\FiltersAbstract;


class CourseFilters extends FiltersAbstract
{
    protected $filters = [
        'access' => AccessFilter::class,
        'type' => TypeFilter::class,
        'subject' => SubjectFilter::class,
        'started' => StartedFilter::class,
        'views' => ViewsOrder::class
    ];
}
