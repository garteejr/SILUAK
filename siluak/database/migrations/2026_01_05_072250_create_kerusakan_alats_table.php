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
        Schema::create('kerusakan_alats', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('bidang'); // Sesuai blade <select name="bidang">
            $table->string('jenis_alat'); // Sesuai blade <select name="jenis_alat">
            $table->string('nama_alat');  // Merk/Type
            $table->text('kerusakan');    // Sesuai blade <input name="kerusakan">
            $table->string('status')->default('Menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kerusakan_alats');
    }
};
