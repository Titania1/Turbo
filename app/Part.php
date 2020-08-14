<?php

declare(strict_types=1);

namespace App;

use Exception;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Laravel\Nova\Actions\Actionable;
use Illuminate\Support\Facades\Redis;
use Illuminate\Database\Eloquent\Model;
use Gloudemans\Shoppingcart\CanBeBought;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Part.
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $vehicle_id
 * @property int|null $type_id
 * @property string $title
 * @property string|null $description
 * @property string|null $image
 * @property float $price
 * @property float|null $old_price
 * @property string|null $sku
 * @property int $rating
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $cart_header_image
 * @property-read string $index_image
 * @property-read bool $is_hot
 * @property-read string $new_arrival_image
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\Vehicle|null $vehicle
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Part newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Part newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Part query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Part whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Part whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Part whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Part whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Part whereOldPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Part wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Part whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Part whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Part whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Part whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Part whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Part whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Part whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Part whereVehicleId($value)
 * @mixin \Eloquent
 */
class Part extends Model implements HasMedia, Buyable
{
	use Searchable, InteractsWithMedia, CanBeBought, SoftDeletes, Actionable;

	/**
	 * The attributes that should be cast.
	 *
	 * @var array
	 */
	protected $casts = [
		'key_features' => 'array',
	];

	public function getBuyableIdentifier($options = null)
	{
		return $this->id;
	}

	public function getBuyableDescription($options = null)
	{
		return $this->title;
	}

	public function getBuyablePrice($options = null)
	{
		return $this->price;
	}

	public function getBuyableWeight($options = null)
	{
		return 0;
	}

	/**
	 * Get the vehicle of a part.
	 *
	 * Defines the Part to Vehicle relationship
	 *
	 **/
	public function vehicle(): BelongsTo
	{
		return $this->belongsTo(Vehicle::class);
	}

	public function vehicles()
	{
		return $this->belongsToMany(Vehicle::class);
	}

	public function getCompatibilityAttribute(): string
	{
		$array = $this->vehicles()->select('model')->pluck('model')->toArray();
		$string = implode(', ', $array);

		return $string;
	}

	/**
	 * Get the index name for the model.
	 */
	public function searchableAs(): string
	{
		return 'parts_index';
	}

	/**
	 * Get the indexable data array for the model.
	 */
	public function toSearchableArray(): array
	{
		$vehicle = $this->vehicle->only('year', 'brand', 'model', 'fuel');

		$part = $this->only('title', 'image', 'price');

		$searchable = array_merge($part, $vehicle);

		return $searchable;
	}

	/**
	 * Get the value used to index the model.
	 *
	 * @return mixed
	 */
	public function getScoutKey(): string
	{
		return $this->title;
	}

	/**
	 * Get the key name used to index the model.
	 *
	 * @return mixed
	 */
	public function getScoutKeyName(): string
	{
		return 'title';
	}

	/**
	 * Get the route key for the model.
	 */
	public function getRouteKeyName(): string
	{
		return 'slug';
	}

	public function registerMediaConversions(Media $media = null): void
	{
		$this->addMediaConversion('_245x245')
			->width(245)
			->height(245)
			->sharpen(10);
		$this->addMediaConversion('_40x40')
			->width(40)
			->height(40)
			->sharpen(10);
		$this->addMediaConversion('_70x70')
			->width(70)
			->height(70)
			->sharpen(10);
		$this->addMediaConversion('_92x92')
			->width(92)
			->height(92)
			->sharpen(10);
	}

	public function getIndexImageAttribute(): string
	{
		$mediaItems = $this->getMedia();
		if ($mediaItems->isNotEmpty()) {
			return $mediaItems[0]->getUrl('_245x245');
		}

		return '/images/avatar44x44.png';
	}

	public function getCartHeaderImageAttribute(): string
	{
		$mediaItems = $this->getMedia();
		if ($mediaItems->isNotEmpty()) {
			return $mediaItems[0]->getUrl('_70x70');
		}

		return '/images/avatar44x44.png';
	}

	public function getNewArrivalImageAttribute(): string
	{
		$mediaItems = $this->getMedia();
		if ($mediaItems->isNotEmpty()) {
			try {
				return $mediaItems[0]->getUrl('_92x92');
			} catch (Exception $ex) {
				return '/images/avatar44x44.png';
			}
		}

		return '/images/avatar44x44.png';
	}

	public function getIsHotAttribute(): bool
	{
		$ids = \Illuminate\Support\Facades\Redis::zrevrange('popular_parts', 0, 9);

		return in_array($this->id, $ids);
	}

	public function invoices()
	{
		return $this->belongsToMany(Invoice::class);
	}

	public function brand()
	{
		return $this->belongsTo(Brand::class, 'vehicle_id', 'id', Vehicle::class);
	}

	public function reviews()
	{
		return $this->hasMany(Review::class);
	}

	public function getViewsAttribute()
	{
		return Redis::zscore('popular_parts', $this->id);
	}

	/**
	 * Get the user that owns the part.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo App\User
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function getBuyPriceAttribute()
	{
		return optional(InvoicePart::where('part_id', $this->id)->first())->buyPrice;
	}

	public function getSellPriceAttribute()
	{
		return optional(InvoicePart::where('part_id', $this->id)->first())->sellPrice;
	}

	public function getSupplierAttribute()
	{
		$supplier_id = optional(InvoicePart::where('part_id', $this->id)->first())->supplier_id;

		return optional(Supplier::find($supplier_id))->name;
	}
}
