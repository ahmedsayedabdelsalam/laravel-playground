<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Filters\Course\DiffecultyFilter;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::with('subjects')->filter($request, $this->addFilters())->get();
        // return $courses;
        return view('courses.index', compact('courses'));
    }

    protected function addFilters()
    {
        return [
            'diffeculty' => DiffecultyFilter::class
        ];
    }
}
