<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Category extends Model implements HasMedia
{
    use HasRelationships;
    use InteractsWithMedia;

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
        return (bool) !$this->category_id;
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
