<?php

namespace App\Http\Services\Rezix_File;

use App\Http\Services\Rezix_File\FileTools;
use Intervention\Image\ImageManagerStatic as Image;

class ImageService extends FileTools
{
    public static function save($file, $reqFile)
    {
        // get path
        $path = self::getPath($file);
        // get storage 
        $storage = self::getStorage();
        // create directories on path
        if (!$storage->exists($path)) self::makeDirectories($storage, $path);
        // returns ImageManagerStatic  
        $getFile = Image::make($reqFile)->stream('jpg', 25);
        // upload image to Disk
        $result = $storage->put(self::getFullPath($file), $getFile->__toString());

        return $result;
    }
}
