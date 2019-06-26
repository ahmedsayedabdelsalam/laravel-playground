<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use App\Nova\Filters\PostPublished;
use App\Nova\Filters\PostCategories;
use App\Nova\Lenses\MostTags;
use App\Nova\Actions\PublishPost;
use App\Nova\Metrics\PostsPerDay;
use App\Nova\Metrics\PostCount;
use App\Nova\Metrics\PostsPerCategory;

class Post extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Post';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'title', 'body'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Title')
                ->rules(['required']),

            Trix::make('Body'),

            DateTime::make('Publish At')
                ->hideFromIndex()
                ->rules('after_or_equal:today'),

            DateTime::make('Publish Until')
                ->hideFromIndex()
                ->rules('after_or_equal:publish_at'),

            Boolean::make('Is Published')
                // ->canSee(function($request) {
                //     return false;
                // })
                // ->onlyOnIndex(),
                ,

            Select::make('Category')
                ->options([
                    'tutorials' => 'Tutorials',
                    'news' => 'News'
                ])
                ->hideWhenUpdating()
                ->rules('required'),

            BelongsTo::make('User')
                ->rules('required'),

            BelongsToMany::make('Tags')
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [
            (new PostCount)->width('1/2'),
            (new PostsPerCategory)->width('1/2'),
            (new PostsPerDay)->width('full')
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new PostPublished,
            new PostCategories
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [
            new MostTags
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            (new PublishPost)->canSee(function ($request) {
                // return $request->user()->id === 2;
                return true;
            })->canRun(function ($request, $post) { // issue not working with queued action
                return $post->id === 2;
            })
        ];
    }

    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where('user_id', $request->user()->id);
    }
}
