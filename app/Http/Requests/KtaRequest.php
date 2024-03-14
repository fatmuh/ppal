<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KtaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'no_kta'                => ['nullable'],
            'full_name'             => ['required'],
            'ttl'                   => ['required'],
            'agama'                 => ['required'],
            'gol_darah'             => ['required'],
            'pangkat_terakhir'      => ['required'],
            'nik'                   => ['required'],
            'tanda_jasa_tertinggi'  => ['required'],
            'tanggal_cetak'         => ['nullable'],
            'foto'                  => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg', 'max:4096'],
            'ttd'                   => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg', 'max:4096'],
            'istri_suami'           => ['required'],
            'nama_istri_suami'      => ['nullable'],
            'nik_istri_suami'       => ['nullable'],
            'alamat1'               => ['required'],
            'alamat2'               => ['nullable'],
            'wil_rayon'             => ['required'],
        ];
    }

    public function attributes(): array
    {
        return [
            'no_kta'                => 'Nomor KTA',
            'full_name'             => 'Nama lengkap',
            'ttl'                   => 'Tempat, tanggal lahir',
            'agama'                 => 'Agama',
            'gol_darah'             => 'Golongan darah',
            'pangkat_terakhir'      => 'Pangkat terakhir',
            'nik'                   => 'Nomor Induk Kependudukan (NIK)',
            'tanda_jasa_tertinggi'  => 'Tanda jasa tertinggi',
            'tanggal_cetak'         => 'Tanggal cetak',
            'foto'                  => 'Foto',
            'ttd'                   => 'Tanda tangan',
            'istri_suami'           => 'Istri/suami',
            'nama_istri_suami'      => 'Nama istri/suami',
            'nik_istri_suami'       => 'NIK istri/suami',
            'alamat1'               => 'Alamat 1',
            'alamat2'               => 'Alamat 2',
            'wil_rayon'             => 'Wilayah/rayon',
        ];
    }
}
