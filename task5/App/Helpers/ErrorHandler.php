<?php
namespace App\Helpers;

class ErrorHandler { 
    public static function get(string $error) :?string
    {
        if(isset($_SESSION['errors'][$error])){
            foreach ($_SESSION['errors'][$error] as $value) {
                return ErrorHandler::template($value);
            }
        }
        return null;
    }

    public static function display() :?string
    {
        $message = null;
        if(isset($_SESSION['errors'])){
            foreach($_SESSION['errors'] AS $errors){
                foreach($errors AS $error){
                    $message .= ErrorHandler::template($error);
                    break;
                }
            }
        }
        return $message;
    }


    public static function template(string $value)
    {
        return "<p class='text-danger font-weight-bold'>{$value}</p>";
    }

}

