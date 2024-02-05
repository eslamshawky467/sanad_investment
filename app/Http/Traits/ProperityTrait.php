<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;


trait ProperityTrait
{

    public function saveImage($photo,$index,$folder,$subFolder){

        $file_extension = $photo->getClientOriginalExtension();
        $file_name=time() .'_'.$index.'.'.$file_extension;
        $path = 'uploads/'.$folder.'/'.$subFolder;
        $photo->storeAs($path, $file_name,'local');
        // Storage::disk('local')->put($path,$file_name);
        $Fullpath =$path.'/'.$file_name;
        // $Fullpath =asset('storage/'.$path.'/'.$file_name);
        return $Fullpath;


    }

    public function FileType($ex){

        $imgTypes=array('jpg','png','gif','jpeg','svg','apng','avif','jfif','pjpeg','pjp','webp');
        $excelType=array('xls','xlsx','ods');
        $wordTypes=array('docx','dot','dotx','odt');

        if(in_array($ex, $imgTypes) )
        {
            return 'image';
        }

        elseif(in_array($ex, $excelType) )
        {
            return 'excel';
        }

        elseif(in_array($ex, $wordTypes) )
        {
            return 'word';
        }
        else{
            return 'pdf';
        }


    }

    public function downloadFile($file_name){

        $path = storage_path('app/public/'.$file_name);
        //  return $path;
        return response()->download($path);

        // if (file_exists('storage/'.$file_name)) {
        //     return response()->download($path);
        // }

    }
}
