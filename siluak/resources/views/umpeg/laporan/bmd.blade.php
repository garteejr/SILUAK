@extends('umpeg.layout.umpeg_portal')

<!-- header -->
@section('page_title', 'Daftar Kebutuhan BMD')
@section('page_subtitle', 'Daftar usulan pengadaan Barang Milik Daerah (BMD).')

@section('content')
    <div class="px-8 pb-8">
    <!-- pake table di components -->
        <x-table :headers="['Nama', 'Bidang', 'Kode', 'Program', 'Kegiatan', 'Output', 'Barang', 'Ket', 'Status']">
            
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
                <td class="px-6 py-4 text-sm text-slate-700">{{ $item->kode }}</td>
                <td class="px-6 py-4 text-sm text-slate-700">{{ $item->program }}</td>
                <td class="px-6 py-4 text-sm text-slate-700">{{ $item->kegiatan }}</td>
                <td class="px-6 py-4 text-sm text-slate-700">{{ $item->output }}</td>
                
                <!-- item listnyaa -->
                <td class="px-6 py-4">
                    <ul class="list-disc list-inside space-y-1 text-sm">
                        @foreach($item->items as $barang)
                            <li>
                                <span class="font-medium text-slate-700">{{ $barang['nama_barang'] }}</span> 
                                <span class="text-slate-500 text-xs">({{ $barang['jumlah'] }} {{ $barang['satuan'] }})</span>
                            </li>
                        @endforeach
                    </ul>
                </td>

                <td class="px-6 py-4 text-sm text-slate-700">{{ $item->keterangan }}</td>

                <!-- status dari components -->
                <td class="px-6 py-4">
                    <x-status :status="$item->status" />
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="px-6 py-12 text-sm text-center text-slate-400 italic">Belum ada usulan yang masuk.</td>
            </tr>
            @endforelse

        </x-table>
    </div>
@endsection