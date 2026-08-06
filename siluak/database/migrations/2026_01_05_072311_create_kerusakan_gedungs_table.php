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
        Schema::create('kerusakan_gedungs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('telepon');
            $table->string('bidang');
            $table->string('gedung');    // Sesuai blade <input name="gedung">
            $table->string('lokasi');
            $table->text('deskripsi');
            $table->string('foto')->nullable(); // Untuk simpan path gambar
            $table->string('status')->default('Menunggu');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kerusakan_gedungs');
    }
};
