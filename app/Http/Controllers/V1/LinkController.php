<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\ApiController;
use App\Http\Resources\V1\Link\LinkResource;
use App\Models\Base\Setting;
use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends ApiController
{
    public function store(Request $request)
    {
        $redirect = $request->redirect_url;
        $inputs = [
            'redirect_url' => $redirect,
            'code' => $request->code,
            'is_active' => 1, //active
            'status_id' => 1, //public
            'type_id' => $redirect ? 1 : 2, // link or file 
        ];
        if (!$inputs['code']) $inputs['code'] = Setting::generateCode();
        $link = Link::create($inputs);
        return $this->successResponse(new LinkResource($link));
    }
    
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
        return $this->successResponse(new LinkResource($redirect), 'show link details');
    }       
}
