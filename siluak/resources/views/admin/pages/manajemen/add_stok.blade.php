@extends('admin.layout.master')

@section('navigation')
    @include('admin.layout.navigation')
@endsection

@section('content')
<div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4">
    <div class="bg-white dark:bg-sidebar-dark w-full max-w-2xl rounded-3xl shadow-2xl border border-slate-200 dark:border-slate-800 overflow-hidden">
        
        <div class="px-8 py-6 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-slate-800 dark:text-white">Tambah Stok Baru</h2>
                <p class="text-sm text-slate-500 dark:text-slate-400">Silakan isi formulir di bawah ini untuk menambah stok gudang.</p>
            </div>
            <a href="{{ route('admin.manajemen.index') }}" class="p-2 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-full text-slate-400">
                <span class="material-symbols-outlined">close</span>
            </a>
        </div>

        <form action="{{ route('admin.manajemen.store') }}" method="POST" class="p-8 space-y-2">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                {{-- Nama Barang dengan Datalist (Bisa pilih yang ada atau ketik baru) --}}
                <div class="md:col-span-2 space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Nama Barang</label>
                    <input type="text" name="nama_barang" list="barang_list" required 
                           class="w-full bg-slate-50 dark:bg-slate-900 border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm focus:ring-primary focus:border-primary" 
                           placeholder="Ketik atau pilih nama barang...">
                    <datalist id="barang_list">
                        @foreach($daftarBarang as $db)
                            <option value="{{ $db->nama_barang }}">
                        @endforeach
                    </datalist>
                </div>

                {{-- Kategori --}}
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Kategori</label>
                    <select name="kategori" required class="w-full bg-slate-50 dark:bg-slate-900 border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm focus:ring-primary">
                        <option value="Kertas">Kertas</option>
                        <option value="Alat Tulis">Alat Tulis</option>
                        <option value="Arsip">Arsip</option>
                        <option value="Kebersihan">Kebersihan</option>
                        <option value="Lain-lain">Lain-lain</option>
                    </select>
                </div>

                {{-- Satuan --}}
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Satuan</label>
                    <select name="satuan" required class="w-full bg-slate-50 dark:bg-slate-900 border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm focus:ring-primary">
                        <option value="Rim">Rim</option>
                        <option value="Pcs">Pcs</option>
                        <option value="Lusin">Lusin</option>
                        <option value="Unit">Unit</option>
                        <option value="Pack">Pak</option>
                    </select>
                </div>

                {{-- Jumlah Stok --}}
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Jumlah Stok Masuk</label>
                    <input type="number" name="stok" min="1" required 
                           class="w-full bg-slate-50 dark:bg-slate-900 border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm focus:ring-primary" 
                           placeholder="0">
                </div>

                {{-- Jumlah Stok minimal --}}
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Stok Minimal</label>
                    <input type="number" name="stok_minimal" min="0" required 
                           class="w-full bg-slate-50 dark:bg-slate-900 border-slate-200 dark:border-slate-800 rounded-xl px-4 py-3 text-sm focus:ring-primary" 
                           placeholder="0">
                </div>

                {{-- Tanggal (Informasi saja) --}}
                <div class="md:col-span-2 space-y-2">
                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Tanggal Masuk</label>
                    <input type="date" value="{{ date('Y-m-d') }}" readonly 
                           class="w-full bg-slate-100 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-sm text-slate-500">
                </div>
            </div>

            <div class="pt-6 flex items-center justify-end gap-3 border-t border-slate-100 dark:border-slate-800">
                <a href="{{ route('admin.manajemen.index') }}" class="px-6 py-2.5 bg-white text-slate-600 rounded-xl text-sm font-semibold border border-slate-200 hover:bg-slate-50 transition-all">
                    Batal
                </a>
                <button type="submit" class="px-8 py-2.5 bg-primary text-white rounded-xl text-sm font-semibold shadow-lg shadow-blue-500/30 hover:bg-blue-700 transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">save</span>
                    Simpan Stok
                </button>
            </div>
        </form>
    </div>
</div>
@endsection