<?php

namespace App\Services;


class FileService extends FileServiceTools
{
    public static function save($file, $reqFile)
    {
        // get path
        $path = self::getPath($file);
        // get storage 
        $storage = self::getStorage();
        // create directories on path
        if (!$storage->exists($path)) self::makeDirectories($storage, $path);
        // upload image to Disk    
        $reqFile->move($storage->path($path), $file->name);
        return true;
    }
}
