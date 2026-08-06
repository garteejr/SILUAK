@extends('umpeg.layout.umpeg_portal')

@section('page_title', 'Daftar Peminjaman Ruangan Rapat')
@section('page_subtitle', 'Reservasi penggunaan ruang pertemuan dan aula kantor.')

@section('content')

    <div class="px-8 pb-8">

        <x-table :headers="['Nama Peminjam', 'Bidang', 'Ruangan', 'Acara', 'Tanggal', 'Waktu', 'Status']">
            
            @forelse($items as $item)
            <tr class="hover:bg-slate-50 border-b border-slate-100 transition-colors">
                <td class="px-6 py-4">
                    <div class="flex flex-col">
                        <span class="text-sm font-bold text-slate-600">{{ $item->nama }}</span>
                        <!-- created at -->
                        <span class="text-xs text-slate-400 mt-1 font-normal flex gap-1">
                            {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i') }}
                        </span>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm text-slate-600 font-medium">{{ $item->bidang }}</td>
                <td class="px-6 py-4 text-sm font-slate-700">{{ $item->ruangan }}</td>
                <td class="px-6 py-4 text-sm text-slate-700">{{ $item->acara }}</td>

                <!-- format tanggal -->
                <td class="px-6 py-4 text-sm text-slate-700">
                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                </td>

                <!-- format waktu -->
                <td class="px-6 py-4 text-sm text-slate-700">
                    {{ $item->waktu_mulai }} - {{ $item->waktu_selesai }}
                </td>

                <td class="px-6 py-4">
                    <x-status :status="$item->status" />
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="px-6 py-12 text-sm text-center text-slate-400 italic">
                    Belum ada jadwal peminjaman ruangan.
                </td>
            </tr>
            @endforelse

        </x-table>

    </div>

@endsection