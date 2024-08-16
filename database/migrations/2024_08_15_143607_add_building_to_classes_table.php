<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('classes', function (Blueprint $table) {
        $table->string('building')->nullable()->after('name'); // Adjust 'name' to whatever column you want to place 'building' after
    });
}


    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('classes', function (Blueprint $table) {
        $table->dropColumn('building');
    });
}

};
