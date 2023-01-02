<?php

use App\Models\Link;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|-------------------------------------------------------------------------- 
*/

Route::get('/{code}', function ($code) {
    //find public code
    $redirect = Link::query()
        ->whereCode($code)
        ->whereStausId(1)
        ->select('redirect_url')
        ->first()?->redirect_url;
    // Does not exist code
    if (!$redirect) return abort(404);
    // redirect to original url
    return redirect($redirect);
});
