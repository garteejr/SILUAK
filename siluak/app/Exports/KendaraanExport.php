<?php

namespace App\Exports;

use App\Models\PeminjamanKendaraan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class KendaraanExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithEvents
{
    public function collection() {
        return PeminjamanKendaraan::all()->map(function($item, $index) {
            // Logika Link Surat: Jika ada file, buat link ke URL storage
            $urlSurat = $item->surat_permohonan 
                ? asset('storage/' . $item->surat_permohonan) 
                : 'Belum Upload';

            return [
                $index + 1,                                     // A: NO
                '#KND-' . $item->id,                            // B: ID LAPORAN
                $item->jenis_kendaraan,                         // C: KENDARAAN
                $item->nama,                                    // D: NAMA PEMINJAM
                $item->bidang,                                  // E: BIDANG
                // Format tanggal jadwal tanpa jam
                \Carbon\Carbon::parse($item->tgl_pinjam)->format('d-m-Y') . ' s/d ' . 
                \Carbon\Carbon::parse($item->tgl_kembali)->format('d-m-Y'), // F: JADWAL
                $item->tujuan,                                  // G: TUJUAN
                $item->status ?? 'Pending',                     // H: STATUS
                $urlSurat,                                      // I: SURAT (Link)
                $item->created_at->format('d-m-Y H:i')          // J: TANGGAL INPUT
            ];
        });
    }

    public function headings(): array {
        return [
            'NO',
            'ID LAPORAN',
            'KENDARAAN',
            'NAMA PEMINJAM',
            'BIDANG',
            'JADWAL PINJAM',
            'TUJUAN',
            'STATUS',
            'SURAT PERMOHONAN',
            'TANGGAL INPUT'
        ];
    }

    public function styles(Worksheet $sheet) {
        return [
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D9EAD3']
                ]
            ],
        ];
    }

    public function registerEvents(): array {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet;
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                // 1. Terapkan Rata Tengah & Border
                $sheet->getStyle("A1:{$highestColumn}{$highestRow}")->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                        'wrapText' => true,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // 2. Ubah Kolom Surat (I) menjadi Hyperlink Biru jika berisi link
                for ($i = 2; $i <= $highestRow; $i++) {
                    $cell = $sheet->getCell('I' . $i);
                    $value = $cell->getValue();

                    if (str_contains($value, 'http')) {
                        $cell->getHyperlink()->setUrl($value);
                        $sheet->getStyle('I' . $i)->applyFromArray([
                            'font' => [
                                'color' => ['rgb' => '0000FF'],
                                'underline' => true
                            ]
                        ]);
                        $cell->setValue('Lihat Surat'); // Ubah teks link agar rapi
                    }
                }
            },
        ];
    }
}