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
        Schema::table('kerusakan_alats', function (Blueprint $table) {
            $table->string('prioritas')->default('Belum Diatur')->after('status');
        });
    }

    public function down()
    {
        Schema::table('kerusakan_alats', function (Blueprint $table) {
            $table->dropColumn('prioritas');
        });
    }
};
