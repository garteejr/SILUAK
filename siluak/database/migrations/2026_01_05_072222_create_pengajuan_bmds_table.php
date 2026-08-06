<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengajuan_bmds', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('bidang');
            $table->string('kode')->nullable();
            $table->string('program');
            $table->string('kegiatan');
            $table->string('output');
            $table->text('keterangan');
            // Kolom items akan menyimpan array dari: nama_barang, jumlah, satuan
            $table->json('items'); 
            $table->string('status')->default('Menunggu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan_bmds');
    }
};