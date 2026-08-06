@extends('admin.layout.master')

@section('navigation')
    @include('admin.layout.navigation')
@endsection

@section('content')
    {{-- Welcome Message Section --}}
    <div class="mb-8 p-6 bg-gradient-to-r from-primary/10 to-transparent border-l-4 border-primary rounded-r-xl">
        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">
            Selamat Datang, Admin! 👋
        </h3>
        <p class="text-slate-600 dark:text-[#92a4c9] text-sm leading-relaxed max-w-3xl">
            Di panel ini, Anda dapat memantau statistik Laporan dan mengelola layanan dengan mudah. Anda juga dapat melihat aktivitas terbaru serta laporan yang memerlukan tindakan segera. Anda juga dapat mengakses menu navigasi di sebelah kiri untuk mengakses berbagai menu yang tersedia.
        </p>
    </div>
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight">Ringkasan Layanan</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-1">Pantau kinerja sistem dan layanan terkini.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.layanan.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-primary hover:bg-blue-600 text-white rounded-lg text-sm font-medium transition-colors shadow-lg shadow-primary/20">
                <span class="material-symbols-outlined">add</span> Layanan Baru
            </a>
        </div>
    </div>

    {{-- Statistik Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
        <div
            class="p-5 rounded-xl bg-surface-light dark:bg-surface-dark border border-slate-200 shadow-sm flex flex-col gap-3 group">
            <div class="flex items-center justify-between">
                <div class="p-2 rounded-lg bg-blue-100 text-primary"><span
                        class="material-symbols-outlined">assignment_add</span></div>
                <span
                    class="text-xs font-medium {{ $persentaseKenaikan >= 0 ? 'text-emerald-500 bg-emerald-100' : 'text-red-500 bg-red-100' }} px-2 py-1 rounded-full flex items-center gap-1">
                    <span
                        class="material-symbols-outlined text-[14px]">{{ $persentaseKenaikan >= 0 ? 'trending_up' : 'trending_down' }}</span>
                    {{ abs($persentaseKenaikan) }}%
                </span>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Permohonan Baru</p>
                <p class="text-3xl font-bold text-slate-900 dark:text-white mt-1">{{ $permohonanBaru }}</p>
            </div>
        </div>

        <div
            class="p-5 rounded-xl bg-surface-light dark:bg-surface-dark border border-slate-200 shadow-sm flex flex-col gap-3 group">
            <div class="flex items-center justify-between">
                <div class="p-2 rounded-lg bg-orange-100 text-orange-500"><span
                        class="material-symbols-outlined">priority_high</span></div>
                <span
                    class="text-xs font-medium text-orange-500 bg-orange-100 px-2 py-1 rounded-full flex items-center gap-1">
                    {{ $persentasePerluTindakan }}%
                </span>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Perlu Tindakan</p>
                <p class="text-3xl font-bold text-slate-900 dark:text-white mt-1">{{ $perluTindakan }}</p>
            </div>
        </div>

        <div
            class="p-5 rounded-xl bg-surface-light dark:bg-surface-dark border border-slate-200 shadow-sm flex flex-col gap-3 group">
            <div class="flex items-center justify-between">
                <div class="p-2 rounded-lg bg-emerald-100 text-emerald-500"><span
                        class="material-symbols-outlined">check_circle</span></div>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Layanan Selesai</p>
                <p class="text-3xl font-bold text-slate-900 dark:text-white mt-1">{{ $layananSelesai }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
        {{-- Statistik Grafik --}}
        <div class="lg:col-span-2 p-6 rounded-xl bg-surface-light dark:bg-surface-dark border border-slate-200 shadow-sm">
            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6">Statistik Permohonan (Minggu Ini)</h3>
            <div class="relative h-64 w-full px-2">
                <svg class="w-full h-full overflow-visible" preserveAspectRatio="none" viewBox="0 0 800 200">
                    @php
                        $xCoords = [20, 146, 272, 398, 524, 650, 776]; // Jarak antar hari
                        $points = [];
                        foreach ($chartData as $index => $value) {
                            // Rumus: Koordinat Dasar(180) - (Nilai / Max * Tinggi Area(160))
                            $y = 180 - ($value / $maxData) * 160;
                            $points[] = "{$xCoords[$index]},{$y}";
                        }
                        $polylinePath = implode(' ', $points);
                    @endphp

                    {{-- Garis Latar (Grid) --}}
                    <line x1="0" y1="180" x2="800" y2="180" stroke="#e2e8f0" stroke-width="1" />
                    <line x1="0" y1="100" x2="800" y2="100" stroke="#f1f5f9" stroke-width="1" />
                    <line x1="0" y1="20" x2="800" y2="20" stroke="#f1f5f9" stroke-width="1" />

                    {{-- Garis Grafik Biru --}}
                    <polyline points="{{ $polylinePath }}" fill="none" stroke="#135bec" stroke-width="3"
                        stroke-linecap="round" stroke-linejoin="round" />

                    {{-- Titik-Titik Data --}}
                    @foreach ($chartData as $index => $value)
                        @php $y = 180 - ($value / $maxData * 160); @endphp
                        <circle class="fill-white stroke-primary cursor-pointer chart-dot" cx="{{ $xCoords[$index] }}"
                            cy="{{ $y }}" r="5" stroke-width="2" data-value="{{ $value }} Laporan">
                        </circle>
                    @endforeach
                </svg>
            </div>

            {{-- Label Hari (Senin s/d Minggu) --}}
            <div class="flex justify-between mt-4 text-[10px] sm:text-xs font-semibold text-slate-400">
                @php $startOfWeek = \Carbon\Carbon::now()->startOfWeek(); @endphp
                @for ($i = 0; $i < 7; $i++)
                    <span class="w-20 text-center">{{ $startOfWeek->copy()->addDays($i)->isoFormat('ddd') }}</span>
                @endfor
            </div>
        </div>

        {{-- Aktivitas Terbaru --}}
        <div class="p-6 rounded-xl bg-surface-light dark:bg-surface-dark border border-slate-200 shadow-sm">
            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6">Aktivitas Terbaru</h3>
            <div class="space-y-4">
                @forelse ($aktivitas as $akt)
                    <div class="flex gap-3">
                        <div
                            class="size-8 rounded-full bg-{{ $akt->color ?? 'blue' }}-100 flex items-center justify-center text-{{ $akt->color ?? 'blue' }}-500">
                            <span class="material-symbols-outlined text-[16px]">{{ $akt->icon ?? 'notifications' }}</span>
                        </div>
                        <div>
                            <p class="text-sm text-slate-800 dark:text-slate-200"><strong>{{ $akt->nama }}</strong>
                                mengajukan {{ $akt->type }}.</p>
                            <p class="text-xs text-slate-500">{{ $akt->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-500 italic">Belum ada aktivitas.</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Tabel Perlu Tindakan --}}
    <div class="mt-6 rounded-xl bg-surface-light dark:bg-surface-dark border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-200">
            <h3 class="text-lg font-bold text-slate-900 dark:text-white">Daftar Perlu Tindakan</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 dark:bg-slate-800 text-xs uppercase text-slate-500">
                    <tr>
                        <th class="px-6 py-4">Pemohon</th>
                        <th class="px-6 py-4">Layanan</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse ($layananPerluTindakan as $layanan)
                        <tr>
                            <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">{{ $layanan->nama }}</td>
                            <td class="px-6 py-4">{{ $layanan->jenis }}</td>
                            <td class="px-6 py-4">{{ $layanan->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-2 py-1 rounded-full bg-orange-100 text-orange-600 text-xs">{{ $layanan->status }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route($layanan->route_name, $layanan->id) }}"
                                    class="text-primary hover:text-blue-700 font-medium text-sm mr-3">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-500">Semua tugas sudah selesai
                                dikerjakan!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <style>
        .chart-tooltip {
            position: fixed;
            background: #0f172a;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            opacity: 0;
            transition: opacity 0.2s;
            pointer-events: none;
            z-index: 9999;
            font-weight: bold;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dots = document.querySelectorAll('.chart-dot');
            const tooltip = document.createElement('div');
            tooltip.className = 'chart-tooltip';
            document.body.appendChild(tooltip);

            dots.forEach(dot => {
                dot.addEventListener('mouseenter', function() {
                    tooltip.textContent = this.getAttribute('data-value');
                    tooltip.style.opacity = '1';
                });
                dot.addEventListener('mousemove', function(e) {
                    tooltip.style.left = (e.clientX + 10) + 'px';
                    tooltip.style.top = (e.clientY - 25) + 'px';
                });
                dot.addEventListener('mouseleave', () => tooltip.style.opacity = '0');
            });
        });
    </script>
@endsection
