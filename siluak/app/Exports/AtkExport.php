<?php

namespace App\Exports;

use App\Models\Atk;
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

class AtkExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithEvents
{
    private $mergeRows = [];

    public function collection()
    {
        $rows = collect();
        $items = Atk::all();
        $currentRow = 2;

        foreach ($items as $index => $item) {
            $requestItems = is_array($item->items) ? $item->items : json_decode($item->items, true);
            
            if (!empty($requestItems)) {
                $itemCount = count($requestItems);
                
                $this->mergeRows[] = [
                    'start' => $currentRow,
                    'end' => $currentRow + $itemCount - 1,
                ];

                // Logika URL Nota: Jika ada file foto/nota
                $urlNota = $item->foto 
                    ? asset('storage/' . $item->foto) 
                    : 'Tidak Ada Nota';

                foreach ($requestItems as $subIndex => $subItem) {
                    $rows->push([
                        'no' => ($subIndex == 0) ? $index + 1 : '',
                        'tanggal' => $item->created_at ? $item->created_at->format('d-m-Y H:i') : '-',
                        'nama' => $item->nama,
                        'bidang' => $item->bidang,
                        'nama_barang' => $subItem['nama_barang'] ?? '-',
                        'jumlah_minta' => $subItem['jumlah'] ?? 0,
                        'jumlah_beri' => $subItem['diberikan'] ?? 0,
                        'satuan' => $subItem['satuan'] ?? '-',
                        'status' => $item->status,
                        'nota' => $urlNota, // Kolom J: Nota Dinas
                    ]);
                    $currentRow++;
                }
            }
        }
        return $rows;
    }

    public function headings(): array
    {
        return [
            'NO',
            'TANGGAL PENGAJUAN',
            'NAMA PEMOHON',
            'BIDANG',
            'NAMA BARANG',
            'PERMINTAAN',
            'DISETUJUI',
            'SATUAN',
            'STATUS',
            'NOTA DINAS'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E2EFDA']
                ]
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet;
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                // 1. Alignment Center & Border
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

                // 2. Merge Cells (Termasuk kolom J untuk Nota)
                foreach ($this->mergeRows as $row) {
                    if ($row['start'] !== $row['end']) {
                        $columnsToMerge = ['A', 'B', 'C', 'D', 'I', 'J'];
                        foreach ($columnsToMerge as $col) {
                            $sheet->mergeCells("{$col}{$row['start']}:{$col}{$row['end']}");
                        }
                    }
                }

                // 3. Aktivasi Hyperlink untuk Nota Dinas (Kolom J)
                for ($i = 2; $i <= $highestRow; $i++) {
                    $cell = $sheet->getCell('J' . $i);
                    $value = $cell->getValue();

                    if (str_contains($value, 'http')) {
                        $cell->getHyperlink()->setUrl($value);
                        $sheet->getStyle('J' . $i)->applyFromArray([
                            'font' => [
                                'color' => ['rgb' => '0000FF'],
                                'underline' => true
                            ]
                        ]);
                        $cell->setValue('Lihat Nota');
                    }
                }
            },
        ];
    }
}