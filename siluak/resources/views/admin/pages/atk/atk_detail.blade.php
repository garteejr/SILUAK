@extends('admin.layout.master')
@section('navigation')
    @include('admin.layout.navigation') 
@endsection
@section('content')
        <main class="flex-1 overflow-y-auto bg-background-light dark:bg-background-dark p-2 md:p-2">
            <div class="max-w-6xl mx-auto space-y-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <a class="p-1 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-500 transition-colors"
                                href="#">
                                <span class="material-symbols-outlined">arrow_back</span>
                            </a>
                            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Detail Aplikasi Magang</h1>
                        </div>
                        <div class="flex items-center gap-2 text-slate-500 dark:text-slate-400 ml-9">
                            <span>ID: #INT-2024-892</span>
                            <span class="size-1 rounded-full bg-slate-300 dark:bg-slate-600"></span>
                            <span>Didaftarkan 2 hari yang lalu</span>
                        </div>
                    </div>
                    <div class="flex gap-3 w-full md:w-auto">
                        <button
                            class="flex-1 md:flex-none justify-center inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 hover:border-red-200 dark:hover:border-red-800 transition-colors">
                            <span class="material-symbols-outlined text-[18px]">close</span>
                            Tolak
                        </button>
                        <button
                            class="flex-1 md:flex-none justify-center inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                            <span class="material-symbols-outlined text-[18px]">calendar_month</span>
                            Jadwal Interview
                        </button>
                        <button
                            class="flex-1 md:flex-none justify-center inline-flex items-center gap-2 px-4 py-2 bg-primary hover:bg-blue-600 text-white rounded-lg text-sm font-medium transition-colors shadow-lg shadow-primary/20">
                            <span class="material-symbols-outlined text-[18px]">check</span>
                            Terima Magang
                        </button>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 space-y-6">
                        <div
                            class="bg-surface-light dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-6">
                            <div class="flex flex-col sm:flex-row gap-6">
                                <div class="shrink-0 flex justify-center sm:justify-start">
                                    <div class="size-24 rounded-xl bg-slate-200 dark:bg-slate-700 bg-center bg-cover ring-4 ring-slate-50 dark:ring-slate-800"
                                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCP2iElDzSvcEAaaLNiJDh2bsOuglkPTXaTRWgEIZCoSKc_MEH3DPZ5QCQowgxFKh9xUUH6VdtHhC_j2XM03RWREZObYqGSsXhCeq8ibj2-uoJhva93WgFGpdXM07v1DGpPmxvOyMTuXgqcaZ3IrwQ5bFnCSt3dxl5ILuKnrU6uTFAiQRWFzScY2Uxsc6YqhKtRkqqE5WIvsy93iULrGFkfLFAXavOLfjbyVLyOBn5xXBQhSW-BFEvTlQlhQAhrmB7ljhCG3r4ZdqSN");'>
                                    </div>
                                </div>
                                <div class="flex-1 text-center sm:text-left">
                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                        <h2 class="text-xl font-bold text-slate-900 dark:text-white">Rizky Ramadhan
                                        </h2>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 self-center sm:self-auto">
                                            Frontend Developer Intern
                                        </span>
                                    </div>
                                    <p class="text-slate-500 dark:text-slate-400 mt-1">Mahasiswa Teknik Informatika -
                                        Universitas Indonesia</p>
                                    <div class="flex flex-wrap justify-center sm:justify-start gap-4 mt-4">
                                        <a class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-primary transition-colors"
                                            href="mailto:rizky.ramadhan@example.com">
                                            <span class="material-symbols-outlined text-[18px]">mail</span>
                                            rizky.ramadhan@example.com
                                        </a>
                                        <a class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-primary transition-colors"
                                            href="tel:+6281234567890">
                                            <span class="material-symbols-outlined text-[18px]">call</span>
                                            +62 812-3456-7890
                                        </a>
                                        <div
                                            class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-300">
                                            <span class="material-symbols-outlined text-[18px]">location_on</span>
                                            Jakarta Selatan
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-6 border-slate-100 dark:border-slate-700/50" />
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white mb-3">Detail
                                        Pendidikan</h3>
                                    <ul class="space-y-4">
                                        <li
                                            class="relative pl-4 border-l-2 border-slate-200 dark:border-slate-700 pb-1">
                                            <div
                                                class="absolute -left-[5px] top-1.5 size-2.5 rounded-full bg-slate-300 dark:bg-slate-600">
                                            </div>
                                            <p class="text-sm font-medium text-slate-900 dark:text-white">S1 Teknik
                                                Informatika</p>
                                            <p class="text-xs text-slate-500">Universitas Indonesia • 2021 - Sekarang
                                            </p>
                                            <p class="text-xs text-slate-500 mt-0.5">IPK: 3.85 / 4.00</p>
                                        </li>
                                        <li class="relative pl-4 border-l-2 border-slate-200 dark:border-slate-700">
                                            <div
                                                class="absolute -left-[5px] top-1.5 size-2.5 rounded-full bg-slate-300 dark:bg-slate-600">
                                            </div>
                                            <p class="text-sm font-medium text-slate-900 dark:text-white">SMA Negeri 1
                                                Jakarta</p>
                                            <p class="text-xs text-slate-500">IPA • 2018 - 2021</p>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white mb-3">Skills &amp;
                                        Keahlian</h3>
                                    <div class="flex flex-wrap gap-2">
                                        <span
                                            class="px-2.5 py-1 rounded-md bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-xs font-medium border border-slate-200 dark:border-slate-700">HTML5
                                            / CSS3</span>
                                        <span
                                            class="px-2.5 py-1 rounded-md bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-xs font-medium border border-slate-200 dark:border-slate-700">JavaScript
                                            (ES6+)</span>
                                        <span
                                            class="px-2.5 py-1 rounded-md bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-xs font-medium border border-slate-200 dark:border-slate-700">React.js</span>
                                        <span
                                            class="px-2.5 py-1 rounded-md bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-xs font-medium border border-slate-200 dark:border-slate-700">Tailwind
                                            CSS</span>
                                        <span
                                            class="px-2.5 py-1 rounded-md bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-xs font-medium border border-slate-200 dark:border-slate-700">Git</span>
                                        <span
                                            class="px-2.5 py-1 rounded-md bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-xs font-medium border border-slate-200 dark:border-slate-700">UI/UX
                                            Basic</span>
                                    </div>
                                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white mt-6 mb-3">Tautan
                                        Portfolio</h3>
                                    <div class="space-y-2">
                                        <a class="flex items-center gap-2 text-sm text-primary hover:underline"
                                            href="#">
                                            <span class="material-symbols-outlined text-[16px]">link</span>
                                            github.com/rizkyramadhan
                                        </a>
                                        <a class="flex items-center gap-2 text-sm text-primary hover:underline"
                                            href="#">
                                            <span class="material-symbols-outlined text-[16px]">link</span>
                                            linkedin.com/in/rizkyramadhan
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="bg-surface-light dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-6">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Dokumen Pendukung</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div
                                    class="group relative flex items-center p-3 rounded-lg border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors cursor-pointer">
                                    <div
                                        class="size-10 rounded bg-red-100 dark:bg-red-900/30 text-red-600 flex items-center justify-center mr-3">
                                        <span class="material-symbols-outlined">picture_as_pdf</span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-slate-900 dark:text-white truncate">
                                            Curriculum Vitae (CV).pdf</p>
                                        <p class="text-xs text-slate-500">2.4 MB • Diupload 24 Okt 2023</p>
                                    </div>
                                    <button class="text-slate-400 group-hover:text-primary transition-colors">
                                        <span class="material-symbols-outlined">download</span>
                                    </button>
                                </div>
                                <div
                                    class="group relative flex items-center p-3 rounded-lg border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors cursor-pointer">
                                    <div
                                        class="size-10 rounded bg-blue-100 dark:bg-blue-900/30 text-blue-600 flex items-center justify-center mr-3">
                                        <span class="material-symbols-outlined">description</span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-slate-900 dark:text-white truncate">
                                            Transkrip Nilai.pdf</p>
                                        <p class="text-xs text-slate-500">1.8 MB • Diupload 24 Okt 2023</p>
                                    </div>
                                    <button class="text-slate-400 group-hover:text-primary transition-colors">
                                        <span class="material-symbols-outlined">download</span>
                                    </button>
                                </div>
                                <div
                                    class="group relative flex items-center p-3 rounded-lg border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors cursor-pointer">
                                    <div
                                        class="size-10 rounded bg-purple-100 dark:bg-purple-900/30 text-purple-600 flex items-center justify-center mr-3">
                                        <span class="material-symbols-outlined">image</span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-slate-900 dark:text-white truncate">
                                            Portfolio_Design.pdf</p>
                                        <p class="text-xs text-slate-500">5.2 MB • Diupload 24 Okt 2023</p>
                                    </div>
                                    <button class="text-slate-400 group-hover:text-primary transition-colors">
                                        <span class="material-symbols-outlined">download</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div
                            class="bg-surface-light dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-6">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Surat Motivasi</h3>
                            <div
                                class="p-4 bg-slate-50 dark:bg-slate-800/50 rounded-lg border border-slate-100 dark:border-slate-700/50 text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                                <p class="mb-3">Yth. Bapak/Ibu HRD,</p>
                                <p class="mb-3">Saya Rizky Ramadhan, mahasiswa semester 7 Teknik Informatika
                                    Universitas Indonesia, bermaksud mengajukan lamaran magang untuk posisi Frontend
                                    Developer.</p>
                                <p class="mb-3">Saya memiliki ketertarikan yang mendalam pada pengembangan antarmuka
                                    pengguna web. Selama kuliah, saya telah mengerjakan berbagai proyek web menggunakan
                                    React.js dan Tailwind CSS. Saya sangat ingin belajar lebih dalam mengenai best
                                    practice pengembangan software di lingkungan profesional.</p>
                                <p>Terima kasih atas waktu dan pertimbangan Bapak/Ibu.</p>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-1 space-y-6">
                        <div
                            class="bg-surface-light dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-6">
                            <h3
                                class="text-sm font-semibold text-slate-900 dark:text-white uppercase tracking-wider mb-4">
                                Status Lamaran</h3>
                            <div class="flex flex-col gap-4">
                                <div
                                    class="p-4 rounded-lg bg-orange-50 dark:bg-orange-900/20 border border-orange-100 dark:border-orange-800/50 flex items-start gap-3">
                                    <span class="material-symbols-outlined text-orange-500 mt-0.5">hourglass_top</span>
                                    <div>
                                        <p class="text-sm font-bold text-orange-700 dark:text-orange-400">Menunggu
                                            Review</p>
                                        <p class="text-xs text-orange-600/80 dark:text-orange-400/70 mt-1">Lamaran ini
                                            belum direview oleh tim rekrutmen.</p>
                                    </div>
                                </div>
                                <div class="space-y-3 pt-2">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-slate-500 dark:text-slate-400">Posisi</span>
                                        <span class="font-medium text-slate-900 dark:text-white">Frontend Dev</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-slate-500 dark:text-slate-400">Departemen</span>
                                        <span class="font-medium text-slate-900 dark:text-white">IT &amp;
                                            Engineering</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-slate-500 dark:text-slate-400">Durasi</span>
                                        <span class="font-medium text-slate-900 dark:text-white">3 Bulan</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-slate-500 dark:text-slate-400">Tanggal Mulai</span>
                                        <span class="font-medium text-slate-900 dark:text-white">1 Jan 2024</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="bg-surface-light dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3
                                    class="text-sm font-semibold text-slate-900 dark:text-white uppercase tracking-wider">
                                    Catatan Internal</h3>
                                <button class="text-xs text-primary hover:underline">Edit</button>
                            </div>
                            <textarea
                                class="w-full text-sm rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-primary focus:border-primary placeholder-slate-400 dark:placeholder-slate-500"
                                placeholder="Tambahkan catatan untuk tim HR..." rows="3"></textarea>
                            <button
                                class="w-full mt-3 py-2 text-sm font-medium text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 rounded-lg transition-colors">
                                Simpan Catatan
                            </button>
                        </div>
                        <div
                            class="bg-surface-light dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-6">
                            <h3
                                class="text-sm font-semibold text-slate-900 dark:text-white uppercase tracking-wider mb-6">
                                Riwayat Tindakan</h3>
                            <div
                                class="relative pl-4 space-y-6 before:absolute before:inset-y-0 before:left-1.5 before:w-0.5 before:bg-slate-200 dark:before:bg-slate-800">
                                <div class="relative">
                                    <div
                                        class="absolute -left-[19px] top-1 size-3 bg-white dark:bg-surface-dark border-2 border-primary rounded-full">
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-slate-900 dark:text-white">Lamaran Diterima
                                            Sistem</p>
                                        <p class="text-xs text-slate-500 mt-0.5">24 Okt 2023, 10:30 WIB</p>
                                        <p class="text-xs text-slate-500 mt-1">Otomatis oleh Sistem</p>
                                    </div>
                                </div>
                                <div class="relative">
                                    <div
                                        class="absolute -left-[19px] top-1 size-3 bg-white dark:bg-surface-dark border-2 border-slate-300 dark:border-slate-600 rounded-full">
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-slate-900 dark:text-white">Email Konfirmasi
                                            Terkirim</p>
                                        <p class="text-xs text-slate-500 mt-0.5">24 Okt 2023, 10:31 WIB</p>
                                    </div>
                                </div>
                                <div class="relative">
                                    <div
                                        class="absolute -left-[19px] top-1 size-3 bg-white dark:bg-surface-dark border-2 border-slate-300 dark:border-slate-600 rounded-full">
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-slate-900 dark:text-white">Dokumen Diunduh
                                        </p>
                                        <p class="text-xs text-slate-500 mt-0.5">25 Okt 2023, 09:15 WIB</p>
                                        <p class="text-xs text-slate-500 mt-1">oleh Budi Santoso</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection 