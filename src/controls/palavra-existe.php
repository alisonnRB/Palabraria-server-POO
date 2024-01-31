<?php

include_once '../conexao/conexao.php';
include_once '../Login/Login.php';
include_once '../resposta/resposta.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE, PATCH');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

$token = $_SERVER['HTTP_AUTHORIZATION'];
$method = $_SERVER['REQUEST_METHOD'];

$token = str_replace('Bearer ', '', $token);
$login = new Login(false, false, $token);

existe($_GET['palavra']);

function existe($word)
{
    $word = strip_tags($word);

    $con = new Connection;
    $con->createConnection();

    $stmt = $con->getConect()->prepare('SELECT palavra FROM palavras WHERE palavra = :palavra');
    $stmt->bindParam(':palavra', $word);
    $stmt->execute();
    $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(!$stmt || !$stmt[0]){
        $resposta = new Respost(200, true, 'palavra disponivel');
        $resposta->Return();
    }else{
        $resposta = new Respost(200, false, 'essa palavra ja foi catalogada');
        $resposta->Return();
    }
}