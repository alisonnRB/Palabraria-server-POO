<?php


include_once '../Update/Update.php';
include_once '../resposta/resposta.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE, PATCH');
header('Access-Control-Allow-Headers: *');

$method = $_SERVER['REQUEST_METHOD'];
$token = $_SERVER['HTTP_AUTHORIZATION'];


$token = str_replace('Bearer ', '', $token);
$login = new Login(false, false, $token);

if($login->getAuth()->tipo != "admin" || $login->getAuth()->tipo != "moder"){
    $res = new Respost(200, false, "não autorizado");
    $res->Return();
}

if($method == "DELETE" || $method == "PUT"){
    $form = [
        "type" => $_GET["type"],
        "id" => $_GET["id"]
    ];

    $update = new Update($form, false, $method);
}

if ($_FILES) {
    $images = (object) array();
    foreach ($_FILES as $key => $value) {
        $images->{$key} = $value;
    }
} else {
    $images = false;
}

$update = new Update($_POST["form"], $images);