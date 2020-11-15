<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
			$table->foreignId('user_id')->nullable()->constrained();
			// The supplier owner (when the supplier isn't a user)
			$table->foreignId('owner_id')->constrained('users');
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
