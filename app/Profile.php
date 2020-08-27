<?php

declare(strict_types=1);

namespace App;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Profile.
 *
 * @property int $id
 * @property string $avatar
 * @property string $address
 * @property string $phone
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Profile whereUserId($value)
 * @mixin \Eloquent
 */
class Profile extends Model implements HasMedia
{
	use InteractsWithMedia;

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function registerMediaConversions(Media $media = null): void
	{
		$this->addMediaConversion('account_menu')
			->width(44)
			->height(44)
			->sharpen(10);
		$this->addMediaConversion('dashboard')
			->width(90)
			->height(90)
			->sharpen(10);
	}
}
