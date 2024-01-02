<?php

include_once '../conexao/conexao.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');


class Login extends Connection
{
    protected $user;
    protected $senha;

    public function __construct($user = false, $senha = false)
    {
        $this->setUser($user);
        $this->setSenha($senha);
        $this->createConnection();
    }

    public function Verify_user()
    {
        //this->conect
    }

    private function getUser()
    {
        return $this->user;
    }

    private function setUser($value)
    {
        if ($value) {
            $value = strip_tags($value);
            $this->user = $value;
        } else {
            $erro = new Respost(400, false, 'o campo de usuario deve ser preenchido');
            $erro->Return();
        }
    }

    private function getSenha()
    {
        return $this->senha;
    }

    private function setSenha($value)
    {

        if ($value) {
            $value = strip_tags($value);
            $value = (password_hash($value, PASSWORD_DEFAULT));
            $this->senha = $value;
        } else {
            $erro = new Respost(400, false, 'o campo de senha deve ser preenchido');
            $erro->Return();
        }
    }
}

$login = new Login('oi', 'oko');
$login->Verify_user();
