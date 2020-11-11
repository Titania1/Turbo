<?php

declare(strict_types=1);

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Stock extends Resource
{
    public static $with = ['part'];

    /**
     * Build an "index" query for the given resource.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where('user_id', auth()->id());
    }

    /**
     * Get the displayable label of the resource.
     */
    public static function label(): string
    {
        return __('Stocks');
    }

    /**
     * Get the displayable singular label of the resource.
     */
    public static function singularLabel(): string
    {
        return __('Stock');
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Stock';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'quantity',
    ];

    /**
     * The relationship columns that should be searched.
     *
     * @var array
     */
    public static $searchRelations = [
        'part' => ['title', 'excerpt', 'description', 'price', 'sku'],
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make(__('Part'), 'part', Part::class),
            Text::make(__('SKU'), 'part.sku'),
            Number::make(__('Quantity'), 'quantity')->min(1)->max(1e4)->step(1),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
