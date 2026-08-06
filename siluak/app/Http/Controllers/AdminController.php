<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Menu;
use App\Models\BarangAtk;
use App\Models\PengajuanBmd;
use App\Models\KerusakanAlat;
use App\Models\KerusakanGedung;
use App\Models\PeminjamanKendaraan;
use App\Models\PeminjamanRuangan;
use App\Models\Atk;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BmdExport;
use App\Exports\GedungExport;
use App\Exports\PeralatanExport;
use App\Exports\ManajemenExport;
use App\Exports\KendaraanExport;
use App\Exports\RuangExport;
use App\Exports\AtkExport;


class AdminController extends Controller
{
    /**
     * DASHBOARD ADMIN
     * Menampilkan statistik akumulatif dari semua layanan
     */
    public function dashboard()
    {
        // 1. Statistik Utama (Menghitung status 'Menunggu' dari SEMUA model)
        $permohonanBaru = PengajuanBmd::where('status', 'Menunggu')->count() +
            KerusakanAlat::where('status', 'Menunggu')->count() +
            KerusakanGedung::where('status', 'Menunggu')->count() +
            PeminjamanKendaraan::where('status', 'Menunggu')->count() +
            PeminjamanRuangan::where('status', 'Menunggu')->count() +
            Atk::where('status', 'Menunggu')->count();

        $perluTindakan = $permohonanBaru;

        $layananSelesai = PengajuanBmd::where('status', 'Selesai')->count() +
            KerusakanAlat::where('status', 'Selesai')->count() +
            KerusakanGedung::where('status', 'Selesai')->count() +
            PeminjamanKendaraan::where('status', 'Selesai')->count() +
            PeminjamanRuangan::where('status', 'Selesai')->count() +
            Atk::where('status', 'Selesai')->count();

        // 2. Logika Tren (Minggu Ini vs Minggu Lalu)
        $now = Carbon::now();
        $startOfCurrentWeek = $now->copy()->startOfWeek();
        $startOfLastWeek = $now->copy()->subWeek()->startOfWeek();
        $endOfLastWeek = $now->copy()->subWeek()->endOfWeek();

        $totalMingguIni = PengajuanBmd::where('created_at', '>=', $startOfCurrentWeek)->count() +
            KerusakanAlat::where('created_at', '>=', $startOfCurrentWeek)->count() +
            KerusakanGedung::where('created_at', '>=', $startOfCurrentWeek)->count() +
            PeminjamanKendaraan::where('created_at', '>=', $startOfCurrentWeek)->count() +
            PeminjamanRuangan::where('created_at', '>=', $startOfCurrentWeek)->count() +
            Atk::where('created_at', '>=', $startOfCurrentWeek)->count();

        $totalMingguLalu = PengajuanBmd::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count() +
            KerusakanAlat::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count() +
            KerusakanGedung::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count() +
            PeminjamanKendaraan::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count() +
            PeminjamanRuangan::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count() +
            Atk::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count();

        if ($totalMingguLalu > 0) {
            $persentaseKenaikan = round((($totalMingguIni - $totalMingguLalu) / $totalMingguLalu) * 100);
        } else {
            $persentaseKenaikan = $totalMingguIni > 0 ? 100 : 0;
        }

        $totalSemuaLaporan = PengajuanBmd::count() + KerusakanAlat::count() + KerusakanGedung::count() +
            PeminjamanKendaraan::count() + PeminjamanRuangan::count() + Atk::count();
        $persentasePerluTindakan = $totalSemuaLaporan > 0 ? round(($perluTindakan / $totalSemuaLaporan) * 100) : 0;

        // 3. Data Grafik (Senin s/d Minggu di Minggu Berjalan)
        $chartData = [];
        $monday = Carbon::now()->startOfWeek();
        for ($i = 0; $i < 7; $i++) {
            $date = $monday->copy()->addDays($i)->toDateString();
            $count = PengajuanBmd::whereDate('created_at', $date)->count() +
                KerusakanAlat::whereDate('created_at', $date)->count() +
                KerusakanGedung::whereDate('created_at', $date)->count() +
                PeminjamanKendaraan::whereDate('created_at', $date)->count() +
                PeminjamanRuangan::whereDate('created_at', $date)->count() +
                Atk::whereDate('created_at', $date)->count();
            $chartData[] = $count;
        }

        // Tentukan angka maksimal untuk skala tinggi grafik (Y-Axis)
        $maxData = max($chartData) > 0 ? max($chartData) : 10;

        // 4. Aktivitas Terbaru
        $aktivitas = KerusakanAlat::latest()->take(3)->get()->map(function ($item) {
            $item->type = 'Kerusakan Alat';
            $item->icon = 'devices';
            $item->color = 'blue';
            return $item;
        })->concat(KerusakanGedung::latest()->take(2)->get()->map(function ($item) {
            $item->type = 'Kerusakan Gedung';
            $item->icon = 'apartment';
            $item->color = 'orange';
            return $item;
        }))->sortByDesc('created_at')->take(5);

        // 5. Daftar Perlu Tindakan (GABUNGAN SEMUA MODEL)
        $layananPerluTindakan = KerusakanAlat::where('status', 'Menunggu')->get()->map(function ($item) {
            $item->jenis = 'Kerusakan Alat';
            $item->route_name = 'admin.laporan.peralatan.detail';
            return $item;
        })->concat(KerusakanGedung::where('status', 'Menunggu')->get()->map(function ($item) {
            $item->jenis = 'Kerusakan Gedung';
            $item->route_name = 'admin.laporan.gedung.detail';
            return $item;
        }))->concat(PengajuanBmd::where('status', 'Menunggu')->get()->map(function ($item) {
            $item->jenis = 'Pengajuan BMD';
            $item->nama = $item->nama;
            $item->route_name = 'admin.bmd.detail';
            return $item;
        }))->concat(PeminjamanKendaraan::where('status', 'Menunggu')->get()->map(function ($item) {
            $item->jenis = 'Peminjaman Kendaraan';
            $item->route_name = 'admin.peminjaman.kendaraan_detail';
            return $item;
        }))->concat(PeminjamanRuangan::where('status', 'Menunggu')->get()->map(function ($item) {
            $item->jenis = 'Peminjaman Ruangan';
            $item->route_name = 'admin.peminjaman.ruang_detail';
            return $item;
        }))
            // ->concat(Atk::where('status', 'Menunggu')->get()->map(function ($item) {
            //     $item->jenis = 'Permintaan ATK';
            //     $item->route_name = 'admin.atk.atk_detail';
            //     return $item;
            // }))
            ->sortByDesc('created_at'); // Mengurutkan dari yang paling baru
        // Hapus ->take(10) jika Anda ingin menampilkan SEMUA data tanpa batas.

        return view('admin.pages.dashboard', compact(
            'permohonanBaru',
            'perluTindakan',
            'layananSelesai',
            'persentaseKenaikan',
            'persentasePerluTindakan',
            'chartData',
            'maxData',
            'aktivitas',
            'layananPerluTindakan'
        ));
    }
    public function bmd(Request $request)
    {
        $query = PengajuanBmd::query();

        // PENYESUAIAN: Gunakan kolom 'nama' sesuai database
        if ($request->has('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('program', 'like', "%{$search}%");
            });
        }

