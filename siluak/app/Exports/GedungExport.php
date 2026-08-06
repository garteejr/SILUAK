<?php

namespace App\Exports;

use App\Models\KerusakanGedung;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class GedungExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithEvents, WithDrawings
{
    /**
     * Mengambil dan memetakan data dari database
     */
    public function collection()
    {
        return KerusakanGedung::all()->map(function ($item, $index) {
            return [
                $index + 1,                    // A: NO
                '#GDG-' . $item->id,           // B: ID LAPORAN
                $item->nama,                    // C: NAMA PELAPOR
                $item->telepon,                 // D: NOMOR HP
                $item->bidang,                  // E: BIDANG
                $item->gedung,                  // F: GEDUNG
                $item->lokasi,                  // G: LOKASI
                $item->deskripsi,               // H: DETAIL KERUSAKAN
                '',                             // I: FOTO (Akan diisi oleh drawings)
                $item->status,                  // J: STATUS
                $item->prioritas,               // K: PRIORITAS
                $item->created_at ? $item->created_at->format('d-m-Y H:i') : '-' // L: TANGGAL
            ];
        });
    }

    /**
     * Menempatkan gambar ke kolom FOTO (Kolom I)
     */
    public function drawings()
    {
        $drawings = [];
        $items = KerusakanGedung::all();

        foreach ($items as $index => $item) {
            $imagePath = storage_path('app/public/' . $item->foto);
            
            if ($item->foto && file_exists($imagePath)) {
                $drawing = new Drawing();
                $drawing->setName('Foto Kerusakan');
                $drawing->setDescription($item->nama);
                $drawing->setPath($imagePath);
                $drawing->setHeight(50); 
                // Diubah ke 'I' karena kolom FOTO ada di urutan ke-9
                $drawing->setCoordinates('I' . ($index + 2)); 
                // Mengatur offset agar gambar berada di tengah sel
                $drawing->setOffsetX(5);
                $drawing->setOffsetY(5);
                $drawings[] = $drawing;
            }
        }

        return $drawings;
    }

    /**
     * Judul kolom Excel
     */
    public function headings(): array
    {
        return [
            'NO',
            'ID LAPORAN',
            'NAMA PELAPOR',
            'NOMOR HP',
            'BIDANG',
            'GEDUNG',
            'LOKASI',
            'DETAIL KERUSAKAN',
            'FOTO',
            'STATUS',
            'PRIORITAS',
            'TANGGAL LAPOR'
        ];
    }

    /**
     * Styling Bold untuk Header
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E2E3E5'] // Abu-abu muda untuk header
                ]
            ],
        ];
    }

    /**
     * Pengaturan Border, Alignment, dan Tinggi Baris
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();
                $fullRange = 'A1:' . $highestColumn . $highestRow;

                // 1. Mengatur tinggi baris untuk semua data agar gambar muat
                for ($i = 2; $i <= $highestRow; $i++) {
                    $sheet->getDelegate()->getRowDimension($i)->setRowHeight(55);
                }

                // 2. Terapkan Alignment Center dan Border ke seluruh tabel
                $sheet->getStyle($fullRange)->applyFromArray([
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

                // 3. Khusus kolom Detail Kerusakan (H) rata kiri agar lebih enak dibaca jika panjang
                $sheet->getStyle('H2:H' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}