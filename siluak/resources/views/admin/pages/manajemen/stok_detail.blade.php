@extends('admin.layout.master')

@section('navigation')
    @include('admin.layout.navigation')
@endsection

@section('content')
    <main class="flex-1 flex flex-col">
        <div class="px-8 pt-6">
            <div class="flex flex-wrap items-center gap-2">
                <a class="text-[#4c739a] hover:text-primary text-sm font-medium transition-colors"
                    href="{{ route('admin.manajemen.index') }}">Stok Barang</a>
                <span class="text-[#4c739a] text-sm font-medium">/</span>
                <span class="text-[#0d141b] dark:text-white text-sm font-bold">Detail & Edit Barang</span>
            </div>
        </div>

        <form action="{{ route('admin.manajemen.update', $barang->id) }}" method="POST">
            @csrf
            <div class="px-8 pt-4 pb-6 border-b border-[#cfdbe7] dark:border-slate-800">
                <div class="flex flex-wrap justify-between items-center gap-4">
                    <div class="flex flex-col gap-1">
                        <h2 class="text-[#0d141b] dark:text-white text-3xl font-black tracking-tight">
                            {{ $barang->nama_barang }}</h2>
                        <p class="text-[#4c739a] dark:text-slate-400 text-sm font-normal">ID Barang:
                            BRG-{{ str_pad($barang->id, 5, '0', STR_PAD_LEFT) }} • Terakhir diupdate:
                            {{ $barang->updated_at->format('d M Y') }}</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('admin.manajemen.index') }}"
                            class="flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-white dark:bg-slate-800 text-[#0d141b] dark:text-white font-bold text-sm hover:bg-slate-50 transition-colors">
                            <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali
                        </a>
                        <button type="submit"
                            class="flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg bg-primary text-white font-bold text-sm shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all">
                            <span class="material-symbols-outlined text-sm">save</span> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>

            <div class="p-8 space-y-8 max-w-6xl mx-auto w-full">
                <section>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div
                            class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-slate-900 border border-[#cfdbe7] dark:border-slate-800 shadow-sm">
                            <p class="text-[#4c739a] text-xs font-bold uppercase tracking-wider">Nama Barang</p>
                            <p class="text-[#0d141b] dark:text-white text-xl font-extrabold">{{ $barang->nama_barang }}</p>
                        </div>
                        <div
                            class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-slate-900 border border-[#cfdbe7] dark:border-slate-800 shadow-sm">
                            <p class="text-[#4c739a] text-xs font-bold uppercase tracking-wider">Kategori</p>
                            <p class="text-[#0d141b] dark:text-white text-xl font-extrabold">{{ $barang->kategori }}</p>
                        </div>
                        <div
                            class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-slate-900 border border-[#cfdbe7] dark:border-slate-800 shadow-sm">
                            <p class="text-[#4c739a] text-xs font-bold uppercase tracking-wider">Satuan</p>
                            <p class="text-[#0d141b] dark:text-white text-xl font-extrabold">{{ $barang->satuan }}</p>
                        </div>
                        <div
                            class="flex flex-col gap-2 rounded-xl p-6 {{ $barang->stok <= $barang->stok_minimal ? 'bg-red-50' : 'bg-blue-50' }} dark:bg-primary/10 border border-primary/20 shadow-sm">
                            <p
                                class="{{ $barang->stok <= $barang->stok_minimal ? 'text-red-600' : 'text-primary' }} text-xs font-bold uppercase tracking-wider">
                                Sisa Stok Saat Ini</p>
                            <div class="flex items-center gap-2">
                                <p
                                    class="{{ $barang->stok <= $barang->stok_minimal ? 'text-red-600' : 'text-primary' }} text-2xl font-black">
                                    {{ $barang->stok }}</p>
                                <span
                                    class="px-2 py-0.5 rounded-full font-bold text-[10px] {{ $barang->stok <= $barang->stok_minimal ? 'bg-red-200 text-red-700' : 'bg-primary/20 text-primary' }}">
                                    {{ $barang->stok <= $barang->stok_minimal ? 'KRITIS' : 'STABIL' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <div
                        class="bg-white dark:bg-slate-900 rounded-xl border border-[#cfdbe7] dark:border-slate-800 shadow-sm overflow-hidden">
                        <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-[#0d141b] dark:text-slate-300">Nama Barang</label>
                                <input name="nama_barang"
                                    class="w-full rounded-lg border-[#cfdbe7] dark:border-slate-700 bg-white dark:bg-slate-800 px-4 py-2.5 focus:ring-primary transition-all"
                                    type="text" value="{{ $barang->nama_barang }}" />
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-[#0d141b] dark:text-slate-300">Kategori</label>
                                <select name="kategori"
                                    class="w-full rounded-lg border-[#cfdbe7] dark:border-slate-700 bg-white dark:bg-slate-800 px-4 py-2.5 focus:ring-primary transition-all">
                                    <option {{ $barang->kategori == 'Kertas' ? 'selected' : '' }}>Kertas</option>
                                    <option {{ $barang->kategori == 'Alat Tulis' ? 'selected' : '' }}>Alat Tulis</option>
                                    <option {{ $barang->kategori == 'Arsip' ? 'selected' : '' }}>Arsip</option>
                                    <option {{ $barang->kategori == 'Lain-lain' ? 'selected' : '' }}>Lain-lain</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-[#0d141b] dark:text-slate-300">Satuan</label>
                                <input name="satuan"
                                    class="w-full rounded-lg border-[#cfdbe7] dark:border-slate-700 bg-white dark:bg-slate-800 px-4 py-2.5 focus:ring-primary transition-all"
                                    type="text" value="{{ $barang->satuan }}" />
                            </div>
                            
                            {{-- TAMBAHAN INPUT STOK --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-[#0d141b] dark:text-slate-300">Jumlah Stok</label>
                                <input name="stok"
                                    class="w-full rounded-lg border-[#cfdbe7] dark:border-slate-700 bg-white dark:bg-slate-800 px-4 py-2.5 focus:ring-primary transition-all font-bold text-primary"
                                    type="number" value="{{ $barang->stok }}" />
                            </div>

                            <div class="space-y-2">
                                <label class="text-sm font-bold text-[#0d141b] dark:text-slate-300">Ambang Batas Minimum
                                    (Stok Kritis)</label>
                                <input name="stok_minimal"
                                    class="w-full rounded-lg border-[#cfdbe7] dark:border-slate-700 bg-white dark:bg-slate-800 px-4 py-2.5 focus:ring-primary transition-all"
                                    type="number" value="{{ $barang->stok_minimal }}" />
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </form>
    </main>
@endsection