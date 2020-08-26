<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleModelsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vehicle_models', function (Blueprint $table) {
			$table->id();
			$table->foreignId('brand_id')->onDelete('cascade');
			$table->foreignId('vehicle_model_id')->nullable()->constrained();
			$table->date('from')->nullable();
			$table->date('to')->nullable();
			$table->string('name');
			$table->string('image')->nullable();
			$table->boolean('is_commercial')->default(false);
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
		Schema::dropIfExists('vehicle_models');
	}
}
