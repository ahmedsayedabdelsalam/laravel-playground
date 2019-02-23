<?php

namespace App\Filters\Course;

use App\Filters\Course\Ordering\ViewsOrder;
use App\Filters\FiltersAbstract;
use App\Subject;


class CourseFilters extends FiltersAbstract
{
    protected $filters = [
        'access' => AccessFilter::class,
        'type' => TypeFilter::class,
        'subject' => SubjectFilter::class,
        'started' => StartedFilter::class,
        'views' => ViewsOrder::class
    ];

    public static function mappings()
    {
        $map = [
            'access' => [
                'free' => 'Free',
                'premium' => 'Premium'
            ],
            'difficulty' => [
                'easy' => 'Easy',
                'medium' => 'Medium',
                'difficult' => 'Difficult'
            ],
            'type' => [
                'tech' => 'Tech',
                'math' => 'Math',
                'science' => 'Science'
            ],
            'subject' => Subject::pluck('name', 'slug')
        ];

        if(auth()->check()) {
            $map = array_merge($map, [
                'started' => [
                    'true' => 'Started',
                    'false' => 'Not Started'
                ]
            ]);
        }

        return $map;
    }
}
