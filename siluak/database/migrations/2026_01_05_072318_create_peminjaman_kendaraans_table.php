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
        Schema::create('peminjaman_kendaraans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nip');      // Tambahan sesuai blade
            $table->string('telepon');
            $table->string('bidang');
            $table->string('jenis_kendaraan');
            $table->string('tujuan');
            $table->string('kegiatan'); // Sesuai blade <input name="kegiatan">
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->string('status')->default('Menunggu');
            $table->string('surat_permohonan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_kendaraans');
    }
};
