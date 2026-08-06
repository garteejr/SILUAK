<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanRuangan extends Model
{
    use HasFactory;

    protected $table = 'peminjaman_ruangans';
    protected $guarded = [];

    protected $casts = [
        'tanggal' => 'date',
        // Waktu mulai/selesai biarkan string atau time, 
        // tapi kalau mau manipulasi jam bisa pakai 'datetime' format
    ];
}