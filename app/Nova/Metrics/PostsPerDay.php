<?php

namespace App\Nova\Metrics;

use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Trend;
use App\Post;
use Laravel\Nova\Metrics\TrendResult;

class PostsPerDay extends Trend
{
    /**
     * override default name which taken from class name
     *
     * @var string
     */
    // public $name = 'Posts Per Month';

    /**
     * override default name which taken from class name
     *
     * @return void
     */
    // public function name() {
    //     return 'Posts Per Month';
    // }
    
    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        return $this->countByDays($request, Post::class)
            ->showLatestValue();
        // return $this->countByMonths($request, Post::class);
        // return (new TrendResult)->trend([
        //     'Day 1' => 1,
        //     'Day 2' => 100,
        //     'Day 3' => 50,
        // ]);
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
            30 => '30 Days',
            60 => '60 Days',
            90 => '90 Days',
            // 6 => '6 Months',
            // 12 => '12 Months',
        ];
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'posts-per-day';
    }
}