        $items = $query->latest()->paginate(10);
        return view('admin.pages.bmd.bmd', compact('items'));
    }

    // peminjaman kendaraan
    public function kendaraan()
    {
        $items = PeminjamanKendaraan::latest()->get();
        return view('admin.pages.peminjaman.kendaraan.kendaraan', compact('items'));
    }

    // public function kendaraan_detail($id)
    // {
    //     $item = PeminjamanKendaraan::findOrFail($id);
    //     return view('admin.pages.peminjaman.kendaraan.kendaraan_detail', compact('item'));
    // }

    public function exportKendaraanExcel()
    {
        return Excel::download(new KendaraanExport, 'peminjaman_kendaraan.xlsx');
    }

    // peminjaman ruang
    public function ruang()
    {
        $items = PeminjamanRuangan::latest()->get();
        return view('admin.pages.peminjaman.ruang.ruang', compact('items'));
    }

    // public function ruang_detail($id) // blm dilanjut yg detail
    // {
    //     $item = PeminjamanRuangan::findOrFail($id);
    //     return view('admin.pages.peminjaman.ruang.ruang_detail', compact('item'));
    //     $laporan = \App\Models\KerusakanAlat::findOrFail($id);
    //     $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.pages.laporan.peralatan.peralatan_pdf_item', compact('laporan'))
    //         ->setPaper('a4', 'portrait');
    //     return $pdf->download('Laporan_Kerusakan_ALT_' . $id . '.pdf');
    // }

    public function exportRuanganExcel()
    {
        return Excel::download(new RuangExport, 'peminjaman_ruangan.xlsx');
    }

    // permintaan atk
    public function atk()
    {
        $items = Atk::latest()->get();
        return view('admin.pages.atk.atk', compact('items'));
    }

    // public function atk_detail($id)
    // {
    //     $item = Atk::findOrFail($id);

    //     return view('admin.pages.atk.atk_detail', compact('item'));
    // }

    // status
    // ini baru kendaraan dan ruangan, pakenya if else
    // public function updateStatus(Request $request, $type, $id)
    // {
    //     $status = $request->status;

    //     if ($type == 'kendaraan') {
    //         $model = \App\Models\PeminjamanKendaraan::findOrFail($id);
    //     } elseif ($type == 'ruangan') {
    //         $model = \App\Models\PeminjamanRuangan::findOrFail($id);
    //     } elseif ($type == 'atk') {
    //         $model = \App\Models\Atk::findOrFail($id);
    //     } else {
    //         return back()->with('error', 'Tipe layanan tidak dikenali.');
    //     }

    //     $model->update(['status' => $status]);

    //     return back()->with('success', "Permohonan berhasil diperbarui menjadi $status.");
    // }

    public function updateStatus(Request $request, $type, $id)
    {
        $status = $request->status;
        return DB::transaction(function () use ($request, $type, $id, $status) {
            switch ($type) {
                case 'kendaraan':
                    $model = PeminjamanKendaraan::findOrFail($id);
                    if ($request->has('plat_nomor')) {
                        $model->jenis_kendaraan = $model->jenis_kendaraan . ' (' . $request->plat_nomor . ')';
                    }
                    break;
                case 'ruangan':
                    $model = PeminjamanRuangan::findOrFail($id);
                    break;
                case 'atk':
                    $model = Atk::findOrFail($id);
                    $oldStatus = $model->status;

                    // 1. VALIDASI KETAT SAAT DISETUJUI
                    if ($status == 'Disetujui' && $request->has('items')) {
                        $tempItems = $model->items;

                        foreach ($request->items as $index => $val) {
                            if (isset($tempItems[$index])) {
                                $jumlahDiberikan = (int) $val['diberikan'];
                                $namaBarang = trim($tempItems[$index]['nama_barang']);

                                $stokGudang = BarangAtk::where('nama_barang', $namaBarang)->first();

                                if (!$stokGudang) {
                                    return back()->with('error', "Barang [$namaBarang] tidak ditemukan di gudang.");
                                }

                                // HITUNG SIMULASI SISA STOK
                                $simulasiSisa = $stokGudang->stok - $jumlahDiberikan;

                                // KUNCI: Tidak boleh kurang dari Stok Minimal (Batas Aman)
                                if ($simulasiSisa < $stokGudang->stok_minimal) {
                                    return back()->with(
                                        'error',
                                        "Gagal Menyetujui! Stok [$namaBarang] tidak mencukupi batas aman. " .
                                            "Stok saat ini: {$stokGudang->stok}, " .
                                            "Batas minimal: {$stokGudang->stok_minimal}."
                                    );
                                }

                                // POTONG STOK: Hanya jika status lama belum Disetujui/Selesai
                                if ($oldStatus != 'Disetujui' && $oldStatus != 'Selesai') {
                                    $stokGudang->decrement('stok', $jumlahDiberikan);
                                }

                                $tempItems[$index]['diberikan'] = $jumlahDiberikan;
                            }
                        }
                        $model->items = $tempItems;
                    }

                    // 2. KEMBALIKAN STOK JIKA DIBATALKAN (DITOLAK / KEMBALI KE MENUNGGU)
                    if (($oldStatus == 'Disetujui' || $oldStatus == 'Selesai') && ($status == 'Ditolak' || $status == 'Menunggu')) {
                        foreach ($model->items as $item) {
                            $barang = BarangAtk::where('nama_barang', trim($item['nama_barang']))->first();
                            if ($barang) {
                                $barang->increment('stok', (int) ($item['diberikan'] ?? 0));
                            }
                        }
                    }
                    break;
                case 'bmd':
                    $model = PengajuanBmd::findOrFail($id);
                    break;
                default:
                    return back()->with('error', 'Tipe layanan tidak dikenali.');
            }

            $model->status = $status;
            $model->save();

            return back()->with('success', "Permohonan berhasil diperbarui menjadi $status.");
        });
    }



    // search gabungan
    // masi error iaaaaaaaaaaaa stresz
    public function search(Request $request)
    {
        // Menangkap parameter 'q' dari URL
        $query = $request->input('q');

        if (empty($query)) {
            $results = ['pengajuanBmd', 'kerusakanAlat', 'kerusakanGedung', 'peminjamanKendaraan', 'peminjamanRuangan', 'permintaanAtk', 'users'];
            $data = ['query' => ''];
            foreach ($results as $r) $data[$r] = collect();
            return view('admin.pages.search', $data);
        }

        // Perbaikan Query: Gunakan kolom 'nama' khusus untuk PengajuanBmd
        $pengajuanBmd = PengajuanBmd::where('nama', 'like', "%$query%")
            ->orWhere('email', 'like', "%$query%")
            ->get();

        $kerusakanAlat = KerusakanAlat::where('nama', 'like', "%$query%")
            ->orWhere('nama_alat', 'like', "%$query%")->get();

        $kerusakanGedung = KerusakanGedung::where('nama', 'like', "%$query%")
            ->orWhere('gedung', 'like', "%$query%")->get();

        $peminjamanKendaraan = PeminjamanKendaraan::where('nama', 'like', "%$query%")
            ->orWhere('jenis_kendaraan', 'like', "%$query%")->get();

        $peminjamanRuangan = PeminjamanRuangan::where('nama', 'like', "%$query%")
            // Jika kolom 'lokasi' tidak ada, hapus atau ganti dengan kolom yang benar (misal: 'nama')
            ->orWhere('nama', 'like', "%$query%")
            ->get();
        $permintaanAtk = Atk::where('nama', 'like', "%$query%")->get();

        $users = User::where('name', 'like', "%$query%")
            ->orWhere('email', 'like', "%$query%")->get();

        return view('admin.pages.search', compact(
            'query',
            'pengajuanBmd',
            'kerusakanAlat',
            'kerusakanGedung',
            'peminjamanKendaraan',
            'peminjamanRuangan',
            'permintaanAtk',
            'users'
        ));
    }

    public function exportBmdExcel()
    {
        return Excel::download(new BmdExport, 'daftar_kebutuhan_bmd.xlsx');
    }
    public function bmd_update_status(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
            'catatan_admin' => 'nullable|string'
        ]);

        $bmd = PengajuanBmd::findOrFail($id);

        // Update data sesuai kolom database
        $bmd->update([
            'status' => $request->status,
            // 'catatan_admin' => $request->catatan_admin,
        ]);

        // Kembali ke mode view setelah simpan
        return redirect()->route('admin.bmd.detail', ['id' => $id, 'mode' => 'view'])
            ->with('success', 'Status pengajuan berhasil diperbarui!');
    }
    public function bmd_detail(Request $request, $id)
    {
        $bmd = PengajuanBmd::findOrFail($id);

        // Menangkap mode dari URL (?mode=edit atau ?mode=view)
        // Default-nya adalah 'view' jika tidak ada parameter mode
        $mode = $request->query('mode', 'view');

        return view('admin.pages.bmd.bmd_detail', compact('bmd', 'mode'));
    }
    public function exportBmdPdfItem($id)
    {
        $bmd = PengajuanBmd::findOrFail($id);

        $pdf = Pdf::loadView('admin.pages.bmd.bmd_pdf_item', compact('bmd'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('Pengajuan_BMD_' . $bmd->id . '.pdf');
    }

    public function peralatan(Request $request)
    {
        // Menggunakan query builder agar bisa difilter
        $query = \App\Models\KerusakanAlat::query();

        // Logika Pencarian (berdasarkan Nama Pelapor atau Nama Alat)
        if ($request->has('q') && $request->q != '') {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->q . '%')
                    ->orWhere('nama_alat', 'like', '%' . $request->q . '%');
            });
        }

        // Logika Filter Status
        if ($request->has('status') && $request->status != '' && $request->status != 'Semua Status') {
            $query->where('status', $request->status);
        }

        // Ambil data berdasarkan filter di atas
        $dataAlat = $query->latest()->get();

        return view('admin.pages.laporan.peralatan.peralatan', compact('dataAlat'));
    }
    public function peralatan_store(Request $request)
    {
        // 1. Tambahkan 'seksi' ke dalam validasi agar tidak error SQL
        $validated = $request->validate([
            'nama' => 'required',
            'bidang' => 'required',
            'nama_alat' => 'required',
            'jenis_alat' => 'required',
            'status' => 'required',
            'prioritas' => 'required',
            'kerusakan' => 'required',
        ]);

        // Berikan nilai default jika seksi kosong (misal dari input hidden atau default 'umpeg')
        $validated['seksi'] = $request->seksi ?? 'umpeg';

        // 2. Simpan ke database
        \App\Models\KerusakanAlat::create($validated);

        return redirect()->route('admin.laporan.peralatan')
            ->with('success', 'Laporan berhasil dibuat!');
    }
    public function exportPeralatanExcel()
    {
        return Excel::download(new PeralatanExport, 'laporan_peralatan.xlsx');
    }
    public function peralatan_detail($id)
    {
        // Mengambil satu data spesifik berdasarkan ID
        $alat = KerusakanAlat::findOrFail($id);

        // Menangkap mode dari URL (view atau edit)
        $mode = request()->query('mode', 'view');

        return view('admin.pages.laporan.peralatan.peralatan_detail', compact('alat', 'mode'));
    }
    public function exportPeralatanPdfItem($id)
    {
        // Ambil data asli dari Database berdasarkan ID
        $laporan = \App\Models\KerusakanAlat::findOrFail($id);

        // Generate PDF menggunakan view template khusus gedung
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.pages.laporan.peralatan.peralatan_pdf_item', compact('laporan'))
            ->setPaper('a4', 'portrait');

        // Download file dengan nama dinamis
        return $pdf->download('Laporan_Kerusakan_Peralatan_' . $id . '.pdf');
    }
    public function peralatan_update(Request $request, $id)
    {
        // Fungsi ini menangani update Prioritas, Setujui (Proses/Selesai), dan Tolak
        $request->validate([
            'status' => 'required',
            'prioritas' => 'required',
            'catatan' => 'nullable|string'
        ]);

        $alat = \App\Models\KerusakanAlat::findOrFail($id);

        // Update data. 'Setujui' atau 'Tolak' ditentukan oleh nilai status yang dikirim form
        $alat->update([
            'status'    => $request->status,
            'prioritas' => $request->prioritas,
            // Jika Anda sudah menambah kolom 'catatan' di DB, aktifkan baris bawah:
            // 'catatan' => $request->catatan, 
        ]);

        return redirect()->route('admin.laporan.peralatan.detail', ['id' => $id, 'mode' => 'view'])
            ->with('success', 'Data laporan berhasil diperbarui!');
    }
    public function gedung()
    {
        // Ambil data untuk tabel
        $dataGedung = \App\Models\KerusakanGedung::latest()->get();

        // Hitung Statistik (Dinamis)
        // Total Laporan Bulan Ini
        $totalBulanIni = \App\Models\KerusakanGedung::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Laporan dengan status 'Menunggu'
        $belumDitangani = \App\Models\KerusakanGedung::where('status', 'Menunggu')->count();

        // Laporan dengan status 'Proses'
        $sedangDikerjakan = \App\Models\KerusakanGedung::where('status', 'Proses')->count();

        // Laporan dengan status 'Selesai'
        $selesai = \App\Models\KerusakanGedung::where('status', 'Selesai')->count();

        return view('admin.pages.laporan.gedung.gedung', compact(
            'dataGedung',
            'totalBulanIni',
            'belumDitangani',
            'sedangDikerjakan',
            'selesai'
        ));
    }
    public function gedung_store(Request $request)
    {
        // 1. Validasi disesuaikan dengan name="" di form Blade Anda
        $validated = $request->validate([
            'nama' => 'required',
            'telepon' => 'required',
            'bidang' => 'required',
            'lokasi' => 'required',
            'gedung' => 'required',
            'prioritas' => 'required',
            'kerusakan' => 'required', // di form namanya 'kerusakan', di DB 'deskripsi'
            'lampiran' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        // 2. Olah data sebelum simpan
        $data = [
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'bidang' => $request->bidang,
            'gedung' => $request->gedung,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->kerusakan, // Map 'kerusakan' dari form ke 'deskripsi' di DB
            'prioritas' => $request->prioritas,
            'status' => 'Menunggu', // Status awal default
        ];

        // 3. Penanganan Upload Foto
        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $path = $file->store('pelaporan/gedung', 'public');
            $data['foto'] = $path; // Gunakan variabel $data, bukan $validatedData
        }
        \App\Models\KerusakanGedung::create($data);

        return redirect()->route('admin.laporan.gedung')
            ->with('success', 'Laporan kerusakan gedung berhasil dibuat!');
    }

    public function gedung_detail($id)
    {
        $gedung = \App\Models\KerusakanGedung::findOrFail($id);
        return view('admin.pages.laporan.gedung.gedung_detail', compact('gedung'));
    }
    public function gedung_update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
            'prioritas' => 'required',
            'catatan' => 'nullable|string'
        ]);

        $laporan = \App\Models\KerusakanGedung::findOrFail($id);
        // 3. Logika Upload Foto Baru (Jika ada)
        if ($request->hasFile('lampiran')) {
            // Hapus foto lama jika ada untuk menghemat storage
            if ($laporan->foto && Storage::disk('public')->exists($laporan->foto)) {
                Storage::disk('public')->delete($laporan->foto);
            }

            $file = $request->file('lampiran');
            $path = $file->store('pelaporan/gedung', 'public');
            $data['foto'] = $path;
        }

        // 4. Eksekusi Update
        $laporan->update([
            'status'    => $request->status,
            'prioritas' => $request->prioritas,
            // Jika Anda sudah menambah kolom 'catatan' di DB, aktifkan baris bawah:
            // 'catatan' => $request->catatan, 
        ]);

        return redirect()->route('admin.laporan.gedung.detail', ['id' => $id, 'mode' => 'view'])
            ->with('success', 'Laporan berhasil diperbarui!');
    }
    public function exportGedungExcel()
    {
        return Excel::download(new GedungExport, 'laporan_gedung.xlsx');
    }
    public function exportGedungPdfItem($id)
    {
        // Ambil data asli dari Database berdasarkan ID
        $laporan = \App\Models\KerusakanGedung::findOrFail($id);

        // Generate PDF menggunakan view template khusus gedung
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.pages.laporan.gedung.gedung_pdf_item', compact('laporan'))
            ->setPaper('a4', 'portrait');

        // Download file dengan nama dinamis
        return $pdf->download('Laporan_Kerusakan_Gedung_' . $id . '.pdf');
    }
    // --- FUNGSI MANAJEMEN MENU LAYANAN BARU ---

    public function layanan_index()
    {
        // Menggunakan Model Menu yang sudah di-import di atas
        $menus = Menu::all();
        return view('admin.pages.layanan_index', compact('menus'));
    }

    public function layanan_add()
    {
        return view('admin.pages.add');
    }
    public function layanan_store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'icon'         => 'nullable|string'
        ]);

        // Simpan data
        Menu::create([
            'nama_layanan' => $request->nama_layanan,
            'slug'         => Str::slug($request->nama_layanan), // Menghasilkan URL-friendly slug
            'icon'         => $request->icon ?? 'description',
            'is_active'    => true
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Layanan baru berhasil ditambahkan!');
    }

    public function layanan_toggle($id)
    {
        $menu = Menu::findOrFail($id);

        // Toggle status boolean
        $menu->is_active = !$menu->is_active;
        $menu->save();

        return redirect()->back()->with('success', 'Status tampilan menu berhasil diubah!');
    }

    //untuk export atk
    public function exportAtkExcel()
    {
        return Excel::download(new AtkExport, 'permintaan_atk_' . date('Y-m-d') . '.xlsx');
    }
    public function stok_index()
    {
        // Menggunakan get() agar semua data tersedia bagi JavaScript Filter di Blade
        $barangs = BarangAtk::latest()->get();

        $totalJenis = BarangAtk::count();
        // Stok Menipis disesuaikan dengan kriteria data-stok-status (<= stok_minimal)
        $stokMenipis = BarangAtk::whereRaw('stok <= stok_minimal')->count();
        $totalUnitSeluruhnya = BarangAtk::sum('stok');

        return view('admin.pages.manajemen.manajemen_stok', compact(
            'barangs',
            'totalJenis',
            'stokMenipis',
            'totalUnitSeluruhnya'
        ));
    }

    public function exportManajemenExcel()
    {
        return Excel::download(new ManajemenExport, 'manajemen_stok.xlsx');
    }
    public function manajemen_add()
    {
        return view('admin.pages.manajemen.add_stok');
    }
    public function manajemen_store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_barang'    => 'required|string|max:255',
            'deskripsi'      => 'nullable|string',
            'stok'           => 'required|integer|min:0',
            'stok_minimal'   => 'required|integer|min:0',
        ]);

        // Simpan data
        \App\Models\BarangAtk::create([
            'nama_barang'   => $request->nama_barang,
            'deskripsi'     => $request->deskripsi,
            'stok'          => $request->stok,
            'stok_minimal'  => $request->stok_minimal,
        ]);

        return redirect()->route('admin.manajemen.stok')->with('success', 'Data barang ATK berhasil ditambahkan!');
    }
    public function manajemen_update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_barang'    => 'required|string|max:255',
            'deskripsi'      => 'nullable|string',
            'stok'           => 'required|integer|min:0',
            'stok_minimal'   => 'required|integer|min:0',
        ]);

        // Cari data berdasarkan ID
        $barang = \App\Models\BarangAtk::findOrFail($id);

        // Update data
        $barang->update([
            'nama_barang'   => $request->nama_barang,
            'deskripsi'     => $request->deskripsi,
            'stok'          => $request->stok,
            'stok_minimal'  => $request->stok_minimal,
        ]);

        return redirect()->route('admin.manajemen.stok')->with('success', 'Data barang ATK berhasil diperbarui!');
    }

    public function stok_add()
    {
        $daftarBarang = BarangAtk::select('nama_barang')->distinct()->get();
        return view('admin.pages.manajemen.add_stok', compact('daftarBarang'));
    }

    public function stok_store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string',
            'kategori'    => 'required|string',
            'satuan'      => 'required|string',
            'stok'        => 'required|integer|min:1',
            'stok_minimal' => 'required|integer|min:0', // Admin nentuin minimal sendiri
        ]);

        $barang = BarangAtk::where('nama_barang', $request->nama_barang)->first();

        if ($barang) {
            $barang->increment('stok', $request->stok);
            $barang->update([
                'kategori' => $request->kategori,
                'satuan'   => $request->satuan,
                'stok_minimal' => $request->stok_minimal // Update minimal stok jika ada perubahan
            ]);
        } else {
            BarangAtk::create([
                'nama_barang' => $request->nama_barang,
                'kategori'    => $request->kategori,
                'satuan'      => $request->satuan,
                'stok'        => $request->stok,
                'stok_minimal' => $request->stok_minimal
            ]);
        }

        return redirect()->route('admin.manajemen.index')->with('success', 'Stok berhasil diperbarui!');
    }
    public function stok_detail($id)
    {
        $barang = BarangAtk::findOrFail($id);
        return view('admin.pages.manajemen.stok_detail', compact('barang'));
    }

    public function stok_update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'kategori'    => 'required|string',
            'satuan'      => 'required|string',
            'stok'        => 'required|integer', // Tambahkan ini
            'stok_minimal' => 'required|integer',
        ]);

        $barang = BarangAtk::findOrFail($id);
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'kategori'    => $request->kategori,
            'satuan'      => $request->satuan,
            'stok'        => $request->stok, // Tambahkan ini
            'stok_minimal' => $request->stok_minimal,
        ]);

        return redirect()->route('admin.manajemen.index')->with('success', 'Barang berhasil diperbarui!');
    }
    public function stok_destroy($id)
    {
        $barang = BarangAtk::findOrFail($id);
        $barang->delete();
        return back()->with('success', 'Barang berhasil dihapus dari gudang.');
    }
}
