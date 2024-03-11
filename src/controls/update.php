<?php


include_once '../Update/Update.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE, PATCH');
header('Access-Control-Allow-Headers: *');



$update = new Update($_POST["form"]);