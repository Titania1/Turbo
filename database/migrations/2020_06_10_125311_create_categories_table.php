<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function (Blueprint $table) {
			$table->id();
			$table->foreignId('category_id')->nullable()->constrained();
			$table->unsignedBigInteger('internal_id')->nullable()->unique()->index('categories_catalog');
			$table->string('name');
			$table->string('image')->nullable();
			$table->string('slug');
			$table->unique(['category_id', 'name']);
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
		Schema::dropIfExists('categories');
	}
}
