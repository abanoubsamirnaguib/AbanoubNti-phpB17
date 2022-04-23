<?php
session_start();

include_once "../../Middlewares/RequestPost.php";
include_once "../../../vendor/autoload.php";

use App\Database\Models\User;
use App\Http\Requests\Validation;

$validator = new Validation;
$validator->setValName('password')->setVal($_POST['password'])->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/', "Minimum eight and maximum 20 characters, at least one uppercase letter, one lowercase letter, one number and one special character")
    ->confirmed($_POST['password_confirmation']);
$validator->setValName('password_confirmation')->setVal($_POST['password_confirmation'])->required();

if (!empty($validator->getErrors())) {
    $_SESSION['errors'] = $validator->getErrors();
    $_SESSION['old'] = $_POST;
    header('location:../../../public/reset-password.php');
}

$user = new User;
$user->setEmail($_SESSION['verification_email'])->setPassword(password_hash($_POST['password'],PASSWORD_BCRYPT));

if (! $user->updateNewPassword() ) {
    $_SESSION['errors']['code']['wrong'] = "Error In Updating Password";
    $_SESSION['old'] = $_POST;
    header('location:../../../reset-password.php');
    die;
}

header('location:../../../public/signin.php');