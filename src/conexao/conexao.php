<?php

require_once '../resposta/resposta.php';

class Connection extends Respost
{
    protected $conect;
    private $state;

    public function __construct()
    {

    }

    public function createConnection()
    {
        try {
            $this->conect = new PDO("mysql:host=localhost;dbname=palabraria", "root", "");
            $this->setState(true);
        } catch (PDOException $e) {
            $this->setState(false);
        }

        if ($this->state) {
            return $this->conect;
        } else {
            $erro = new Respost(500, false, 'Impossivel conectar ao servidor');
            $erro->Return();
        }
    }

    public function GetConect()
    {
        return $this->conect;
    }

    protected function GetState()
    {
        return $this->state;
    }

    protected function setState($value)
    {
        $this->state = $value;
    }
}
