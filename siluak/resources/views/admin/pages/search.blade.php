@extends('admin.layout.master')
@section('navigation')
    @include('admin.layout.navigation')
@endsection
@section('content')
<div class="p-3">
    <div class="mb-3">
        <h2 class="text-2xl font-bold text-slate-900">Hasil Pencarian</h2>
        <p class="text-slate-500">Kata kunci: "{{ $query }}"</p>
    </div>

    @php $hasResults = false; @endphp

    @php
        $sections = [
            [
                'data' => $pengajuanBmd, 
                'title' => 'Pengajuan BMD', 
                'field' => 'nama', 
                'sub' => 'program', 
                'route' => 'admin.bmd.detail',
                'is_clickable' => true
            ],
            [
                'data' => $kerusakanAlat, 
                'title' => 'Kerusakan Alat', 
                'field' => 'nama', 
                'sub' => 'nama_alat', 
                'route' => 'admin.laporan.peralatan.detail',
                'is_clickable' => true
            ],
            [
                'data' => $kerusakanGedung, 
                'title' => 'Kerusakan Gedung', 
                'field' => 'nama', 
                'sub' => 'gedung', 
                'route' => 'admin.laporan.gedung.detail',
                'is_clickable' => true
            ],
            [
                'data' => $peminjamanKendaraan, 
                'title' => 'Peminjaman Kendaraan', 
                'field' => 'nama', 
                'sub' => 'jenis_kendaraan', 
                'route' => null, 
                'is_clickable' => false 
            ],
            [
                'data' => $peminjamanRuangan, 
                'title' => 'Peminjaman Ruangan', 
                'field' => 'nama', 
                'sub' => 'ruangan', 
                'route' => 'admin.peminjaman.ruang_detail',
                'is_clickable' => false
            ],
            [
                'data' => $permintaanAtk, 
                'title' => 'Permintaan ATK', 
                'field' => 'nama', 
                'sub' => 'bidang', 
                'route' => 'admin.atk.detail', 
                'is_clickable' => false
            ],
        ];
    @endphp

    @foreach($sections as $section)
        @if($section['data']->count() > 0)
            @php $hasResults = true; @endphp
            <div class="mb-8 bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
                <div class="bg-slate-50 px-4 py-3 border-b border-slate-200">
                    <h3 class="font-bold text-slate-700">{{ $section['title'] }} ({{ $section['data']->count() }})</h3>
                </div>
                <div class="divide-y divide-slate-100">
                    @foreach($section['data'] as $item)
                        @if($section['is_clickable'])
                            <a href="{{ route($section['route'], $item->id) }}" 
                               class="p-4 flex justify-between items-center hover:bg-slate-50 transition-all group cursor-pointer block">
                        @else
                            <div class="p-4 flex justify-between items-center bg-white">
                        @endif
                            
                            <div class="flex-1">
                                <p class="font-bold text-slate-900 {{ $section['is_clickable'] ? 'group-hover:text-blue-600' : '' }} transition-colors">
                                    {{ $item->{$section['field']} ?? 'Tanpa Nama' }}
                                </p>
                                <p class="text-sm text-slate-500 mt-1">
                                    {{ $item->{$section['sub']} ?? 'Detail tidak tersedia' }} — 
                                    <span class="text-slate-400">{{ $item->created_at->format('d M Y') }}</span>
                                </p>
                            </div>

                            <div class="flex items-center gap-4">
                                {{-- Badge Status --}}
                                <span class="px-3 py-1 text-[11px] font-bold rounded-full uppercase tracking-tight
                                    {{ $item->status == 'Selesai' || $item->status == 'Disetujui' ? 'bg-emerald-50 text-emerald-600' : 'bg-orange-50 text-orange-600' }}">
                                    {{ $item->status }}
                                </span>
                                
                                {{-- Ikon Panah hanya tampil jika bisa diklik --}}
                                @if($section['is_clickable'])
                                    <span class="material-symbols-outlined text-slate-300 group-hover:text-blue-500 group-hover:translate-x-1 transition-all">
                                        chevron_right
                                    </span>
                                @endif
                            </div>

                        @if($section['is_clickable'])
                            </a>
                        @else
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach

    @if(!$hasResults)
        <div class="text-center py-20 bg-white rounded-xl border border-dashed border-slate-300">
            <div class="text-slate-400 mb-2">
                <span class="material-symbols-outlined text-6xl">search_off</span>
            </div>
            <p class="text-slate-500 font-medium">Tidak ada hasil yang ditemukan untuk "{{ $query }}"</p>
            <p class="text-sm text-slate-400 mt-1">Coba gunakan kata kunci lain atau periksa ejaan Anda.</p>
        </div>
    @endif
</div>
@endsection