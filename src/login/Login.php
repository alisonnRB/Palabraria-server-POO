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
        $stmt = $this->conect->prepare("SELECT user, senha, tipo FROM usuarios WHERE user = :user");
        $stmt->execute([":user" => $this->getUser()]);
        $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = $stmt[0];

        if ($stmt) {
            if (password_verify($this->getSenha(), $stmt['senha'])) {
                //TODO iniciar token
            } else {
                $erro = new Respost(400, false, "As senhas não coicidem");
                $erro->Return();
            }

        } else {
            $erro = new Respost(400, false, 'Usuário não cadastrado!');
            $erro->Return();
        }
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
            $this->senha = $value;
        } else {
            $erro = new Respost(400, false, 'o campo de senha deve ser preenchido');
            $erro->Return();
        }
    }
}

$login = new Login('admin', 'admin');
$login->Verify_user();
