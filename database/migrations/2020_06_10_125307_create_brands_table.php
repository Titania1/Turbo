<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('brands', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('internal_id')->nullable()->index('catalog_brands');
			$table->string('name');
			$table->string('logo')->default('brands/brand.png');
			$table->string('country')->nullable();
			$table->string('slug');
			$table->boolean('is_commercial')->default(false);
			$table->unique(['slug', 'is_commercial']);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('brands');
	}
}
