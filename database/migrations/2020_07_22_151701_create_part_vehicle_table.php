<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartVehicleTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('part_vehicle', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('part_id');
			$table->unsignedBigInteger('vehicle_id');
			$table->unique(['part_id', 'vehicle_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('part_vehicle');
	}
}
