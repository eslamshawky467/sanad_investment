<?php

namespace App\Http\Controllers\Api;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SettingsResource;

class SettingsController extends Controller
{
    public function index(Request $request){
        // return $request;

        $settings =Setting::where('type',$request->type)->selection()->get();
        // var_dump($settings);
       if (!$settings) {
           return response()->json([
                       'status' => true,
                       'message' => "Success",
                        'msg'=>'لا توجد اعداد حاليا '
                   ]);
           }
           $setting=  SettingsResource::collection($settings);
            return response()->json([
                       'status' => true,
                       'message' => "Success",
                        'data'=>$setting
                   ]);

   }
}