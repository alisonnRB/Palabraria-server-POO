<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

include_once '../login/Login.php';

// Obtenha o corpo da requisição e decodifique como JSON
$body = file_get_contents('php://input');
$body = json_decode($body);

$login = new Login($body->user, $body->senha);
$login->Verify_user();