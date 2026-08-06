@extends('admin.layout.master')

@section('navigation')
    @include('admin.layout.navigation')
@endsection

@section('content')
    <div class="flex-1 overflow-y-auto bg-background-light dark:bg-background-dark p-4 md:p-2">
        <div class="max-w-6xl mx-auto space-y-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2 mb-2 text-sm text-slate-500">
                        <a class="hover:text-primary transition-colors" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                        <span class="text-slate-800 dark:text-slate-200 font-medium">Buat Layanan</span>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight">Buat Layanan Baru</h2>
                    <p class="text-slate-500 dark:text-slate-400 mt-1">Tambahkan layanan baru yang akan tersedia di aplikasi.</p>
                </div>
            </div>

            <div class="bg-surface-light dark:bg-surface-dark border border-slate-200 dark:border-slate-800 rounded-xl shadow-sm overflow-hidden">
                <div class="p-6 md:p-8">
                    <form action="{{ route('admin.layanan.store') }}" method="POST">
                        @csrf {{-- Penting untuk mencegah 419 Page Expired --}}
                        
                        <div class="space-y-8">
                            {{-- Input Nama Layanan --}}
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300" for="service_name">
                                    Nama Layanan <span class="text-red-500">*</span>
                                </label>
                                <input required
                                    class="block w-full rounded-lg border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-primary focus:border-primary sm:text-sm py-2.5 px-3 shadow-sm placeholder:text-slate-400"
                                    id="service_name" name="nama_layanan" {{-- Sesuaikan dengan Controller --}}
                                    placeholder="Contoh: Pengajuan Cuti, Laporan Keuangan" type="text" />
                            </div>

                            {{-- Pilih Icon (Ditambah Lebih Banyak) --}}
                            <div class="space-y-3">
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                    Pilih Icon <span class="text-red-500">*</span>
                                </label>
                                <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 gap-3">
                                    {{-- Group 1: Dokumen & Tugas --}}
                                    @php
                                        $icons = [
                                            'description' => 'Docs', 'assignment' => 'Task', 'article' => 'Post', 
                                            'draw' => 'Sign', 'history_edu' => 'Write', 'folder' => 'Folder',
                                            'group' => 'People', 'person' => 'User', 'badge' => 'ID Card',
                                            'calendar_month' => 'Date', 'event' => 'Event', 'schedule' => 'Time',
                                            'payments' => 'Money', 'account_balance' => 'Bank', 'receipt_long' => 'Bill',
                                            'inventory_2' => 'Box', 'local_shipping' => 'Truck', 'store' => 'Store',
                                            'school' => 'Edu', 'auto_stories' => 'Book', 'military_tech' => 'Cert',
                                            'settings' => 'Gear', 'build' => 'Fix', 'construction' => 'Tools',
                                            'mail' => 'Email', 'campaign' => 'Info', 'support_agent' => 'Help'
                                        ];
                                    @endphp

                                    @foreach($icons as $val => $label)
                                    <div class="relative">
                                        <input class="icon-radio sr-only peer" id="icon_{{ $val }}" 
                                               name="icon" type="radio" value="{{ $val }}" 
                                               {{ $val == 'description' ? 'checked' : '' }} />
                                        <label class="flex flex-col items-center justify-center p-3 border border-slate-200 dark:border-slate-700 rounded-lg cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-800 transition-all peer-checked:border-primary peer-checked:bg-primary/5 peer-checked:text-primary text-slate-500 dark:text-slate-400"
                                            for="icon_{{ $val }}">
                                            <span class="material-symbols-outlined text-2xl mb-1">{{ $val }}</span>
                                            <span class="text-[9px] font-medium truncate w-full text-center">{{ $label }}</span>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Toggle Status --}}
                            <div class="p-4 rounded-lg bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700/50 flex items-center justify-between">
                                <div class="flex flex-col">
                                    <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">Status Aktif</span>
                                    <span class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Tampilkan layanan ini di sidebar menu.</span>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer" for="status_toggle">
                                    <input class="sr-only peer" id="status_toggle" name="status" type="checkbox" value="active" checked />
                                    <div class="w-11 h-6 bg-slate-200 peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary"></div>
                                </label>
                            </div>
                        </div>

                        {{-- Footer Buttons --}}
                        <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-slate-100 dark:border-slate-800">
                            <a href="{{ route('admin.dashboard') }}"
                                class="px-5 py-2.5 rounded-lg border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 text-sm font-semibold hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                                Batal
                            </a>
                            <button class="inline-flex items-center gap-2 px-6 py-2.5 rounded-lg bg-primary text-white text-sm font-semibold hover:bg-blue-600 shadow-lg shadow-primary/20 transition-all focus:ring-2 focus:ring-offset-2 focus:ring-primary"
                                type="submit">
                                <span class="material-symbols-outlined text-[18px]">save</span>
                                Simpan Layanan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection