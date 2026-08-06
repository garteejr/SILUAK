<?php

namespace App\Exports;

use App\Models\KerusakanAlat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class PeralatanExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithEvents
{
    /**
    * Mengambil data dari database dan memformatnya
    */
    public function collection() {
        return KerusakanAlat::all()->map(function($item, $index) {
            return [
                $index + 1, // Menambah kolom No
                '#ALT-' . $item->id, // Menambahkan ID Laporan
                $item->nama, 
                $item->bidang, 
                $item->nama_alat, 
                $item->jenis_alat,
                $item->kerusakan, 
                $item->status, 
                $item->prioritas, 
                $item->created_at ? $item->created_at->format('d-m-Y H:i') : '-'
            ];
        });
    }

    /**
    * Menentukan Header Tabel
    */
    public function headings(): array {
        return [
            'NO',
            'ID LAPORAN',
            'NAMA PELAPOR',
            'BIDANG',
            'NAMA BARANG',
            'JENIS ALAT',
            'DETAIL KERUSAKAN',
            'STATUS',
            'PRIORITAS',
            'TANGGAL LAPOR'
        ];
    }

    /**
    * Styling dasar untuk Header
    */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true],
            ],
        ];
    }

    /**
    * Mengatur Alignment Center dan Border secara dinamis
    */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Mendapatkan koordinat baris dan kolom terakhir yang ada datanya
                $highestRow = $event->sheet->getHighestRow();
                $highestColumn = $event->sheet->getHighestColumn();
                $fullRange = 'A1:' . $highestColumn . $highestRow;

                // Terapkan format rata tengah dan border hanya pada range data
                $event->sheet->getStyle($fullRange)->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                        'wrapText' => true, // Agar teks panjang dalam kolom kerusakan otomatis rapi
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // Opsional: Memberikan warna latar belakang pada header agar lebih profesional
                $event->sheet->getStyle('A1:' . $highestColumn . '1')->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'E2E3E5'], // Warna abu-abu muda
                    ],
                ]);
            },
        ];
    }
}