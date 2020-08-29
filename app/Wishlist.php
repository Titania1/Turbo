<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Facade;
use Gloudemans\Shoppingcart\Exceptions\InvalidRowIDException;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\DatabaseManager;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Collection;

class WishlistFacade extends Facade
{
	const DEFAULT_INSTANCE = 'default';
	private $session;
	private $events;
	private $instance;
	private $createdAt;

	private $updatedAt;

	protected static function getFacadeAccessor()
	{
		return 'wishlist';
	}


	public function __construct(SessionManager $session, Dispatcher $events)
	{
		$this->session = $session;
		$this->events = $events;
		$this->instance(self::DEFAULT_INSTANCE);
	}

	public function instance($instance = null)
	{
		$instance = $instance ?: self::DEFAULT_INSTANCE;

		if ($instance instanceof InstanceIdentifier) {
			$instance = $instance->getInstanceIdentifier();
		}

		$this->instance = sprintf('%s.%s', 'wishlist', $instance);

		return $this;
	}

	/**
	 * Get the current wishlist instance.
	 *
	 * @return string
	 */
	public function currentInstance()
	{
		return str_replace('wishlist.', '', $this->instance);
	}


	public function add($id, $qty = null)
	{
		if ($this->isMulti($id)) {
			return array_map(function ($item) {
				return $this->add($item);
			}, $id);
		}

		$wishlistItem = $this->createwishlistItem($id, $qty);

		return $this->addwishlistItem($wishlistItem);
	}


	public function addwishlistItem($item, $dispatchEvent = true)
	{

		$content = $this->getContent();

		if ($content->has($item->rowId)) {
			$item->qty += $content->get($item->rowId)->qty;
		}

		$content->put($item->rowId, $item);

		if ($dispatchEvent) {
			$this->events->dispatch('wishlist.added', $item);
		}

		$this->session->put($this->instance, $content);

		return $item;
	}


	public function update($rowId, $qty)
	{
		$wishlistItem = $this->get($rowId);

		$content = $this->getContent();

		if ($rowId !== $wishlistItem->rowId) {
			$itemOldIndex = $content->keys()->search($rowId);

			$content->pull($rowId);

			if ($content->has($wishlistItem->rowId)) {
				$existingwishlistItem = $this->get($wishlistItem->rowId);
				$wishlistItem->setQuantity($existingwishlistItem->qty + $wishlistItem->qty);
			}
		}

		if ($wishlistItem->qty <= 0) {
			$this->remove($wishlistItem->rowId);

			return;
		} else {
			if (isset($itemOldIndex)) {
				$content = $content->slice(0, $itemOldIndex)
					->merge([$wishlistItem->rowId => $wishlistItem])
					->merge($content->slice($itemOldIndex));
			} else {
				$content->put($wishlistItem->rowId, $wishlistItem);
			}
		}

		$this->events->dispatch('wishlist.updated', $wishlistItem);

		$this->session->put($this->instance, $content);

		return $wishlistItem;
	}

	/**
	 * Remove the wishlist item with the given rowId from the wishlist.
	 *
	 * @param string $rowId
	 *
	 * @return void
	 */
	public function remove($rowId)
	{
		$wishlistItem = $this->get($rowId);

		$content = $this->getContent();

		$content->pull($wishlistItem->rowId);

		$this->events->dispatch('wishlist.removed', $wishlistItem);

		$this->session->put($this->instance, $content);
	}

	/**
	 * Get a wishlist item from the wishlist by its rowId.
	 *
	 * @param string $rowId
	 *
	 * @return \Gloudemans\Shoppingwishlist\wishlistItem
	 */
	public function get($rowId)
	{
		$content = $this->getContent();

		if (!$content->has($rowId)) {
			throw new InvalidRowIDException("The wishlist does not contain rowId {$rowId}.");
		}

		return $content->get($rowId);
	}

	/**
	 * Destroy the current wishlist instance.
	 *
	 * @return void
	 */
	public function destroy()
	{
		$this->session->remove($this->instance);
	}

	/**
	 * Get the content of the wishlist.
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function content()
	{
		if (is_null($this->session->get($this->instance))) {
			return new Collection([]);
		}

		return $this->session->get($this->instance);
	}

	/**
	 * Get the number of items in the wishlist.
	 *
	 * @return int|float
	 */
	public function count()
	{
		return $this->getContent()->sum('qty');
	}

