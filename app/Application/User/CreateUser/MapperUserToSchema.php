<?php

namespace App\Application\User\CreateUser;

use App\Exceptions\ConflictException;
use App\Exceptions\ZipCodeInvalidException;
use App\Models\User;
use GuzzleHttp\Exception\GuzzleException;

class MapperUserToSchema
{
    private int $id;
    private string $email;
    private string $birthday;
    private string $cpf;
    private array $address;

    /**
     * @param User $user
     * @param array $address
     *
     * @return void
     */
    public function __construct(User $user, array $address)
    {
        $this->id = $user->id;
        $this->email = $user->email;
        $this->birthday = $user->birthday;
        $this->cpf = $user->cpf;
        $this->address = $address;
    }

    /**
     * @return array
     */
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
