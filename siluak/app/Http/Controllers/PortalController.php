<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeminjamanRuangan;
use App\Models\BarangAtk;

class PortalController extends Controller
{
    public function index()
    {
        // data dari admin: manajemen stok
        $daftarBarangGudang = BarangAtk::where('stok', '>', 0)
                                ->orderBy('nama_barang', 'asc')
                                ->get();
        
        // peminjaman ruangan terakhir yang disetujui
        $items = PeminjamanRuangan::where('status', 'Disetujui')
                                ->latest()
                                ->take(6)
                                ->get(); 

        return view('welcome', [
            'items' => $items,
            'daftarBarangGudang' => $daftarBarangGudang
        ]);
    }
}