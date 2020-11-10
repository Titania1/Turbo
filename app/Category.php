<?php

declare(strict_types=1);

namespace App;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * App\Category.
 *
 * @property int $id
 * @property int|null $category_id
 * @property string $name
 * @property string|null $image
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read mixed $fertile_sub_categories
 * @property-read mixed $infertile_sub_categories
 * @property-read string $mega_menu_size
 * @property-read string $sub_category_image
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Part[] $parts
 * @property-read int|null $parts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Type[] $types
 * @property-read int|null $types_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read Category|null $category
 * @property-read bool $is_parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Type[] $subType
 * @property-read int|null $sub_type_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Type[] $subTypes
 * @property-read int|null $sub_types_count
 */
class Category extends Model implements HasMedia
{
	use HasRelationships, InteractsWithMedia;

	// protected $with = ['categories', 'types'];

	public function category(): BelongsTo
	{
		return $this->belongsTo(self::class);
	}

	public function categories(): HasMany
	{
		return $this->hasMany(self::class);
	}

	public function types(): HasMany
	{
		return $this->hasMany(Type::class)->limit(7);
	}

	public function parts(): HasManyThrough
	{
		return $this->hasManyThrough(Part::class, Type::class);
	}

	public function subTypes(): HasManyThrough
	{
		return $this->hasManyThrough(Type::class, self::class)->limit(7);
	}

	public function subType(): HasManyThrough
	{
		return $this->hasManyThrough(Type::class, self::class)->limit(1);

		return $this->hasMany(Type::class)->limit(1);
	}

	public function subParts(): HasManyDeep
	{
		return $this->hasManyDeep(Part::class, [self::class, Type::class]);
	}

	public function getFertileSubCategoriesAttribute(): HasMany
	{
		return $this->categories()->whereHas('types')->limit(6)->get();
	}

	public function getInfertileSubCategoriesAttribute(): HasMany
	{
		return $this->categories()->whereDoesntHave('types')->limit(5)->get();
	}

	public function getMegaMenuSizeAttribute(): string
	{
		// xl, lg, md, nl, sm
		$count = $this->categories()->count();
		if ($count >= 9) {
			return 'xl';
		} elseif ($count >= 8) {
			return 'lg';
		} elseif ($count >= 6) {
			return 'md';
		} elseif ($count >= 4) {
			return 'nl';
		} else {
			return 'sm';
		}
	}

	public function getRouteKeyName(): string
	{
		return 'slug';
	}

	public function registerMediaConversions(Media $media = null): void
	{
		$this->addMediaConversion('_148x148')
			->width(148)
			->height(148)
			->sharpen(10);
	}

	public function getSubCategoryImageAttribute(): string
	{
		$mediaItems = $this->getMedia();
		if ($mediaItems->isNotEmpty()) {
			return $mediaItems[0]->getUrl('_148x148');
		}

		return '/images/avatar44x44.png';
	}

	public function getIsParentAttribute(): bool
	{
		return (bool) ! $this->category_id;
	}

	public function cars(): BelongsToMany
	{
		return $this->belongsToMany(Car::class);
	}

	public function products(): BelongsToMany
	{
		return $this->belongsToMany(Product::class);
	}

	public function carSubCategories(int $car_id): Collection
	{
		$ids = DB::table('car_category')->where('car_id', $car_id)->select('category_id')->pluck('category_id')->toArray();

		return $this->categories()->whereIn('id', $ids)->get();
	}
}
