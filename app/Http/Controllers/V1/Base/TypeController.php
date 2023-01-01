<?php

namespace App\Http\Controllers\V1\Base;

use App\Http\Controllers\ApiController;
use App\Models\Base\Type;

class TypeController extends ApiController
{
    public function index()
    {
        $data = Type::select('id', 'name')->orderByDesc('id')->get();
        return $this->successResponse($data, 'list of types');
    }
}
