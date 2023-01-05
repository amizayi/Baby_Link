<?php

use App\Http\Services\Rezix_File\FileService;
use App\Http\Services\Rezix_FTP\FTPService;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect; 
use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
| Web Routes
|-------------------------------------------------------------------------- 
*/

Route::get('/{code}', function ($code) {
    //find public code
    $link = Link::query()
        ->whereCode($code)
        ->whereIsActive(1)
        ->whereStatusId(1)
        ->select('id', 'redirect_url')
        ->first();
    if (!$link) return abort(404); 
    // Does not exist code  
    $redirect = $link->redirect_url;
    if ($redirect) {
        // redirect to original url  
        if (!Str::startsWith($redirect, ['https://', 'http://']))  $redirect = 'https://' . $redirect;
        return Redirect::away($redirect);
    } else {
        $file = $link->files()->first(); 
        if (!$file) return abort(404); 
        return Redirect::away(FileService::getStorageFullPath($file));

    }
});

