<?php

namespace App;

use Illuminate\Database\Eloquent\{Model, Builder};
use App\Filters\Course\CourseFilters;
use Illuminate\Http\Request;

class Course extends Model
{
    protected $appends = ['started'];
    protected $hidden = ['users'];

    // scopes
    public function scopeFilter(Builder $builder, Request $reqeust, array $filters = [])
    {
        return (new CourseFilters($reqeust))->addFilters($filters)->filter($builder);
    }



    // relations
    public function subjects()
    {
        return $this->morphToMany(Subject::class, 'subjectable');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }


    // getters
    public function getStartedAttribute()
    {
        if (!auth()->check()) {
            return false;
        }

        return $this->users->contains(auth()->user());
    }

    public function getFormattedDifficultyAttribute()
    {
        return ucfirst($this->difficulty);
    }
    
    public function getFormattedTypeAttribute()
    {
        return ucfirst($this->type);
    }

    public function getFormattedAccessAttribute()
    {
        return (bool)$this->is_free === true ? 'Free' : 'Premium';
    }

    public function getFormattedStartedAttribute()
    {
        return (bool)$this->started === true ? 'Started' : 'Not Started';
    }
}
