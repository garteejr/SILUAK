@extends('umpeg.layout.umpeg_portal')

@section('content')
<html lang="id" class="scroll-smooth"> <head>
<section class="bg-dinas-blue text-white py-10 px-6 text-center relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>

    <div class="relative z-10 max-w-4xl mx-auto mt-10">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4 tracking-tight leading-tight">
            SILUAK
        </h1>
        <p class="text-lg md:text-xl text-blue-100 mb-10 font-light">
            Sistem Layanan Umum dan Kepegawaian
        </p>
        
        <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-md px-6 py-3 rounded-full border border-white/30 shadow-lg mb-12">
            <span class="font-medium tracking-wide">Bekerja dengan Cinta, Melayani dengan Integritas</span>
        </div>
    </div>
</section>

<!-- tugas dan fungsi -->
<section id="tugas" class="py-16 px-4 max-w-6xl mx-auto scroll-mt-28">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-center">
        
        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm transition-all duration-300 hover:shadow-lg hover:-translate-y-1 cursor-default">
            <div class="w-14 h-14 mx-auto bg-dinas-blue rounded-full flex items-center justify-center text-white mb-4 shadow-sm">
                <i class="fas fa-file-alt text-xl"></i>
            </div>
            <h3 class="font-bold text-gray-900 text-lg mb-2">Administrasi Umum</h3>
            <p class="text-sm text-gray-600 leading-relaxed">
                Mengelola administrasi surat menyurat, kearsipan, dan dokumentasi kegiatan dinas.
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm transition-all duration-300 hover:shadow-lg hover:-translate-y-1 cursor-default">
            <div class="w-14 h-14 mx-auto bg-dinas-blue rounded-full flex items-center justify-center text-white mb-4 shadow-sm">
                <i class="fas fa-users text-xl"></i>
            </div>
            <h3 class="font-bold text-gray-900 text-lg mb-2">Kepegawaian</h3>
            <p class="text-sm text-gray-600 leading-relaxed">
                Mengelola data kepegawaian, absensi, cuti, dan pengembangan SDM aparatur.
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm transition-all duration-300 hover:shadow-lg hover:-translate-y-1 cursor-default">
            <div class="w-14 h-14 mx-auto bg-dinas-blue rounded-full flex items-center justify-center text-white mb-4 shadow-sm">
                <i class="fas fa-building text-xl"></i>
            </div>
            <h3 class="font-bold text-gray-900 text-lg mb-2">Pengelolaan Aset</h3>
            <p class="text-sm text-gray-600 leading-relaxed">
                Mengelola inventaris barang milik daerah (BMD), pemeliharaan gedung dan peralatan kantor.
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm transition-all duration-300 hover:shadow-lg hover:-translate-y-1 cursor-default">
            <div class="w-14 h-14 mx-auto bg-dinas-blue rounded-full flex items-center justify-center text-white mb-4 shadow-sm">
                <i class="fas fa-briefcase text-xl"></i>
            </div>
            <h3 class="font-bold text-gray-900 text-lg mb-2">Layanan Publik</h3>
            <p class="text-sm text-gray-600 leading-relaxed">
                Menyediakan layanan pinjam kendaraan, ruang rapat, ATK, dan layanan umum lainnya.
            </p>
        </div>

    </div>
</section>

