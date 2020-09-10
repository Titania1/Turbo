<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogCategoriesTable extends Migration
{
	/**
	 * Run the migrations.
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
