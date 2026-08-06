<?php

namespace App\Exports;

use App\Models\BarangAtk;
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

class ManajemenExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithEvents
{
    /**
    * Mengambil data stok barang dan memformatnya
    */
    public function collection() {
        return BarangAtk::all()->map(function($item, $index) {
            return [
                $index + 1,                                     // A: NO
                '#ATK-' . $item->id,                            // B: ID BARANG
                $item->nama_barang,                             // C: NAMA BARANG
                $item->kategori,                                // D: KATEGORI
                $item->satuan,                                  // E: SATUAN
                $item->stok,                                    // F: SISA STOK
                $item->stok_minimal,                            // G: STOK MINIMAL
                $item->updated_at ? $item->updated_at->format('d-m-Y H:i') : '-' // H: TANGGAL UPDATE
            ];
        });
    }

    /**
    * Menentukan Header Tabel
    */
    public function headings(): array {
        return [
            'NO',
            'ID BARANG',
            'NAMA BARANG',
            'KATEGORI',
            'SATUAN',
            'SISA STOK',
            'STOK MINIMAL',
            'TANGGAL UPDATE'
        ];
    }

    /**
    * Style Header (Bold & Warna Biru Soft)
    */
    public function styles(Worksheet $sheet) {
        return [
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'DDEBF7'] // Warna biru soft untuk Manajemen Stok
                ]
            ],
        ];
    }

    /**
    * Mengatur Center Alignment dan Border secara dinamis
    */
    public function registerEvents(): array {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet;
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                // Terapkan Rata Tengah & Border hanya sampai data terakhir
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
            },
        ];
    }
}