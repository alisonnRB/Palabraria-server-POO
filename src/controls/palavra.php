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

if ($_FILES) {
    $images = (object) array();
    foreach ($_FILES as $key => $value) {
        $images->{$key} = $value;
    }
} else {
    $images = false;
}

if($_POST['form3']){
    $form3 = json_decode($_POST['form3']);
}else{
    $form3 = false;
}


$list = (object) array(
    'form1' => json_decode($_POST['form1']),
    'form2' => $images,
    'form3' => $form3
);


if ($method == 'POST') {
    $word = new Palavra($method, $list, $login);
}


$cadastro = new Cadastro($word);
$cadastro->Decide_word();