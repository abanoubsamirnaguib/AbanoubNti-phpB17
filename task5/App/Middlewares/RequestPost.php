<?php
if($_SERVER['REQUEST_METHOD'] === "GET"){
    http_response_code(405);
    die;
    include_once '../../../layouts/errors/405.php';
    die;
}