<?php

namespace App\Repository;

use App\Models\Address;

interface AddressRepositoryInterface
{
    public function existsAddressForThisUser(int $user_id): bool;

    public function createAddress(Address $address): Address;
}
