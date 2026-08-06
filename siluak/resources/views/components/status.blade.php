@props(['status'])

@php
    $styles = [
        'Menunggu' => 'bg-orange-50 text-orange-600 border-orange-100',
        'Disetujui' => 'bg-blue-50 text-blue-600 border-blue-100',
        'Ditolak' => 'bg-red-50 text-red-600 border-red-100',
        'Selesai' => 'bg-emerald-50 text-emerald-600 border-emerald-100'
    ];
    $style = $styles[$status] ?? 'bg-slate-50 text-slate-600';
@endphp

<span class="px-3 py-1 text-[10px] font-bold uppercase rounded-full border {{ $style }}">
    {{ $status }}
</span>