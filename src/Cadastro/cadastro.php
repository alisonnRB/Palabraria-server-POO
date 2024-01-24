<?php


include_once '../login/Login.php';
include_once '../Usuario/Usuario.php';

class Cadastro extends Login
{
    protected $usuario;
    public function __construct(Usuario $usuario = null)
    {
        if ($usuario instanceof Usuario){
            $this->setUsuario($usuario);
        }
    }

    private function getUsuario()
    {
        return $this->usuario;
    }

    private function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;
    }
}