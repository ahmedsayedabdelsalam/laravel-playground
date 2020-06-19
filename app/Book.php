<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Book extends Model
{

    public function users()
    {
        return $this->belongsToMany(User::class, 'checkout')
            ->using(Checkout::class)
            ->withPivot('borrowed_at');
    }

    public function checkouts()
    {
        return $this->hasMany(Checkout::class);
    }

    public function lastCheckout()
    {
        return $this->belongsTo(Checkout::class, 'last_checkout_id');
    }

    public function scopeWithLastCheckout(Builder $query)
    {
        return $query->addSelect([
            'last_checkout_id' => Checkout::select('id')
                ->whereColumn('books.id', '=', 'checkout.book_id')
                ->latest('borrowed_at')
                ->take(1)
        ])->with('lastCheckout');
    }
}
