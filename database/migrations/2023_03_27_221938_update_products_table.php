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

 Schema::table('products', function ($table) {
     $table->dropConstrainedForeignId('vendor_id');

 });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

 Schema::table('products', function ($table) {
    $table->foreign('vendor_id')->references('id')->on('suppliers');
 });

    }
};
