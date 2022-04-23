<?php
session_start();
include_once "../vendor/autoload.php";

use App\Database\Models\User;

if(!isset($_SESSION['user']) && isset($_COOKIE['userToken'])){
    $userObj = new User;
    $user = $userObj->setRememberToken($_COOKIE['userToken'])->getUserByToken()->fetch_object(User::class);
    $_SESSION['user'] = $user->safeData();
}
// print_r($_SESSION['user']->email);
?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> <?= $title ?> </title>
    <meta name="description" content="">
    <meta name="robots" content="noindex, follow" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.png">

    <!-- all css here -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/slick.css">
    <link rel="stylesheet" href="../assets/css/chosen.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/ionicons.min.css">
    <link rel="stylesheet" href="../assets/css/jquery-ui.css">
    <link rel="stylesheet" href="../assets/css/meanmenu.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <script src="../assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <?= $css ?? '' ?>
</head>

<body>