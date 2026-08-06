<?php

namespace App\Exports;

use App\Models\PengajuanBmd;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class BmdExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithEvents
{
    private $mergeRows = [];

    public function collection()
    {
        $rows = collect();
        $items = PengajuanBmd::all();
        $currentRow = 2;

        foreach ($items as $index => $item) {
            $requestItems = is_array($item->items) ? $item->items : json_decode($item->items, true);
            
            if (!empty($requestItems)) {
                $itemCount = count($requestItems);
                $this->mergeRows[] = [
                    'start' => $currentRow,
                    'end' => $currentRow + $itemCount - 1,
                ];

                foreach ($requestItems as $subIndex => $subItem) {
                    $rows->push([
                        'no' => ($subIndex == 0) ? $index + 1 : '',
                        'id_laporan' => '#BMD-' . $item->id,
                        'tanggal' => $item->created_at ? $item->created_at->format('d-m-Y') : '-',
                        'nama_pemohon' => $item->nama,
                        'bidang' => $item->bidang,
                        'kode_barang' => $item->kode ?? '-',
                        'nama_barang' => $subItem['nama_barang'] ?? '-',
                        'jumlah' => $subItem['jumlah'] ?? 0,
                        'satuan' => $subItem['satuan'] ?? '-',
                        'program' => $item->program ?? '-',
                        'kegiatan' => $item->kegiatan ?? '-',
                        'output' => $item->output ?? '-',
                        'alasan' => $item->keterangan ?? '-',
                        'status' => $item->status,
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
            'NO', 'ID LAPORAN', 'TANGGAL PENGAJUAN', 'NAMA PEMOHON', 'BIDANG',
            'KODE BARANG', 'NAMA BARANG', 'JUMLAH', 'SATUAN',
            'PROGRAM', 'KEGIATAN', 'OUTPUT', 'KETERANGAN/ALASAN', 'STATUS'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Hanya atur Bold untuk Header saja di sini
        return [
            1 => [
                'font' => ['bold' => true],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // 1. Dapatkan baris terakhir yang benar-benar ada datanya
                $highestRow = $event->sheet->getHighestRow();
                $highestColumn = $event->sheet->getHighestColumn();
                $fullRange = 'A1:' . $highestColumn . $highestRow;

                // 2. Terapkan Center Alignment & Border HANYA pada range data tersebut
                $event->sheet->getStyle($fullRange)->applyFromArray([
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

                // 3. Lakukan Merge Cells sesuai data yang dicatat
                foreach ($this->mergeRows as $row) {
                    if ($row['start'] !== $row['end']) {
                        $columnsToMerge = ['A', 'B', 'C', 'D', 'E', 'F', 'J', 'K', 'L', 'M', 'N', 'O'];
                        foreach ($columnsToMerge as $col) {
                            $event->sheet->mergeCells("{$col}{$row['start']}:{$col}{$row['end']}");
                        }
                    }
                }
            },
        ];
    }
}