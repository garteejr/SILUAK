@extends('admin.layout.master')

@section('navigation')
    @include('admin.layout.navigation')
@endsection

@section('content')
<main class="flex-1 overflow-y-auto bg-background-light dark:bg-background-dark p-4 md:p-2">
    <div class="max-w-9xl mx-auto space-y-6">
        {{-- Breadcrumbs --}}
        <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
            <a class="hover:text-primary transition-colors" href="{{ route('admin.dashboard') }}">Dashboard</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <a class="hover:text-primary transition-colors" href="{{ route('admin.bmd') }}">Kebutuhan BMD</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <span class="font-medium text-slate-900 dark:text-white">Detail Pengajuan BMD</span>
        </div>

        {{-- Header Detail --}}
        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight">Detail Pengajuan BMD</h2>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium 
                        {{ $bmd->status == 'Menunggu' ? 'bg-orange-100 text-orange-600' : 'bg-green-100 text-green-600' }} 
                        border border-orange-200 dark:border-orange-800">
                        {{ $bmd->status }}
                    </span>
                </div>
                <p class="text-slate-500 dark:text-slate-400 mt-1">
                    Nomor Pengajuan: <span class="font-mono text-slate-700 dark:text-slate-300">#BMD-{{ $bmd->id }}</span>
                </p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.bmd.export.item', $bmd->id) }}"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium hover:bg-blue-600 transition-colors shadow-lg shadow-primary/20">
                            <span class="material-symbols-outlined text-[18px]">download</span> Export PDF
                        </a>
                <a href="{{ route('admin.bmd') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span> Kembali
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Sisi Kiri: Informasi Detail --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="rounded-xl bg-surface-light dark:bg-surface-dark border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-200 dark:border-slate-800">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Informasi Kegiatan</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
                            {{-- Tambahan Kolom Kode --}}
                            <div class="sm:col-span-1">
                                <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Kode</p>
                                <p class="text-sm font-mono font-semibold text-primary dark:text-blue-400">{{ $bmd->kode }}</p>
                            </div>
                            <div class="sm:col-span-2">
                                <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Program</p>
                                <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $bmd->program }}</p>
                            </div>
                            <div class="sm:col-span-2">
                                <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Kegiatan</p>
                                <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $bmd->kegiatan }}</p>
                            </div>
                            {{-- Tambahan Kolom Output --}}
                            <div class="sm:col-span-2">
                                <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Output</p>
                                <p class="text-sm font-semibold text-emerald-600 dark:text-emerald-400">{{ $bmd->output }}</p>
                            </div>
                            {{-- Tambahan Kolom Keterangan --}}
                            <div class="sm:col-span-2">
                                <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">Keterangan / Alasan</p>
                                <p class="text-sm text-slate-700 dark:text-slate-300 italic">"{{ $bmd->keterangan }}"</p>
                            </div>
                            
                            {{-- Tabel Barang dari JSON items --}}
                            <div class="sm:col-span-2 mt-4">
                                <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-3">Daftar Barang yang Diajukan</p>
                                <div class="overflow-hidden border border-slate-100 dark:border-slate-800 rounded-lg">
                                    <table class="w-full text-left text-sm">
                                        <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-500">
                                            <tr>
                                                <th class="px-4 py-3 font-semibold">Nama Barang</th>
                                                <th class="px-4 py-3 font-semibold text-center">Jumlah</th>
                                                <th class="px-4 py-3 font-semibold">Satuan</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                            @php 
                                                $dataBarang = is_array($bmd->items) ? $bmd->items : json_decode($bmd->items, true); 
                                            @endphp
                                            @if(is_array($dataBarang))
                                                @foreach($dataBarang as $barang)
                                                <tr class="text-slate-700 dark:text-slate-300">
                                                    <td class="px-4 py-3 font-medium">{{ $barang['nama_barang'] ?? '-' }}</td>
                                                    <td class="px-4 py-3 text-center font-bold">{{ $barang['jumlah'] ?? 0 }}</td>
                                                    <td class="px-4 py-3">{{ $barang['satuan'] ?? 'Unit' }}</td>
                                                </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Profil Pemohon --}}
                <div class="rounded-xl bg-surface-light dark:bg-surface-dark border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="size-12 rounded-full bg-slate-200 dark:bg-slate-700 bg-center bg-cover" 
                                 style='background-image: url("https://ui-avatars.com/api/?name={{ urlencode($bmd->nama) }}&background=random");'>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-900 dark:text-white">{{ $bmd->nama }}</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">{{ $bmd->unitKerja ?? $bmd->bidang }}</p>
                                <div class="flex gap-4 mt-1.5 text-xs text-slate-500">
                                    <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">mail</span> {{ $bmd->email }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sisi Kanan: Tindakan Admin & Riwayat --}}
            <div class="space-y-6">
                <div class="rounded-xl bg-surface-light dark:bg-surface-dark border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
                    <div class="p-4 bg-slate-50 dark:bg-slate-800 border-b border-slate-200 dark:border-slate-800">
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white">Tindakan Admin</h3>
                    </div>
                    <div class="p-5">
                        @if($mode == 'edit')
                        <form action="{{ route('admin.bmd.update', $bmd->id) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1.5">Update Status</label>
                                <select name="status" class="w-full bg-white dark:bg-background-dark border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-sm rounded-lg focus:ring-primary block p-2.5">
                                    <option value="Menunggu" {{ $bmd->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="Selesai" {{ $bmd->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="Disetujui" {{ $bmd->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                    <option value="Ditolak" {{ $bmd->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1.5">Catatan Admin</label>
                                <textarea name="catatan_admin" class="w-full bg-white dark:bg-background-dark border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-sm rounded-lg focus:ring-primary block p-2.5" rows="3">{{ $bmd->catatan_admin }}</textarea>
                            </div>
                            <button type="submit" class="w-full py-2.5 px-4 bg-primary hover:bg-blue-600 text-white font-medium rounded-lg text-sm transition-colors shadow-lg">Simpan Perubahan</button>
                        </form>
                        @else
                        <div class="text-center py-4">
                            <p class="text-sm text-slate-500 mb-4">Mode pratinjau aktif. Klik tombol di bawah untuk memproses pengajuan ini.</p>
                            <a href="{{ route('admin.bmd.detail', ['id' => $bmd->id, 'mode' => 'edit']) }}" class="inline-block w-full py-2 px-4 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 rounded-lg text-sm font-medium hover:bg-slate-200 transition-colors">
                                Aktifkan Mode Edit
                            </a>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Riwayat --}}
                <div class="rounded-xl bg-surface-light dark:bg-surface-dark border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
                    <div class="p-4 bg-slate-50 dark:bg-slate-800 border-b border-slate-200 dark:border-slate-800">
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white">Riwayat Pengajuan</h3>
                    </div>
                    <div class="p-5">
                        <ol class="relative border-l border-slate-200 dark:border-slate-700 ml-1.5">
                            <li class="mb-6 ml-6">
                                <span class="absolute flex items-center justify-center w-4 h-4 bg-blue-100 dark:bg-blue-900 rounded-full -left-2 ring-4 ring-white dark:ring-surface-dark">
                                    <span class="size-2 bg-blue-500 rounded-full"></span>
                                </span>
                                <h3 class="text-sm font-semibold text-slate-900 dark:text-white">{{ $bmd->status }}</h3>
                                <time class="block mb-2 text-xs text-slate-400">Update Terakhir: {{ $bmd->updated_at->format('d M Y, H:i') }}</time>
                            </li>
                            <li class="ml-6">
                                <span class="absolute flex items-center justify-center w-4 h-4 bg-slate-100 dark:bg-slate-800 rounded-full -left-2 ring-4 ring-white dark:ring-surface-dark">
                                    <span class="size-2 bg-slate-300 dark:bg-slate-600 rounded-full"></span>
                                </span>
                                <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Pengajuan Dibuat</h3>
                                <time class="block text-xs text-slate-400">{{ $bmd->created_at->format('d M Y, H:i') }}</time>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection