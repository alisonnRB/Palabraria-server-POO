<?php


include_once '../Update/Update.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE, PATCH');
header('Access-Control-Allow-Headers: *');

$method = $_SERVER['REQUEST_METHOD'];

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