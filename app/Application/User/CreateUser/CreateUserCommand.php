<?php

namespace App\Application\User\CreateUser;

use App\Models\User;
use Illuminate\Support\Str;

class CreateUserCommand
{
    private string $name;
    private string $email;
    private string $birthday;
    private string $cpf;
    private string $uuid;

    /**
     * @param string $name
     * @param string $email
     * @param string $birthday
     * @param string $cpf
     */
    public function __construct(string $name, string $email, string $birthday, string $cpf)
    {
        $this->name = $name;
        $this->email = $email;
        $this->birthday = $birthday;
        $this->cpf = $cpf;
        $this->uuid = Str::uuid()->toString();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getBirthday(): string
    {
        return $this->birthday;
    }

    /**
     * @return string
     */
    public function getCpf(): string
    {
        return $this->cpf;
    }

    /**
     * @return string
     */
    public function getUUID(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUUID(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    public function toModel(): User
    {
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->birthday = $this->birthday;
        $user->cpf = $this->cpf;
        $user->uuid = $this->uuid;
        $user->active = true;

        return $user;
    }
}
