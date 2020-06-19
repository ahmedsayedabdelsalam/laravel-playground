<?php

namespace App\Providers;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // mysql
        Builder::macro('orderByNullsLast', function ($column, $direction = 'asc') {
            $column = $this->getGrammar()->wrap($column);
            $direction = strtolower($direction) === 'asc' ? 'asc' : 'desc';
            return $this->orderByRaw("$column is null, $column $direction");
        });

        // postgre sql
        // Builder::macro('orderByNullsLast', function ($column, $direction = 'asc') {
        //     $column = $this->getGrammar()->wrap($column);
        //     $direction = strtolower($direction) === 'asc' ? 'asc' : 'desc';
        //     return $this->orderByRaw("$column $direction nulls last");
        // });
    }
}
