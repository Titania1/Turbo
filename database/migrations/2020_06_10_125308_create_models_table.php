<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('models', function (Blueprint $table) {
			$table->id();
			$table->foreignId('brand_id')->constrained();
			$table->string('image')->default('/models/model.jpg');
			$table->string('name');
			$table->string('slug');
			$table->unique(['name', 'brand_id']);
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
		Schema::dropIfExists('models');
	}
}