	/**
	 * Get the number of items instances in the wishlist.
	 *
	 * @return int|float
	 */
	public function countInstances()
	{
		return $this->getContent()->count();
	}

	/**
	 * Get the total price of the items in the wishlist.
	 *
	 * @return float
	 */
	public function totalFloat()
	{
		return $this->getContent()->reduce(function ($total, wishlistItem $wishlistItem) {
			return $total + $wishlistItem->total;
		}, 0);
	}

	/**
	 * Get the total price of the items in the wishlist as formatted string.
	 *
	 * @param int    $decimals
	 * @param string $decimalPoint
	 * @param string $thousandSeperator
	 *
	 * @return string
	 */
	public function total($decimals = null, $decimalPoint = null, $thousandSeperator = null)
	{
		return $this->numberFormat($this->totalFloat(), $decimals, $decimalPoint, $thousandSeperator);
	}

	/**
	 * Get the total tax of the items in the wishlist.
	 *
	 * @return float
	 */
	public function taxFloat()
	{
		return $this->getContent()->reduce(function ($tax, wishlistItem $wishlistItem) {
			return $tax + $wishlistItem->taxTotal;
		}, 0);
	}

	/**
	 * Get the total tax of the items in the wishlist as formatted string.
	 *
	 * @param int    $decimals
	 * @param string $decimalPoint
	 * @param string $thousandSeperator
	 *
	 * @return string
	 */
	public function tax($decimals = null, $decimalPoint = null, $thousandSeperator = null)
	{
		return $this->numberFormat($this->taxFloat(), $decimals, $decimalPoint, $thousandSeperator);
	}

	/**
	 * Get the subtotal (total - tax) of the items in the wishlist.
	 *
	 * @return float
	 */
	public function subtotalFloat()
	{
		return $this->getContent()->reduce(function ($subTotal, wishlistItem $wishlistItem) {
			return $subTotal + $wishlistItem->subtotal;
		}, 0);
	}

	/**
	 * Get the subtotal (total - tax) of the items in the wishlist as formatted string.
	 *
	 * @param int    $decimals
	 * @param string $decimalPoint
	 * @param string $thousandSeperator
	 *
	 * @return string
	 */
	public function subtotal($decimals = null, $decimalPoint = null, $thousandSeperator = null)
	{
		return $this->numberFormat($this->subtotalFloat(), $decimals, $decimalPoint, $thousandSeperator);
	}

	/**
	 * Get the discount of the items in the wishlist.
	 *
	 * @return float
	 */
	public function discountFloat()
	{
		return $this->getContent()->reduce(function ($discount, wishlistItem $wishlistItem) {
			return $discount + $wishlistItem->discountTotal;
		}, 0);
	}

	/**
	 * Get the discount of the items in the wishlist as formatted string.
	 *
	 * @param int    $decimals
	 * @param string $decimalPoint
	 * @param string $thousandSeperator
	 *
	 * @return string
	 */
	public function discount($decimals = null, $decimalPoint = null, $thousandSeperator = null)
	{
		return $this->numberFormat($this->discountFloat(), $decimals, $decimalPoint, $thousandSeperator);
	}

	/**
	 * Get the price of the items in the wishlist (not rounded).
	 *
	 * @return float
	 */
	public function initialFloat()
	{
		return $this->getContent()->reduce(function ($initial, wishlistItem $wishlistItem) {
			return $initial + ($wishlistItem->qty * $wishlistItem->price);
		}, 0);
	}

	/**
	 * Get the price of the items in the wishlist as formatted string.
	 *
	 * @param int    $decimals
	 * @param string $decimalPoint
	 * @param string $thousandSeperator
	 *
	 * @return string
	 */
	public function initial($decimals = null, $decimalPoint = null, $thousandSeperator = null)
	{
		return $this->numberFormat($this->initialFloat(), $decimals, $decimalPoint, $thousandSeperator);
	}

	/**
	 * Get the price of the items in the wishlist (previously rounded).
	 *
	 * @return float
	 */
	public function priceTotalFloat()
	{
		return $this->getContent()->reduce(function ($initial, wishlistItem $wishlistItem) {
			return $initial + $wishlistItem->priceTotal;
		}, 0);
	}

