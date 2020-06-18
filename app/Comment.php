<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }

    public function isAuthor()
    {
        return $this->feature->comments->first()->user_id === $this->user_id;
    }

    public function scopeVisibleTo(Builder $query,User $user)
    {
        if ($user->is_admin) {
            return;
        }

        return $query->where('user_id', $user->id);
    }
}
