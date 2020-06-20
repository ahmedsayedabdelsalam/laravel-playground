<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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

    public function scopeOrderByDate(Builder $query)
    {
        return $query->orderByRaw('date_format(borrowed_at, "%m-%d")');
    }

    public function scopeOrderByUpcomingBorrowedAt(Builder $query)
    {
        return $query->orderByRaw('
                case
                    when (birth_date + interval (year(?) - year(birth_date)) year) >= ?
                    then (birth_date + interval (year(?) - year(birth_date)) year)
                    else (birth_date + interval (year(?) - year(birth_date)) + 1 year)
                end
            ', [
            array_fill(0, 4, Carbon::now()->startOfWeek()->toDateString()),
        ]);
    }

    public function scopeWhereBorrowedThisWeek(Builder $query)
    {
        // this method will not work at start of the year because month 12 first will be greater than month 1 next
//        Carbon::setTestNow(Carbon::parse("2020-01-01"));
//        return $query->whereRaw('date_format(borrowed_at, "%m-%d") between ? and ?', [
//            Carbon::now()->startOfWeek()->format("m-d"),
//            Carbon::now()->endOfWeek()->format("m-d"),
//        ]);

        $week_days = Carbon::now()
            ->startOfWeek()
            ->daysUntil(Carbon::now()->endOfWeek())
            ->map(fn($date) => $date->format("m-d"));
        return $query->whereRaw('date_format(borrowed_at, "%m-%d") in (?,?,?,?,?,?,?)', iterator_to_array($week_days));
    }
}
