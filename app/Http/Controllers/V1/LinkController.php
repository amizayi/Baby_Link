<?php

namespace App\Http\Controllers\V1;

use App\Http\Resources\V1\Link\LinkResource;
use App\Http\Requests\Link\LinkRequest;
use App\Http\Controllers\ApiController;
use App\Http\Services\FileService;
use App\Http\Services\ImageService;
use App\Models\Base\File;
use App\Models\Link;

class LinkController extends ApiController
{
    public function shortener(LinkRequest $request)
    { 
        $link = Link::createLink($request);
        return $this->successResponse(new LinkResource($link), 'link shorted');
    }

    public function uploader(LinkRequest $request)
    {
        $reqFile = $request->file;
        $imageTypes = ['jpg', 'png', 'bmp', 'svg'];
        // generate shortcut
        $link = Link::createLink($request, 'file-link');
        // create record file in database
        $file = File::createFile($reqFile, $link);
        // check type file
        if (in_array($reqFile->extension(), $imageTypes)) {
            // save image in storage
            $is_save = ImageService::save($file, $reqFile);
            if ($is_save) return $this->successResponse(new LinkResource($link), 'image saved');
            return $this->errorResponse('image is not saved');
        } else {
            // save file in storage
            $is_file = FileService::save($file, $reqFile);
            if ($is_file) return $this->successResponse(new LinkResource($link), 'file saved');
            return $this->errorResponse('file is not saved');
        }
        return false;
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
