<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLockersTable extends Migration
{
    public function up()
    {
        Schema::create('lockers', function (Blueprint $table) {
            $table->id();
            $table->string('locker_name'); // e.g., C209
            $table->string('building');    // e.g., C building
            $table->string('floor');       // e.g., 2nd floor
            $table->enum('status', ['Available', 'In Use', 'Out of Service']); // Locker status
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lockers');
    }
}
