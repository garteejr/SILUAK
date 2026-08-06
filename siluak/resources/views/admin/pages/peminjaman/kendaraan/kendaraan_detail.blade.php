@extends('admin.layout.master')

@section('navigation')
    @include('admin.layout.navigation')
@endsection

@section('content')
    <main class="flex-1 overflow-y-auto bg-background-light p-4 md:p-8">
        <div class="max-w-6xl mx-auto space-y-6">
            {{-- Breadcrumb & Header --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <nav class="flex text-sm text-slate-500 mb-2">
                        <a class="hover:text-primary transition-colors" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span class="mx-2">/</span>
                        <a class="hover:text-primary transition-colors" href="{{ route('admin.peminjaman.kendaraan') }}">Peminjaman Kendaraan</a>
                        <span class="mx-2">/</span>
                        <span class="text-slate-900 font-medium">Detail Peminjaman</span>
                    </nav>
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Detail Peminjaman Kendaraan</h2>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-slate-500 text-sm">ID Request:</span>
                        <span class="font-mono font-medium text-slate-900 bg-slate-100 px-2 py-0.5 rounded text-sm">#KND-{{ $item->id }}</span>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex gap-3 flex-wrap">
                    <button onclick="window.print()" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">print</span> Cetak
                    </button>
                    
                    @if($item->status == 'Menunggu')
                    <form action="{{ route('admin.update_status', ['type' => 'kendaraan', 'id' => $item->id]) }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="status" value="Ditolak">
                        <button class="px-4 py-2 bg-red-50 text-red-600 border border-red-100 rounded-lg hover:bg-red-100 font-medium text-sm flex items-center gap-2 transition-colors">
                            <span class="material-symbols-outlined text-[18px]">close</span> Tolak
                        </button>
                    </form>

                    <form action="{{ route('admin.update_status', ['type' => 'kendaraan', 'id' => $item->id]) }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="status" value="Disetujui">
                        <button class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-600 font-medium text-sm flex items-center gap-2 shadow-lg shadow-primary/20 transition-colors">
                            <span class="material-symbols-outlined text-[18px]">check</span> Setujui
                        </button>
                    </form>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    {{-- Informasi Pemohon --}}
                    <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-900 mb-4 border-b border-slate-100 pb-3">Informasi Pemohon</h3>
                        <div class="flex flex-col sm:flex-row items-start gap-6">
                            <div class="size-20 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center flex-shrink-0 shadow-inner">
                                <span class="text-2xl font-bold">{{ strtoupper(substr($item->nama, 0, 2)) }}</span>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4 w-full">
                                <div>
                                    <p class="text-xs text-slate-500 uppercase font-bold tracking-wider">Nama Lengkap</p>
                                    <p class="text-sm font-semibold text-slate-900 mt-1">{{ $item->nama }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500 uppercase font-bold tracking-wider">NIP</p>
                                    <p class="text-sm font-semibold text-slate-900 mt-1">{{ $item->nip }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500 uppercase font-bold tracking-wider">Bidang</p>
                                    <p class="text-sm font-semibold text-slate-900 mt-1">{{ $item->bidang }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500 uppercase font-bold tracking-wider">Seksi / Subbag</p>
                                    <p class="text-sm font-semibold text-slate-900 mt-1">{{ $item->seksi }}</p>
                                </div>
                                <div class="sm:col-span-2 pt-2 border-t border-slate-100 mt-1">
                                    <p class="text-xs text-slate-500 uppercase font-bold tracking-wider">No. Telepon / WA</p>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="material-symbols-outlined text-[16px] text-slate-400">call</span>
                                        <p class="text-sm text-slate-700">{{ $item->telepon ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Detail Perjalanan --}}
                    <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-900 mb-4 border-b border-slate-100 pb-3">Detail Perjalanan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                            <div class="md:col-span-2 bg-slate-50 p-4 rounded-lg border border-slate-100">
                                <p class="text-xs text-slate-500 uppercase font-bold tracking-wider">Keperluan / Kegiatan</p>
                                <p class="text-base font-medium text-slate-900 mt-1 leading-relaxed">{{ $item->kegiatan }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 uppercase font-bold tracking-wider">Tanggal Mulai</p>
                                <div class="flex items-center gap-3 mt-1.5">
                                    <div class="bg-primary/10 text-primary p-2 rounded-md">
                                        <span class="material-symbols-outlined text-[20px]">calendar_today</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-900">{{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d F Y') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 uppercase font-bold tracking-wider">Tanggal Selesai</p>
                                <div class="flex items-center gap-3 mt-1.5">
                                    <div class="bg-primary/10 text-primary p-2 rounded-md">
                                        <span class="material-symbols-outlined text-[20px]">event_available</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-900">{{ \Carbon\Carbon::parse($item->tgl_kembali)->format('d F Y') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-xs text-slate-500 uppercase font-bold tracking-wider">Lokasi Tujuan</p>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="material-symbols-outlined text-slate-400 text-sm">location_on</span>
                                    <p class="text-sm font-medium text-slate-900">{{ $item->tujuan }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar Status --}}
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
                        <h3 class="text-sm font-bold text-slate-900 mb-4 uppercase tracking-wider">Status Permohonan</h3>
                        
                        <div class="flex justify-center mb-6">
                            @php
                                $statusClasses = [
                                    'Menunggu' => 'bg-orange-100 text-orange-600 border-orange-200',
                                    'Disetujui' => 'bg-emerald-100 text-emerald-600 border-emerald-200',
                                    'Ditolak' => 'bg-red-100 text-red-600 border-red-200',
                                    'Selesai' => 'bg-blue-100 text-blue-600 border-blue-200',
                                ];
                                $currentClass = $statusClasses[$item->status] ?? 'bg-slate-100 text-slate-600 border-slate-200';
                            @endphp
                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold {{ $currentClass }} shadow-sm">
                                @if($item->status == 'Menunggu')
                                    <span class="relative flex h-3 w-3">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-3 w-3 bg-orange-500"></span>
                                    </span>
                                @endif
                                {{ $item->status }}
                            </span>
                        </div>

                        <div class="space-y-3 pt-4 border-t border-slate-100 text-sm">
                            <div class="flex justify-between">
                                <span class="text-slate-500">Kendaraan:</span>
                                <span class="font-bold text-slate-900">{{ $item->jenis_kendaraan }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Diajukan Pada:</span>
                                <span class="font-medium text-slate-900">{{ $item->created_at->format('d M Y, H:i') }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Catatan Penting --}}
                    <div class="bg-blue-50 rounded-xl border border-blue-100 p-4">
                        <div class="flex gap-3">
                            <span class="material-symbols-outlined text-primary shrink-0">info</span>
                            <div>
                                <p class="text-sm font-bold text-blue-900">Instruksi Admin</p>
                                <p class="text-xs text-blue-700 mt-1 leading-relaxed">
                                    Lakukan verifikasi ketersediaan unit <strong>{{ $item->jenis_kendaraan }}</strong> sebelum menyetujui. 
                                    Pastikan pemohon membawa Surat Tugas saat pengambilan kunci.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection