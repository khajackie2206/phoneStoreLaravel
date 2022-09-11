<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->unsignedBigInteger('express_id');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('tax_id');
            $table->unsignedBigInteger('voucher_id');
            $table->unsignedBigInteger('payment_id');
            $table->unsignedBigInteger('user_id');
            $table->date('delivery_date');
            $table->string('note')->nullable();
            $table->integer('total');
            $table->integer('profit');
            $table->string('delivery_address');
            $table->timestamps();
            $table->foreign('express_id')->references('id')->on('expresses');
            $table->foreign('status_id')->references('id')->on('status');
            $table->foreign('tax_id')->references('id')->on('tax');
            $table->foreign('voucher_id')->references('id')->on('voucher');
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->foreign('user_id')->references('id')->on('users');
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
};
