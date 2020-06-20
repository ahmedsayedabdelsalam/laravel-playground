<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\Model;

class Feature extends Model
{
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function scopeOrderByType(Builder $query, $direction)
    {
        return $query->orderBy(DB::raw('
            case
                when type = "pending" then 1
                when type = "rejected" then 2
                when type = "accepted" then 3
            end
        '), $direction);
    }

    public function scopeOrderByActivity(Builder $query, $direction)
    {
        return $query->orderBy(DB::raw('
            -(likes_count + (comments_count * 2))
        '), $direction);
    }
}
