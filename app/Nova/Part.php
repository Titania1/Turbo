<?php

declare(strict_types=1);

namespace App\Nova;

use App\Nova\Actions\ChangePartViews;
use Armincms\Fields\BelongsToMany;
use Caddydz\NovaPreviewResource\NovaPreviewResource;
use Emiliogrv\NovaBatchLoad\BatchLoadField;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class Part extends Resource
{
    /**
     * Get the displayable label of the resource.
     */
    public static function label(): string
    {
        return __('Parts');
    }

    /**
     * Get the displayable singular label of the resource.
     */
    public static function singularLabel(): string
    {
        return __('Part');
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Part';

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
        'id', 'title', 'description', 'sku',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Text::make(__('Reference'), 'sku')->sortable(),
            Text::make(__('Title'), 'title')->creationRules('required', 'unique:parts,title'),
            Trix::make(__('Description'), 'description'),
            Image::make(__('Image'), 'image'),
            Number::make(__('Price'), 'price')
                ->min(1)->max(1e6)->step(0.01)
                ->required()->displayUsing(fn ($p) => $p.' DZD'),
            KeyValue::make(__('Key Features'), 'key_features')
                ->nullable()
                ->rules('json')
                ->keyLabel(__('Feature'))
                ->valueLabel(__('Value'))
                ->actionText(__('Add Another')),
            BelongsToMany::make(__('Compatible with'), 'vehicles', Vehicle::class)->hideFromIndex(),
            BatchLoadField::make()
                ->accept('.xlsx')
                ->defaultTabActive(1)
                ->ignoreAttributes('key_features')
                ->keepOriginalFields('belongs|select|boolean'),
            Number::make(__('Views'), fn ($part) => $part->views)->canSee(fn ($request) => $request->user()->can('See Part Views')),
            NovaPreviewResource::make(__('Preview'))
                ->image($this->indexImage)
                ->options([
                    __('Buy Price')  => $this->buyPrice,
                    __('Sell Price') => $this->sellPrice,
                    __('Supplier')   => $this->supplier,
                ])->onlyOnIndex(),
        ];
    }

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
     * Build a "relatable" query for the given resource.
     *
     * This query determines which instances of the model may be attached to other resources.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function relatableQuery(NovaRequest $request, $query)
    {
        return parent::relatableQuery($request, $query->where('user_id', auth()->id()));
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
     */
    public function actions(Request $request): array
    {
        return [
            (new DownloadExcel())->except('image'),
            (new ChangePartViews())->confirmButtonText(__('Update'))
                ->canSee(fn ($request) => $request->user()->can('Update Part Views')),
        ];
    }
}
