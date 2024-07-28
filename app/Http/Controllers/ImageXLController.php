<?php

namespace App\Http\Controllers;

use App\Models\Image_XL;
use Illuminate\Http\Request;

class ImageXLController extends Controller
{
    //

    public static function addXLarg($imageId)
    {
        try {
            //code...
            $larg=Image_XL::create([
                'imageId'=>$imageId,
                'number'=>2
            ]);
            return true;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }
    public static function update($imageId)
    {
        $number=Image_XL::where('imageId',$imageId)->value('number');
        $image=Image_XL::where('imageId',$imageId)->update([
            'number'=>($number-1)
        ]);
    }
}
