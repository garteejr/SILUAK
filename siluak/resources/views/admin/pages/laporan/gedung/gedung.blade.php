@extends('admin.layout.master')
@section('navigation')
    @include('admin.layout.navigation')
@endsection
@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight">Laporan Kerusakan Gedung</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Daftar laporan masuk terkait pemeliharaan fasilitas gedung.
            </p>
        </div>
        <div class="flex gap-3">
            <form action="{{ route('admin.laporan.gedung.export.excel') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">download</span> Export Excel
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-6">
        <div
            class="p-5 rounded-xl bg-surface-light dark:bg-surface-dark border border-slate-200 dark:border-slate-800 shadow-sm flex flex-col gap-3 group">
            <div class="flex items-center justify-between">
                <div class="p-2 rounded-lg bg-blue-50 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                    <span class="material-symbols-outlined">folder_open</span>
                </div>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Laporan Bulan Ini</p>
                <p class="text-3xl font-bold text-slate-900 dark:text-white mt-1">{{ $totalBulanIni }}</p>
            </div>
        </div>

        <div
            class="p-5 rounded-xl bg-surface-light dark:bg-surface-dark border border-slate-200 dark:border-slate-800 shadow-sm flex flex-col gap-3 group">
            <div class="flex items-center justify-between">
                <div class="p-2 rounded-lg bg-red-50 text-red-600 dark:bg-red-900/30 dark:text-red-400">
                    <span class="material-symbols-outlined">pending_actions</span>
                </div>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Belum Ditangani</p>
                <p class="text-3xl font-bold text-slate-900 dark:text-white mt-1">{{ $belumDitangani }}</p>
            </div>
        </div>

        <div
            class="p-5 rounded-xl bg-surface-light dark:bg-surface-dark border border-slate-200 dark:border-slate-800 shadow-sm flex flex-col gap-3 group">
            <div class="flex items-center justify-between">
                <div class="p-2 rounded-lg bg-yellow-50 text-yellow-600 dark:bg-yellow-900/30 dark:text-yellow-400">
                    <span class="material-symbols-outlined">build</span>
                </div>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Sedang Dikerjakan</p>
                <p class="text-3xl font-bold text-slate-900 dark:text-white mt-1">{{ $sedangDikerjakan }}</p>
            </div>
        </div>

        <div
            class="p-5 rounded-xl bg-surface-light dark:bg-surface-dark border border-slate-200 dark:border-slate-800 shadow-sm flex flex-col gap-3 group">
            <div class="flex items-center justify-between">
                <div class="p-2 rounded-lg bg-green-50 text-green-600 dark:bg-green-900/30 dark:text-green-400">
                    <span class="material-symbols-outlined">check_circle</span>
                </div>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Selesai</p>
                <p class="text-3xl font-bold text-slate-900 dark:text-white mt-1">{{ $selesai }}</p>
            </div>
        </div>
    </div>

    <div
        class="bg-surface-light dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm flex flex-col mt-6">
        <div class="overflow-x-auto rounded-t-xl">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr
                        class="bg-slate-50/80 dark:bg-slate-800/80 border-b border-slate-200 dark:border-slate-700 text-xs uppercase tracking-wide text-slate-500 dark:text-slate-400">
                        {{-- <th class="px-6 py-4 font-semibold w-16 text-center">
                            <input class="rounded border-slate-300 text-primary focus:ring-primary/50 cursor-pointer"
                                type="checkbox" />
                        </th> --}}
                        <th class="px-6 py-4 font-semibold">Nama Pelapor</th>
                        <th class="px-6 py-4 font-semibold">No. Telepon</th>
                        <th class="px-6 py-4 font-semibold">Bidang</th>
                        <th class="px-6 py-4 font-semibold">Gedung & Lokasi</th>
                        <th class="px-6 py-4 font-semibold text-center">Status</th>
                        <th class="px-6 py-4 font-semibold text-center">Prioritas</th>
                        <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
                    @foreach ($dataGedung as $item)
                        <tr class="group hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                            {{-- <td class="px-6 py-4 text-center">
                                <input class="rounded border-slate-300 text-primary cursor-pointer" type="checkbox" />
                            </td> --}}

                            {{-- Nama Pelapor --}}
                            <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">
                                {{ $item->nama }}
                            </td>

                            {{-- No Telepon --}}
                            <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">
                                {{ $item->telepon }}
                            </td>

                            {{-- Bidang --}}
                            <td class="px-6 py-4 text-slate-700 dark:text-slate-300">
                                {{ $item->bidang }}
                            </td>

                            {{-- Gedung & Lokasi --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div>
                                        <p class="font-bold text-slate-900 dark:text-white">Gedung {{ $item->gedung }}</p>
                                        <p class="text-xs text-slate-500 italic">{{ $item->lokasi }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- Status --}}
                            {{-- Status --}}
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="px-2.5 py-1 rounded-full text-xs font-bold 
        {{ $item->status == 'Selesai' ? 'bg-green-100 text-green-700' : '' }}
        {{ $item->status == 'Disetujui' || $item->status == 'Proses' ? 'bg-blue-100 text-blue-600' : '' }}
        {{ $item->status == 'Ditolak' ? 'bg-red-100 text-red-700' : '' }}
        {{ $item->status == 'Menunggu' ? 'bg-orange-100 text-orange-600' : '' }}">
                                    {{ $item->status }}
                                </span>
                            </td>

                            {{-- Prioritas --}}
                            <td class="px-6 py-4">
                                @if ($item->prioritas == 'Tinggi')
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-bold bg-red-50 text-red-700">
                                        <span class="size-1.5 rounded-full bg-red-500"></span> Tinggi
                                    </span>
                                @elseif($item->prioritas == 'Sedang')
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-bold bg-yellow-50 text-yellow-700">
                                        <span class="size-1.5 rounded-full bg-yellow-500"></span> Sedang
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-bold bg-green-50 text-green-700">
                                        <span class="size-1.5 rounded-full bg-green-500"></span> Rendah
                                    </span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @if ($item->status == 'Menunggu')
                                        {{-- Tombol Setujui (Approve) --}}
                                        <a href="{{ route('admin.laporan.gedung.detail', ['id' => $item->id, 'mode' => 'edit']) }}"
                                            class="p-1.5 text-slate-400 hover:text-emerald-500 rounded-lg transition-colors"
                                            title="Setujui">
                                            <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                        </a>


                                        {{-- Tombol Tolak (Reject) --}}
                                        <form action="{{ route('admin.laporan.gedung.update', $item->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            <input type="hidden" name="status" value="Ditolak">
                                            <input type="hidden" name="prioritas" value=""> {{-- Kosongkan prioritas --}}
                                            <button type="submit"
                                                class="p-1.5 text-slate-400 hover:text-red-500 rounded-lg transition-colors"
                                                title="Tolak">
                                                <span class="material-symbols-outlined text-[20px]">cancel</span>
                                            </button>
                                        </form>
                                    @else
                                        {{-- Link Lihat Detail (Mata) - Mode View --}}
                                        <a href="{{ route('admin.laporan.gedung.detail', ['id' => $item->id, 'mode' => 'view']) }}"
                                            class="p-1.5 text-slate-400 hover:text-emerald-500 rounded-lg transition-colors"
                                            title="Lihat Detail">
                                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                                        </a>

                                        {{-- Link Edit (Pensil) - Mode Edit --}}
                                        <a href="{{ route('admin.laporan.gedung.detail', ['id' => $item->id, 'mode' => 'edit']) }}"
                                            class="p-1.5 text-slate-400 hover:text-primary rounded-lg transition-colors"
                                            title="Edit Laporan">
                                            <span class="material-symbols-outlined text-[20px]">edit</span>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
