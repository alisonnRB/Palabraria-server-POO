<?php


include_once '../Cadastro/cadastro.php';
include_once '../resposta/resposta.php';
include_once '../Palavra/Palavra.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE, PATCH');
header('Access-Control-Allow-Headers: *');


$token = $_SERVER['HTTP_AUTHORIZATION'];
$method = $_SERVER['REQUEST_METHOD'];

$token = str_replace('Bearer ', '', $token);
$login = new Login(false, false, $token);

// $erro = new Respost(200, false, $_POST['form1']);
// $erro->Return();

$list = array(
    'form1' => $_POST['form1']
);

if ($method == 'POST') {
    $word = new Palavra($method, $list, $login);
}

$cadastro = new Cadastro($word);
$cadastro->Decide_word();