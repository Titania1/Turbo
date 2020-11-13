<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreContactsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('store_contacts', function (Blueprint $table) {
			$table->id();
			$table->foreignId('store_id')->onDelete('cascade');
			$table->string('longitude')->nullable();
			$table->string('latitude')->nullable();
			$table->string('address')->nullable();
			$table->text('comment')->nullable();
			$table->string('email')->unique()->nullable();
			$table->string('phone')->unique()->nullable();
			$table->json('opening_hours')->nullable();
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
		Schema::dropIfExists('store_contacts');
	}
}
