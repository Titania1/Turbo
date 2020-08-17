<?php

declare(strict_types=1);

namespace App\Catalog;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
	/**
	 * The connection name for the model.
	 *
	 * @var string
	 */
	protected $connection = 'tecdoc';

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'articles';
}
