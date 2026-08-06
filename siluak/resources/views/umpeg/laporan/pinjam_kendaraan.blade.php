@extends('umpeg.layout.umpeg_portal')

@section('page_title', 'Daftar Peminjaman Kendaraan Dinas')
@section('page_subtitle', 'Monitoring dan pengajuan izin penggunaan kendaraan operasional.')

@section('content')

    <div class="px-8 pb-8">

        <x-table :headers="['Nama Peminjam', 'Bidang', 'Kendaraan', 'Tujuan', 'Waktu Pinjam', 'Dokumen', 'Status']">
            
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
                <td class="px-6 py-4 text-sm text-slate-700">{{ $item->jenis_kendaraan }}</td>
                <td class="px-6 py-4 text-sm text-slate-700">{{ $item->tujuan }}</td>
                <td class="px-6 py-4">
                    <div class="text-sm font-medium text-slate-700">
                        {{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d/m/Y') }}
                    </div>
                    <div class="text-[10px] text-slate-400 tracking-wider my-0.5">s/d</div>
                    <div class="text-sm font-medium text-slate-700">
                        {{ \Carbon\Carbon::parse($item->tgl_kembali)->format('d/m/Y') }}
                    </div>
                </td>
                
                <td class="px-2 py-4 text-center">
                    <div class="flex flex-col gap-2 w-fit mx-auto">
                        <a href="{{ route('umpeg.pinjam_kendaraan.download', $item->id) }}" 
                        class="inline-flex items-center justify-center gap-1.5 px-1.5 py-1 bg-white border border-slate-200 rounded text-[10px] font-bold text-slate-600 hover:text-blue-600 hover:border-blue-200 transition shadow-sm w-full">
                            <i class="fa-solid fa-download"></i> UNDUH SURAT
                        </a>
                        @if($item->surat_permohonan)
                            <a href="{{ asset('storage/' . $item->surat_permohonan) }}" target="_blank" 
                            class="inline-flex items-center justify-center gap-1.5 px-1.5 py-1 bg-blue-50 border border-blue-100 rounded text-[10px] font-bold text-blue-600 hover:bg-blue-100 transition w-full">
                                <i class="fa-solid fa-eye"></i> LIHAT SCAN
                            </a>
                        @else
                            <form action="{{ route('umpeg.pinjam_kendaraan.upload', $item->id) }}" method="POST" enctype="multipart/form-data" class="w-full max-w-[140px]">
                                @csrf
                                <div class="flex flex-col gap-1">
                                    <input type="file" name="surat" required
                                           class="block w-full text-[9px] text-slate-500
                                                  file:mr-2 file:py-1 file:px-2
                                                  file:rounded file:border-0
                                                  file:text-[9px] file:font-semibold
                                                  file:bg-slate-100 file:text-slate-700
                                                  hover:file:bg-slate-200 cursor-pointer">
                                    
                                    <button type="submit" class="w-full bg-slate-800 text-white text-[9px] font-bold py-1 rounded hover:bg-slate-700 transition">
                                        UPLOAD SCAN
                                    </button>
                                </div>
                            </form>
                        @endif

                    </div>
                </td>

                <td class="px-6 py-4">
                    <x-status :status="$item->status" />
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="px-6 py-12 text-sm text-center text-slate-400 italic">
                    Belum ada permohonan peminjaman kendaraan yang masuk.
                </td>
            </tr>
            @endforelse

        </x-table>

    </div>

@endsection