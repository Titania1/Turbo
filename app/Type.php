<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Type.
 *
 * @property int                             $id
 * @property int                             $category_id
 * @property string                          $name
 * @property string|null                     $image
 * @property string                          $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $sub_category_image
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type whereUpdatedAt($value)
 * @mixin \Eloquent
 *
 * @property-read \App\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Part[] $parts
 * @property-read int|null $parts_count
 */
class Type extends Model implements HasMedia
{
    use InteractsWithMedia;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function parts(): HasMany
    {
        return $this->hasMany(Part::class);
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
}
