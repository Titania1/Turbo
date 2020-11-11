<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicePartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_part', function (Blueprint $table) {
            $table->id();
            $table->foreignId('part_id');
            $table->foreignId('invoice_id');
            $table->integer('quantity');
            $table->double('buy_price');
            $table->double('sell_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_part');
    }
}
