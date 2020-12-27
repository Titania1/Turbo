<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('internal_id')->unique()->index('catalog_cars');
            $table->foreignId('vehicle_id')->constrained();
            $table->string('type');
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->string('slug');
            $table->unique(['vehicle_id', 'type']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
}
