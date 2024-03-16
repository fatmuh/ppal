<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KtaCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                    => $this->id,
            'no_kta'                => $this->no_kta ?? '-',
            'full_name'             => $this->full_name,
            'ttl'                   => $this->ttl,
            'agama'                 => $this->agama,
            'gol_darah'             => $this->gol_darah,
            'pangkat_terakhir'      => $this->pangkat_terakhir,
            'nik'                   => $this->nik,
            'tanda_jasa_tertinggi'  => $this->tanda_jasa_tertinggi,
            'tanggal_cetak'         => $this->tanggal_cetak,
            'foto'                  => $this->foto,
            'ttd'                   => $this->ttd,
            'istri_suami'           => $this->istri_suami,
            'nama_istri_suami'      => $this->nama_istri_suami,
            'nik_istri_suami'       => $this->nik_istri_suami,
            'alamat1'               => $this->alamat1,
            'alamat2'               => $this->alamat2,
            'wil_rayon'             => $this->wil_rayon,
            'card'          => [
                'front' => route('kta.front', $this->id),
                'back' => route('kta.back', $this->id),
            ],
            'urls'          => [
                'data_url'   => route('kta.detail.data', $this->id),
                'detail_url' => route('kta.detail', $this->id),
                'update_url' => route('kta.update', $this->id),
                'delete_url' => route('kta.delete', $this->id),
            ]
        ];
    }
}
