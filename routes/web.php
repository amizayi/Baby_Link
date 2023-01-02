<?php

use App\Models\Link;
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
    $redirect = Link::query()
        ->whereCode($code)
        ->whereIsActive(1)
        ->whereStatusId(1)
        ->select('redirect_url')
        ->first()?->redirect_url;
    // Does not exist code
    if (!$redirect) return abort(404);
    // redirect to original url  
    if (!Str::startsWith($redirect, ['https://', 'http://']))  $redirect = 'https://' . $redirect;

    return Redirect::away($redirect);
});
