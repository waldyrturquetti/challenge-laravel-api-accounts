<?php

namespace App\Application\User\CreateUser;

use App\Models\User;

class MapperUserToSchema
{
    private int $id;
    private string $email;
    private string $birthday;
    private string $cpf;
    private array $address;

    public function __construct(User $user, array $address)
    {
        $this->id = $user->id;
        $this->email = $user->email;
        $this->birthday = $user->birthday;
        $this->cpf = $user->cpf;
        $this->address = $address;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'birthday' => $this->birthday,
            'cpf' => $this->cpf,
            'address' => $this->address,
        ];
    }
}
