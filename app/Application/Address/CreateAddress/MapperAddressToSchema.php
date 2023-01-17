<?php

namespace App\Application\Address\CreateAddress;

use App\Models\Address;
use App\Models\User;

class MapperAddressToSchema
{

    private int $id;
    private string $zip_code;
    private string $street;
    private ?string $complement;
    private string $neighborhood;
    private string $city;
    private string $uf;
    private int $number;
    private int $user_id;

    public function __construct(Address $address)
    {
        $this->id = $address->id;
        $this->zip_code = $address->zip_code;
        $this->street = $address->street;
        $this->complement = $address->complement;
        $this->neighborhood = $address->neighborhood;
        $this->city = $address->city;
        $this->uf = $address->uf;
        $this->number = $address->number;
        $this->user_id = $address->user_id;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'street' => $this->street,
            'complement' => $this->complement,
            'neighborhood' => $this->neighborhood,
            'city' => $this->city,
            'uf' => $this->uf,
            'number' => $this->number,
            'user_id' => $this->user_id,
        ];
    }
}
