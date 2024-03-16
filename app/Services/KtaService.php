<?php

namespace App\Services;

use App\Http\Requests\KtaRequest;
use App\Repositories\KtaRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KtaService
{
    public function __construct(
        protected KtaRepository $ktaRepository,
    ) {}

    public function fetchTabulator(Request $request): object
    {
        $filters = [
            'no_kta'    => null,
            'name'      => null,
            'nik'       => null,
        ];

        if ($request->has('filter')) {
            foreach ($request->get('filter') as $filter) {
                if ($filter['value'] != null && $filter['value'] != "") {
                    $filters[$filter['field']] = $filter['value'];
                }
            }
        }

        $result = $this->ktaRepository->generateTabulator(
            size: ($request->has('size')) ? $request->size : 10,
            filters: $filters
        );

        return (object) [
            'data' => $result
        ];
    }

    public function findKta(int $id): object
    {
        $result = $this->ktaRepository->getKtaById(id: $id);

        return (object) [
            'data' => $result
        ];
    }

    public function getDetail(int $id): array
    {
        $kta = $this->ktaRepository->getKtaById(id: $id);

        return compact('kta');
    }

    public function saveKta(KtaRequest $request): object
    {
        DB::beginTransaction();
        try {
            $kta = $this->ktaRepository->saveKta(
                no_kta: $request->no_kta,
                full_name: $request->full_name,
                ttl: $request->ttl,
                agama: $request->agama,
                gol_darah: $request->gol_darah,
                pangkat_terakhir: $request->pangkat_terakhir,
                nik: $request->nik,
                tanda_jasa_tertinggi: $request->tanda_jasa_tertinggi,
                tanggal_cetak: $request->tanggal_cetak,
                istri_suami: $request->istri_suami,
                nama_istri_suami: $request->nama_istri_suami,
                nik_istri_suami: $request->nik_istri_suami,
                alamat1: $request->alamat1,
                alamat2: $request->alamat2,
                wil_rayon: $request->wil_rayon,
            );

            if ($request->hasFile('foto')) {
                if ($request->has('foto') && $request->foto != null) {
                    if (!empty($kta->foto)) {
                        Storage::disk('ftp')->delete($kta->foto);
                    }
                    
                    $fotoFilePath = Storage::disk('ftp')->putFile('foto' , $request->foto);
                }
                $kta->foto = $fotoFilePath;
                $kta->save();
            }

            if ($request->hasFile('ttd')) {
                if ($request->has('ttd') && $request->ttd != null) {
                    if (!empty($kta->ttd)) {
                        Storage::disk('ftp')->delete($kta->ttd);
                    }
                    
                    $ttdFilePath = Storage::disk('ftp')->putFile('ttd' , $request->ttd);
                }
                $kta->ttd = $ttdFilePath;
                $kta->save();
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return (object) [
            'code'    => Response::HTTP_OK,
            'message' => 'Berhasil menambahkan data KTA!'
        ];
    }

    public function updateKta(KtaRequest $request, $id): object
    {
        DB::beginTransaction();
        try {
            $kta = $this->ktaRepository->updateKta(
                id: $id,
                no_kta: $request->no_kta,
                full_name: $request->full_name,
                ttl: $request->ttl,
                agama: $request->agama,
                gol_darah: $request->gol_darah,
                pangkat_terakhir: $request->pangkat_terakhir,
                nik: $request->nik,
                tanda_jasa_tertinggi: $request->tanda_jasa_tertinggi,
                tanggal_cetak: $request->tanggal_cetak,
                istri_suami: $request->istri_suami,
                nama_istri_suami: $request->nama_istri_suami,
                nik_istri_suami: $request->nik_istri_suami,
                alamat1: $request->alamat1,
                alamat2: $request->alamat2,
                wil_rayon: $request->wil_rayon,
            );

            if ($request->hasFile('foto')) {
                if ($request->has('foto') && $request->foto != null) {
                    if (!empty($kta->foto)) {
                        Storage::disk('ftp')->delete($kta->foto);
                    }
                    
                    $fotoFilePath = Storage::disk('ftp')->putFile('foto' , $request->foto);
                }
                $kta->foto = $fotoFilePath;
                $kta->save();
            }

            if ($request->hasFile('ttd')) {
                if ($request->has('ttd') && $request->ttd != null) {
                    if (!empty($kta->ttd)) {
                        Storage::disk('ftp')->delete($kta->ttd);
                    }
                    
                    $ttdFilePath = Storage::disk('ftp')->putFile('ttd' , $request->ttd);
                }
                $kta->ttd = $ttdFilePath;
                $kta->save();
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return (object) [
            'code'    => Response::HTTP_OK,
            'message' => 'Berhasil mengubah data KTA!'
        ];
    }

    public function deleteKta(int $id): object
    {
        try {
            $kta = $this->ktaRepository->getKtaById(id: $id);
            if (!$kta) {
                throw new ModelNotFoundException();
            }

            if($kta->foto != null && $kta->ttd != null) {
                Storage::disk(env('DISK_PUBLIC'))->delete($kta->foto);
                Storage::disk(env('DISK_PUBLIC'))->delete($kta->ttd);
            }
            
            $this->ktaRepository->deleteKta(
                id: $id,
            );
        } catch (\Throwable $e) {
            throw $e;
        }

        return (object) [
            'code'    => Response::HTTP_OK,
            'message' => 'Berhasil menghapus data KTA!'
        ];
    }
}
