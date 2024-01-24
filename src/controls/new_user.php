<?php

include_once '../Usuario/Usuario.php';
include_once '../Cadastro/cadastro.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE, PATCH');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

$token = $_SERVER['HTTP_AUTHORIZATION'];
$method = $_SERVER['REQUEST_METHOD'];

$token = str_replace('Bearer ', '', $token);
$login = new Login(false, false, $token);

$body = file_get_contents('php://input');
$body = json_decode($body);

if ($method == 'POST' || $method == 'PUT' || $method == 'PATCH') {
    $user = new Usuario($method, $body->user, $body->senha, $body->permition, $login);
} else if ($method == 'GET') {
    $user = new Usuario($method, null, null, null, $login, $_GET['id']);
} else if ($method == 'DELETE') {
    $user = new Usuario($method, null, null, null, $login);
}

$cadastrar = new Cadastro($user);