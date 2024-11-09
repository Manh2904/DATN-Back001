<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('od_transaction_id')->constrained('transactions')->onDelete('cascade');
            $table->foreignId('od_product_id')->constrained('products')->onDelete('cascade');
            $table->integer('od_sale')->default(0);
            $table->integer('od_qty')->default(0);
            $table->integer('od_price')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
