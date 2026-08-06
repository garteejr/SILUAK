<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanKendaraan extends Model
{
    use HasFactory;

    protected $table = 'peminjaman_kendaraans';
    protected $guarded = [];

    // Opsional: Agar Laravel otomatis menganggap ini sebagai tanggal
    protected $casts = [
        'tgl_pinjam' => 'date',
        'tgl_kembali' => 'date',
    ];
}