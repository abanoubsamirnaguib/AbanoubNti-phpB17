<?php
session_start();
include_once "../../Middlewares/RequestPost.php";
include_once "../../Middlewares/guest.php";

include_once "../../../vendor/autoload.php";

use App\Database\Models\User;
use App\Http\Requests\Validation;


$validator = new Validation;
$validator->setValName('code')->setVal($_POST['code'])->required()->integer()->digits(5)->exists('users', "verification_code");

if (!empty($validator->getErrors())) {
    $_SESSION['errors'] = $validator->getErrors();
    $_SESSION['old'] = $_POST;
    header('location:../../../public/verification-code.php?page=' . $_GET['page']);
}

$user = new User;
$user->setEmail($_SESSION['verification_email'])->setVerification_code($_POST['code']);
// print_r($_SESSION['verification_email']);
// die;
$result = $user->checkCode();

if ($result->num_rows != 1) {
    $_SESSION['errors']['code']['wrong'] = "Wrong Code";
    $_SESSION['old'] = $_POST;
    header('location:../../../public/verification-code.php?page=' . $_GET['page']);
    die;
}

if ($_GET['page'] == 'signup') {
    $user->setEmail_verified_at(date('Y-m-d H:i:s'));
    if ($user->makeUserVerified()) {
        unset($_SESSION['verification_email']);
        header('location:../../../public/signin.php');
        die;
    } else {
        $_SESSION['errors']['someting']['wrong'] = "Something Went Wrong";
        $_SESSION['old'] = $_POST;
        header('location:../../../public/verification-code.php?page=' . $_GET['page']);
        die;
    }
} elseif ($_GET['page'] == 'verifyEmail') {
    header('location:../../../public/reset-password.php');
    die;
}
