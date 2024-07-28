<?php

namespace App\Http\Controllers;

use App\Models\Image_service;
use Illuminate\Http\Request;

class ImageServiceController extends Controller
{
    //

    public static function add($imageId,$serviceId)
    {
        try {
            //code...
            $Image_service=Image_service::create([
                'imageId'=>$imageId,
                'serviceId'=>$serviceId
            ]);
            return true;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }
}