	/**
	 * Get the price of the items in the wishlist as formatted string.
	 *
	 * @param int    $decimals
	 * @param string $decimalPoint
	 * @param string $thousandSeperator
	 *
	 * @return string
	 */
	public function priceTotal($decimals = null, $decimalPoint = null, $thousandSeperator = null)
	{
		return $this->numberFormat($this->priceTotalFloat(), $decimals, $decimalPoint, $thousandSeperator);
	}

	/**
	 * Get the total weight of the items in the wishlist.
	 *
	 * @return float
	 */
	public function weightFloat()
	{
		return $this->getContent()->reduce(function ($total, wishlistItem $wishlistItem) {
			return $total + ($wishlistItem->qty * $wishlistItem->weight);
		}, 0);
	}

	/**
	 * Get the total weight of the items in the wishlist.
	 *
	 * @param int    $decimals
	 * @param string $decimalPoint
	 * @param string $thousandSeperator
	 *
	 * @return string
	 */
	public function weight($decimals = null, $decimalPoint = null, $thousandSeperator = null)
	{
		return $this->numberFormat($this->weightFloat(), $decimals, $decimalPoint, $thousandSeperator);
	}

	/**
	 * Search the wishlist content for a wishlist item matching the given search closure.
	 *
	 * @param \Closure $search
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function search(Closure $search)
	{
		return $this->getContent()->filter($search);
	}

	/**
	 * Associate the wishlist item with the given rowId with the given model.
	 *
	 * @param string $rowId
	 * @return void
	 */
	public function associate($rowId, $model)
	{
		$wishlistItem = $this->get($rowId);

		$wishlistItem->associate($model);

		$content = $this->getContent();

		$content->put($wishlistItem->rowId, $wishlistItem);

		$this->session->put($this->instance, $content);
	}



	/**
	 * Store an the current instance of the wishlist.
	 *
	 * @param mixed $identifier
	 *
	 * @return void
	 */
	public function store($identifier)
	{
		$content = $this->getContent();

		if ($identifier instanceof InstanceIdentifier) {
			$identifier = $identifier->getInstanceIdentifier();
		}

		if ($this->storedwishlistWithIdentifierExists($identifier)) {
			throw new wishlistAlreadyStoredException("A wishlist with identifier {$identifier} was already stored.");
		}

		$this->getConnection()->table($this->getTableName())->insert([
			'identifier' => $identifier,
			'instance'   => $this->currentInstance(),
			'content'    => serialize($content),
			'created_at' => $this->createdAt ?: Carbon::now(),
			'updated_at' => Carbon::now(),
		]);

		$this->events->dispatch('wishlist.stored');
	}

	/**
	 * Restore the wishlist with the given identifier.
	 *
	 * @param mixed $identifier
	 *
	 * @return void
	 */
	public function restore($identifier)
	{
		if ($identifier instanceof InstanceIdentifier) {
			$identifier = $identifier->getInstanceIdentifier();
		}

		if (!$this->storedwishlistWithIdentifierExists($identifier)) {
			return;
		}

		$stored = $this->getConnection()->table($this->getTableName())
			->where('identifier', $identifier)->first();

		$storedContent = unserialize(data_get($stored, 'content'));

		$currentInstance = $this->currentInstance();

		$this->instance(data_get($stored, 'instance'));

		$content = $this->getContent();

		foreach ($storedContent as $wishlistItem) {
			$content->put($wishlistItem->rowId, $wishlistItem);
		}

		$this->events->dispatch('wishlist.restored');

		$this->session->put($this->instance, $content);

		$this->instance($currentInstance);

		$this->createdAt = Carbon::parse(data_get($stored, 'created_at'));
		$this->updatedAt = Carbon::parse(data_get($stored, 'updated_at'));

		$this->getConnection()->table($this->getTableName())->where('identifier', $identifier)->delete();
	}

	/**
	 * Erase the wishlist with the given identifier.
	 *
	 * @param mixed $identifier
	 *
	 * @return void
	 */
	public function erase($identifier)
	{
		if ($identifier instanceof InstanceIdentifier) {
			$identifier = $identifier->getInstanceIdentifier();
		}

		if (!$this->storedwishlistWithIdentifierExists($identifier)) {
			return;
		}

		$this->getConnection()->table($this->getTableName())->where('identifier', $identifier)->delete();

		$this->events->dispatch('wishlist.erased');
	}

