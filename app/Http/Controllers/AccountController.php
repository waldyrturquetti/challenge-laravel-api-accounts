<?php

namespace App\Http\Controllers;


use App\Application\Account\createAccount\CreateAccountCommand;
use App\Application\Account\createAccount\CreateAccountHandler;
use App\Exceptions\ConflictException;
use App\Http\Requests\AccountFromRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseHttpStatus;

class AccountController extends Controller
{
    private CreateAccountHandler $createAccountHandler;

    /**
     * @param CreateAccountHandler $createAccountHandler
     */
    public function __construct(CreateAccountHandler $createAccountHandler)
    {
        $this->createAccountHandler = $createAccountHandler;
    }

    /**
     * Creates Account register
     *
     * @param Request $request
     * @return JsonResponse
     *
     * @throws ConflictException
     *
     * @api POST /api/account
     */
    public function createAccount(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), AccountFromRequest::rules(), AccountFromRequest::messages());

        if ($validator->fails()) {
            return Response::json([ 'messages' => $validator->getMessageBag() ],
                ResponseHttpStatus::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $command = new CreateAccountCommand(
            $request->input('user_name'),
            $request->input('credits'),
            $request->input('user_id'),
            $request->input('type'),
            $request->input('cnpj')
        );

        $account = $this->createAccountHandler->handle($command);

        return Response::json($account->toArray(), ResponseHttpStatus::HTTP_CREATED);
    }
}
