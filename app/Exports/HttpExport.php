<?php

namespace App\Exports;

use App\Models\Alat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HttpExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Menyusun data yang akan diexport
        return Alat::where('protocol', 'http')->get()->map(function ($item) {
            return [
                'ID' => $item->id_alat,
                'Jenis Protokol' => $item->protocol,
                'Microcontroller' => $item->microcontroller,
                'MAC Address' => $item->mac_address,
                'IP Address' => $item->ip_address,
                'Throughput' => $item->data->pluck('throughput')->implode(', '),
                'Latency' => $item->data->pluck('latency')->implode(', '),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID', 'Jenis Protokol', 'Microcontroller', 'MAC Address', 'IP Address', 'Throughput', 'Latency'
        ];
    }
}
