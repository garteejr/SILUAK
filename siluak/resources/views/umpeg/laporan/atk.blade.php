@extends('umpeg.layout.umpeg_portal')

@section('page_title', 'Daftar Permohonan ATK')
@section('page_subtitle', 'Daftar pengajuan alat tulis kantor untuk kebutuhan operasional.')

@section('content')

    <div class="px-8 pb-8">

        <x-table :headers="['Nama Pemohon', 'Bidang', 'Detail Barang', 'Status']">
            
            @forelse($items as $item)
            <tr class="hover:bg-slate-50 border-b border-slate-100 transition-colors align-top">
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
                
                <!-- Kolom Detail Barang (Gabungan Nama, Jumlah, & Realisasi) -->
                <td class="px-6 py-4">
                    <ul class="space-y-2">
                        @php 
                            // kalau belum di-casting di Model
                            $barangList = is_array($item->items) ? $item->items : json_decode($item->items, true); 
                        @endphp
                        
                        @foreach($barangList as $barang)
                        <li class="text-sm border-b border-slate-50 last:border-0 pb-2">
                            <!-- Nama Barang -->
                            <div class="font-medium text-slate-700 flex items-center gap-2">
                                <i class="fas fa-caret-right text-slate-300 text-xs"></i>
                                {{ $barang['nama_barang'] ?? $barang['nama'] }}
                            </div>
                            
                            <!-- Baris Info Jumlah -->
                            <div class="pl-4 mt-0.5 flex gap-3 text-xs">
                                <!-- Jumlah Pengajuan -->
                                <span class="text-slate-500">
                                    Jumlah: <span class="font-bold text-slate-700">{{ $barang['jumlah'] }} {{ $barang['satuan'] }}</span>
                                </span>

                                <!-- Jumlah Diberi (Hanya muncul jika sudah diproses) -->
                                @if($item->status == 'Selesai' || $item->status == 'Disetujui')
                                    <span class="text-blue-600 bg-blue-50 px-1.5 rounded border border-blue-100">
                                        Diberi: <b>{{ $barang['diberikan'] }} {{ $barang['satuan'] }}</b>
                                    </span>
                                @elseif($item->status == 'Ditolak')
                                    <span class="text-red-500 italic">Ditolak</span>
                                @else
                                    <span class="text-slate-400 italic">(Proses)</span>
                                @endif
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </td>

                <td class="px-6 py-4">
                    <x-status :status="$item->status" />
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-12 text-sm text-center text-slate-400 italic">
                    Belum ada data permohonan ATK yang diajukan.
                </td>
            </tr>
            @endforelse

        </x-table>

    </div>

@endsection