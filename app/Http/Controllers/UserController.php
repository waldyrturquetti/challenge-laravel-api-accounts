<?php

namespace App\Http\Controllers;

use App\Application\User\CreateUser\CreateUserCommand;
use App\Application\User\CreateUser\CreateUserHandle;
use App\Exceptions\ConflictException;
use App\Http\Requests\UserFromRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseHttpStatus;
use \Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private CreateUserHandle $createUserHandle;

    /**
     * @param CreateUserHandle $createUserHandle
     */
    public function __construct(CreateUserHandle $createUserHandle)
    {
        $this->createUserHandle = $createUserHandle;
    }


    /**
     * Creates User register
     *
     * @api POST /api/user
     *
     * @throws ConflictException
     */
    public function createUser(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), UserFromRequest::rules(), UserFromRequest::messages());

        if ($validator->fails()) {
            return Response::json([ 'messages' => $validator->getMessageBag() ],
                ResponseHttpStatus::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $command = new CreateUserCommand(
            $request->input('name'),
            $request->input('email'),
            $request->input('birthday'),
            $request->input('cpf'),
            $request->input('zip_code')
        );

        $user = $this->createUserHandle->handle($command);

        return Response::json($user->toArray(), ResponseHttpStatus::HTTP_CREATED);
    }
}
