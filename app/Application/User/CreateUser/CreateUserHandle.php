<?php

namespace App\Application\User\CreateUser;

use App\Exceptions\ConflictException;
use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CreateUserHandle
{
    const LEGAL_AGE = 18;

    private UserRepositoryInterface $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws ConflictException
     */
    public function handle(CreateUserCommand $createUserCommand): ?User
    {
        $userBirthday = $createUserCommand->getBirthday();
        if (Carbon::parse($userBirthday)->diffInYears(Carbon::now()) < self::LEGAL_AGE) {
            throw new ConflictException("The user is not old enough to create the account.");
        }

        if ($this->userRepository->existsEmail($createUserCommand->getEmail())) {
            throw new ConflictException("This email is already used by other user.");
        }

        if ($this->userRepository->existsCpf($createUserCommand->getCpf())) {
            throw new ConflictException("This CPF is already used by other user.");
        }

        $this->verifyUUID($createUserCommand);

        return $this->userRepository->createUser($createUserCommand->toModel());
    }

    private function verifyUUID(CreateUserCommand $createUserCommand): void
    {
        if ($this->userRepository->existsUUID($createUserCommand->getUUID())){
            $createUserCommand->setUUID(Str::uuid());
            $this->verifyUUID($createUserCommand);
        }
    }
}
