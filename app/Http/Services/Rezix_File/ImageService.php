<?php

namespace App\Http\Services\Rezix_File;

use App\Http\Controllers\V1\Base\FileController; 
use App\Http\Services\Rezix_File\FileTools;
use Intervention\Image\ImageManagerStatic as Image;

class ImageService extends FileTools
{
    public static function save($file, $reqFile, $storage)
    { 
        // get path
        $path = self::getPath($file);
        // get storage 
        if ($storage === 'FTP') {
            $result = FileController::upload($reqFile, self::getFullPath($file));
        } else {
            $storage = self::getStorage();
            // create directories on path
            if (!$storage->exists($path)) self::makeDirectories($storage, $path);
            // returns ImageManagerStatic  
            $getFile = Image::make($reqFile)->stream('jpg', 25);
            // upload image to Disk
            $result = $storage->put(self::getFullPath($file), $getFile->__toString());
        } 
        
        return $result;
    }
}
