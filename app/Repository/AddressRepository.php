<?php

namespace App\Repository;

use App\Models\Address;

class AddressRepository implements AddressRepositoryInterface
{
    public function existsAddressForThisUser(int $user_id): bool
    {
        return Address::query()->where('user_id', $user_id)->exists();
    }

    public function createAddress(Address $address): Address
    {
        $address->save();
        return $address;
    }
}
