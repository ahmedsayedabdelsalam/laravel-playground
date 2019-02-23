<?php

namespace App\Providers;

use App\Http\ViewComposer\CourseFiltersComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('courses.partials._filters', CourseFiltersComposer::class);
    }
}
