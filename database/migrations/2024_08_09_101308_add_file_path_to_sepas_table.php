<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFilePathToSepasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sepas', function (Blueprint $table) {
            // Add file_path column only if it doesn't exist
            if (!Schema::hasColumn('sepas', 'file_path')) {
                $table->string('file_path')->nullable()->after('verified');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sepas', function (Blueprint $table) {
            // Drop file_path column if it exists
            if (Schema::hasColumn('sepas', 'file_path')) {
                $table->dropColumn('file_path');
            }
        });
    }
}
