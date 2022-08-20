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
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->after('password')->nullable();
            $table->string('address')->nullable();
            $table->date('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->string('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'users',
            function (Blueprint $table) {
            $table->dropColumn('avatar');
            $table->dropColumn('address');
            $table->dropColumn('birthday');
            $table->dropColumn('gender');
            $table->dropColumn('active');
            }
        );
    }
};
