<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang_atks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('satuan'); // Rim, Pcs, Unit, dll
            $table->integer('stok');
            $table->string('kategori'); // Kertas, Alat Tulis, Arsip, dll
            $table->integer('stok_minimal')->default(10); // Ambang batas stok menipis
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_atks');
    }
};
