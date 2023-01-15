<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFromRequest;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as ResponseHttpStatus;
use \Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Creates User register
     *
     * @api POST /api/user
     */
    public function createUser(UserFromRequest $userFromRequest): JsonResponse
    {
        return Response::json([ "nome" => $userFromRequest->nome ], ResponseHttpStatus::HTTP_OK);
    }
}
