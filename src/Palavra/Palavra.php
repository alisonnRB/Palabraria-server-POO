<?php

include_once '../login/Login.php';
include_once '../resposta/resposta.php';

class Palavra
{
    protected $method;

    protected $formularios;

    protected $auth;

    public function __construct($method, $formularios, Login $auth )
    {
        $this->setMethod($method);
        $this->setformularios($formularios);
        $this->setauth($auth);

        $this->sanitize();
        $a = new Respost(200, false, $this->getformularios()->form1);
        $a->Return();
    }

    public function sanitize()
    {
        $this->getformularios()->form1->ENpalavra = strip_tags($this->getformularios()->form1->ENpalavra);
        $this->getformularios()->form1->PTpalavra = strip_tags($this->getformularios()->form1->PTpalavra);
        $this->getformularios()->form1->campo1 = strip_tags($this->getformularios()->form1->campo1);
        $this->getformularios()->form1->campo2 = strip_tags($this->getformularios()->form1->campo2);
        $this->getformularios()->form1->descricao = strip_tags($this->getformularios()->form1->descricao);
    }


    public function getMethod()
    {
        return $this->method;
    }

    public function setMethod($value)
    {
        $this->method = $value;
    }

    public function getformularios()
    {
        return $this->formularios;
    }

    public function setformularios($value)
    {
        $this->formularios = $value;
    }

    public function getauth()
    {
        return $this->auth;
    }

    public function setauth($value)
    {
        $this->auth = $value;
    }
}
