<?php

declare(strict_types=1);

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Store extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Store';

    /**
     * Get the displayable label of the resource.
     */
    public static function label(): string
    {
        return __('Store');
    }

    /**
     * Get the displayable singular label of the resource.
     */
    public static function singularLabel(): string
    {
        return __('Store');
    }

    /**
     * Indicates if the resource should be globally searchable.
     *
     * @var bool
     */
    public static $globallySearchable = false;

    /**
     * Build an "index" query for the given resource.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        if ($request->user()->hasRole('Super Admin')) {
            return $query;
        }

        return $query->where('user_id', auth()->id());
    }

    /**
     * The pagination per-page options configured for this resource.
     */
    public static function perPageOptions(): array
    {
        if (auth()->user()->hasRole('Super Admin')) {
            return static::$perPageOptions;
        }

        return [1];
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Store';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [];

    /**
     * Get the fields displayed by the resource.
     */
    public function fields(Request $request): array
    {
        return [
            Text::make(__('Name'), 'name')->required()->rules('min:3|max:50'),
            // Photo de profile, wajiha de mahal
            // Logo
            // Description
            // Email
            // Phone Number
            // Fax
            BelongsTo::make(__('User'), 'user', User::class)->canSee(function ($request) {
                return $request->user()->hasRole('Super Admin');
            }),
        ];
    }
}
