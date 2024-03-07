<?php

include_once '../Search/search.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

$type = $_GET['tipo'];
$search = $_GET['busca'];
$index = $_GET['index'];
$bd = $_GET['bd'] ? $_GET['bd'] : null;

$busca = new Search($type, $search, $index, $bd);