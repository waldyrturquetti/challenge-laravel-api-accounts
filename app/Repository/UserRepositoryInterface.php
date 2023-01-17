<?php

namespace App\Repository;

use App\Models\User;

interface UserRepositoryInterface
{
    public function existsEmail(string $email): bool;
    public function existsCpf(string $cpf): bool;
    public function existsUUID(string $uuid): bool;
    public function existsUser(int $id): bool;
    public function createUser(User $user): ?User;
}
