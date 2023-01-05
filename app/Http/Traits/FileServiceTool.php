<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait FileServiceTool
{
    public static function getPath($file)
    {
        return str_replace("-", DIRECTORY_SEPARATOR, $file->date);
    }

    public static function getFullPath($file)
    {
        return self::getPath($file) . DIRECTORY_SEPARATOR . $file->name;
    }

    public static function makeDirectories($storage, $path)
    {
        return $storage->makeDirectory($path, 0777, true, true);
    }

    public static function getStorage()
    {
        return Storage::disk('public');
    }
}
