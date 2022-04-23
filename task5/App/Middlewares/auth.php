<?php
if(empty($_SESSION['user'])){
    header('location:../public/signin.php');die;
}