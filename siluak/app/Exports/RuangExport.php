<?php

namespace App\Exports;

use App\Models\PeminjamanRuangan;
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
use Carbon\Carbon;

class RuangExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithEvents
{
    /**
    * Mengambil data dan memformat kolom sesuai kebutuhan instansi
    */
    public function collection() {
        return PeminjamanRuangan::all()->map(function($item, $index) {
            // Logika Hyperlink Surat (jika user sudah upload)
            $urlSurat = $item->surat_permohonan 
                ? asset('storage/' . $item->surat_permohonan) 
                : 'Belum Upload';

            return [
                $index + 1,                                     // A: NO
                '#RNG-' . $item->id,                            // B: ID LAPORAN
                $item->nama,                                    // C: NAMA PEMINJAM
                $item->bidang,                                  // D: BIDANG
                $item->ruangan,                                 // E: RUANGAN
                $item->acara,                                   // F: ACARA
                // Format Tanggal saja (tanpa jam)
                $item->tanggal ? Carbon::parse($item->tanggal)->format('d-m-Y') : '-', // G: TANGGAL
                $item->waktu_mulai,                             // H: MULAI
                $item->waktu_selesai,                           // I: SELESAI
                $item->status,                                  // J: STATUS
            ];
        });
    }

    /**
    * Header Tabel
    */
    public function headings(): array {
        return [
            'NO',
            'ID LAPORAN',
            'NAMA PEMINJAM',
            'BIDANG',
            'RUANGAN',
            'NAMA ACARA',
            'TANGGAL PINJAM',
            'JAM MULAI',
            'JAM SELESAI',
            'STATUS',
        ];
    }

    /**
    * Style Header (Bold & Warna)
    */
    public function styles(Worksheet $sheet) {
        return [
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'FFF2CC'] // Warna kuning soft untuk Ruangan
                ]
            ],
        ];
    }

    /**
    * Mengatur Center Alignment, Border, dan Link Klik
    */
    public function registerEvents(): array {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet;
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                // 1. Terapkan Rata Tengah & Border Dinamis
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

                // 2. Mengaktifkan Hyperlink pada Kolom Surat (K)
                for ($i = 2; $i <= $highestRow; $i++) {
                    $cell = $sheet->getCell('K' . $i);
                    $value = $cell->getValue();

                    if (str_contains($value, 'http')) {
                        $cell->getHyperlink()->setUrl($value);
                        $sheet->getStyle('K' . $i)->applyFromArray([
                            'font' => [
                                'color' => ['rgb' => '0000FF'],
                                'underline' => true
                            ]
                        ]);
                        $cell->setValue('Lihat Surat'); // Teks yang tampil di sel
                    }
                }
            },
        ];
    }
}