<!-- layanan -->
<section id="layanan" class="py-6 px-4 max-w-6xl mx-auto scroll-mt-28">
    <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-dinas-blue">Informasi Layanan</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <div class="bg-blue-50 rounded-xl p-6 border border-blue-100 shadow-sm hover:shadow-md transition-shadow flex flex-col h-full">
            <div class="flex items-start gap-4 mb-6">
                <div class="w-12 h-12 bg-dinas-blue rounded-lg flex items-center justify-center shrink-0 text-white">
                    <i class="fas fa-clipboard-list text-xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 text-lg mb-1">Usulan Rencana Kebutuhan BMD</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Pengajuan rencana kebutuhan barang milik daerah untuk mendukung operasional dinas.
                    </p>
                </div>
            </div>
            <div class="mt-auto">
                <button id="btnAjukanPermohonan" class="w-full bg-dinas-blue hover:bg-blue-700 text-white font-semibold py-2.5 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                    <i class="fas fa-plus text-sm"></i> Ajukan Permohonan
                </button>
            </div>
        </div>

        <div class="bg-blue-50 rounded-xl p-6 border border-blue-100 shadow-sm hover:shadow-md transition-shadow flex flex-col h-full">
            <div class="flex items-start gap-4 mb-6">
                <div class="w-12 h-12 bg-dinas-blue rounded-lg flex items-center justify-center shrink-0 text-white">
                    <i class="fas fa-exclamation-triangle text-xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 text-lg mb-1">Pelaporan Kerusakan Peralatan Kantor</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Melaporkan kerusakan peralatan kantor untuk segera ditindaklanjuti perbaikan.
                    </p>
                </div>
            </div>
            <div class="mt-auto">
                <button id="btnLaporAlat" class="w-full bg-dinas-blue hover:bg-blue-700 text-white font-semibold py-2.5 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                    <i class="fas fa-plus text-sm"></i> Laporkan Kerusakan Alat
                </button>
            </div>
        </div>

        <div class="bg-blue-50 rounded-xl p-6 border border-blue-100 shadow-sm hover:shadow-md transition-shadow flex flex-col h-full">
            <div class="flex items-start gap-4 mb-6">
                <div class="w-12 h-12 bg-dinas-blue rounded-lg flex items-center justify-center shrink-0 text-white">
                    <i class="fas fa-building text-xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 text-lg mb-1">Pelaporan Kerusakan Gedung & Bangunan</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Melaporkan kerusakan infrastruktur gedung dan bangunan kantor.
                    </p>
                </div>
            </div>
            <div class="mt-auto">
                <button id="btnLaporGedung" class="w-full bg-dinas-blue hover:bg-blue-700 text-white font-semibold py-2.5 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                    <i class="fas fa-plus text-sm"></i> Laporkan Kerusakan Gedung
                </button>
            </div>
        </div>

        <div class="bg-blue-50 rounded-xl p-6 border border-blue-100 shadow-sm hover:shadow-md transition-shadow flex flex-col h-full">
            <div class="flex items-start gap-4 mb-6">
                <div class="w-12 h-12 bg-dinas-blue rounded-lg flex items-center justify-center shrink-0 text-white">
                    <i class="fas fa-car text-xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 text-lg mb-1">Peminjaman Kendaraan Dinas</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Peminjaman kendaraan dinas untuk keperluan kegiatan resmi.
                    </p>
                </div>
            </div>
            <div class="mt-auto">
                <button id="btnPinjamKendaraan" class="w-full bg-dinas-blue hover:bg-blue-700 text-white font-semibold py-2.5 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                    <i class="fas fa-plus text-sm"></i> Ajukan Peminjaman Kendaraan
                </button>
            </div>
        </div>

        <div class="bg-blue-50 rounded-xl p-6 border border-blue-100 shadow-sm hover:shadow-md transition-shadow flex flex-col h-full">
            <div class="flex items-start gap-4 mb-6">
                <div class="w-12 h-12 bg-dinas-blue rounded-lg flex items-center justify-center shrink-0 text-white">
                    <i class="fas fa-door-open text-xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 text-lg mb-1">Peminjaman Ruangan Rapat</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Peminjaman ruang rapat untuk kegiatan pertemuan dan koordinasi.
                    </p>
                </div>
            </div>
            <div class="mt-auto">
                <button id="btnPinjamRuangan" class="w-full bg-dinas-blue hover:bg-blue-700 text-white font-semibold py-2.5 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                    <i class="fas fa-plus text-sm"></i> Ajukan Peminjaman Ruang
                </button>
            </div>
        </div>

        <div class="bg-blue-50 rounded-xl p-6 border border-blue-100 shadow-sm hover:shadow-md transition-shadow flex flex-col h-full">
            <div class="flex items-start gap-4 mb-6">
                <div class="w-12 h-12 bg-dinas-blue rounded-lg flex items-center justify-center shrink-0 text-white">
                    <i class="fas fa-book-reader text-xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 text-lg mb-1">Permohonan ATK</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Layanan pengajuan kebutuhan alat tulis kantor (ATK) untuk mendukung kegiatan operasional dinas.
                    </p>
                </div>
            </div>
            <div class="mt-auto">
                <button id="btnDaftarATK" class="w-full bg-dinas-blue hover:bg-blue-700 text-white font-semibold py-2.5 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                    <i class="fas fa-plus text-sm"></i> Ajukan Permohonan
                </button>
            </div>
        </div>

    </div>
</section>

<!-- jadwal pemakaian ruang rapat -->
<section id="jadwal" class="py-16 px-4 max-w-6xl mx-auto scroll-mt-28">
    <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-dinas-blue mb-4">Jadwal Pemakaian Ruang Rapat</h2>
        <p class="text-gray-600 max-w-3xl mx-auto mb-6">
            Daftar reservasi ruangan yang telah diajukan. Pastikan untuk mengecek ketersediaan sebelum melakukan peminjaman.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($items as $item)
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col h-full">
                <div class="bg-dinas-blue h-32 flex flex-col items-center justify-center text-white p-4 text-center">
                    <span class="text-sm font-medium opacity-80 uppercase tracking-wider">Ruangan</span>
                    <h4 class="font-bold leading-tight">{{ $item->ruangan }}</h4>
                </div>
                
                <div class="p-6 flex-1">
                    <div class="flex items-center gap-2 text-dinas-blue text-sm font-bold mb-3">
                        <i class="far fa-clock"></i>
                        <span>
                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}
                        </span>
                    </div>
                    <div class="text-xs text-gray-500 mb-3 bg-gray-100 inline-block px-2 py-1 rounded">
                        Pukul: {{ $item->waktu_mulai }} - {{ $item->waktu_selesai }} WIB
                    </div>

                    <h3 class="text-lg font-bold text-gray-900 mb-2 leading-tight">
                        {{ $item->acara }}
                    </h3>

                    <div class="space-y-2 mt-4 pt-4 border-t border-gray-100">
                        <div class="flex items-center gap-2 text-gray-600 text-xs">
                            <i class="fas fa-user text-blue-500"></i>
                            <span class="font-medium">{{ $item->nama }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-gray-600 text-[11px]">
                            <i class="fas fa-building text-gray-400"></i>
                            <span>{{ $item->bidang }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-20 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                <i class="far fa-calendar-times text-5xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 font-medium">Belum ada jadwal peminjaman ruangan saat ini.</p>
            </div>
        @endforelse
    </div>
</section>

<!-- form layanan -->
@include('umpeg.layanan.bmd')
@include('umpeg.layanan.kerusakan_alat')
@include('umpeg.layanan.kerusakan_gedung')
@include('umpeg.layanan.pinjam_kendaraan')
@include('umpeg.layanan.pinjam_ruangan')
@include('umpeg.layanan.ATK')

@endsection