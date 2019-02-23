<?php

namespace App\Http\ViewComposer;

use App\Filters\Course\CourseFilters;
use Illuminate\View\View;

class CourseFiltersComposer
{
    public function compose(View $view)
    {
        $view->with([
            'mappings' => CourseFilters::mappings()
        ]);
    }
}
