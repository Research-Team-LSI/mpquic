<?php

namespace App\Exports;

use App\Models\Temperature;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TemperatureExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping, WithStyles
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {
        return Temperature::whereBetween('created_at', [$this->startDate, $this->endDate])
            ->orderBy('created_at') // Mengurutkan berdasarkan waktu
            ->get();
    }


    // public function collection()
    // {
    //     return Temperature::whereBetween('created_at', [$this->startDate, $this->endDate])
    //         ->selectRaw('DATE(created_at) as tanggal, AVG(nilai_temperature) as rata_rata_suhu')
    //         ->groupBy('tanggal')
    //         ->orderBy('tanggal')
    //         ->get();
    // }

    public function headings(): array
    {
        return [
            'No',
            'ID Alat',
            'Nilai Temperature',
            'Tanggal Dibuat',
            'Tanggal Diperbarui',
        ];
    }

    // public function headings(): array
    // {
    //     return [
    //         'No',
    //         'Tanggal',
    //         'Rata-rata Suhu',
    //     ];
    // }

    /**
     * @param  mixed  $row
     */

    public function map($row): array
    {
        static $number = 0;
        $number++;

        return [
            $number,
            $row->id_alat,          // ID alat
            $row->nilai_temperature,   // Nilai suhu
            $row->created_at,       // Tanggal dibuat
            $row->updated_at,       // Tanggal diperbarui
        ];
    }

    // public function map($row): array
    // {
    //     static $number = 0;
    //     $number++;

    //     return [
    //         $number,
    //         $row->tanggal,
    //         $row->rata_rata_suhu,
    //     ];
    // }

    /**
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        // Apply styles to the header row
        $sheet->getStyle('A1:E1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => Color::COLOR_WHITE],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF4CAF50'],
            ],
        ]);

        // Apply borders to all cells
        $sheet->getStyle('A1:E' . ($sheet->getHighestRow()))
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color(Color::COLOR_BLACK));

        return [];
    }
}
