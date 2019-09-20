<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use Searchable;

    protected $fillable = ['body', 'user_id'];

    public function searchableAs()
    {
        return 'posts_index';
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
