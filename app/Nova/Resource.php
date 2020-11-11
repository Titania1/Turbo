<?php

declare(strict_types=1);

namespace App\Nova;

use Inspheric\NovaDefaultable\HasDefaultableFields;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource as NovaResource;
use Titasgailius\SearchRelations\SearchesRelations;

abstract class Resource extends NovaResource
{
	use SearchesRelations;
	use HasDefaultableFields;

	/**
	 * Whether to show borders for each column on the X-axis.
	 *
	 * @var bool
	 */
	public static $showColumnBorders = true;

	/**
	 * The visual style used for the table. Available options are 'tight' and 'default'.
	 *
	 * @var string
	 */
	public static $tableStyle = 'tight';

	/**
	 * Build an "index" query for the given resource.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 *
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public static function indexQuery(NovaRequest $request, $query)
	{
		return $query;
	}

	/**
	 * Build a Scout search query for the given resource.
	 *
	 * @param \Laravel\Scout\Builder $query
	 *
	 * @return \Laravel\Scout\Builder
	 */
	public static function scoutQuery(NovaRequest $request, $query)
	{
		return $query;
	}

	/**
	 * Determine if this resource uses Laravel Scout.
	 *
	 * @return bool
	 */
	public static function usesScout()
	{
		$searchable = in_array(Searchable::class, class_uses_recursive(static::newModel()));
		$scout_enabled = config('scout.driver');

		return $searchable && $scout_enabled;
	}

	/**
	 * Build a "detail" query for the given resource.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 *
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public static function detailQuery(NovaRequest $request, $query)
	{
		return parent::detailQuery($request, $query);
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
		return parent::relatableQuery($request, $query);
	}
}
