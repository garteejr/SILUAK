@extends('admin.layout.master')

@section('navigation')
    @include('admin.layout.navigation')
@endsection

@section('content')
    <main class="flex-1 overflow-y-auto bg-background-light dark:bg-background-dark p-3 md:p-2">
        <div class="max-w-6xl mx-auto space-y-6">
            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                <a class="hover:text-primary transition-colors" href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span class="material-symbols-outlined text-xs">chevron_right</span>
                <a class="hover:text-primary transition-colors" href="{{ route('admin.laporan.gedung') }}">Laporan</a>
                <span class="material-symbols-outlined text-xs">chevron_right</span>
                <span class="font-medium text-slate-900 dark:text-white">Detail #GDG-{{ $gedung->id }}</span>
            </div>

            {{-- Header --}}
            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3">
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight">Laporan Kerusakan
                            Gedung</h2>
                        <span
                            class="px-2.5 py-0.5 rounded-full text-xs font-medium 
                            {{ $gedung->status == 'Selesai'? 'bg-green-100 text-green-700' : ($gedung->status == 'Ditolak' ? 'bg-red-100 text-red-700' : ($gedung->status == 'Disetujui' ? 'bg-blue-100 text-blue-500' : 'bg-orange-100 text-orange-600')) }} border border-orange-200">
                            {{ $gedung->status }}
                        </span>
                    </div>
                    <p class="text-slate-500 dark:text-slate-400 mt-1 italic text-sm">
                        ID Laporan: <span
                            class="font-mono text-slate-700 dark:text-slate-300">#GDG-{{ $gedung->id }}</span> •
                        Prioritas: <span
                            class="{{ $gedung->prioritas == 'Tinggi' ? 'text-red-600' : 'text-blue-600' }} font-medium">{{ $gedung->prioritas ?? 'Belum Diatur' }}</span>
                    </p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('admin.laporan.gedung.export.item', $gedung->id) }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium hover:bg-blue-600 transition-colors shadow-lg shadow-primary/20">
                        <span class="material-symbols-outlined text-[18px]">download</span> Export PDF
                    </a>
                    <a href="{{ route('admin.laporan.gedung') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-200 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span> Kembali
                    </a>
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
                                        Gedung</p>
                                    <p class="text-sm font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                                        <span class="material-symbols-outlined text-slate-400 text-lg">domain</span>
                                        Gedung {{ $gedung->gedung }}
                                    </p>
                                </div>
                                <div>
                                    <p
                                        class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">
                                        No.Telepon</p>
                                    <p class="text-sm font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                                        <span class="material-symbols-outlined text-slate-400 text-lg">call</span>
                                        {{ $gedung->telepon }}
                                    </p>
                                </div>
                                <div>
                                    <p
                                        class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">
                                        Lokasi Detail</p>
                                    <p class="text-sm font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                                        <span class="material-symbols-outlined text-slate-400 text-lg">location_on</span>
                                        {{ $gedung->lokasi }}
                                    </p>
                                </div>
                                <div>
                                    <p
                                        class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1">
                                        Tanggal Laporan</p>
                                    <p class="text-sm font-semibold text-slate-900 dark:text-white">
                                        {{ $gedung->created_at->format('d M Y, H:i') }} WIB
                                    </p>
                                </div>
                            </div>

                            <div>
                                <p
                                    class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">
                                    Deskripsi Kerusakan</p>
                                <div
                                    class="p-4 rounded-lg bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700/50 text-sm text-slate-700 dark:text-slate-300 leading-relaxed italic">
                                    "{{ $gedung->deskripsi }}"
                                </div>
                            </div>

                            {{-- Foto Lampiran --}}
                            <div>
                                <p
                                    class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-3">
                                    Lampiran Foto</p>
                                <div class="flex gap-4 overflow-x-auto pb-2">
                                    @if ($gedung->foto)
                                        <div class="relative group cursor-zoom-in shrink-0"
                                            onclick="openModal('{{ asset('storage/' . $gedung->foto) }}')">
                                            <img src="{{ asset('storage/' . $gedung->foto) }}"
                                                class="w-48 h-48 object-cover rounded-lg border border-slate-200"
                                                alt="Foto Kerusakan">
                                            <div
                                                class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center rounded-lg">
                                                <span class="material-symbols-outlined text-white">zoom_in</span>
                                            </div>
                                        </div>
                                    @else
                                        <div
                                            class="w-32 h-32 rounded-lg bg-slate-100 flex flex-col items-center justify-center text-slate-400 border border-dashed border-slate-300">
                                            <span class="material-symbols-outlined text-3xl">image_not_supported</span>
                                            <span class="text-[10px]">Tidak ada foto</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Informasi Pelapor --}}
                    <div
                        class="rounded-xl bg-surface-light dark:bg-surface-dark border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
                        <div class="p-4">
                            <div class="flex items-center gap-2">
                                <div
                                    class="size-12 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-lg">
                                    {{ substr($gedung->nama, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-900 dark:text-white">{{ $gedung->nama }}</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">Unit Kerja: {{ $gedung->bidang }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Samping: Tindakan Admin --}}
                <div class="space-y-6">
                    <div
                        class="rounded-xl bg-surface-light dark:bg-surface-dark border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
                        <div class="p-4 bg-slate-50 dark:bg-slate-800 border-b border-slate-200 dark:border-slate-800">
                            <h3 class="text-sm font-bold text-slate-900 dark:text-white">Tindakan Admin</h3>
                        </div>
                        <div class="p-5">
                            <form action="{{ route('admin.laporan.gedung.update', $gedung->id) }}" method="POST"
                                class="space-y-4">
                                @csrf
                                <div>
                                    <label
                                        class="block text-xs font-medium text-slate-700 dark:text-slate-300 mb-1.5">Update
                                        Status</label>
                                    <select name="status" {{ request('mode') != 'edit' ? 'disabled' : '' }}
                                        class="w-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-sm rounded-lg p-2.5">
                                        <option value="Menunggu" {{ $gedung->status == 'Menunggu' ? 'selected' : '' }}>
                                            Menunggu </option>
                                        <option value="Disetujui" {{ $gedung->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                        <option value="Selesai" {{ $gedung->status == 'Selesai' ? 'selected' : '' }}>
                                            Selesai</option>
                                        <option value="Ditolak" {{ $gedung->status == 'Ditolak' ? 'selected' : '' }}>
                                            Ditolak</option>
                                    </select>
                                </div>
                                <div class="mt-4">
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Set
                                        Prioritas</label>
                                    <select name="prioritas"
                                        class="w-full bg-white border border-slate-300 text-slate-900 text-sm rounded-lg p-2.5">
                                        <option value="Tinggi" {{ $gedung->prioritas == 'Tinggi' ? 'selected' : '' }}>
                                            Tinggi</option>
                                        <option value="Sedang" {{ $gedung->prioritas == 'Sedang' ? 'selected' : '' }}>
                                            Sedang</option>
                                        <option value="Rendah" {{ $gedung->prioritas == 'Rendah' ? 'selected' : '' }}>
                                            Rendah</option>
                                    </select>
                                </div>

                                @if (request('mode') == 'edit')
                                    <button type="submit"
                                        class="w-full py-2.5 px-4 bg-primary hover:bg-blue-600 text-white font-medium rounded-lg text-sm shadow-lg shadow-primary/20 transition-colors">
                                        Simpan Perubahan
                                    </button>
                                @else
                                    <a href="{{ route('admin.laporan.gedung.detail', ['id' => $gedung->id, 'mode' => 'edit']) }}"
                                        class="block w-full text-center py-2.5 px-4 bg-slate-800 text-white font-medium rounded-lg text-sm hover:bg-slate-700 transition-colors">
                                        Masuk Mode Edit
                                    </a>
                                @endif
                            </form>
                        </div>
                    </div>

                    {{-- Riwayat --}}
                    <div
                        class="rounded-xl bg-surface-light dark:bg-surface-dark border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
                        <div class="p-4 bg-slate-50 dark:bg-slate-800 border-b border-slate-200 dark:border-slate-800">
                            <h3 class="text-sm font-bold text-slate-900 dark:text-white">Riwayat Laporan</h3>
                        </div>
                        <div class="p-5 text-xs">
                            <ol class="relative border-l border-slate-200 dark:border-slate-700 ml-1.5">
                                <li class="mb-4 ml-6">
                                    <span
                                        class="absolute flex items-center justify-center w-3 h-3 bg-blue-500 rounded-full -left-[6px] ring-4 ring-white dark:ring-surface-dark"></span>
                                    <p class="font-bold text-slate-900 dark:text-white">Laporan Dibuat</p>
                                    <time class="text-slate-400">{{ $gedung->created_at->format('d M Y, H:i') }}</time>
                                </li>
                                <li class="ml-6">
                                    <span
                                        class="absolute flex items-center justify-center w-3 h-3 bg-slate-300 rounded-full -left-[6px] ring-4 ring-white dark:ring-surface-dark"></span>
                                    <p class="font-bold text-slate-500">Update Terakhir</p>
                                    <time class="text-slate-400">{{ $gedung->updated_at->diffForHumans() }}</time>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- Modal Zoom Foto --}}
    <div id="imageModal" class="fixed inset-0 z-[99] hidden bg-black/90 flex items-center justify-center p-4">
        <button onclick="closeModal()" class="absolute top-5 right-5 text-white">
            <span class="material-symbols-outlined text-4xl">close</span>
        </button>
        <img id="modalImg" src=""
            class="max-w-full max-h-full rounded-lg shadow-2xl transition-transform duration-300" alt="Full Image">
    </div>

    <script>
        function openModal(src) {
            document.getElementById('modalImg').src = src;
            document.getElementById('imageModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }
    </script>
@endsection
