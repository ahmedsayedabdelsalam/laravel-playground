<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Filters\Course\DiffecultyFilter;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        return Course::with('subjects')->filter($request, $this->addFilters())->get();
    }

    protected function addFilters()
    {
        return [
            'diffeculty' => DiffecultyFilter::class
        ];
    }
}
