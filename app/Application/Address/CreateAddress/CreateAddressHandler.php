<?php

namespace App\Application\Address\CreateAddress;

use App\Exceptions\ConflictException;
use App\Repository\AddressRepositoryInterface;
use App\Repository\UserRepositoryInterface;

class CreateAddressHandler
{
    private AddressRepositoryInterface $addressRepository;
    private UserRepositoryInterface $userRepository;

    /**
     * @param AddressRepositoryInterface $addressRepository
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(AddressRepositoryInterface $addressRepository, UserRepositoryInterface $userRepository)
    {
        $this->addressRepository = $addressRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @throws ConflictException
     */
    public function handle(CreateAddressCommand $createAddressCommand): MapperAddressToSchema
    {
        if (!$this->userRepository->existsUser($createAddressCommand->getUserId())) {
            throw new ConflictException('This user not exists.');
        }

        if ($this->addressRepository->existsAddressForThisUser($createAddressCommand->getUserId())) {
            throw new ConflictException('This user already has an address created.');
        }

        $address = $this->addressRepository->createAddress($createAddressCommand->toModel());

        return new MapperAddressToSchema($address);
    }
}
