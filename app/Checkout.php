<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Checkout extends Pivot
{
    protected $dates = [
        'borrowed_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
