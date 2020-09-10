<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogCategoriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(): void
	{
		Schema::create('catalog_categories', function (Blueprint $table) {
			$table->id();
			$table->foreignId('engine_id')->constrained();
			$table->unsignedBigInteger('internal_id')->index('catalog');
			$table->string('name');
			$table->string('image')->nullable();
			$table->string('slug');
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
		Schema::dropIfExists('catalog_categories');
	}
}
