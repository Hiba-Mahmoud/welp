<?php

// helper functions

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

function diffForHumans($date){
    return Carbon::create($date)->diffForHumans();
}


 // upload images and files
function upload(UploadedFile $file, $folder)
{
    $date_path = date("Y") . '/' . date("m") . '/' . date("d") . '/';
    $path = public_path() . '/assets/uploads/' . $folder . '/' . $date_path;

    if (!File::exists($path)) {
        File::makeDirectory($path, 0777, true);
    }

    $file_name = date('YmdHis') . mt_rand() . '_' . $folder . '.' . $file->getClientOriginalExtension();

    if ($file->move($path, $file_name)) {
        return $img = '/assets/uploads/' . $folder . '/' . $date_path . $file_name;
    }

}

function getDistance($long1,$lat1,$long2,$lat2){
    $theta = $long1 - $long2;
    $miles = (sin(deg2rad($lat1))) * sin(deg2rad($lat2)) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
    $miles = acos($miles);
    $miles = rad2deg($miles);
    $result['miles'] = $miles * 60 * 1.1515;
    $result['feet'] = $result['miles']*5280;
    $result['yards'] = $result['feet']/3;
    $result['kilometers'] = $result['miles']*1.609344;
    $result['meters'] = $result['kilometers']*1000;
    return $result;
}
