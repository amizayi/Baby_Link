<?php

namespace App\Http\Controllers\V1\Base;

use App\Http\Controllers\ApiController;
use App\Models\Base\Status;

class StatusController extends ApiController
{
    public function index()
    {
        $data = Status::select('id', 'name')->orderByDesc('id')->get();
        return $this->successResponse($data, 'list of statuses');
    }
}
