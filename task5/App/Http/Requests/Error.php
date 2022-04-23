<?php 
namespace App\Http\Requests;

class Error {
    public static function Message($mess)
    {
        return ucwords(str_replace('_',' ',$mess));
    }
}