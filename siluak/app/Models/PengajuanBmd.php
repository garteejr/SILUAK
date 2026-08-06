<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanBmd extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_bmds'; // Nama tabel di database
    protected $guarded = []; // Izinkan semua kolom diisi
    
    protected $casts = [
        'items' => 'array',
    ];
}
