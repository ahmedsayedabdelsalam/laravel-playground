<?php

namespace App;

use Illuminate\Database\Eloquent\{Model, Builder};
use App\Filters\Course\CourseFilters;
use Illuminate\Http\Request;

class Course extends Model
{
    protected $appends = ['started'];
    protected $hidden = ['users'];

    public function scopeFilter(Builder $builder, Request $reqeust, array $filters = [])
    {
        return (new CourseFilters($reqeust))->addFilters($filters)->filter($builder);
    }

    public function subjects()
    {
        return $this->morphToMany(Subject::class, 'subjectable');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getStartedAttribute()
    {
        if (!auth()->check()) {
            return false;
        }

        return $this->users->contains(auth()->user());
    }
}
