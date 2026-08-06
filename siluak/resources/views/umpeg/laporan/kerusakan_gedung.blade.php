@extends('umpeg.layout.umpeg_portal')

@section('page_title', 'Daftar Laporan Kerusakan Gedung dan Bangunan')
@section('page_subtitle', 'Monitoring perbaikan gedung dan bangunan instansi.')

@section('content')

    <div class="px-8 pb-8">

        <x-table :headers="['Nama Pelapor', 'Bidang', 'No. Telepon', 'Gedung', 'Lokasi', 'Deskripsi', 'Foto', 'Status']">
            
            @forelse($items as $item)
            <tr class="hover:bg-slate-50 border-b border-slate-100 transition-colors">
                <td class="px-6 py-4">
                    <div class="flex flex-col">
                        <span class="text-sm font-bold text-slate-600">{{ $item->nama }}</span>
                        <!-- created at -->
                        <span class="text-xs text-slate-400 mt-1 font-normal flex items-center gap-1">
                            {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i') }}
                        </span>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm text-slate-600 font-medium">{{ $item->bidang }}</td>
                <td class="px-6 py-4 text-sm text-slate-700">{{ $item->telepon }}</td>
                <td class="px-6 py-4 text-sm text-slate-700">{{ $item->gedung }}</td>
                <td class="px-6 py-4 text-sm text-slate-700">{{ $item->lokasi }}</td>
                <td class="px-6 py-4 text-sm text-slate-700">{{ $item->deskripsi }}</td>
                
                <td class="px-6 py-4 text-center">
                    @if($item->foto)
                        <a href="{{ asset('storage/' . $item->foto) }}" target="_blank" 
                           class="inline-flex items-center justify-center w-8 h-8 border border-blue-200 rounded-md bg-blue-50 hover:bg-blue-100 transition text-blue-600"
                           title="Lihat Foto">
                            <i class="fa-regular fa-image"></i>
                        </a>
                    @else
                        <span class="text-slate-300 italic text-xs">N/A</span>
                    @endif
                </td>

                <td class="px-6 py-4">
                    <x-status :status="$item->status" />
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="px-6 py-12 text-sm text-center text-slate-400 italic">
                    Belum ada laporan kerusakan gedung yang masuk.
                </td>
            </tr>
            @endforelse

        </x-table>

    </div>

@endsection