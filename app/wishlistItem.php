<?php


class wishlistItem
{
	public $rowId;
	public $id;
	public $qty;
	private $associatedModel = null;

	public function __construct($id, $qte)
	{
		if (empty($id)) {
			throw new \InvalidArgumentException('Please supply a valid identifier.');
		}
		if (empty($qte)) {
			throw new \InvalidArgumentException('Please supply a valid name.');
		}

		$this->id = $id;
		$this->rowId = $this->generateRowId($id);
	}


	public function setQuantity($qty)
	{
		if (empty($qty) || !is_numeric($qty)) {
			throw new \InvalidArgumentException('Please supply a valid quantity.');
		}

		$this->qty = $qty;
	}

	public function updateFromArray(array $attributes)
	{
		$this->id = Arr::get($attributes, 'id', $this->id);
		$this->qty = Arr::get($attributes, 'qty', $this->qty);
		$this->rowId = $this->generateRowId($this->id, $this->options->all());
	}


	public function associate($model)
	{
		$this->associatedModel = is_string($model) ? $model : get_class($model);

		return $this;
	}

	public function __get($attribute)
	{
		if (property_exists($this, $attribute)) {
			return $this->{$attribute};
		}
		$decimals = config('wishlist.format.decimals', 2);

		switch ($attribute) {
			case 'model':
				if (isset($this->associatedModel)) {
					return with(new $this->associatedModel())->find($this->id);
				}
			case 'modelFQCN':
				if (isset($this->associatedModel)) {
					return $this->associatedModel;
				}
			case 'weightTotal':
				return round($this->weight * $this->qty, $decimals);
		}
	}


	public static function fromArray(array $attributes)
	{
		$options = Arr::get($attributes, 'options', []);

		return new self($attributes['id'], $attributes['Qte']);
	}

	/**
	 * Generate a unique id for the wishlist item.
	 *
	 * @param string $id
	 * @param array  $options
	 *
	 * @return string
	 */
	protected function generateRowId($id)
	{
		return md5($id);
	}

	/**
	 * Get the instance as an array.
	 *
	 * @return array
	 */

	public function toArray()
	{
		return [
			'rowId'    => $this->rowId,
			'id'       => $this->id,
			'qty'      => $this->qty,

		];
	}

	/**
	 * Get the formatted number.
	 *
	 * @param float  $value
	 * @param int    $decimals
	 * @param string $decimalPoint
	 * @param string $thousandSeperator
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
}
