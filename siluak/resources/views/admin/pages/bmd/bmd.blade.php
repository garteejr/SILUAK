@extends('admin.layout.master')
@section('navigation')
    @include('admin.layout.navigation')
@endsection
@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight">Daftar Kebutuhan BMD</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Kelola usulan pengadaan Barang Milik Daerah (BMD).</p>
        </div>
        <div class="flex gap-3">
            <form action="{{ route('admin.bmd.export.excel') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">download</span> Export Excel
                </button>
            </form>
        </div>
    </div>

    <div
        class="p-4 mt-6 bg-surface-light dark:bg-surface-dark border border-slate-200 dark:border-slate-800 rounded-xl shadow-sm">
        <div class="flex flex-col lg:flex-row gap-4 justify-between lg:items-center">
            <div class="relative w-full lg:w-96">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                    <span class="material-symbols-outlined text-[20px]">search</span>
                </div>
                <input id="searchInput"
                    class="block w-full pl-10 pr-3 py-2 border border-slate-200 dark:border-slate-700 rounded-lg leading-5 bg-white dark:bg-slate-900 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/50 sm:text-sm transition-all"
                    placeholder="Cari nama, bidang, atau program..." type="text" />
            </div>
            <div class="flex flex-wrap gap-3 w-full lg:w-auto">
                <div class="relative min-w-[150px] flex-1 lg:flex-none">
                    <select id="unitFilter"
                        class="w-full appearance-none pl-3 pr-10 py-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg text-sm text-slate-700 dark:text-slate-300 focus:ring-2 focus:ring-primary/50 outline-none cursor-pointer">
                        <option value="">Semua Bidang</option>
                        {{-- Opsi ini bisa dibuat dinamis dari database --}}
                        <option value="Sekretariat">Sekretariat</option>
                        <option value="LPA">LPA</option>
                        <option value="PPA">PPA</option>
                        <option value="P3K">P3K</option>
                        <option value="Pengembangan Perpustakaan">Pengembangan Perpustakaan</option>
                        <option value="Pengelolaan Perpustakaan">Pengelolaan Perpustakaan</option>



                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-slate-500">
                        <span class="material-symbols-outlined">expand_more</span>
                    </div>
                </div>
                <div class="relative min-w-[150px] flex-1 lg:flex-none">
                    <select id="statusFilter"
                        class="w-full appearance-none pl-3 pr-10 py-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg text-sm text-slate-700 dark:text-slate-300 focus:ring-2 focus:ring-primary/50 outline-none cursor-pointer">
                        <option value="">Semua Status</option>
                        <option value="Menunggu">Menunggu</option>
                        <option value="Disetujui">Disetujui</option>
                        <option value="Ditolak">Ditolak</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-slate-500">
                        <span class="material-symbols-outlined">expand_more</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div
        class="mt-6 rounded-xl bg-surface-light dark:bg-surface-dark border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden flex flex-col">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600 dark:text-slate-400">
                <thead
                    class="bg-slate-50 dark:bg-slate-800 text-xs uppercase font-semibold text-slate-500 dark:text-slate-400">
                    <tr>
                        <th class ="px-6 py-4">Nama Pemohon</th>
                        <th class="px-6 py-4">Bidang</th>
                        <th class="px-6 py-4">Program / Kegiatan</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Tanggal Pengajuan</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody id="bmdTableBody" class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse ($items as $item)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-col">
                                    <span class="font-semibold text-slate-900 dark:text-white">{{ $item->nama }}</span>
                                    <span class="text-xs text-slate-500">{{ $item->email }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 dark:text-slate-400">
                                {{ $item->unitKerja ?? $item->bidang }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-0.5">
                                    <span
                                        class="text-sm font-medium text-slate-900 dark:text-white">{{ $item->program }}</span>
                                    <span
                                        class="text-[11px] text-slate-500 italic">{{ Str::limit($item->kegiatan, 40) }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span
                                    class="px-2.5 py-1 rounded-full text-xs font-medium 
                    {{ $item->status == 'Menunggu' ? 'bg-orange-100 text-orange-500' : ($item->status == 'Selesai' ? 'bg-green-100 text-green-600' : ($item->status == 'Ditolak' ? 'bg-red-100 text-red-600' : ($item->status == 'Disetujui' ? 'bg-blue-100 text-blue-500' : 'bg-gray-100 text-gray-600'))) }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-slate-600 dark:text-slate-400">
                                {{ $item->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @if ($item->status == 'Menunggu')
                                        {{-- Tombol Setujui (Approve) --}}
                                        <a href="{{ route('admin.bmd.detail', ['id' => $item->id, 'mode' => 'edit']) }}"
                                            class="p-1.5 text-slate-400 hover:text-emerald-500 rounded-lg transition-colors">
                                            <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                        </a>


                                        {{-- Tombol Tolak (Reject) --}}
                                        <form action="{{ route('admin.bmd.update', $item->id) }}" method="POST"
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
                                        <a href="{{ route('admin.bmd.detail', ['id' => $item->id, 'mode' => 'view']) }}"
                                            class="p-1.5 text-slate-400 hover:text-emerald-500 rounded-lg transition-colors"
                                            title="Lihat Detail">
                                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                                        </a>

                                        {{-- Link Edit (Pensil) - Mode Edit --}}
                                        <a href="{{ route('admin.bmd.detail', ['id' => $item->id, 'mode' => 'edit']) }}"
                                            class="p-1.5 text-slate-400 hover:text-primary rounded-lg transition-colors"
                                            title="Edit Laporan">
                                            <span class="material-symbols-outlined text-[20px]">edit</span>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-slate-500 italic">Data tidak ditemukan
                            </td>
                        </tr>
                    @endforelse
                    <tr id="noResultsRow" style="display: none;">
                        <td colspan="6" class="px-6 py-10 text-center text-slate-500 italic">
                            Data tidak ditemukan untuk pencarian tersebut.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const unitFilter = document.getElementById('unitFilter');
            const statusFilter = document.getElementById('statusFilter');
            const tableBody = document.getElementById('bmdTableBody');
            const tableRows = tableBody.querySelectorAll('tr:not(#noResultsRow):not(.no-data-original)');
            const noResultsRow = document.getElementById('noResultsRow');

            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                const unitTerm = unitFilter.value.toLowerCase().trim();
                const statusTerm = statusFilter.value.toLowerCase().trim();

                let visibleCount = 0;

                tableRows.forEach(row => {
                    // Mengambil teks dari tiap kolom
                    const nama = row.cells[0].textContent.toLowerCase().trim();
                    const unit = row.cells[1].textContent.toLowerCase().trim();
                    const program = row.cells[2].textContent.toLowerCase().trim();
                    const status = row.cells[3].textContent.toLowerCase().trim();

                    // Logika Filter
                    const matchesSearch = searchTerm === "" || (nama.includes(searchTerm) || program
                        .includes(searchTerm));
                    const matchesUnit = unitTerm === "" || unit.includes(unitTerm);
                    const matchesStatus = statusTerm === "" || status.includes(statusTerm);

                    if (matchesSearch && matchesUnit && matchesStatus) {
                        row.style.display = "";
                        visibleCount++;
                    } else {
                        row.style.display = "none";
                    }
                });

                // Tampilkan pesan jika tidak ada data yang cocok dengan filter
                if (visibleCount === 0) {
                    noResultsRow.style.display = "";
                } else {
                    noResultsRow.style.display = "none";
                }
            }

            searchInput.addEventListener('input', filterTable);
            unitFilter.addEventListener('change', filterTable);
            statusFilter.addEventListener('change', filterTable);
        });
    </script>
@endsection
