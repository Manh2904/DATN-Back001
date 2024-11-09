<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('pro_name')->nullable();
            $table->integer('pro_amount')->default(100);
            $table->integer('pro_view')->default(0);
            $table->string('pro_slug')->nullable();
            $table->integer('pro_price')->default(0);
            $table->integer('pro_sale')->default(0);
            $table->foreignId('pro_category')->constrained('category')->onDelete('cascade');
            $table->string('pro_avatar')->nullable();
            $table->integer('pro_favourite')->default(0);
            $table->integer('pro_hot')->default(0);
            $table->integer('pro_active')->default(0);
            $table->integer('pro_admin_id')->default(0);
            $table->integer('pro_pay')->default(0);
            $table->text('pro_description')->nullable();
            $table->text('pro_content')->nullable();
            $table->integer('pro_review_total')->default(0);
            $table->string('keywordseo')->nullable();
            $table->integer('pro_review_star')->default(5);
            $table->string('_wysihtml5_mode')->nullable();
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
        Schema::dropIfExists('products');
    }
}
