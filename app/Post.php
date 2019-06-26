<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Laravel\Nova\Actions\Actionable;

class Post extends Model
{
    use Searchable, Actionable;

    protected $fillable = [
        'is_published'
    ];
    
    protected $casts = [
        'publish_at' => 'datetime',
        'publish_until' => 'datetime',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
