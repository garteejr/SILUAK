@extends('admin.layout.master')

@section('navigation')
    @include('admin.layout.navigation')
@endsection

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight">Peminjaman Ruang Rapat</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Kelola dan pantau penggunaan ruang pertemuan kantor.</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.peminjaman.ruang.export.excel') }}" 
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
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Jadwal Disetujui</p>
                <h3 class="text-3xl font-bold text-slate-900 dark:text-white mt-2">{{ $items->where('status', 'Disetujui')->count() }}</h3>
                <p class="text-xs text-blue-500 mt-1 font-medium flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">meeting_room</span> Ruangan telah di-booking
                </p>
            </div>
            <div class="p-2 bg-blue-50 dark:bg-blue-900/20 text-blue-500 rounded-lg">
                <span class="material-symbols-outlined">check_circle</span>
            </div>
        </div>
        <div class="bg-white dark:bg-surface-dark p-5 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm flex items-start justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Permohonan</p>
                <h3 class="text-3xl font-bold text-slate-900 dark:text-white mt-2">{{ $items->count() }}</h3>
                <p class="text-xs text-emerald-500 mt-1 font-medium flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">history</span> Riwayat pemakaian
                </p>
            </div>
            <div class="p-2 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-500 rounded-lg">
                <span class="material-symbols-outlined">calendar_month</span>
            </div>
        </div>
    </div>

    <x-table :headers="['Peminjam', 'Bidang & Seksi', 'Ruangan', 'Acara', 'Jadwal', 'Status', 'Aksi']">
        
        @forelse($items as $item)
        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group border-b border-slate-100 dark:border-slate-800">
            <td class="px-6 py-4">
                <div class="font-medium text-sm text-slate-700 dark:text-slate-200">{{ $item->nama }}</div>
                <div class="text-xs text-slate-500 dark:text-slate-400">{{ $item->nip }}
                    <span class="text-[10px] text-slate-400 mt-1 font-normal flex gap-1">
                        {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i') }}
                    </span>
                </div>
            </td>
            <td class="px-6 py-4 font-medium text-sm text-slate-700 dark:text-slate-200">{{ $item->bidang }}</td>
            <td class="px-6 py-4 text-sm text-slate-700 dark:text-slate-300">{{ $item->ruangan }}</td>
            <td class="px-6 py-4 text-sm text-slate-700 dark:text-slate-300">{{ $item->acara }}</td>
            <td class="px-6 py-4">
                <div class="text-medium text-sm text-slate-700 dark:text-white">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</div>
                <div class="text-xs text-slate-500">{{ $item->waktu_mulai }} - {{ $item->waktu_selesai }}</div>
            </td>

            <td class="px-6 py-4 text-center">
                <x-status :status="$item->status" />
            </td>

            <td class="px-6 py-4 text-right">
                <div class="flex justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                    @if($item->status == 'Menunggu')
                        <form action="{{ route('admin.update_status', ['type' => 'ruangan', 'id' => $item->id]) }}" method="POST">
                            @csrf <input type="hidden" name="status" value="Disetujui">
                            <button class="p-1.5 text-emerald-600 hover:bg-emerald-50 rounded-lg" title="Setujui">
                                <span class="material-symbols-outlined text-[20px]">check_circle</span>
                            </button>
                        </form>
                        <form action="{{ route('admin.update_status', ['type' => 'ruangan', 'id' => $item->id]) }}" method="POST">
                            @csrf <input type="hidden" name="status" value="Ditolak">
                            <button class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg" title="Tolak">
                                <span class="material-symbols-outlined text-[20px]">cancel</span>
                            </button>
                        </form>
                    @elseif($item->status == 'Disetujui')
                        <form action="{{ route('admin.update_status', ['type' => 'ruangan', 'id' => $item->id]) }}" method="POST">
                            @csrf <input type="hidden" name="status" value="Selesai">
                            <button class="inline-flex items-center gap-1 px-3 py-1 bg-emerald-600 text-white rounded-lg text-[10px] font-bold hover:bg-emerald-700 transition-colors shadow-sm">
                                <span class="material-symbols-outlined text-sm">task_alt</span> Selesaikan
                            </button>
                        </form>
                    @else
                        <span class="text-[10px] text-slate-400 font-bold uppercase italic">No Action</span>
                    @endif
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="px-6 py-12 text-center text-slate-400 italic">Belum ada data peminjaman ruangan.</td>
        </tr>
        @endforelse

    </x-table>
@endsection