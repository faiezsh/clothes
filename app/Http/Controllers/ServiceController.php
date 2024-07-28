<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    //

    public  static function add($id,$nameplace)
    {
       try {
        //code...
        $service=Service::create([
            'userId'=>$id,
            'ShopName'=>$nameplace,
            'numberService'=>3,
            'ServiceMachine'=>true
        ]);
        return $service['id'];
       } catch (\Throwable $th) {
        //throw $th;
        return response()->json([
            'state'=>false,
            'message'=>$th->getMessage()
        ]);
       }
    }

    public function addService(Request $request)
    {
        try {
            //code...
            $roll=user::where('id',Auth::id())->value('roll');
            if ($roll!="Admin")
            {

                return response()->json([
                    'state'=>false,
                    'massege'=>'access is denied'
                ]);
            }
            $userId=User::where('userName',$request->userName)->value('id');
            $serviceN=Service::where('userId',$userId)->first('numberService');
            if ($serviceN==null)
            {

                return response()->json([
                    'state'=>false,
                    'message'=>'access is denied'
                ],309);
            }
            $numberService=$serviceN['numberService'] + ($request->number);
            $service=Service::where('userId',$userId)->update([
                'numberService'=>$numberService,
                'ServiceMachine'=>true
            ]);
            return response()->json([
                'state'=>true,
                'message'=>'sucssfuly'
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'state'=>false,
                'message'=>$th->getMessage()
            ]);
        }
    }

    public static function update($userId)
    {
        try {
            //code...
            $number=Service::where('userId',$userId)->value('numberService');
            $ServiceMachine=Service::where('userId',$userId)->value('ServiceMachine');

            if($ServiceMachine==false)
            {
                return (2);
            }
            $number=$number-1;
            if ($number==0)
            {
            $service=Service::where('userId',$userId)->update([
                'numberService'=>$number,
                'ServiceMachine'=>false
            ]);
            }
            $service=Service::where('userId',$userId)->update(['numberService'=>$number]);
            return 1;
        } catch (\Throwable $th) {
            //throw $th;
            return 0;
        }

    }

    public static function Machine ($id)
    {
        $ServiceMachine=Service::where('userId',$id)->value('ServiceMachine');
        return $ServiceMachine;
    }
}
