<?php

namespace App\Http\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
class UploaderService
{
    public function upload(UploadedFile $file, $folder)
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

    /**
     * This function to Delete file from directoru
     * @param $file_name
     * @return bool
     */
    // public function deleteFile($file_name)
    // {
    //     $file_path = public_path() . $file_name;
    //     if (File::exists($file_path)) {
    //         File::delete($file_path);
    //     }
    //     return true;
    // }

    // public function handleBase64Image($image, $folder)
    // {

    //     $image_parts = explode(";base64,", $image);
    //     $image_type_aux = explode("image/", $image_parts[0]);
    //     $image_type = $image_type_aux[1];
    //     $image_base64 = base64_decode($image_parts[1]);

    //     $date_path = date("Y") . '/' . date("m") . '/' . date("d") . '/';

    //     $path = public_path() . '/assets/uploads/' . $folder . '/' . $date_path;
    //     if (!File::exists($path)) {
    //         File::makeDirectory($path, 0777, true);
    //     }
    //     $fileName = uniqid() . '.'.$image_type ;
    //     $file = $path. $fileName;
    //     file_put_contents($file, $image_base64);
    //     return $img = '/assets/uploads/' . $folder .'/'.$date_path . $fileName;

    // }
    // public function handleFolderBase64Image($image, $folder, $folderId)
    // {

    //     $image_parts = explode(";base64,", $image);
    //     $image_type_aux = explode("image/", $image_parts[0]);
    //     $image_type = $image_type_aux[1];
    //     $image_base64 = base64_decode($image_parts[1]);

    //     $date_path = date("Y") . '/' . date("m") . '/' . date("d") . '/';

    //     $path = public_path() . '/assets/uploads/' . $folder . '/'. $folderId. '/'. $date_path;
    //     if (!File::exists($path)) {
    //         File::makeDirectory($path, 0777, true);
    //     }
    //     $fileName = uniqid() . '.'.$image_type ;
    //     $file = $path. $fileName;
    //     file_put_contents($file, $image_base64);
    //     return $img = '/assets/uploads/' . $folder . '/'. $folderId. '/'.$date_path . $fileName;

    // }
}
