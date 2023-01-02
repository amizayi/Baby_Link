<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\ApiController;
use App\Http\Resources\V1\Link\LinkResource;
use App\Models\Link;

class LinkController extends ApiController
{
    public function show($code)
    {
        //find public code
        $redirect = Link::query()
            ->whereCode($code)
            ->whereStatusId(1) 
            ->first();
        // Does not exist code
        if (!$redirect) return $this->errorResponse('not found', 404);
        // redirect to original url
        return $this->successResponse(new LinkResource($redirect),'show link details');
    }
}
