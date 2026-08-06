<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\PengajuanBmd;
use App\Models\KerusakanAlat;
use App\Models\KerusakanGedung;
use App\Models\PeminjamanKendaraan;
use App\Models\PeminjamanRuangan;
use App\Models\Atk;

class LaporanController extends Controller
{
    // bmd
    public function bmd()
    {
        $items = PengajuanBmd::latest()->get(); 
        return view('umpeg.laporan.bmd', [
            'items' => $items
        ]);
    }

    public function storeBMD(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'nama'       => 'required|string|max:255',
            'email'      => 'required|email',
            'bidang'  => 'required|string',
            'kode'       => 'required|string',
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

        return back()->with('success', 'Permohonan berhasil dikirim!');
    }

    // kerusakan alat
    public function kerusakan_alat()
    {
        $items = KerusakanAlat::latest()->get(); 
        return view('umpeg.laporan.kerusakan_alat', [
            'items' => $items
        ]);
    }

    public function storeKerusakanAlat(Request $request)
    {
        $validated = $request->validate([
            'nama'       => 'required|string',
            'bidang'     => 'required|string',
            'jenis_alat' => 'required|string',
            'nama_alat'  => 'required|string',
            'kerusakan'  => 'required|string',
        ]);
        KerusakanAlat::create($validated);
        return back()->with('success', 'Permohonan berhasil dikirim!');
    }

    // kerusakan gedung
    public function kerusakan_gedung()
    {
        $items = KerusakanGedung::latest()->get(); 
        return view('umpeg.laporan.kerusakan_gedung', [
            'items' => $items
        ]);
    }

    public function storeKerusakanGedung(Request $request)
    {
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
        return back()->with('success', 'Permohonan berhasil dikirim!');
    }

    // peminjaman kendaraan dinas
    public function pinjam_kendaraan()
    {
        $items = PeminjamanKendaraan::latest()->get(); 
        return view('umpeg.laporan.pinjam_kendaraan', [
            'items' => $items
        ]);
    }

    public function storePinjamKendaraan(Request $request)
    {
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
        return back()->with('success', 'Permohonan berhasil dikirim!');
    }

    public function uploadSuratKendaraan(Request $request, $id)
    {
        $request->validate([
            'surat' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        $item = PeminjamanKendaraan::findOrFail($id);

        if ($request->hasFile('surat')) {
            // hapus file lama jika ada
            if ($item->surat_permohonan) {
                Storage::disk('public')->delete($item->surat_permohonan);
            }

            // simpan file baru
            $path = $request->file('surat')->store('surat_peminjaman', 'public');
            $item->update(['surat_permohonan' => $path]);
        }

        return back()->with('success', 'Surat permohonan berhasil diunggah!');
    }

    public function downloadTemplate($id)
    {
        $templatePath = public_path('templates/template_izin_kendaraan.docx');

        if (!file_exists($templatePath)) {
            return back()->with('error', 'File template tidak ditemukan di public/templates/! Silakan upload filenya dulu ke sana.');
        }

        return response()->download($templatePath, 'Form_Permohonan_Izin_Kendaraan.docx');
    }

    // peminjaman ruangan
    public function pinjam_ruangan()
    {
        $items = PeminjamanRuangan::latest()->get(); 
        return view('umpeg.laporan.pinjam_ruangan', [
            'items' => $items
        ]);
    }

    public function storePinjamRuangan(Request $request)
    {
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
        return back()->with('success', 'Permohonan berhasil dikirim!');
    }

    // permintaan atk
    public function atk()
    {
        $items = Atk::latest()->get(); 
        return view('umpeg.laporan.atk', [
            'items' => $items
        ]);
    }

    public function storeATK(Request $request)
    {
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
        return back()->with('success', 'Permohonan ATK berhasil dikirim!');
    }
}