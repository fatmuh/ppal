<?php

namespace App\Exports;

use App\Models\Kta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportKta implements FromCollection, WithHeadings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kta::select([
            'no_kta',
            'full_name',
            'ttl',
            'agama',
            'gol_darah',
            'pangkat_terakhir',
            'nik',
            'tanda_jasa_tertinggi',
            'tanggal_cetak',
            'istri_suami',
            'nama_istri_suami',
            'nik_istri_suami',
            'alamat1',
            'alamat2',
            'wil_rayon',
        ])->get();
    }

    public function headings(): array
    {
        return [
            'Nomor KTA',
            'Nama Lengkap',
            'Tempat, Tanggal Lahir',
            'Agama',
            'Golongan Darah',
            'Pangkat Terakhir',
            'NIK',
            'Tanda Jasa',
            'Tanggal Cetak',
            'Istri/Suami',
            'Nama Istri/Suami',
            'NIK Istri/Suami',
            'Alamat 1',
            'Alamat 2',
            'Wilayah/Rayon',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Apply border to all cells
                $event->sheet->getDelegate()->getStyle('A1:' . $event->sheet->getDelegate()->getHighestColumn() . $event->sheet->getDelegate()->getHighestRow())
                    ->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => ['argb' => '000000'],
                            ],
                        ],
                    ]);

                // Apply background color to headings
                $event->sheet->getDelegate()->getStyle('A1:' . $event->sheet->getDelegate()->getHighestColumn() . '1')
                    ->applyFromArray([
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'startColor' => [
                                'argb' => '22d3ee', // Adjust this to your desired color
                            ],
                        ],
                    ]);
            },
        ];
    }
}
