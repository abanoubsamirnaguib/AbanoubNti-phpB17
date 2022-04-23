<?php
if(!empty($_SESSION['user'])){
    header('location:../public/index.php');die;
}