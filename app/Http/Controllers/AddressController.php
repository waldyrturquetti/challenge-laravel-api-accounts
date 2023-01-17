<?php

namespace App\Http\Controllers;

use App\Application\Address\CreateAddress\CreateAddressCommand;
use App\Application\Address\CreateAddress\CreateAddressHandler;
use App\Exceptions\ConflictException;
use App\Http\Requests\AddressFromRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseHttpStatus;

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

    /**
     * Creates Address register
     *
     * @param Request $request
     * @return JsonResponse
     *
     * @throws ConflictException
     *
     * @api POST /api/address
     */
    public function createAddress(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), AddressFromRequest::rules(), AddressFromRequest::messages());

        if ($validator->fails()) {
            return Response::json([ 'messages' => $validator->getMessageBag() ],
                ResponseHttpStatus::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $command = new CreateAddressCommand(
            $request->input('zip_code'),
            $request->input('street'),
            $request->input('complement'),
            $request->input('neighborhood'),
            $request->input('city'),
            $request->input('uf'),
            $request->input('number'),
            $request->input('user_id'),
        );

        $address = $this->createAddressHandler->handle($command);

        return Response::json($address->toArray(), ResponseHttpStatus::HTTP_CREATED);
    }
}
