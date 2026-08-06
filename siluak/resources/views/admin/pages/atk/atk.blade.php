@extends('admin.layout.master')

@section('navigation')
    @include('admin.layout.navigation')
@endsection

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight">
                Permohonan Alat Tulis Kantor (ATK)
            </h2>
            <p class="text-slate-500 dark:text-slate-400 mt-1">
                Kelola dan pantau pengajuan kebutuhan ATK setiap bidang.
            </p>
        </div>
        <div class="flex gap-3">
            <form action="{{ route('admin.atk.export.excel') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">download</span> Export Excel
                </button>
            </form>
        </div>
    </div>
    {{-- Alert Error (Stok Tidak Cukup) --}}
    @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 flex items-center gap-3 rounded shadow-sm">
            <span class="material-symbols-outlined">report</span>
            <p class="font-medium">{{ session('error') }}</p>
        </div>
    @endif

    @if (session('success'))
        <div
            class="mb-4 p-4 bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 flex items-center gap-3 rounded shadow-sm">
            <span class="material-symbols-outlined">check_circle</span>
            <p class="font-medium">{{ session('success') }}</p>
        </div>
    @endif

    {{-- Kartu Statistik Dinamis --}}
    <div
        class="bg-white dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden flex flex-col min-h-[500px] mt-6">
        <div class="flex-1 overflow-auto">
            <table class="w-full text-left border-collapse">
                <thead
                    class="bg-slate-50 dark:bg-slate-800/50 sticky top-0 z-10 border-b border-slate-200 dark:border-slate-800">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Pemohon</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Bidang</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase">Barang</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase text-center">Jumlah</th>
                        {{-- Permintaan --}}
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase text-center">Diberikan</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase text-center">Foto</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase text-center">Status</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
                    @forelse($items as $item)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="font-medium text-sm text-slate-700 dark:text-slate-200">{{ $item->nama }}
                                </div>
                                <div class="text-xs text-slate-500 dark:text-slate-400">{{ $item->nip }}
                                    <span class="text-[10px] text-slate-400 mt-1 font-normal flex gap-1">
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i') }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-medium text-sm text-slate-700 dark:text-slate-200">
                                {{ $item->bidang }}</td>
                            {{-- KOLOM BARANG --}}
                            <td class="px-6 py-4 text-sm">
                                <div class="space-y-4">
                                    @foreach ($item->items as $barang)
                                        <div class="text-slate-700 dark:text-slate-300 font-medium h-8 flex items-center">
                                            • {{ $barang['nama_barang'] }}
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            {{-- KOLOM JUMLAH (Permintaan Awal) --}}
                            <td class="px-6 py-4 text-center">
                                <div class="space-y-4">
                                    @foreach ($item->items as $barang)
                                        <div class="h-8 flex flex-col justify-center">
                                            <span
                                                class="font-bold text-slate-700 dark:text-slate-200">{{ $barang['jumlah'] }}</span>
                                            <span
                                                class="text-[9px] text-slate-400 uppercase leading-none">{{ $barang['satuan'] }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </td>

                            {{-- KOLOM DIBERIKAN (Input/Hasil Akhir) --}}
                            <td class="px-6 py-4 text-center bg-blue-50/30 dark:bg-blue-900/10">
                                <form id="approve-form-{{ $item->id }}"
                                    action="{{ route('admin.update_status', ['type' => 'atk', 'id' => $item->id]) }}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="Disetujui">

                                    <div class="space-y-4">
                                        @foreach ($item->items as $index => $barang)
                                            <div class="h-8 flex items-center justify-center gap-2">
                                                @if ($item->status == 'Menunggu')
                                                    <input type="number" name="items[{{ $index }}][diberikan]"
                                                        value="{{ $barang['diberikan'] ?? $barang['jumlah'] }}"
                                                        class="w-16 px-2 py-1 text-xs font-bold border border-blue-300 rounded text-center focus:ring-2 focus:ring-blue-500 text-blue-700"
                                                        required>
                                                @else
                                                    <span class="font-bold text-emerald-600 text-base">
                                                        {{ $barang['diberikan'] ?? 0 }}
                                                    </span>
                                                @endif
                                                <span
                                                    class="text-[9px] text-slate-400 uppercase">{{ $barang['satuan'] }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </form>
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if ($item->foto)
                                    <a href="{{ asset('storage/' . $item->foto) }}" target="_blank"
                                        class="text-blue-600 font-bold text-xs uppercase underline">Lihat Nota</a>
                                @else
                                    <span class="text-[10px] text-slate-400 italic">Kosong</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center">
                                <x-status :status="$item->status" />
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    @if ($item->status == 'Menunggu')
                                        <button form="approve-form-{{ $item->id }}" type="submit"
                                            class="p-1.5 text-emerald-600 hover:bg-emerald-100 rounded border border-emerald-200"
                                            title="Setujui">
                                            <span class="material-symbols-outlined">check_circle</span>
                                        </button>
                                        <form
                                            action="{{ route('admin.update_status', ['type' => 'atk', 'id' => $item->id]) }}"
                                            method="POST">
                                            @csrf <input type="hidden" name="status" value="Ditolak">
                                            <button type="submit"
                                                class="p-1.5 text-red-600 hover:bg-red-100 rounded border border-red-200"
                                                title="Tolak">
                                                <span class="material-symbols-outlined">cancel</span>
                                            </button>
                                        </form>
                                    @elseif($item->status == 'Disetujui')
                                        <form
                                            action="{{ route('admin.update_status', ['type' => 'atk', 'id' => $item->id]) }}"
                                            method="POST">
                                            @csrf <input type="hidden" name="status" value="Selesai">
                                            <button type="submit"
                                                class="px-3 py-1 bg-emerald-600 text-white rounded text-xs font-bold hover:bg-emerald-700">Serahkan</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-slate-400 italic">Belum ada data
                                permintaan ATK.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
