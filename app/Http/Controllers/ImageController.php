<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    //

    public function addImage(Request $request)
    {
        try {
            $Image = Validator::make($request->all(), [
                'path' => 'required|file|nullable'
            ]);
            if ($Image->fails()) {
                return response()->json([
                    'status' => false,
                    'massage' => 'validation error ',
                    'error' => $Image->errors()
                ], 401);
            }
               $path = $request->file('path');
               $filename = time() . $path->getClientOriginalName();
               Storage::disk('public')->put($filename, File::get($path));
                $Image = Image::create([
                    'userId'=>Auth::id(),
                    'path'=>$filename,
                    'type'=>$request->path->getClientMimeType()
                 ]);
                 $Image_M=ImageMController::addMdiom($Image['id']);
                 if ($Image_M==false)
                 {
                    Image::where('id',$Image['id'])->delete();
                    return response()->json([
                        'massege'=>'re Enter agian'
                    ]);
                 }

                 $Image_L=ImageLController::addLarg($Image['id']);
                 if ($Image_L==false)
                 {
                    Image::where('id',$Image['id'])->delete();
                    return response()->json([
                        'massege'=>'re Enter agian'
                    ]);
                 }
                 $Image_XL=ImageXLController::addXLarg($Image['id']);
                 if ($Image_XL==false)
                 {
                    Image::where('id',$Image['id'])->delete();
                    return response()->json([
                        'massege'=>'re Enter agian'
                    ]);
                 }
                 $service=Service::where('userId',Auth::id())->value('id');
                return response()->json([
                    'state' => true,
                    'massage' => 'sucssfully',
                    'id'=>$Image['id']
                ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => false,
                'massage' => $th->getMessage()
            ], 500);
        }
    }

    public function showPiece()
    {
        $Image=Image::where('userId',Auth::id())->get(['id']);
        return response()->json([
            'Image'=>$Image
        ]);
    }

    public function show($id)
    {
        try {
            $Image = Image::where('id', $id)->first(['path', 'type']);
            $file = Storage::disk('public')->get($Image->path);
            return (new Response($file, 200))->header('Content-Type', $Image->typeFile);
    } catch (\Throwable $th) {
        //throw $th;
        return response()->json([
            'status' => false,
            'massage' => $th->getMessage()
        ], 500);
    }
    }
}
