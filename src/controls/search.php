<?php

include_once '../Search/search.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

$type = $_GET['tipo'];
$search = $_GET['busca'];
$index = $_GET['index'];
if (isset($_GET['bd'])) {
    $bd = $_GET['bd'];
    $busca = new Search($type, $search, $index, $bd);
}

$busca = new Search($type, $search, $index);
