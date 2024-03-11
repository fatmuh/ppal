<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kta extends Model
{
    use HasFactory;

    protected $table = 'kta';
    
    protected $fillable = [
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
    ];
}
