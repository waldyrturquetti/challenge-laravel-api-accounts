<?php

namespace App\Application\Address\CreateAddress;

use App\Models\Address;

class CreateAddressCommand
{
    private string $zip_code;
    private string $street;
    private ?string $complement;
    private string $neighborhood;
    private string $city;
    private string $uf;
    private int $number;
    private int $user_id;

    /**
     * @param string $zip_code
     * @param string $street
     * @param string|null $complement
     * @param string $neighborhood
     * @param string $city
     * @param string $uf
     * @param int $number
     * @param int $user_id
     */
    public function __construct(
        string $zip_code, string $street, ?string $complement,
        string $neighborhood, string $city, string $uf, int $number, int $user_id
    )
    {
        $this->zip_code = $zip_code;
        $this->street = $street;
        $this->complement = $complement;
        $this->neighborhood = $neighborhood;
        $this->city = $city;
        $this->uf = $uf;
        $this->number = $number;
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function toModel(): Address
    {
        $address = new Address();
        $address->zip_code = $this->zip_code;
        $address->street = $this->street;
        $address->complement = $this->complement;
        $address->neighborhood = $this->neighborhood;
        $address->city = $this->city;
        $address->uf = $this->uf;
        $address->number = $this->number;
        $address->user_id = $this->user_id;

        return $address;
    }
}
