@extends('admin.layout.master')

@section('navigation')
    @include('admin.layout.navigation')
@endsection

@section('content')
    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white tracking-tight">Manajemen Stok Gudang ATK</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-1 text-sm">Kelola dan pantau ketersediaan stok alat tulis kantor secara real-time.</p>
        </div>
        <div class="flex gap-3">
            <form action="{{ route('admin.manajemen.export.excel') }}" method="GET" style="display: inline;">
                <button type="submit"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">download</span> Export Excel
                </button>
            </form>
            <a href="{{ route('admin.manajemen.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-primary hover:bg-blue-600 text-white rounded-lg text-sm font-medium transition-colors shadow-lg shadow-primary/20">
                <span class="material-symbols-outlined text-[18px]">add</span> Tambah Barang
            </a>
        </div>
    </div>

    {{-- Stats Cards Section --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 items-stretch">
        <div class="bg-white dark:bg-sidebar-dark p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 flex flex-col justify-between min-h-[180px]">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-[15px] font-medium text-slate-500">Total Jenis Barang</p>
                    <h2 id="statTotalJenis" class="text-4xl font-bold mt-3 text-slate-900 dark:text-white">{{ $totalJenis }}</h2>
                </div>
                <div class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-2xl">
                    <span class="material-symbols-outlined text-primary text-2xl">inventory_2</span>
                </div>
            </div>
            <div class="flex items-center gap-1.5 mt-4 text-xs text-primary font-semibold">
                <span class="material-symbols-outlined text-[16px]">insert_chart</span>
                <span>Aktif di gudang</span>
            </div>
        </div>

        <div class="bg-white dark:bg-sidebar-dark p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 flex flex-col justify-between min-h-[180px]">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-[15px] font-medium text-slate-500">Stok Menipis</p>
                    <h2 id="statStokMenipis" class="text-4xl font-bold mt-3 text-orange-500">{{ $stokMenipis }}</h2>
                </div>
                <div class="p-3 bg-orange-50 dark:bg-orange-900/20 rounded-2xl">
                    <span class="material-symbols-outlined text-orange-500 text-2xl">notifications_active</span>
                </div>
            </div>
            <div class="flex items-center gap-1.5 mt-4 text-xs text-orange-500 font-semibold">
                <span class="material-symbols-outlined text-[16px]">error_outline</span>
                <span>Perlu restock segera</span>
            </div>
        </div>

        <div class="bg-white dark:bg-sidebar-dark p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 flex flex-col min-h-[180px]">
            <div class="flex justify-between items-start mb-2">
                <div class="flex-1">
                    <p class="text-[15px] font-medium text-slate-500">Total Keseluruhan Unit</p>
                    <div class="flex items-baseline gap-2 mt-3">
                        <h2 id="statTotalUnit" class="text-4xl font-bold text-slate-900 dark:text-white">{{ number_format($totalUnitSeluruhnya, 0, ',', '.') }}</h2>
                        <span class="text-[10px] font-bold text-slate-400 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded-md uppercase tracking-wider">Unit</span>
                    </div>
                </div>
                <div class="p-3 bg-emerald-50 dark:bg-emerald-900/20 rounded-2xl shrink-0">
                    <span class="material-symbols-outlined text-emerald-500 text-2xl">update</span>
                </div>
            </div>
            
            <div class="mt-auto pt-4 border-t border-slate-50 dark:border-slate-800/50">
                <div class="relative group">
                    <select id="itemStatFilter"
                        class="w-full appearance-none pl-3 pr-10 py-2.5 bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700 rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-300 focus:ring-2 focus:ring-primary/20 transition-all outline-none cursor-pointer">
                        <option value="all">Semua Barang</option>
                        @foreach($barangs as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_barang }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter & Sort Section --}}
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-6">
        <div class="flex flex-wrap items-center gap-3">
            <div class="relative min-w-[150px]">
                <select id="stokFilter" class="w-full appearance-none pl-4 pr-10 py-2.5 bg-slate-50 dark:bg-slate-800 border-none rounded-xl text-sm font-medium text-slate-600 dark:text-slate-300 focus:ring-2 focus:ring-primary/20 outline-none cursor-pointer">
                    <option value="">Semua Stok</option>
                    <option value="Menipis">Stok Menipis</option>
                    <option value="Tersedia">Stok Tersedia</option>
                </select>
            </div>

            <div class="relative min-w-[170px]">
                <select id="kategoriFilter" class="w-full appearance-none pl-4 pr-10 py-2.5 bg-slate-50 dark:bg-slate-800 border-none rounded-xl text-sm font-medium text-slate-600 dark:text-slate-300 focus:ring-2 focus:ring-primary/20 outline-none cursor-pointer">
                    <option value="">Filter Kategori</option>
                    <option value="KERTAS">Kertas</option>
                    <option value="ALAT TULIS">Alat Tulis</option>
                    <option value="LAIN-LAIN">Lain-lain</option>
                </select>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <span class="text-[11px] text-slate-400 font-bold uppercase tracking-widest">Urutkan:</span>
            <div class="relative min-w-[160px]">
                <select id="sortStok" class="w-full appearance-none pl-4 pr-12 py-2.5 bg-slate-50 dark:bg-slate-800 border-none rounded-xl text-sm font-medium text-slate-600 dark:text-slate-300 focus:ring-2 focus:ring-primary/20 outline-none cursor-pointer">
                    <option value="default">Terbaru (Asc)</option>
                    <option value="asc">Stok Terendah</option>
                    <option value="desc">Stok Tertinggi</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Table Section --}}
    <div class="bg-white dark:bg-sidebar-dark rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-800">
                        <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Nama Barang</th>
                        <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Satuan</th>
                        <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-center">Sisa Stok</th>
                        <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-center">Kategori</th>
                        <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-center">Peringatan</th>
                        <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="inventoryTableBody" class="divide-y divide-slate-50 dark:divide-slate-800/50">
                    @forelse($barangs as $barang)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors item-row" 
                            data-id="{{ $barang->id }}"
                            data-stok="{{ $barang->stok }}"
                            data-stok-status="{{ $barang->stok <= $barang->stok_minimal ? 'Menipis' : 'Tersedia' }}">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-400">
                                        <span class="material-symbols-outlined text-xl">description</span>
                                    </div>
                                    <span class="font-semibold text-slate-700 dark:text-slate-200 text-sm">{{ $barang->nama_barang }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-sm text-slate-500">{{ $barang->satuan }}</td>
                            <td class="px-6 py-5 text-center">
                                <span class="text-sm font-bold {{ $barang->stok <= $barang->stok_minimal ? 'text-red-500' : 'text-emerald-500' }}">
                                    {{ $barang->stok }}
                                </span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="px-3 py-1 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-[10px] font-bold rounded-full uppercase tracking-tighter">
                                    {{ $barang->kategori }}
                                </span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                @if($barang->stok <= $barang->stok_minimal)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-red-50 dark:bg-red-900/20 text-red-600 text-[10px] font-bold rounded-full uppercase tracking-tight">
                                        <span class="material-symbols-outlined text-[14px]">report</span>
                                        Stok Menipis
                                    </span>
                                @else
                                    <span class="text-slate-300 dark:text-slate-600">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-5 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.manajemen.detail', $barang->id) }}" class="p-2 text-slate-400 hover:text-primary transition-all">
                                        <span class="material-symbols-outlined text-xl">edit_square</span>
                                    </a>
                                    <form action="{{ route('admin.manajemen.destroy', $barang->id) }}" method="POST" onsubmit="return confirm('Hapus barang ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-400 hover:text-red-500 transition-all">
                                            <span class="material-symbols-outlined text-xl">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400 italic text-sm">Belum ada data barang.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Script JavaScript (Tanpa Perubahan) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stokFilter = document.getElementById('stokFilter');
            const kategoriFilter = document.getElementById('kategoriFilter');
            const sortStok = document.getElementById('sortStok');
            const itemStatFilter = document.getElementById('itemStatFilter');
            const tableBody = document.getElementById('inventoryTableBody');
            
            const statTotalJenis = document.getElementById('statTotalJenis');
            const statStokMenipis = document.getElementById('statStokMenipis');
            const statTotalUnit = document.getElementById('statTotalUnit');

            function updateUI() {
                const stokVal = stokFilter.value;
                const kategoriVal = kategoriFilter.value.toUpperCase();
                const sortVal = sortStok.value;
                const selectedStatId = itemStatFilter.value;
                
                let rows = Array.from(tableBody.querySelectorAll('.item-row'));
                let filteredCount = 0;
                let totalUnitSum = 0;
                let menipisSum = 0;
                let filteredTotalUnit = 0;

                rows.forEach(row => {
                    const statusStok = row.getAttribute('data-stok-status');
                    const stokNum = parseInt(row.getAttribute('data-stok'));
                    const rowId = row.getAttribute('data-id');
                    const kategoriText = row.cells[3].textContent.trim().toUpperCase();

                    const matchesStok = stokVal === "" || statusStok === stokVal;
                    const matchesKategori = kategoriVal === "" || kategoriText.includes(kategoriVal);

                    if (matchesStok && matchesKategori) {
                        row.style.display = "";
                        filteredCount++;
                        totalUnitSum += stokNum;
                        if (statusStok === 'Menipis') menipisSum++;
                        
                        if (selectedStatId === 'all' || selectedStatId === rowId) {
                            filteredTotalUnit += stokNum;
                        }
                    } else {
                        row.style.display = "none";
                    }
                });

                statTotalJenis.textContent = filteredCount;
                statStokMenipis.textContent = menipisSum;
                statTotalUnit.textContent = new Intl.NumberFormat('id-ID').format(selectedStatId === 'all' ? totalUnitSum : filteredTotalUnit);

                if (sortVal !== 'default') {
                    rows.sort((a, b) => {
                        const valA = parseInt(a.getAttribute('data-stok'));
                        const valB = parseInt(b.getAttribute('data-stok'));
                        return sortVal === 'asc' ? valA - valB : valB - valA;
                    });
                    rows.forEach(row => tableBody.appendChild(row));
                }
            }

            [stokFilter, kategoriFilter, sortStok, itemStatFilter].forEach(el => {
                if(el) el.addEventListener('change', updateUI);
            });
        });
    </script>
@endsection