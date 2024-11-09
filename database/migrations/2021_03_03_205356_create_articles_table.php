<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('a_name')->nullable();
            $table->string('a_slug')->nullable();
            $table->integer('a_hot')->default(0);
            $table->integer('a_active')->default(1);
            $table->string('a_menu_id')->nullable();
            $table->integer('a_view')->default(0);
            $table->text('a_description')->nullable();
            $table->text('a_avatar')->nullable();
            $table->text('a_content')->nullable();
            $table->integer('_wysihtml5_mode')->nullable();
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
        Schema::dropIfExists('articles');
    }
}
