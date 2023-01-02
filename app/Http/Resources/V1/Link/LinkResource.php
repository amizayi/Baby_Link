<?php

namespace App\Http\Resources\V1\Link;

use Illuminate\Http\Resources\Json\JsonResource;

class LinkResource extends JsonResource
{ 
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'redirect' => $this->redirect_url,
            'type' => $this->type?->name,
            'status' => $this->status?->name,
            'created_at' => jdate($this->created_at)->ago(),
        ];
    }
}
