<?php


include_once '../Cadastro/cadastro.php';
include_once '../resposta/resposta.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE, PATCH');
header('Access-Control-Allow-Headers: Content-Type, Authorization');


$token = $_SERVER['HTTP_AUTHORIZATION'];
$method = $_SERVER['REQUEST_METHOD'];

$token = str_replace('Bearer ', '', $token);
$login = new Login(false, false, $token);

$body = file_get_contents('php://input');
$body = json_decode($body);




$cadastrar = new Cadastro($user);
$cadastrar->Decide_user();