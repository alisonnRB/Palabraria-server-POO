<?php

include_once '../login/Login.php';
include_once '../resposta/resposta.php';

class Usuario
{
    protected $user;
    protected $senha;
    protected $permition;
    protected $method;
    protected $auth;
    protected $id;

    public $list = array(
        "admin" => 1,
        "moderador" => 2,
        "instituicao" => 3
    );
    public function __construct($method, $user = null, $senha = null, $permition = null, Login $auth, $id = 0)
    {
        $this->setMethod($method);
        $this->setAuth($auth);
        $this->setPermition($permition);
        $this->setId($id);



        if ($this->getMethod() == 'POST') {

            if ($this->list[$this->getAuth()->tipo] >= 3) {
                $erro = new Respost(200, false, 'Apenas o adm e moderadores podem cadastrar ou modificar usuários!!');
                $erro->Return();
            } else if ($this->getAuth()->tipo == 'moderador' && $this->list[$this->getPermition()] != 3) {
                $erro = new Respost(200, false, 'Moderadores não podem criar ou modificar novos moderadores ou admins');
                $erro->Return();
            } else if ($this->getAuth()->tipo == 'instituição') {
                $erro = new Respost(200, false, 'Você não tem permissão para isso!');
                $erro->Return();
            }


            if (!$user && !$senha) {
                $erro = new Respost(200, false, 'Os campos devem ser preenchidos!!');
                $erro->Return();
            } else if ($user) {
                $this->setUser($user);
            } else {
                $erro = new Respost(200, false, 'O campo de usuario deve ser preenchido!!');
                $erro->Return();
            }



            if ($senha) {
                $this->setSenha($senha);
            } else {
                $erro = new Respost(200, false, 'O campo de senha deve ser preenchido!!');
                $erro->Return();
            }

        } else if ($this->getMethod() == 'PATCH') {
            if (!$user && !$senha) {
                $erro = new Respost(200, false, 'Os campos devem ser preenchidos!!');
                $erro->Return();
            } else {
                $this->setUser($user);
                $this->setSenha($senha);
            }
        } else if ($this->getMethod() == 'DELETE') {

            if ($this->list[$this->getAuth()->tipo] >= 3) {
                $erro = new Respost(200, false, 'Apenas o adm e moderadores podem excluir usuários!!');
                $erro->Return();
            }

        }
    }

    public function getUser()
    {
        return $this->user;
    }

    private function setUser($value)
    {
        if ($value) {
            $value = strip_tags($value);
            $this->user = $value;
        } else {
            $erro = new Respost(200, false, 'O campo de usuario deve ser preenchido!!');
            $erro->Return();
        }
    }

    public function getSenha()
    {
        return $this->senha;
    }

    private function setSenha($value)
    {
        if ($value) {
            $value = strip_tags($value);
            $this->senha = $value;
        } else {
            $erro = new Respost(200, false, 'O campo de senha deve ser preenchido!!');
            $erro->Return();
        }
    }

    public function getPermition()
    {
        return $this->permition;
    }

    private function setPermition($value)
    {
        $this->permition = strip_tags($value);
    }

    public function getId()
    {
        return $this->id;
    }

    private function setId($value)
    {
        $this->id = strip_tags($value);
    }

    public function getMethod()
    {
        return $this->method;
    }

    private function setMethod($value)
    {
        $this->method = $value;
    }
    public function getAuth()
    {
        return $this->auth;
    }

    private function setAuth(Login $auth)
    {
        $this->auth = $auth->getAuth();
    }
}
