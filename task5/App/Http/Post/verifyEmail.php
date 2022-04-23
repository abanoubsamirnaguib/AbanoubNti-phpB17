<?php
session_start();
include_once "../../Middlewares/RequestPost.php";
include_once "../../Middlewares/guest.php";
include_once "../../../vendor/autoload.php";

use App\Database\Models\User;
use App\Mail\VerificationCode;
use App\Http\Requests\Validation;

$validator = new Validation;
$validator->setValName('email')->setVal($_POST['email'])->required()->regex('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/')
    ->exists('users');

if (!empty($validator->getErrors())) {
    $_SESSION['errors'] = $validator->getErrors();
    $_SESSION['old'] = $_POST;
    header('location:../../../public/verifyEmail.php');
    die;
}

$verificationCode = rand(10000, 99999);
$user = new User;
$user->setEmail($_POST['email'])->setVerification_code($verificationCode);
if (!$user->updateUserCode()) {
    $_SESSION['errors']['VerifCode']['wrong'] = "Something Wrong";
    $_SESSION['old'] = $_POST;
    header('location:../../../public/verifyEmail.php');
    die;
}

$body = "<h4>Hello {$_POST['email']}</h4> <p> Your Verification Code Is:<b>{$verificationCode}</b></p><p>Thank You .</p>";
$verificationCode = new VerificationCode($_POST['email'], "Verification Code", $body);
if ($verificationCode->send()) {
    $_SESSION['verification_email'] = $_POST['email'];
    header('location:../../../public/verification-code.php?page=verifyEmail');
    die;
} else {
    $_SESSION['errors']['sendMail']['error'] = "Error In Sending Email";
    header('location:../../../public/verifyEmail.php');
    die;
}
