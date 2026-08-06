<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\PengajuanBmd;
use App\Models\KerusakanAlat;
use App\Models\KerusakanGedung;
use App\Models\PeminjamanKendaraan;
use App\Models\PeminjamanRuangan;
use App\Models\Atk;

class LayananController extends Controller
{
    public function store(Request $request, $jenis)
    {
        try {
            switch ($jenis) {
            // pengajuan BMD
                case 'bmd':
                    $validated = $request->validate([
                        'nama'       => 'required|string|max:255',
                        'email'      => 'required|email',
                        'bidang'  => 'required|string',
                        'kode'       => 'nullable|string',
                        'program'    => 'required|string',
                        'kegiatan'   => 'required|string',
                        'output'     => 'required|string',
                        'keterangan' => 'required|string',
                        'items'                 => 'required|array|min:1',
                        'items.*.nama_barang'   => 'required|string',
                        'items.*.jumlah'        => 'required|integer|min:1',
                        'items.*.satuan'        => 'required|string',
                    ]);

                    PengajuanBmd::create($validated);
                    break;

                // pelaporan kerusakan kantor
                case 'alat':
                    $validated = $request->validate([
                        'nama'       => 'required|string',
                        'bidang'     => 'required|string',
                        'jenis_alat' => 'required|string',
                        'nama_alat'  => 'required|string',
                        'kerusakan'  => 'required|string',
                    ]);
                    KerusakanAlat::create($validated);
                    break;
                // pelaporan kerusakan gedung
                case 'gedung':
                    $validated = $request->validate([
                        'nama'      => 'required|string',
                        'telepon'   => 'required|string',
                        'bidang'    => 'required|string',
                        'gedung'    => 'required|string',
                        'lokasi'    => 'required|string',
                        'deskripsi' => 'required|string',
                        'foto'      => 'required|image|mimes:jpeg,png,jpg|max:1024',
                    ]);

                    if ($request->hasFile('foto')) {
                        $validated['foto'] = $request->file('foto')->store('pelaporan/gedung', 'public');
                    }
                    
                    KerusakanGedung::create($validated);
                    break;

                // peminjaman kendaraan dinas
                case 'kendaraan':
                    $validated = $request->validate([
                        'nama'            => 'required|string',
                        'nip'             => 'required|string',
                        'telepon'         => 'required|string',
                        'bidang'          => 'required|string',
                        'jenis_kendaraan' => 'required|string',
                        'tujuan'          => 'required|string',
                        'kegiatan'        => 'required|string',
                        'tgl_pinjam'      => 'required|date',
                        'tgl_kembali'     => 'required|date|after_or_equal:tgl_pinjam',
                    ]);
                    PeminjamanKendaraan::create($validated);
                    break;

                // peminjaman ruangan
                case 'ruangan':
                    $validated = $request->validate([
                        'nama'          => 'required|string',
                        'nip'           => 'required|string',
                        'telepon'       => 'required|string',
                        'bidang'        => 'required|string',
                        'ruangan'       => 'required|string',
                        'acara'         => 'required|string',
                        'tanggal'       => 'required|date',
                        'waktu_mulai'   => 'required',
                        'waktu_selesai' => 'required|after:waktu_mulai',
                    ]);
                    PeminjamanRuangan::create($validated);
                    break;

                // atk
                case 'atk':
                    $validated = $request->validate([
                        'nama' => 'required|string',
                        'nip'  => 'required|string',
                        'bidang'       => 'required|string',
                        'items'        => 'required|array',
                        'items.*.nama_barang' => 'required|string',
                        'items.*.jumlah'      => 'required|numeric|min:1',
                        'items.*.satuan'      => 'required|string',
                        'foto'      => 'required|image|mimes:jpeg,png,jpg|max:1024',
                    ]);

                    if ($request->hasFile('foto')) {
                        $validated['foto'] = $request->file('foto')->store('pengajuan/atk', 'public');
                    }

                    Atk::create($validated);
                    break;
                
                default:
                    return redirect()->back()->with('error', 'Jenis layanan tidak valid.');
            }

            return redirect()->back()->with('success', 'Permohonan ATK berhasil dikirim!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage())->withInput();
        }
    }
}