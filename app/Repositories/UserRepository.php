<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    public function generateTabulator(int $size = 10, array $filters = []): LengthAwarePaginator
    {
        $user = User::latest();

        foreach ($filters as $key => $value) {
            if ($key == 'value' && $value) {
                $user->where('name', 'like', "%{$value}%");
            } else if ($key == 'email' && $value) {
                $user->where('email', 'like', "%{$value}%");
            }
        }

        return $user->paginate($size);
    }

    public function getUserById(int $id): User
    {
        return User::whereId($id)->firstOrFail();
    }

    public function getTotalUser(): int
    {
        return User::count();
    }

    public function saveUser(
        string $name,
        string $email,
        string $password,
    ): User
    {
        DB::beginTransaction();
        try {
            $kta = User::create([
                'name'      => $name,
                'email'     => $email,
                'password'  => $password,
                'gender'    => '-',
                'active'    => 1,
            ]);

        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return $kta;
    }

    public function updateUser(
        int $id,
        string $name,
        string $email,
    ): User
    {
        DB::beginTransaction();
        try {
            $user = $this->getUserById($id);
            if (!$user) {
                throw new ModelNotFoundException();
            }

            $user->name     = $name;
            $user->email    = $email;

            $user->save();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return $user;
    }

    public function deleteUser(int $id): User
    {
        DB::beginTransaction();
        try {
            $user = $this->getUserById($id);
            if (!$user) {
                throw new ModelNotFoundException();
            }

            $user->delete();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return $user;
    }
}
