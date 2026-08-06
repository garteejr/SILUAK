@extends('admin.layout.master')

@section('navigation')
    @include('admin.layout.navigation')
@endsection

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight">Laporan Kerusakan Peralatan</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Kelola dan pantau perbaikan aset kantor.</p>
        </div>
        <div class="flex gap-3">
            {{-- Form Export disesuaikan dengan konsep BMD (POST) --}}
            <form action="{{ route('admin.laporan.peralatan.export.excel') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">download</span> Export Excel
                </button>
            </form>
        </div>
    </div>

    {{-- Ganti Filter Section dengan kode ini --}}
    <div
        class="p-4 mt-6 bg-surface-light dark:bg-surface-dark border border-slate-200 dark:border-slate-800 rounded-xl shadow-sm">
        <form action="{{ route('admin.laporan.peralatan') }}" method="GET"
            class="flex flex-col lg:flex-row gap-4 justify-between lg:items-center">

            {{-- Input Pencarian --}}
            <div class="relative w-full lg:w-96">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                    <span class="material-symbols-outlined text-[20px]">search</span>
                </div>
                <input name="q" value="{{ request('q') }}"
                    class="block w-full pl-10 pr-3 py-2 border border-slate-200 dark:border-slate-700 rounded-lg leading-5 bg-white dark:bg-slate-900 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/50 sm:text-sm transition-all"
                    placeholder="Cari pelapor atau nama alat..." type="text" />
            </div>

            <div class="flex flex-wrap gap-3 w-full lg:w-auto">
                {{-- Dropdown Status --}}
                <select name="status" onchange="this.form.submit()"
                    class="appearance-none pl-3 pr-10 py-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg text-sm text-slate-700 dark:text-slate-300 focus:ring-2 focus:ring-primary/50 outline-none cursor-pointer">
                    <option value="">Semua Status</option>
                    <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>

                {{-- Tombol Cari (Opsional jika ingin manual klik) --}}
                <button type="submit"
                    class="px-4 py-2 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 rounded-lg text-sm font-semibold hover:bg-slate-200 transition-colors">
                    Terapkan
                </button>

                {{-- Tombol Reset --}}
                @if (request('q') || request('status'))
                    <a href="{{ route('admin.laporan.peralatan') }}"
                        class="px-4 py-2 text-red-600 text-sm font-medium hover:underline flex items-center">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div
        class="mt-6 bg-surface-light dark:bg-surface-dark rounded-xl border border-slate-200 shadow-sm flex flex-col overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200 text-xs uppercase tracking-wide text-slate-500">
                        <th class="px-6 py-4 font-semibold">Nama Pelapor</th>
                        <th class="px-6 py-4 font-semibold">Bidang/Seksi</th>
                        <th class="px-6 py-4 font-semibold">Nama Barang</th>
                        <th class="px-6 py-4 font-semibold text-center">Jenis Alat</th>
                        <th class="px-6 py-4 font-semibold text-center">Kerusakan</th>
                        <th class="px-6 py-4 font-semibold text-center">Status</th>
                        <th class="px-6 py-4 font-semibold text-center">Prioritas</th>
                        <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse ($dataAlat as $item)
                        <tr class="group hover:bg-slate-50 transition-colors text-slate-700">
                            <td class="px-6 py-4 font-medium">{{ $item->nama }}</td>
                            <td class="px-6 py-4">
                                <span class="block font-bold">{{ $item->bidang }}</span>
                                <span class="text-xs text-slate-400">{{ $item->seksi }}</span>
                            </td>
                            <td class="px-6 py-4 font-bold text-primary">{{ $item->nama_alat }}</td>
                            <td class="px-6 py-4 text-center">{{ $item->jenis_alat }}</td>
                            <td class="px-6 py-4 text-center italic">"{{ $item->kerusakan }}"</td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="px-2.5 py-1 rounded-full text-xs font-bold {{ $item->status == 'Selesai' ? 'bg-emerald-100 text-emerald-700' : 'bg-orange-100 text-orange-700' }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($item->prioritas == 'Tinggi')
                                    <span
                                        class="px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 uppercase">Tinggi</span>
                                @elseif($item->prioritas == 'Sedang')
                                    <span
                                        class="px-2.5 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 uppercase">Sedang</span>
                                @elseif($item->prioritas == 'Rendah')
                                    <span
                                        class="px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 uppercase">Rendah</span>
                                @else
                                    <span class="text-slate-400 italic text-xs">Belum Diatur</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    {{-- Tombol aksi tetap sama --}}
                                    @if ($item->status == 'Menunggu')
                                        <a href="{{ route('admin.laporan.peralatan.detail', ['id' => $item->id, 'mode' => 'edit']) }}"
                                            class="p-1.5 text-slate-400 hover:text-emerald-500 rounded-lg transition-colors"
                                            title="Setujui">
                                            <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                        </a>
                                        <form action="{{ route('admin.laporan.peralatan.update', $item->id) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="status" value="Ditolak">
                                            <input type="hidden" name="prioritas" value="">
                                            <button type="submit"
                                                class="p-1.5 text-slate-400 hover:text-red-500 rounded-lg transition-colors"
                                                title="Tolak">
                                                <span class="material-symbols-outlined text-[20px]">cancel</span>
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('admin.laporan.peralatan.detail', ['id' => $item->id, 'mode' => 'view']) }}"
                                            class="p-1.5 text-slate-400 hover:text-emerald-500 rounded-lg transition-colors"
                                            title="Lihat Detail">
                                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                                        </a>
                                        <a href="{{ route('admin.laporan.peralatan.detail', ['id' => $item->id, 'mode' => 'edit']) }}"
                                            class="p-1.5 text-slate-400 hover:text-primary rounded-lg transition-colors"
                                            title="Edit Laporan">
                                            <span class="material-symbols-outlined text-[20px]">edit</span>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        {{-- Ini akan muncul di tengah tabel jika $dataAlat kosong --}}
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-slate-400 italic text-sm">
                                Belum ada data laporan kerusakan peralatan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
