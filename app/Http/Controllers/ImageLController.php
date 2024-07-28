<?php

namespace App\Http\Controllers;

use App\Models\Image_L;
use Illuminate\Http\Request;

class ImageLController extends Controller
{
    //

    public static function addLarg($imageId)
    {
        try {
            //code...
            $larg=Image_L::create([
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
        $number=Image_L::where('imageId',$imageId)->value('number');
        $image=Image_L::where('imageId',$imageId)->update([
            'number'=>($number-1)
        ]);
    }
}
