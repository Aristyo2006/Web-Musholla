<?php

namespace App\Exports;

use App\Models\Campaign;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class DonationExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $campaign;
    protected $rowNumber = 1;

    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->campaign->donations()
            ->where('status', 'confirmed')
            ->latest()
            ->get();
    }

    public function headings(): array
    {
        return [
            ['LAPORAN DONASI - ' . strtoupper($this->campaign->title)],
            ['Tanggal Ekspor: ' . date('d F Y')],
            [''],
            [
                'NO',
                'NAMA DONATUR',
                'EMAIL',
                'ALAMAT',
                'JUMLAH (RP)',
                'CATATAN',
                'TANGGAL KONFIRMASI'
            ]
        ];
    }

    public function map($donation): array
    {
        return [
            $this->rowNumber++,
            $donation->donator_name,
            $donation->email ?? '-',
            $donation->donator_address ?? '-',
            $donation->amount, // We keep it as raw number for Excel to format/sum
            $donation->notes ?? '-',
            $donation->updated_at->format('d/m/Y H:i')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Merge Title rows
        $sheet->mergeCells('A1:G1');
        $sheet->mergeCells('A2:G2');

        // Style for Title
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Style for Date Export
        $sheet->getStyle('A2')->getFont()->setItalic(true);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Style for Table Headings (Row 4)
        $sheet->getStyle('A4:G4')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '059669'], // Emerald-600
            ],
        ]);

        // Add Borders to all data cells
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle('A4:G' . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'CCCCCC'],
                ],
            ],
        ]);

        // Format Amount column as Currency/Number (Now it's Column E)
        $sheet->getStyle('E5:E' . $lastRow)->getNumberFormat()->setFormatCode('#,##0');

        return [];
    }
}
