<?php
namespace App\Http\services;

use Illuminate\Http\UploadedFile;

class Media {
    public static function upload(UploadedFile $image, $directory) 
    {
        $photoName = $image->hashName();
        $image->move(public_path("assets/images/{$directory}"), $photoName);
        return $photoName;
    }

    public static function delete( $image, $directory) 
    {
        if(file_exists(public_path("assets/images/{$directory}/$image"))){
            unlink(public_path("assets/images/{$directory}/$image"));
            return true;
        }
        return false;
    }
}
