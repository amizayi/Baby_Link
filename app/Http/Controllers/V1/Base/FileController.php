<?php

namespace App\Http\Controllers\V1\Base;

use App\Http\Controllers\ApiController;
use App\Http\Services\Rezix_FTP\FTPService;
use Illuminate\Support\Facades\Config;

class FileController extends ApiController
{
    public static function upload($file,$path)
    { 
        $config = Config::get('ftp.connections.connection1');
        $ftp = new FTPService($config);
        $ftpSaved = $ftp->uploadFile($file, $path);
        if (!$ftpSaved) return false;
        return true;
    }
}
