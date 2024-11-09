<?php

namespace App\Services;

use App\Http\Requests\KtaRequest;
use App\Repositories\KtaRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

    public function countKtaGroups(): array
    {
        $count = $this->ktaRepository->countKtaGroups();

        return compact('count');
    }

    public function getDataKta($search)
    {
        // Menggunakan parameter search langsung
        $kta = $this->ktaRepository->getKtaByNoKtaNik($search);

        return compact('kta');
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
            if($request->no_kta != null) {
                $findKta = $this->ktaRepository->getKtaByNoKta($request->no_kta);
                if ($findKta) {
                    return (object) [
                        'code'    => Response::HTTP_BAD_REQUEST,
                        'message' => 'No. KTA sudah ada sebelumnya!'
                    ];
                }
            }

            if($request->nik != null) {
                $findNik = $this->ktaRepository->getKtaByNik($request->nik);
                if ($findNik) {
                    return (object) [
                        'code'    => Response::HTTP_BAD_REQUEST,
                        'message' => 'NIK sudah ada sebelumnya!'
                    ];
                }
            }
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
                nama_istri_suami: $request->nama_istri_suami ?? '-',
                nik_istri_suami: $request->nik_istri_suami ?? '-',
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
            'message' => 'Berhasil menambahkan data KTA! ' . $request->no_kta
        ];
    }

    public function updateKtaLanding(KtaRequest $request, $id): object
    {
        DB::beginTransaction();
        try {
            $findData = $this->ktaRepository->getKtaById(id: $id);

            if($request->nik != null && $request->nik != $findData->nik) {
                $findNik = $this->ktaRepository->getKtaByNik($request->nik);
                if ($findNik) {
                    return (object) [
                        'code'    => Response::HTTP_BAD_REQUEST,
                        'message' => 'NIK sudah ada sebelumnya!'
                    ];
                }
            }

            $this->ktaRepository->updateKta(
                id: $id,
                no_kta: $findData->no_kta,
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
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return (object) [
            'code'    => Response::HTTP_OK,
            'message' => 'Berhasil mengubah data KTA! ' . $request->no_kta
        ];
    }

    public function updateKta(KtaRequest $request, $id): object
    {
        DB::beginTransaction();
        try {
            $findData = $this->ktaRepository->getKtaById(id: $id);
            if($request->no_kta != null && $request->no_kta != $findData->no_kta) {
                $findKta = $this->ktaRepository->getKtaByNoKta($request->no_kta);
                if ($findKta) {
                    return (object) [
                        'code'    => Response::HTTP_BAD_REQUEST,
                        'message' => 'No. KTA sudah ada sebelumnya!'
                    ];
                }
            }

            if($request->nik != null && $request->nik != $findData->nik) {
                $findNik = $this->ktaRepository->getKtaByNik($request->nik);
                if ($findNik) {
                    return (object) [
                        'code'    => Response::HTTP_BAD_REQUEST,
                        'message' => 'NIK sudah ada sebelumnya!'
                    ];
                }
            }

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
                    // Pastikan $kta->foto adalah path sebelum mencoba menghapusnya
                    if (!empty($kta->foto) && Str::startsWith($kta->foto, 'foto/')) {
                        Storage::disk('ftp')->delete($kta->foto);
                    }

                    try {
                        // Coba simpan file ke FTP
                        $fotoFilePath = Storage::disk('ftp')->putFile('foto' , $request->foto);

                        // Jika berhasil, simpan path ke dalam kolom foto
                        $kta->foto = $fotoFilePath;
                    } catch (\Exception $e) {
                        // Jika terjadi error, simpan dalam format base64
                        $file = $request->file('foto');
                        $fotoBase64 = base64_encode(file_get_contents($file));
                        $kta->foto = $fotoBase64;
                    }

                    // Simpan perubahan pada database
                    $kta->save();
                }
            }

            if ($request->hasFile('ttd')) {
                if ($request->has('ttd') && $request->ttd != null) {
                    // Pastikan $kta->ttd adalah path sebelum mencoba menghapusnya
                    if (!empty($kta->ttd) && Str::startsWith($kta->ttd, 'ttd/')) {
                        Storage::disk('ftp')->delete($kta->ttd);
                    }

                    try {
                        // Coba simpan file ke FTP
                        $ttdFilePath = Storage::disk('ftp')->putFile('ttd' , $request->ttd);

                        // Jika berhasil, simpan path ke dalam kolom ttd
                        $kta->ttd = $ttdFilePath;
                    } catch (\Exception $e) {
                        // Jika terjadi error, simpan dalam format base64
                        $file = $request->file('ttd');
                        $ttdBase64 = base64_encode(file_get_contents($file));
                        $kta->ttd = $ttdBase64;
                    }

                    // Simpan perubahan pada database
                    $kta->save();
                }
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return (object) [
            'code'    => Response::HTTP_OK,
            'message' => 'Berhasil mengubah data KTA! ' . $request->no_kta
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
                Storage::disk('spaces')->delete($kta->foto);
                Storage::disk('spaces')->delete($kta->ttd);
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
