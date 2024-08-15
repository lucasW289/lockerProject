<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLockerIdToChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('children', function (Blueprint $table) {
            $table->unsignedBigInteger('locker_id')->nullable()->after('class_id');
            
            // Add a foreign key constraint if lockers table exists
            $table->foreign('locker_id')->references('id')->on('lockers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('children', function (Blueprint $table) {
            $table->dropForeign(['locker_id']);
            $table->dropColumn('locker_id');
        });
    }
}
