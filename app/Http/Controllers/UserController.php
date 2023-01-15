<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFromRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseHttpStatus;
use \Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Creates User register
     *
     * @api POST /api/user
     */
    public function createUser(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), UserFromRequest::rules(), UserFromRequest::messages());

        if ($validator->fails()) {
            return Response::json([ 'messages' => $validator->getMessageBag() ],
                ResponseHttpStatus::HTTP_UNPROCESSABLE_ENTITY);
        }

        return Response::json([ "name" => $request->name ], ResponseHttpStatus::HTTP_OK);
    }
}
