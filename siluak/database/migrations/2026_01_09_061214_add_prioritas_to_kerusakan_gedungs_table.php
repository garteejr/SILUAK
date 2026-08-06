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
        Schema::table('kerusakan_gedungs', function (Blueprint $table) {
            // Menambahkan kolom prioritas setelah kolom status (atau lokasi)
            $table->string('prioritas')->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('kerusakan_gedungs', function (Blueprint $table) {
            $table->dropColumn('prioritas');
        });
    }
};
