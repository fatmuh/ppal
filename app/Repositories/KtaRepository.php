<?php

namespace App\Repositories;

use App\Models\Kta;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class KtaRepository
{
    public function generateTabulator(int $size = 10, array $filters = []): LengthAwarePaginator
    {
        $kta = DB::table('kta');

        foreach ($filters as $key => $value) {
            if ($key == 'value' && $value) {
                $kta->where('no_kta', 'like', "%{$value}%");
            } elseif ($key == 'name' && $value) {
                $kta->where('full_name', 'like', "%{$value}%");
            } elseif ($key == 'nik' && $value) {
                $kta->where('nik', 'like', "%{$value}%");
            }
        }

        $kta->orderByRaw("CASE WHEN no_kta REGEXP '^[IVXLCDM]+-[0-9]+-[0-9]+-[0-9]+$' THEN 0 ELSE 1 END")
            ->orderByRaw("CAST(SUBSTRING_INDEX(no_kta, '-', 1) AS CHAR)")
            ->orderByRaw("CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(no_kta, '-', -3), '-', 1) AS UNSIGNED)")
            ->orderByRaw("CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(no_kta, '-', -2), '-', 1) AS UNSIGNED)")
            ->orderByRaw("CAST(SUBSTRING_INDEX(no_kta, '-', -1) AS UNSIGNED)");

        return $kta->paginate($size);
    }

    public function countKtaGroups(): array
    {
        return DB::table('kta')
            ->selectRaw("SUBSTRING_INDEX(no_kta, '-', 1) as romawi_nomor, COUNT(*) as count")
            ->whereRaw("no_kta REGEXP '^[IVXLCDM]+-[0-9]+-[0-9]+-[0-9]+$'") // Pastikan hanya mengambil data sesuai format
            ->groupBy('romawi_nomor')
            ->orderBy('romawi_nomor')
            ->pluck('count', 'romawi_nomor')
            ->toArray();
    }

    public function getKtaById(int $id): Kta
    {
        return Kta::whereId($id)->firstOrFail();
    }

    public function getKtaByNoKtaNik($kta_nik): Kta
    {
        return Kta::where('no_kta', $kta_nik)
            ->orWhere('nik', $kta_nik)
            ->firstOrFail();
    }

    public function getKtaByNoKta(?string $no_kta): ?Kta
    {
        return Kta::where('no_kta', $no_kta)->first();
    }

    public function getKtaByNik(?string $nik): ?Kta
    {
        return Kta::where('nik', $nik)->first();
    }

    public function getTotalKta(): int
    {
        return Kta::count();
    }

    public function saveKta(
        ?string $no_kta,
        string $full_name,
        string $ttl,
        string $agama,
        string $gol_darah,
        string $pangkat_terakhir,
        string $nik,
        string $tanda_jasa_tertinggi,
        ?string $tanggal_cetak,
        string $istri_suami,
        ?string $nama_istri_suami,
        ?string $nik_istri_suami,
        string $alamat1,
        ?string $alamat2,
        string $wil_rayon,
    ): Kta {
        DB::beginTransaction();
        try {
            $kta = Kta::create([
                'no_kta'                => $no_kta,
                'full_name'             => $full_name,
                'ttl'                   => $ttl,
                'agama'                 => $agama,
                'gol_darah'             => $gol_darah,
                'pangkat_terakhir'      => $pangkat_terakhir,
                'nik'                   => $nik,
                'tanda_jasa_tertinggi'  => $tanda_jasa_tertinggi,
                'tanggal_cetak'         => $tanggal_cetak,
                'istri_suami'           => $istri_suami,
                'nama_istri_suami'      => $nama_istri_suami,
                'nik_istri_suami'       => $nik_istri_suami,
                'alamat1'               => $alamat1,
                'alamat2'               => $alamat2,
                'wil_rayon'             => $wil_rayon,
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return $kta;
    }

    public function updateKta(
        int $id,
        ?string $no_kta,
        string $full_name,
        string $ttl,
        string $agama,
        string $gol_darah,
        string $pangkat_terakhir,
        string $nik,
        string $tanda_jasa_tertinggi,
        ?string $tanggal_cetak,
        string $istri_suami,
        string $nama_istri_suami,
        string $nik_istri_suami,
        string $alamat1,
        ?string $alamat2,
        string $wil_rayon,
    ): Kta {
        DB::beginTransaction();
        try {
            $kta = $this->getKtaById($id);
            if (!$kta) {
                throw new ModelNotFoundException();
            }

            $kta->no_kta                = $no_kta;
            $kta->full_name             = $full_name;
            $kta->ttl                   = $ttl;
            $kta->agama                 = $agama;
            $kta->gol_darah             = $gol_darah;
            $kta->pangkat_terakhir      = $pangkat_terakhir;
            $kta->nik                   = $nik;
            $kta->tanda_jasa_tertinggi  = $tanda_jasa_tertinggi;
            $kta->tanggal_cetak         = $tanggal_cetak;
            $kta->istri_suami           = $istri_suami;
            $kta->nama_istri_suami      = $nama_istri_suami;
            $kta->nik_istri_suami       = $nik_istri_suami;
            $kta->alamat1               = $alamat1;
            $kta->alamat2               = $alamat2;
            $kta->wil_rayon             = $wil_rayon;

            $kta->save();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return $kta;
    }

    public function deleteKta(int $id): Kta
    {
        DB::beginTransaction();
        try {
            $kta = $this->getKtaById($id);
            if (!$kta) {
                throw new ModelNotFoundException();
            }

            $kta->delete();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return $kta;
    }
}
