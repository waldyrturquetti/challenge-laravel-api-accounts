<?php

namespace App\Repository;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{

    public function existsEmail(string $email): bool
    {
        return User::query()->where('email', $email)->exists();
    }

    public function existsCpf(string $cpf): bool
    {
        return User::query()->where('cpf', $cpf)->exists();
    }

    public function existsUUID(string $uuid): bool
    {
        return User::query()->where('uuid', $uuid)->exists();
    }

    public function existsUser(int $id): bool
    {
        return User::query()->where('id', $id)->exists();
    }

    public function createUser(User $user): User
    {
        $user->save();
        return $user;
    }
}
