<?php

use Illuminate\Support\Facades\DB;



// if (!function_exists('')) {
//     function ()
//     {
//         return ;
//     }
// }


if (!function_exists('getSetting')) {
    function getSetting($slug)
    {
        return DB::table('settings')->where('slug', $slug)->value('value');
    }
}

use Illuminate\Support\Facades\Storage;

if (!function_exists('publicPath')) {

    function publicPath($path){
        if (empty($path)) {
            return asset('images/no-image.png');
        }

        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        if(env('APP_HOSTING_MODE') == 'WEBHOST'){
            return asset("public/". $path);
        }

        if (Storage::disk('public')->exists($path)) {
            return asset('storage/' . $path);
        }

        return asset($path);
    }
}


