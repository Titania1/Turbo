<?php

declare(strict_types=1);

namespace App;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

/**
 * App\User.
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $account_menu_avatar
 * @property-read string $avatar
 * @property-read string $dashboard_avatar
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \App\Profile|null $profile
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Supplier[] $suppliers
 * @property-read int|null $suppliers_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable implements MustVerifyEmail
{
	use Notifiable, HasRoles, Billable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password', 'phone', 'token', 'google_id', 'provider', 'facebook_id',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function profile(): HasOne
	{
		return $this->hasOne(Profile::class);
	}

	// The supplier associated with this user
	public function supplier(): HasOne
	{
		return $this->hasOne(Supplier::class);
	}

	public function getAvatarAttribute(): string
	{
		if ($this->provider) {
			return $this->profile->avatar;
		}
		$mediaItems = optional($this->profile)->getMedia();
		if ($mediaItems->isNotEmpty()) {
			return $mediaItems[0]->getFullUrl();
		}

		return '/images/avatar.png';
	}

	public function getAccountMenuAvatarAttribute(): string
	{
		if ($this->provider) {
			return $this->profile->avatar;
		}
		$mediaItems = optional($this->profile)->getMedia() ?? collect([]);
		if ($mediaItems->isNotEmpty()) {
			return $mediaItems[0]->getUrl('account_menu');
		}

		return '/images/avatar44x44.png';
	}

	public function getDashboardAvatarAttribute(): string
	{
		if ($this->provider) {
			return $this->profile->avatar;
		}
		$mediaItems = optional($this->profile)->getMedia() ?? collect([]);
		if ($mediaItems->isNotEmpty()) {
			return $mediaItems[0]->getUrl('dashboard');
		}

		return '/images/avatar.png'; // Default 90x90
	}

	public function orders(): HasMany
	{
		return $this->hasMany(Order::class);
	}

	// The suppliers created by this user
	public function suppliers(): HasMany
	{
		return $this->hasMany(Supplier::class, 'owner_id');
	}

	public function workshop(): HasOne
	{
		return $this->hasOne(Workshop::class);
	}

	/**
	 * Get the stocks for the user.
	 *
	 * @return \Illuminate\Database\Eloquent\Collection $stocks
	 */
	public function stocks(): HasMany
	{
		return $this->hasMany(Stock::class);
	}

	/**
	 * Get the store record associated with the user.
	 *
	 * @return \App\Store $store
	 */
	public function store(): HasOne
	{
		return $this->hasOne(Store::class);
	}

	public function parts()
	{
		return $this->hasMany(Part::class);
	}
}
