<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSepasTable extends Migration
{
    public function up()
    {
        Schema::create('sepas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('full_name');
            $table->string('email');
            $table->string('iban');
            $table->string('bic');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sepas');
    }
}
