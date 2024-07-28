<?php

namespace App\Http\Controllers;

use App\Models\Image_M;
use Illuminate\Http\Request;

class ImageMController extends Controller
{
    //

    public static function addMdiom($imageId)
    {
        try {
            //code...
            $larg=Image_M::create([
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
        $number=Image_M::where('imageId',$imageId)->value('number');
        $image=Image_M::where('imageId',$imageId)->update([
            'number'=>($number-1)
        ]);
    }
}
