@extends('admin.layout.master')

@section('navigation')
    @include('admin.layout.navigation')
@endsection

@section('content')
    <main class="flex-1 overflow-y-auto bg-background-light dark:bg-background-dark p-4 md:p-2">
        <div class="max-w-6xl mx-auto space-y-5">
            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                <a class="hover:text-primary transition-colors" href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span class="material-symbols-outlined text-xs">chevron_right</span>
                <a class="hover:text-primary transition-colors" href="{{ route('admin.laporan.peralatan') }}">Laporan</a>
                <span class="material-symbols-outlined text-xs">chevron_right</span>
                <span class="font-medium text-slate-900 dark:text-white">Detail #ALT-{{ $alat->id }}</span>
            </div>

            {{-- Header Detail --}}
            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3">
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight">Laporan Kerusakan
                            Peralatan</h2>
                        <span
                            class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400 border border-orange-200 dark:border-orange-800">
                            {{ $alat->status }}
                        </span>
                    </div>
                    <p class="text-slate-500 dark:text-slate-400 mt-1">ID Laporan: <span
                            class="font-mono text-slate-700 dark:text-slate-300">#ALT-{{ $alat->id }}</span></p>
                </div>
                <div class="flex gap-3">
                    @if (request()->query('mode') == 'edit')
                        {{-- Ganti Simpan Perubahan menjadi Export sesuai perintah --}}
                        <a href="{{ route('admin.laporan.peralatan.export.item', $alat->id) }}"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium hover:bg-blue-600 transition-colors shadow-lg shadow-primary/20">
                            <span class="material-symbols-outlined text-[18px]">download</span> Export PDF
                        </a>
                    @else
                        <a href="{{ route('admin.laporan.peralatan.export.item', $alat->id) }}"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium hover:bg-blue-600 transition-colors shadow-lg shadow-primary/20">
                            <span class="material-symbols-outlined text-[18px]">download</span> Cetak PDF
                        </a>
                        <a href="{{ route('admin.laporan.peralatan') }}"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 transition-colors">
                            <span class="material-symbols-outlined text-[18px]">arrow_back</span> Kembali
                        </a>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    {{-- Detail Permasalahan --}}
                    <div
                        class="rounded-xl bg-surface-light dark:bg-surface-dark border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-slate-200 dark:border-slate-800">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white">Detail Permasalahan</h3>
                        </div>
                        <div class="p-6 space-y-6">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <p
                                        class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">
                                        Nama Barang</p>
                                    <p class="text-sm font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                                        <span class="material-symbols-outlined text-slate-400 text-lg">devices</span>
                                        {{ $alat->nama_alat }}
                                    </p>
                                </div>
                                <div>
                                    <p
                                        class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">
                                        Jenis Alat</p>
                                    <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $alat->jenis_alat }}
                                    </p>
                                </div>
                                <div>
                                    <p
                                        class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">
                                        Bidang / Seksi</p>
                                    <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $alat->bidang }} /
                                        {{ $alat->seksi }}</p>
                                </div>
                                <div>
                                    <p
                                        class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">
                                        Tanggal Dilaporkan</p>
                                    <p class="text-sm font-semibold text-slate-900 dark:text-white italic">
                                        {{ $alat->created_at->format('d M Y, H:i') }} WIB</p>
                                </div>
                            </div>
                            <div>
                                <p
                                    class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">
                                    Deskripsi Kerusakan</p>
                                <div
                                    class="p-4 rounded-lg bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700/50 text-sm text-slate-700 dark:text-slate-300 leading-relaxed italic">
                                    "{{ $alat->kerusakan }}"
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Informasi Pelapor --}}
                    <div
                        class="rounded-xl bg-surface-light dark:bg-surface-dark border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
                        <div class="p-6 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div
                                    class="size-12 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">
                                    {{ strtoupper(substr($alat->nama, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-900 dark:text-white">{{ $alat->nama }}</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">Unit Kerja: {{ $alat->bidang }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    {{-- Form Tindakan Admin --}}
                    {{-- Ganti bagian Tindakan Admin dengan ini --}}
                    <div
                        class="rounded-xl bg-surface-light dark:bg-surface-dark border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
                        <div class="p-4 bg-slate-50 dark:bg-slate-800 border-b border-slate-200 dark:border-slate-800">
                            <h3 class="text-sm font-bold text-slate-900 dark:text-white">Tindakan Admin</h3>
                        </div>
                        <div class="p-5 space-y-4">
                            {{-- BUNGKUS DENGAN FORM --}}
                            <form action="{{ route('admin.laporan.peralatan.update', $alat->id) }}" method="POST">
                                @csrf
                                <div>
                                    <label
                                        class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1.5">Update
                                        Status</label>
                                    <select name="status" {{ request()->query('mode') == 'view' ? 'disabled' : '' }}
                                        class="w-full bg-white dark:bg-background-dark border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-sm rounded-lg focus:ring-primary focus:border-primary block p-2.5">
                                        <option value="Menunggu" {{ $alat->status == 'Menunggu' ? 'selected' : '' }}>
                                            Menunggu</option>
                                        <option value="Disetujui" {{ $alat->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                        <option value="Selesai" {{ $alat->status == 'Selesai' ? 'selected' : '' }}>Selesai
                                        </option>
                                        <option value="Ditolak" {{ $alat->status == 'Ditolak' ? 'selected' : '' }}>Ditolak
                                        </option>
                                    </select>
                                </div>

                                <div class="mt-4">
                                    <label
                                        class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1.5">Update
                                        Prioritas</label>
                                    {{-- Tambahkan name="prioritas" --}}
                                    <select name="prioritas" {{ request()->query('mode') == 'view' ? 'disabled' : '' }}
                                        class="w-full bg-white border border-slate-300 text-slate-900 text-sm rounded-lg p-2.5 focus:ring-primary focus:border-primary">
                                        <option value="" {{ $alat->prioritas == null ? 'selected' : '' }}>-- Pilih
                                            Prioritas --</option>
                                        <option value="Tinggi" {{ $alat->prioritas == 'Tinggi' ? 'selected' : '' }}>Tinggi
                                        </option>
                                        <option value="Sedang" {{ $alat->prioritas == 'Sedang' ? 'selected' : '' }}>Sedang
                                        </option>
                                        <option value="Rendah" {{ $alat->prioritas == 'Rendah' ? 'selected' : '' }}>Rendah
                                        </option>
                                    </select>
                                </div>

                                @if (request()->query('mode') == 'edit')
                                    <div class="mt-4">
                                        <label
                                            class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1.5">Catatan
                                            Internal</label>
                                        <textarea name="catatan"
                                            class="w-full bg-white dark:bg-background-dark border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-sm rounded-lg focus:ring-primary focus:border-primary block p-2.5"
                                            placeholder="Instruksi untuk tim perbaikan..." rows="3"></textarea>
                                    </div>
                                    <button type="submit"
                                        class="w-full mt-4 py-2.5 px-4 bg-primary hover:bg-blue-600 text-white font-medium rounded-lg text-sm transition-colors shadow-lg shadow-primary/20">
                                        Simpan Perubahan
                                    </button>
                                @else
                                    <div
                                        class="mt-4 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg text-xs text-blue-700 dark:text-blue-300 italic border border-blue-100 dark:border-blue-800">
                                        Gunakan mode <strong>Edit</strong> (ikon pensil) untuk memperbarui status atau
                                        menambahkan catatan.
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>

                    {{-- Riwayat Laporan --}}
                    <div
                        class="rounded-xl bg-surface-light dark:bg-surface-dark border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
                        <div class="p-4 bg-slate-50 dark:bg-slate-800 border-b border-slate-200 dark:border-slate-800">
                            <h3 class="text-sm font-bold text-slate-900 dark:text-white">Riwayat Laporan</h3>
                        </div>
                        <div class="p-5">
                            <ol class="relative border-l border-slate-200 dark:border-slate-700 ml-1.5">
                                <li class="mb-6 ml-6">
                                    <span
                                        class="absolute flex items-center justify-center w-4 h-4 bg-orange-100 dark:bg-orange-900 rounded-full -left-2 ring-4 ring-white dark:ring-surface-dark">
                                        <span class="size-2 bg-orange-500 rounded-full"></span>
                                    </span>
                                    <h3 class="flex items-center mb-1 text-sm font-semibold text-slate-900 dark:text-white">
                                        Status Saat Ini: {{ $alat->status }}</h3>
                                    <time class="block mb-2 text-xs font-normal leading-none text-slate-400">Terakhir
                                        diperbarui: {{ $alat->updated_at->diffForHumans() }}</time>
                                </li>
                                <li class="ml-6">
                                    <span
                                        class="absolute flex items-center justify-center w-4 h-4 bg-slate-100 dark:bg-slate-800 rounded-full -left-2 ring-4 ring-white dark:ring-surface-dark">
                                        <span class="size-2 bg-slate-300 dark:bg-slate-600 rounded-full"></span>
                                    </span>
                                    <h3 class="flex items-center mb-1 text-sm font-semibold text-slate-900 dark:text-white">
                                        Laporan Diterima</h3>
                                    <time
                                        class="block mb-2 text-xs font-normal leading-none text-slate-400">{{ $alat->created_at->format('d M Y, H:i') }}
                                        WIB</time>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ $alat->nama }} membuat
                                        laporan baru.</p>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
