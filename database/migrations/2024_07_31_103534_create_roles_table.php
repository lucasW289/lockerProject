<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id(); // This creates an auto-incrementing primary key column named 'id'
            $table->string('name'); // This column stores the role name
            $table->timestamps(); // This adds created_at and updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
