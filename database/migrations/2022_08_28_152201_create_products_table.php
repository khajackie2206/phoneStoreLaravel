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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('brand_id');
            $table->string('name');
            $table->integer('price')->nullable();
            $table->float('discount')->nullable();
            $table->text('description')->nullable();
            $table->integer('active');
            $table->integer('year')->nullable();
            $table->integer('quantity');
            $table->integer('battery')->nullable();
            $table->string('os')->nullable();
            $table->string('cpu')->nullable();
            $table->integer('core')->nullable();
            $table->float('speed')->nullable();
            $table->float('size')->nullable();
            $table->string('display_tech')->nullable();
            $table->string('resolution')->nullable();
            $table->string('font_cam')->nullable();
            $table->string('rear_cam')->nullable();
            $table->foreign('category_id')->references('id')->on('product_category')->onDelete('cascade');
            $table->foreign('vendor_id')->references('id')->on('vendor')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brand')->onDelete('cascade');
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
};
