<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('suppliers', function (Blueprint $table) {
			$table->id();
			// The user who is also a supplier (treated like a profile)
			$table->unsignedBigInteger('user_id')->nullable();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			// The supplier owner (when the supplier isn't a user)
			$table->unsignedBigInteger('owner_id')->nullable();
			$table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
			$table->string('name');
			$table->string('address')->nullable();
			$table->integer('phone')->nullable();
			$table->decimal('credit')->nullable();
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
		Schema::dropIfExists('suppliers');
	}
}
