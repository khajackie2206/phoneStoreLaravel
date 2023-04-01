<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse_receipts', function (Blueprint $table) {
            $table->id();
            $table->dateTime('created_date')->nullable();
            $table->dateTime('confirmed_date')->nullable();
            $table->float('total');
            $table->unsignedBigInteger('staff_id');
            $table->unsignedBigInteger('supplier_id');
            $table->string('status');
            $table->string('note');
            $table->timestamps();
            $table->foreign('staff_id')->references('id')->on('admins');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouse_receipts');
    }
};
