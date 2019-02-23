<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Filters\Course\DifficultyFilter;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::with('subjects')->filter($request, $this->addFilters())->paginate(2);

        return view('courses.index', compact('courses', 'subjects'));
    }

    protected function addFilters()
    {
        return [
            'difficulty' => DifficultyFilter::class
        ];
    }
}
