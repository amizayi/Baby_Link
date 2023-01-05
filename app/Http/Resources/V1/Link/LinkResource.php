<?php

namespace App\Http\Resources\V1\Link;

use App\Http\Services\FileServiceTools;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class LinkResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'redirect' => $this->redirect_url ?? Storage::url(FileServiceTools::getFullPath($this->files()->first())),
            'type' => $this->type?->name,
            'status' => $this->status?->name,
            'created_at' => jdate($this->created_at)->format('Y-m-d H:i'),
        ];
    }
}
