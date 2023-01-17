<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class ZipCodeInvalidException extends \Exception
{
    public function __construct($message = "This Zip Code is invalid.", $code = 422, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render(): JsonResponse
    {
        return Response::json(['message' => __($this->message)], $this->code);
    }

}
