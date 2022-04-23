<?php
session_start();

include_once "../../Middlewares/RequestPost.php";
include_once "../../../vendor/autoload.php";


use App\Helpers\media;
use App\Database\Models\User;
use App\Http\Requests\Validation;

if (isset($_POST['update-profile'])) {
    $validator = new Validation;
    $validator->setValName('first_name')->setVal($_POST['first_name'])->required()->max(32);
    $validator->setValName('last_name')->setVal($_POST['last_name'])->required()->max(32);
    $validator->setValName('gender')->setVal($_POST['gender'])->required()->in(['f', 'm']);

    if (!empty($validator->getErrors())) {
        $_SESSION['errors'] = $validator->getErrors();
        $_SESSION['old'] = $_POST;
        header('location:../../../public/myAccount.php');
        die;
    }

    $userObj = new User;
    $userObj->setFirst_name($_POST['first_name'])->setLast_name($_POST['last_name'])
        ->setGender($_POST['gender'])->setEmail($_SESSION['user']->email);
    if ($userObj->update()) {
        $user = $userObj->setEmail($_SESSION['user']->email)->getUserWithEmail()->fetch_object(User::class);
        $_SESSION['user'] = $user->safeData();
        $_SESSION['success'] = "<div class='alert alert-success text-center'> Profile Updated Successfully </div>";
        header('location:../../../public/myAccount.php?changeInfo=changeInfo');
        die;
    } else {
        $_SESSION['errors']['something']['wrong'] = "Something Went Wrong";
    }
}

if (isset($_POST['changeImage'])) {
    if ($_FILES['image']['name'] == 'default.jpg') {
        header('location:../../../public/myAccount.php');
        die;
    }
    if ($_FILES['image']['error'] == 0) {
        $media = new media($_FILES['image']);
        $media->size(5 * (10 ** 6))->extension('png,jpeg,jpg,gif');

        if (empty($media->getErrors())) {
            $userObj = new User;
            $user = $userObj->setEmail($_SESSION['user']->email)->getUserWithEmail()->fetch_object(User::class);
            $media->upload('../../../assets/img/users/');
            if ($user->getImage() != 'default.jpg') {
                Media::delete('../../../assets/img/users/' . $user->getImage());
            }

            if ($user->setImage($media->newFileName)->updateImage()) {
                $_SESSION['user']->image = $media->newFileName;
                $_SESSION['success'] = "<div class='alert alert-success text-center'> Profile Image Updated Successfully </div>";
                header('location:../../../public/myAccount.php?changeInfo=changeInfo');
                die;
            } else {
                $_SESSION['errors']['something']['wrong'] = " Something Went Wrong ";
            }
        } else {
            $_SESSION['errors']['size'] = $media->getError('size');
            $_SESSION['errors']['extension'] = $media->getError('extension');
            $_SESSION['old'] = $_POST;
            header('location:../../../public/myAccount.php?image=image');
            die;
        }
    }
}
if (isset($_POST['removeImage'])) {
    $userObj = new user;
    $user = $userObj->setEmail($_SESSION['user']->email)->getUserWithEmail()->fetch_object(User::class);
    Media::delete('../../../assets/img/users/' . $user->getImage());
    $user->deleteImage();
    $_SESSION['user']->image = "default.jpg";
    header('location:../../../public/myAccount.php?image=image');
    die;
}
