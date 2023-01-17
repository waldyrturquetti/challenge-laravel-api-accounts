<?php

namespace App\Http\Controllers;

use App\Application\Address\VerifyCEP\CreateAddressHandler;

class AddressController extends Controller
{
    private CreateAddressHandler $createAddressHandler;

    /**
     * @param CreateAddressHandler $createAddressHandler
     */
    public function __construct(CreateAddressHandler $createAddressHandler)
    {
        $this->createAddressHandler = $createAddressHandler;
    }


}
