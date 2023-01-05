<?php

namespace App\Http\Traits;

use Illuminate\Http\Exceptions\HttpResponseException;

trait ApiResponse
{
    //success response api
    protected function successResponse($data, $message = null, $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'result' => $data
        ], $code);
    }
    //error response api
    protected function errorResponse($message = null, $code = 400)
    {
        return response()->json(['status' => false, 'message' => $message], $code);
    }
    //error response validation api
    protected function validationResponse($message, $code = 403)
    {
        return throw (new HttpResponseException(response()->json(['status' => false, 'message' => $message], $code)));
    }
}
