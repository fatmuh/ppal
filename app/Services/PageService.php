<?php

namespace App\Services;

use App\Repositories\KtaRepository;
use App\Repositories\UserRepository;

class PageService
{
    public function __construct(
        protected KtaRepository $ktaRepository,
        protected UserRepository $userRepository,
    ) {}

    public function getData(): array
    {
        $ktas = $this->ktaRepository->getTotalKta();
        $users = $this->userRepository->getTotalUser();

        return compact('ktas', 'users');
    }
}
