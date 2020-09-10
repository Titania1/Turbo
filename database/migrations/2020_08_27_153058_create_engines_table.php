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
			$table->foreignId('vehicle_model_id')->constrained();
			$table->string('type')->unique()->index();
			$table->string('slug')->unique();
			$table->string('interval');
			$table->string('power');
			$table->string('capacity');
			$table->unsignedTinyInteger('cylinders');
			$table->string('body_type');
			$table->string('fuel');
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
