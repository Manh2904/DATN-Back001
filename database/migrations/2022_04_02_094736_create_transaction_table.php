<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tst_user_id')->constrained('users')->onDelete('cascade');
            $table->string('tst_total_money')->default(0);
            $table->string('tst_name')->nullable();
            $table->string('tst_email')->nullable();
            $table->string('tst_phone')->nullable();
            $table->string('tst_address')->nullable();
            $table->string('tst_note')->nullable();
            $table->integer('tst_status')->default(1);
            $table->integer('tst_type')->default(1);
            $table->string('tst_code')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
