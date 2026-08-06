@extends('admin.layout.master')

@section('navigation')
    @include('admin.layout.navigation')
@endsection

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight">
                Peminjaman Kendaraan Dinas
            </h2>
            <p class="text-slate-500 dark:text-slate-400 mt-1">
                Kelola dan pantau penggunaan kendaraan operasional kantor.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.peminjaman.kendaraan.export.excel') }}" 
            class="inline-flex items-center gap-2 px-4 py-2 bg-white hover:bg-slate-50 border border-slate-200 text-black text-sm font-medium rounded-lg transition-all duration-200">
                <span class="material-symbols-outlined text-[18px]">download</span> Export Excel
            </a>
        </div>
    </div>

    {{-- Kartu Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white dark:bg-surface-dark p-5 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm flex items-start justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Menunggu Persetujuan</p>
                <h3 class="text-3xl font-bold text-slate-900 dark:text-white mt-2">{{ $items->where('status', 'Menunggu')->count() }}</h3>
                <p class="text-xs text-orange-500 mt-1 font-medium flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">schedule</span> Perlu tindakan segera
                </p>
            </div>
            <div class="p-2 bg-orange-50 dark:bg-orange-900/20 text-orange-500 rounded-lg">
                <span class="material-symbols-outlined">pending_actions</span>
            </div>
        </div>

        <div class="bg-white dark:bg-surface-dark p-5 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm flex items-start justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Sedang Digunakan</p>
                <h3 class="text-3xl font-bold text-slate-900 dark:text-white mt-2">{{ $items->where('status', 'Disetujui')->count() }}</h3>
                <p class="text-xs text-blue-500 mt-1 font-medium flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">directions_car</span> Kendaraan aktif
                </p>
            </div>
            <div class="p-2 bg-blue-50 dark:bg-blue-900/20 text-blue-500 rounded-lg">
                <span class="material-symbols-outlined">no_crash</span>
            </div>
        </div>

        <div class="bg-white dark:bg-surface-dark p-5 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm flex items-start justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Selesai</p>
                <h3 class="text-3xl font-bold text-slate-900 dark:text-white mt-2">{{ $items->where('status', 'Selesai')->count() }}</h3>
                <p class="text-xs text-emerald-500 mt-1 font-medium flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">check_circle</span> Kendaraan telah kembali
                </p>
            </div>
            <div class="p-2 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-500 rounded-lg">
                <span class="material-symbols-outlined">history</span>
            </div>
        </div>
    </div>

    <x-table :headers="['Kendaraan', 'Peminjam', 'Bidang & Seksi', 'Jadwal', 'Tujuan', 'Dokumen', 'Status', 'Aksi']">
        
        @forelse($items as $item)
        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group border-b border-slate-100 dark:border-slate-800">
            
            <td class="px-6 py-4 text-sm text-slate-700 dark:text-slate-300">{{ $item->jenis_kendaraan }}</td>

            <td class="px-6 py-4">
                <div class="font-medium text-sm text-slate-700 dark:text-slate-200">{{ $item->nama }}</div>
                <div class="text-xs text-slate-500 dark:text-slate-400">{{ $item->nip }}
                    <span class="text-[10px] text-slate-400 mt-1 font-normal flex gap-1">
                        {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i') }}
                    </span>
                </div>
            </td>
            <td class="px-6 py-4 font-medium text-sm text-slate-700 dark:text-slate-200">{{ $item->bidang }}</td>
            <td class="px-6 py-4 text-center">
                <div class="text-sm text-slate-700 dark:text-slate-300">{{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d/m/Y') }}</div>
                <div class="text-xs text-slate-400">s/d</div>
                <div class="text-sm text-slate-700 dark:text-slate-300">{{ \Carbon\Carbon::parse($item->tgl_kembali)->format('d/m/Y') }}</div>
            </td>
            <td class="px-6 py-4 text-sm text-slate-700 dark:text-slate-300">{{ $item->tujuan }}</td>
            <td class="px-6 py-4 text-sm text-center">
                @if($item->surat_permohonan)
                    <a href="{{ asset('storage/' . $item->surat_permohonan) }}" target="_blank" 
                       class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-800 font-bold text-xs uppercase">
                        Lihat Surat
                    </a>
                @else
                    <span class="text-[10px] text-slate-400 italic">Kosong</span>
                @endif
            </td>

            <td class="px-6 py-4 text-center">
                <x-status :status="$item->status" />
            </td>

            <td class="px-6 py-4 text-right">
                <div class="flex justify-end gap-2 items-center">
                    @if($item->status == 'Menunggu')
                        {{-- Form Setujui --}}
                        <form action="{{ route('admin.update_status', ['type' => 'kendaraan', 'id' => $item->id]) }}" 
                            method="POST" 
                            class="flex items-center gap-2 bg-slate-50 p-1.5 rounded-lg border border-slate-200">
                            @csrf 
                            <input type="hidden" name="status" value="Disetujui">  
                            {{-- Dropdown Pilihan --}}
                            <select name="plat_nomor" required 
                                    class="text-xs border-slate-300 rounded focus:border-emerald-500 focus:ring-emerald-500 py-1 pl-2 pr-6 bg-white w-32">
                                <option value="">Pilih Plat</option>
                                <option value="H 9922 PA">H 9922 PA (Avanza)</option>
                                <option value="H 1029 QA">H 1029 QA (Innova)</option>
                                <option value="H 8821 ZA">H 8821 ZA (Hilux)</option>
                            </select>

                            <button type="submit" class="p-1 text-emerald-600 hover:bg-emerald-100 rounded transition-colors" title="Setujui">
                                <span class="material-symbols-outlined text-[20px]">check_circle</span>
                            </button>
                        </form>
                        {{-- Tombol Tolak --}}
                        <form action="{{ route('admin.update_status', ['type' => 'kendaraan', 'id' => $item->id]) }}" method="POST">
                            @csrf <input type="hidden" name="status" value="Ditolak">
                            <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg" title="Tolak">
                                <span class="material-symbols-outlined text-[20px]">cancel</span>
                            </button>
                        </form>
                    @elseif($item->status == 'Disetujui')                        
                        <form action="{{ route('admin.update_status', ['type' => 'kendaraan', 'id' => $item->id]) }}" method="POST">
                            @csrf <input type="hidden" name="status" value="Selesai">
                            <button class="inline-flex items-center gap-1 px-3 py-1 bg-emerald-600 text-white rounded-lg text-xs font-bold hover:bg-emerald-700 transition">
                                <span class="material-symbols-outlined text-sm">task_alt</span> Selesaikan
                            </button>
                        </form>

                    @else
                        <span class="text-[10px] text-slate-300 font-bold uppercase italic">Selesai</span>
                    @endif
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="px-6 py-12 text-center text-slate-400 italic">Belum ada data peminjaman.</td>
        </tr>
        @endforelse

    </x-table>
@endsection