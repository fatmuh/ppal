<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(
        protected UserRepository $userRepository,
    ) {}

    public function fetchTabulator(Request $request): object
    {
        $filters = [
            'name'  => null,
            'email' => null,
        ];

        if ($request->has('filter')) {
            foreach ($request->get('filter') as $filter) {
                if ($filter['value'] != null && $filter['value'] != "") {
                    $filters[$filter['field']] = $filter['value'];
                }
            }
        }

        $result = $this->userRepository->generateTabulator(
            size: ($request->has('size')) ? $request->size : 10,
            filters: $filters
        );

        return (object) [
            'data' => $result
        ];
    }

    public function findUser(int $id): object
    {
        $result = $this->userRepository->getUserById(id: $id);

        return (object) [
            'data' => $result
        ];
    }

    public function saveUser(UserRequest $request): object
    {
        DB::beginTransaction();
        try {

            $this->userRepository->saveUser(
                name: $request->name,
                email: $request->email,
                password: Hash::make($request->password),
            );

        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return (object) [
            'code'    => Response::HTTP_OK,
            'message' => 'Berhasil menambahkan data User!'
        ];
    }

    public function updateUser(UserRequest $request, $id): object
    {
        DB::beginTransaction();
        try {

            $this->userRepository->updateUser(
                id: $id,
                name: $request->name,
                email: $request->email,
            );

        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return (object) [
            'code'    => Response::HTTP_OK,
            'message' => 'Berhasil mengubah data User!'
        ];
    }

    public function deleteUser(int $id): object
    {
        DB::beginTransaction();
        try {
            $this->userRepository->deleteUser(
                id: $id,
            );
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return (object) [
            'code'    => Response::HTTP_OK,
            'message' => 'Berhasil menghapus data User!'
        ];
    }
}
