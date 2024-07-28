<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ServiceController;
use App\Models\Image_L;
use App\Models\Image_M;
use App\Models\Image_service;
use App\Models\Image_XL;
use App\Models\Model_S;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ModelSController extends Controller
{
    //

     /**
     * addModel
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
     public function addModel(Request $request)
     {
         try {
             $Model3d = Validator::make($request->all(), [
                 'path' => 'required|file|nullable',
                 'PieceSize' => 'string'
             ]);
             if ($Model3d->fails()) {
                 return response()->json([
                     'status' => false,
                     'massage' => 'validation error ',
                     'error' => $Model3d->errors()
                 ], 401);
             }
             $idservice=Service::where('userId',Auth::id())->value('id');
                $path = $request->file('path');
                $filename = time() . $path->getClientOriginalName();
                Storage::disk('public')->put($filename, File::get($path));
                 $Model3d1 = Model_S::create([
                    'userid'=>Auth::id(),
                    'idService'=>$idservice,
                    'path'=>$filename,
                    'type'=>$request->path->getClientMimeType()
                 ]);
                 $Image_service=Image_service::where('imageId',$request->imageId)->value('serviceId');
                 if($Image_service!=null)
                 {
                    if ($request->PieceSize=="M")
                    {
                      $piece_M=Image_M::where('imageId',$request->imageId)->first('number');
                      if($piece_M['number'] == 0)
                      {
                        return response()->json([
                            'Message'=>'Ive added this before'
                        ],299);
                      }
                      $madiom=ImageMController::update($request->imageId);
                      return response()->json([
                        'state' => true,
                        'massage' => 'sucssfully'
                    ], 200);
                    }
                    if ($request->PieceSize=="L")
                    {
                        $piece_L=Image_L::where('imageId',$request->imageId)->first('number');
                        if($piece_L['number']==0)
                        {
                          return response()->json([
                              'Message'=>'Ive added this before'
                          ],299);
                        }
                        $large=ImageLController::update($request->imageId);
                        return response()->json([
                          'state' => true,
                          'massage' => 'sucssfully'
                      ], 200);
                    }
                    if ($request->PieceSize=="XL")
                    {
                        $piece_XL=Image_XL::where('imageId',$request->imageId)->first('number');
                      if($piece_XL['number']==0)
                      {
                        return response()->json([
                            'Message'=>'Ive added this before'
                        ],299);
                      }
                      $Xlarge=ImageXLController::update($request->imageId);
                      return response()->json([
                        'state' => true,
                        'massage' => 'sucssfully'
                    ], 200);
                    }
                 }
                 ////////////////////////////////////////
                 $Image_service=ImageServiceController::add($request->imageId,$idservice);
                 $T=ServiceController::update(Auth::id());
                 if ($request->PieceSize=="M")
                    {
                      $madiom=ImageMController::update($request->imageId);
                    }
                    if ($request->PieceSize=="L")
                    {
                        $large=ImageLController::update($request->imageId);
                    }
                    if ($request->PieceSize=="XL")
                    {
                      $Xlarge=ImageMController::update($request->imageId);
                    }
                    /////////////

                 if ($T==2)
                 {
                    Model_S::where('id',$Model3d1['id'])->delete();
                    return response()->json([
                        'state' => false,
                        'massage' => 'Please activate the service again'
                    ],301);
                 }
                 if ($T==0)
                 {
                  $model=Model_S::where('id',$Model3d1['id'])->delete();
                  return response()->json([
                    'state' => false,
                    'massage' => 're Enter again'
                ],301);
                 }
                 return response()->json([
                     'state' => true,
                     'massage' => 'sucssfully'
                 ], 200);
         } catch (\Throwable $th) {
             //throw $th;
             return response()->json([
                 'status' => false,
                 'massage' => $th->getMessage()
             ], 500);
         }
     }
////////////  get_Model  /////////////
     public function get_Model()
     {
        $models=Model_S::where('userid',Auth::id())->get(['id']);
        return response()->json($models);
     }

     public function showModel($id)
     {
         try {
                 $model = Model_S::where('id', $id)->first(['path', 'type']);
                 $file = Storage::disk('public')->get($model->path);
                 return (new Response($file, 200))->header('Content-Type', $model->typeFile);
         } catch (\Throwable $th) {
             //throw $th;
             return response()->json([
                 'status' => false,
                 'massage' => $th->getMessage()
             ], 500);
         }
     }
}
