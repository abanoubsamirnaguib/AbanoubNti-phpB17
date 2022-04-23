<?php
session_start();
include_once "../../Middlewares/RequestPost.php";
include_once "../../../vendor/autoload.php";

use App\Database\Models\User;
use App\Http\Requests\Validation;


$validator = new Validation;
$validator->setvalName('email')->setval($_POST['email'])->required()->regex('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/')
    ->exists('users');
$validator->setvalName('password')->setval($_POST['password'])->required()->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/');

if (!empty($validator->getErrors())) {
    $_SESSION['errors'] = $validator->getErrors();
    $_SESSION['old'] = $_POST;
    header('location:../../../public/signin.php');
}

$user = new User;
$result = $user->setEmail($_POST['email'])->getUserWithEmail();

if ($result->num_rows != 1) {
    $_SESSION['errors']['email']['wrong'] = "Email Not Exists";
    $_SESSION['old'] = $_POST;
    header('location:../../../public/signin.php');
}

$user = $result->fetch_object(User::class);

if (!password_verify($_POST['password'], $user->getPassword())) {
    $_SESSION['errors']['password']['wrong'] = "Wrong Password";
    $_SESSION['old'] = $_POST;
    header('location:../../../public/signin.php');
    die;
}
if ($user->getStatus() == 0) {
    $_SESSION['errors']['something']['block'] = "Your Account Blocked!";
    $_SESSION['old'] = $_POST;
    header('location:../../../public/signin.php');
    die;
}
if (is_null($user->getEmail_verified_at())) {
    $_SESSION['verification_email'] = $_POST['email'];
    header('location:../../../public/verification-code.php');
    die;
}

if (isset($_POST['RememberMe'])) {
    $rememberToken = uniqid(more_entropy: true);
    $user->setRememberToken($rememberToken)->updateRememberToken();
    setcookie('userToken', $rememberToken, time() + (24 * 60 * 60), '/');
}


$_SESSION['user'] = $user->safeData();
header('location:../../../public/index.php');
