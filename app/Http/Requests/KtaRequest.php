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
            'no_kta'                => ['required'],
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
}
