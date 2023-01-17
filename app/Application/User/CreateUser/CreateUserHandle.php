<?php

namespace App\Application\User\CreateUser;

use App\Application\Address\VerifyCEP\VerifyCepAndFormatAddressHandle;
use App\Exceptions\ConflictException;
use App\Exceptions\ZipCodeInvalidException;
use App\Models\User;
use App\Repository\UserRepositoryInterface;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CreateUserHandle
{
    const LEGAL_AGE = 18;

    private UserRepositoryInterface $userRepository;
    private VerifyCepAndFormatAddressHandle $verifyCEPHandle;

    /**
     * @param UserRepositoryInterface $userRepository
     * @param VerifyCepAndFormatAddressHandle $verifyCEPHandle
     */
    public function __construct(UserRepositoryInterface $userRepository, VerifyCepAndFormatAddressHandle $verifyCEPHandle)
    {
        $this->userRepository = $userRepository;
        $this->verifyCEPHandle = $verifyCEPHandle;
    }

    /**
     * @param CreateUserCommand $createUserCommand
     *
     * @return MapperUserToSchema
     *
     * @throws ConflictException
     * @throws ZipCodeInvalidException
     */
    public function handle(CreateUserCommand $createUserCommand): MapperUserToSchema
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

        $address = $this->verifyCEPHandle->handle($createUserCommand->getZipCode());
        $user = $this->userRepository->createUser($createUserCommand->toModel());

        return new MapperUserToSchema($user, $address);
    }

    private function verifyUUID(CreateUserCommand $createUserCommand): void
    {
        if ($this->userRepository->existsUUID($createUserCommand->getUUID())){
            $createUserCommand->setUUID(Str::uuid());
            $this->verifyUUID($createUserCommand);
        }
    }
}
