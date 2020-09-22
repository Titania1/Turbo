<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnginesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('engines', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('internal_id')->index('engines_catalog');
			$table->foreignId('vehicle_id')->constrained();
			$table->string('type')->index();
			$table->string('slug');
			$table->string('interval');
			$table->string('power');
			$table->string('capacity');
			$table->string('construction')->nullable();
			$table->string('fuel')->nullable();
			$table->string('fuel_mixture')->nullable();
			$table->string('charge')->nullable();
			$table->string('cylinder_construction')->nullable();
			$table->string('engine_management')->nullable();
			$table->string('cooling_type')->nullable();
			$table->string('compression')->nullable();
			$table->string('torque')->nullable();
			$table->string('bore')->nullable();
			$table->string('stroke')->nullable();
			$table->unsignedTinyInteger('cylinders')->nullable();
			$table->unsignedTinyInteger('valves')->nullable();
			$table->unsignedTinyInteger('bearings')->nullable();
			$table->string('motor_code');
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
		Schema::dropIfExists('engines');
	}
}
