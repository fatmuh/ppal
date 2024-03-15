<?php

namespace App\Exports;

use App\Models\Kta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportKtaForImport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kta::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'no_kta',
            'full_name',
            'ttl',
            'agama',
            'gol_darah',
            'pangkat_terakhir',
            'nik',
            'tanda_jasa_tertinggi',
            'tanggal_cetak',
            'foto',
            'ttd',
            'istri_suami',
            'nama_istri_suami',
            'nik_istri_suami',
            'alamat1',
            'alamat2',
            'wil_rayon',
            'created_at',
            'updated_at',
        ];
    }
}
