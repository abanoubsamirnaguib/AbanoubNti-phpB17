<?php
session_start();
include_once "../../Middlewares/auth.php";
include_once "../../../vendor/autoload.php";

use App\Database\Models\User;

setcookie('userToken', "", time() - 1, '/');
$user = new User;
$user->setEmail($_SESSION['user']->email)->RemoveRememberToken();

unset($_SESSION['user']);
header('location:../../../public/signin.php');
