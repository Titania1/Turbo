<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CatalogCategory.
 *
 * @property int $id
 * @property int $engine_id
 * @property int $internal_id
 * @property string $name
 * @property string|null $image
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CatalogCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CatalogCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CatalogCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|CatalogCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CatalogCategory whereEngineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CatalogCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CatalogCategory whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CatalogCategory whereInternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CatalogCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CatalogCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CatalogCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CatalogCategory extends Model
{
	//
}
