<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

include_once '../login/Login.php';

$body = file_get_contents('php://input');
$body = json_decode($body);


if (!empty($_SERVER['HTTP_AUTHORIZATION'])) {

    $token = $_SERVER['HTTP_AUTHORIZATION'];

    $token = str_replace('Bearer ', '', $token);
    $login = new Login(false, false, $token);

} else {
    $login = new Login($body->user, $body->senha);
    $login->Verify_user();
}


