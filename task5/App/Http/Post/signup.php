<?php
session_start();

include_once "../../Middlewares/RequestPost.php";
include_once "../../../vendor/autoload.php";

use App\Database\Models\User;
use App\Http\Requests\Validation;

$validator = new Validation;
$validator->setValName('first_name')->setVal($_POST['first_name'])->required()->max(32);
$validator->setValName('last_name')->setVal($_POST['last_name'])->required()->max(32);
$validator->setValName('email')->setVal($_POST['email'])->required()
    ->regex('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/')
    ->max(64)->unique('users');
$validator->setValName('password')->setVal($_POST['password'])->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/', "Minimum eight and maximum 20 characters, at least one uppercase letter, one lowercase letter, one number and one special character")
    ->confirmed($_POST['password_confirmation']);
$validator->setValName('phone')->setVal($_POST['phone'])->required()->regex('/^01[0125][0-9]{8}$/')->unique('users');
$validator->setValName('password_confirmation')->setVal($_POST['password_confirmation'])->required();
$validator->setValName('gender')->setVal($_POST['gender'])->in(['f', 'm']);
$_SESSION['old'] = $_POST;

if (!empty($validator->getErrors())) {
    $_SESSION['errors'] = $validator->getErrors();
    $_SESSION['old'] = $_POST ;
    print_r($_SESSION['errors']);
    header('location:../../../public/signup.php');
    die;
}

$verificationCode = rand(10000, 99999);
$user = new User;
$user->setFirst_name($_POST['first_name'])->setLast_name($_POST['last_name'])
    ->setPassword(password_hash($_POST['password'], PASSWORD_BCRYPT))->setVerification_code($verificationCode)
    ->setEmail($_POST['email'])->setPhone($_POST['phone'])->setGender($_POST['gender']);
if ($user->create()) {
    $body = "<h4>Hello {$_POST['first_name']}</h4> <p> Your Verification Code is:<b>{$verificationCode}</b></p><p>Thank You {$_POST['first_name']}.</p>";
   
    // $verificationCode = new VerificationCode($_POST['email'], "Verification Code", $body);
 
    // if ($verificationCode->send()) {

        $_SESSION['verification_email'] = $_POST['email'];
        header('location:../../../public/verification-code.php?page=signup');
    //     die;
    // } else {
    //     $_SESSION['errors']['mail']['error'] = "Email Error Try Again Later";
    //     header('location:../../../public/signup.php');
    // }
} else {
    $_SESSION['errors']['something']['error'] = "Something Went Worng";
    header('location:../../../public/signup.php');
}