	/**
	 * Merges the contents of another wishlist into this wishlist.
	 *
	 * @param mixed $identifier   Identifier of the wishlist to merge with.
	 * @param bool  $keepDiscount Keep the discount of the wishlistItems.
	 * @param bool  $keepTax      Keep the tax of the wishlistItems.
	 * @param bool  $dispatchAdd  Flag to dispatch the add events.
	 *
	 * @return bool
	 */
	public function merge($identifier, $dispatchAdd = true)
	{
		if (!$this->storedwishlistWithIdentifierExists($identifier)) {
			return false;
		}

		$stored = $this->getConnection()->table($this->getTableName())
			->where('identifier', $identifier)->first();

		$storedContent = unserialize($stored->content);

		foreach ($storedContent as $wishlistItem) {
			$this->addwishlistItem($wishlistItem, $dispatchAdd);
		}

		$this->events->dispatch('wishlist.merged');

		return true;
	}


	/**
	 * Get the wishlists content, if there is no wishlist content set yet, return a new empty Collection.
	 *
	 * @return \Illuminate\Support\Collection
	 */
	protected function getContent()
	{
		if ($this->session->has($this->instance)) {
			return $this->session->get($this->instance);
		}

		return new Collection();
	}

	/**
	 * Create a new wishlistItem from the supplied attributes.
	 *
	 * @param mixed     $id
	 * @param int|float $qty

	 * @return \Gloudemans\Shoppingwishlist\wishlistItem
	 */
	private function createwishlistItem($id,  $qty)
	{
		if ($id instanceof Buyable) {
			$wishlistItem = wishlistItem::fromBuyable($id, $qty ?: []);
			$wishlistItem->associate($id);
		} elseif (is_array($id)) {
			$wishlistItem = wishlistItem::fromArray($id);
			$wishlistItem->setQuantity($id['qty']);
		} else {
			$wishlistItem = wishlistItem::fromAttributes($id);
			$wishlistItem->setQuantity($qty);
		}

		return $wishlistItem;
	}

	/**
	 * Check if the item is a multidimensional array or an array of Buyables.
	 *
	 * @param mixed $item
	 *
	 * @return bool
	 */
	private function isMulti($item)
	{
		if (!is_array($item)) {
			return false;
		}

		return is_array(head($item)) || head($item) instanceof Buyable;
	}

	/**
	 * @param $identifier
	 *
	 * @return bool
	 */
	private function storedwishlistWithIdentifierExists($identifier)
	{
		return $this->getConnection()->table($this->getTableName())->where('identifier', $identifier)->exists();
	}

	/**
	 * Get the database connection.
	 *
	 * @return \Illuminate\Database\Connection
	 */
	private function getConnection()
	{
		return app(DatabaseManager::class)->connection($this->getConnectionName());
	}

	/**
	 * Get the database table name.
	 *
	 * @return string
	 */
	private function getTableName()

		return config('wishlist.database.table', 'wishlist');
	}

	/**
	 * Get the database connection name.
	 *
	 * @return string
	 */
	private function getConnectionName()
	{
		$connection = config('wishlist.database.connection');

		return is_null($connection) ? config('database.default') : $connection;
	}

	/**
	 * Get the Formatted number.
	 *
	 * @param $value
	 * @param $decimals
	 * @param $decimalPoint
	 * @param $thousandSeperator
	 *
	 * @return string
	 */
	private function numberFormat($value, $decimals, $decimalPoint, $thousandSeperator)
	{
		if (is_null($decimals)) {
			$decimals = config('wishlist.format.decimals', 2);
		}

		if (is_null($decimalPoint)) {
			$decimalPoint = config('wishlist.format.decimal_point', '.');
		}

		if (is_null($thousandSeperator)) {
			$thousandSeperator = config('wishlist.format.thousand_separator', ',');
		}

		return number_format($value, $decimals, $decimalPoint, $thousandSeperator);
	}

	/**
	 * Get the creation date of the wishlist (db context).
	 *
	 * @return \Carbon\Carbon|null
	 */
	public function createdAt()
	{
		return $this->createdAt;
	}

	/**
	 * Get the lats update date of the wishlist (db context).
	 *
	 * @return \Carbon\Carbon|null
	 */
	public function updatedAt()
	{
		return $this->updatedAt;
	}
}
