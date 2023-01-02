<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Link\LinkRequest;
use App\Http\Resources\V1\Link\LinkResource;
use App\Models\Base\Setting;
use App\Models\Link;

class LinkController extends ApiController
{
    public function store(LinkRequest $request)
    {
        $redirect = $request->redirect_url;

        $link = Link::query()->create([
            'redirect_url' => $redirect,
            'code' => $request->code ?? Setting::generateCode(), // generate code with system 
            'is_active' => 1, // active
            'status_id' => 1, // public
            'type_id' => $redirect ? 1 : 2, // link or file 
        ]);
        // response
        return $this->successResponse(new LinkResource($link));
    }

    public function show($code)
    {
        // find public code
        $redirect = Link::query()
            ->whereCode($code)
            ->whereStatusId(1)
            ->first();
        // Does not exist code
        if (!$redirect) return $this->errorResponse('not found', 404);
        // redirect to original url
        return $this->successResponse(new LinkResource($redirect), 'show link details');
    }
}
