@extends('admin.layout.master')
@section('navigation')
    @include('admin.layout.navigation')
@endsection
@section('content')
    <main class="flex-1 overflow-y-auto bg-background-light dark:bg-background-dark p-4 md:p-4">
        <div class="max-w-7xl mx-auto space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 mb-1">
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight">Detail
                            Pemakaian Ruang Rapat</h2>
                        <span
                            class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400 border border-orange-200 dark:border-orange-800">
                            Menunggu Persetujuan
                        </span>
                    </div>
                    <p class="text-slate-500 dark:text-slate-400">ID Permohonan: <span
                            class="font-mono text-slate-700 dark:text-slate-300">#REQ-2024-005</span> • Diajukan
                        pada 24 Okt 2023</p>
                </div>
                <div class="flex gap-3">
                    <button
                        class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        Kembali
                    </button>
                    <button
                        class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">print</span>
                        Cetak
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <div
                        class="p-6 rounded-xl bg-surface-light dark:bg-surface-dark border border-slate-200 dark:border-slate-800 shadow-sm">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100 dark:border-slate-800">
                            <div class="p-2 rounded-lg bg-primary/10 text-primary">
                                <span class="material-symbols-outlined">meeting_room</span>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white">Informasi Kegiatan</h3>
                        </div>
                        <div class="space-y-6">
                            <div>
                                <label
                                    class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Judul
                                    Rapat</label>
                                <p class="text-lg font-medium text-slate-900 dark:text-white">Koordinasi Strategi
                                    Q4 &amp; Perencanaan 2025</p>
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Deskripsi
                                    &amp; Agenda</label>
                                <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                                    Rapat internal divisi pemasaran untuk mengevaluasi kinerja kuartal ketiga dan
                                    menyusun strategi pemasaran digital untuk akhir tahun. Termasuk pembahasan
                                    budget tahun depan dan alokasi sumber daya tim.
                                </p>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div class="flex items-start gap-3">
                                    <span class="material-symbols-outlined text-slate-400 mt-0.5">calendar_today</span>
                                    <div>
                                        <p class="text-xs text-slate-500">Tanggal Pelaksanaan</p>
                                        <p class="text-sm font-medium text-slate-900 dark:text-white">Senin, 30 Okt
                                            2023</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <span class="material-symbols-outlined text-slate-400 mt-0.5">schedule</span>
                                    <div>
                                        <p class="text-xs text-slate-500">Waktu &amp; Durasi</p>
                                        <p class="text-sm font-medium text-slate-900 dark:text-white">09:00 - 11:30
                                            WIB (2.5 Jam)</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <span class="material-symbols-outlined text-slate-400 mt-0.5">location_on</span>
                                    <div>
                                        <p class="text-xs text-slate-500">Ruangan</p>
                                        <p class="text-sm font-medium text-slate-900 dark:text-white">Ruang Rapat
                                            Utama (Lt. 2)</p>
                                        <p class="text-xs text-emerald-600 dark:text-emerald-400">Available</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <span class="material-symbols-outlined text-slate-400 mt-0.5">group</span>
                                    <div>
                                        <p class="text-xs text-slate-500">Jumlah Peserta</p>
                                        <p class="text-sm font-medium text-slate-900 dark:text-white">15 Orang</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="p-6 rounded-xl bg-surface-light dark:bg-surface-dark border border-slate-200 dark:border-slate-800 shadow-sm">
                        <div class="flex items-center gap-3 mb-6">
                            <div
                                class="p-2 rounded-lg bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400">
                                <span class="material-symbols-outlined">inventory_2</span>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white">Fasilitas Tambahan</h3>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div
                                class="flex items-center p-3 rounded-lg border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50">
                                <span class="material-symbols-outlined text-primary mr-3">check_box</span>
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Projector
                                    &amp; Screen</span>
                            </div>
                            <div
                                class="flex items-center p-3 rounded-lg border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50">
                                <span class="material-symbols-outlined text-primary mr-3">check_box</span>
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Whiteboard
                                    &amp; Markers</span>
                            </div>
                            <div
                                class="flex items-center p-3 rounded-lg border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50">
                                <span class="material-symbols-outlined text-primary mr-3">check_box</span>
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Sound
                                    System</span>
                            </div>
                            <div
                                class="flex items-center p-3 rounded-lg border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50">
                                <span class="material-symbols-outlined text-primary mr-3">check_box</span>
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Snack
                                        Box</span>
                                    <span class="text-xs text-slate-500">15 Pax (Pagi)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="space-y-6">
                    <div
                        class="p-6 rounded-xl bg-surface-light dark:bg-surface-dark border border-slate-200 dark:border-slate-800 shadow-sm ring-1 ring-primary/5 dark:ring-primary/10">
                        <h3 class="text-base font-bold text-slate-900 dark:text-white mb-4">Aksi Admin</h3>
                        <div class="flex flex-col gap-3">
                            <button
                                class="w-full flex justify-center items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm font-semibold transition-colors shadow-lg shadow-emerald-600/20">
                                <span class="material-symbols-outlined text-[20px]">check</span>
                                Setujui Permohonan
                            </button>
                            <button
                                class="w-full flex justify-center items-center gap-2 px-4 py-2.5 bg-white dark:bg-surface-dark border border-red-200 dark:border-red-900/50 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg text-sm font-semibold transition-colors">
                                <span class="material-symbols-outlined text-[20px]">close</span>
                                Tolak
                            </button>
                            <button
                                class="w-full flex justify-center items-center gap-2 px-4 py-2.5 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 rounded-lg text-sm font-medium transition-colors">
                                <span class="material-symbols-outlined text-[20px]">edit</span>
                                Edit Detail
                            </button>
                        </div>
                        <div class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-800">
                            <label class="block text-xs font-medium text-slate-500 mb-2">Catatan Admin
                                (Opsional)</label>
                            <textarea
                                class="w-full text-sm rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-primary focus:border-primary"
                                placeholder="Tambahkan catatan untuk pemohon..." rows="3"></textarea>
                        </div>
                    </div>
                    <div
                        class="p-6 rounded-xl bg-surface-light dark:bg-surface-dark border border-slate-200 dark:border-slate-800 shadow-sm">
                        <h3 class="text-base font-bold text-slate-900 dark:text-white mb-4">Data Pemohon</h3>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="size-12 rounded-full bg-slate-200 dark:bg-slate-700 bg-center bg-cover"
                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDJX93716d0uRGqbssygAI8akjBVon8yCleAFlVie7YDEhat8aCCmsdksASXShAC0gsnmT3pNqevpytek95-owuCWa-eJ1SMgpGfUNpTC-8l-Qa5DMdbVF1iAkJkStUUggna512KGoG62_fofMGogssZRjDppb1uXLq4T59XcmK6m3mZ7lwpUuILhOb78R1xxcYNjmqD9a4pZg6Ulj2wRvuR9jGWnWZ9XNCjBq1e9pS4wbpul57vdWfAozFJ0CuGPKptMd8SQH3dJ7L");'>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-900 dark:text-white">Sarah Wijaya</p>
                                <p class="text-xs text-slate-500">NIP: 19900312 201502 2 001</p>
                            </div>
                        </div>
                        <div class="space-y-3 pt-3 border-t border-slate-100 dark:border-slate-800">
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">Divisi</span>
                                <span class="font-medium text-slate-900 dark:text-white">Human Resources</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">Jabatan</span>
                                <span class="font-medium text-slate-900 dark:text-white">Senior Staff</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">Email</span>
                                <span
                                    class="font-medium text-primary cursor-pointer hover:underline truncate ml-4">sarah.w@company.com</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">WhatsApp</span>
                                <span class="font-medium text-slate-900 dark:text-white">+62 812-3456-7890</span>
                            </div>
                        </div>
                    </div>
                    <div
                        class="p-6 rounded-xl bg-surface-light dark:bg-surface-dark border border-slate-200 dark:border-slate-800 shadow-sm">
                        <h3 class="text-base font-bold text-slate-900 dark:text-white mb-4">Riwayat Status</h3>
                        <div class="relative pl-4 border-l-2 border-slate-200 dark:border-slate-700 space-y-6">
                            <div class="relative">
                                <span
                                    class="absolute -left-[21px] top-1 size-3 rounded-full bg-slate-300 dark:bg-slate-600 ring-4 ring-white dark:ring-background-dark"></span>
                                <p class="text-sm font-medium text-slate-900 dark:text-white">Permohonan Dibuat</p>
                                <p class="text-xs text-slate-500 mt-0.5">24 Okt 2023, 09:15</p>
                            </div>
                            <div class="relative">
                                <span
                                    class="absolute -left-[21px] top-1 size-3 rounded-full bg-slate-300 dark:bg-slate-600 ring-4 ring-white dark:ring-background-dark"></span>
                                <p class="text-sm font-medium text-slate-900 dark:text-white">Verifikasi Manajer
                                </p>
                                <p class="text-xs text-slate-500 mt-0.5">24 Okt 2023, 10:30 • oleh Bpk. Hartono</p>
                            </div>
                            <div class="relative">
                                <span
                                    class="absolute -left-[21px] top-1 size-3 rounded-full bg-orange-500 ring-4 ring-orange-100 dark:ring-orange-900/30"></span>
                                <p class="text-sm font-bold text-orange-600 dark:text-orange-400">Menunggu
                                    Persetujuan Admin</p>
                                <p class="text-xs text-slate-500 mt-0.5">Sekarang</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </div>
@endsection
