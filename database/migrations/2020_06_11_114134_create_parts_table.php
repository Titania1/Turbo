<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('parts', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained();
			$table->foreignId('vehicle_id')->constrained();
			$table->string('title');
			$table->text('excerpt')->nullable();
			$table->text('description')->nullable();
			$table->string('image')->nullable();
			$table->decimal('price', 8, 2);
			$table->decimal('old_price')->nullable();
			$table->string('sku')->nullable();
			$table->tinyInteger('rating')->default(0);
			$table->json('key_features')->nullable();
			$table->string('slug')->unique();
			$table->timestamp('deleted_at')->nullable();
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
		Schema::dropIfExists('parts');
	}
}
