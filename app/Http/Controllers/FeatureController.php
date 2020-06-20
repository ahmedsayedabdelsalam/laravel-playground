<?php

namespace App\Http\Controllers;

use App\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FeatureController extends Controller
{
    public function index()
    {
        $features = Feature::query()
            ->withCount(['comments', 'likes'])
            ->when(request('sort'), function ($query) {
                $direction = 'asc';
                $column = request('sort');
                if(Str::startsWith($column, '-')) {
                    $direction = 'desc';
                    $column = Str::replaceFirst('-', '', $column);
                }
                switch ($column) {
                    case 'name': return $query->orderBy('name', $direction);
                    case 'type': return $query->orderByType($direction);
                    case 'activity': return $query->orderByActivity($direction);
                }
            })
            ->latest()
            ->paginate(30);

        return view('features.index', compact('features'));
    }
}
