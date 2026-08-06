@extends('umpeg.layout.umpeg_portal')

@section('page_title', 'Daftar Laporan Kerusakan Alat Kantor')
@section('page_subtitle', 'Monitoring dan pelaporan kerusakan fasilitas kantor.')

@section('content')

    <div class="px-8 pb-8">

        <x-table :headers="['Nama Pelapor', 'Bidang', 'Jenis Alat', 'Nama Barang', 'Deskripsi', 'Status']">
            
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
                <td class="px-6 py-4 text-sm text-slate-700">{{ $item->bidang }}</td>
                <td class="px-6 py-4 text-sm text-slate-700">{{ $item->jenis_alat }}</td>
                <td class="px-6 py-4 text-sm text-slate-700">{{ $item->nama_alat }}</td>
                <td class="px-6 py-4 text-sm text-slate-700">{{ $item->kerusakan }}</td>
                
                <td class="px-6 py-4">
                    <x-status :status="$item->status" />
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-12 text-sm text-center text-slate-400 italic">
                    Belum ada laporan kerusakan yang masuk.
                </td>
            </tr>
            @endforelse

        </x-table>

    </div>

@endsection