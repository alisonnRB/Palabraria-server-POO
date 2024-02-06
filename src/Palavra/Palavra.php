<?php

include_once '../login/Login.php';
include_once '../resposta/resposta.php';

class Palavra
{
    protected $method;

    protected $formularios;

    public $auth;

    public function __construct($method, $formularios, Login $auth)
    {
        $this->setMethod($method);
        $this->setformularios($formularios);
        $this->setauth($auth);
        $this->sanitize_form1();

        if ($this->getformularios()->form2) {
            $this->images_filter();
        }

        
        if ($this->getformularios()->form3) {
            $this->sanitize_form3();
        }

    }

    public function sanitize_form1()
    {
        $this->getformularios()->form1->ENpalavra = strip_tags($this->getformularios()->form1->ENpalavra);
        $this->getformularios()->form1->PTpalavra = strip_tags($this->getformularios()->form1->PTpalavra);
        $this->getformularios()->form1->campo1 = strip_tags($this->getformularios()->form1->campo1);
        $this->getformularios()->form1->campo2 = strip_tags($this->getformularios()->form1->campo2);
        $this->getformularios()->form1->descricao = strip_tags($this->getformularios()->form1->descricao);
    }

    public function sanitize_form3()
    {
        if ($this->getformularios()->form3->transcricao) {
            $this->getformularios()->form3->transcricao = strip_tags($this->getformularios()->form3->transcricao);
        }

        if ($this->getformularios()->form3->expressao1) {
            $this->getformularios()->form3->expressao1 = strip_tags($this->getformularios()->form3->expressao1);
        }

        if ($this->getformularios()->form3->expressao2) {
            $this->getformularios()->form3->expressao2 = strip_tags($this->getformularios()->form3->expressao2);
        }

        if ($this->getformularios()->form3->expressao3) {
            $this->getformularios()->form3->expressao3 = strip_tags($this->getformularios()->form3->expressao3);
        }

        if ($this->getformularios()->form3->expressao4) {
            $this->getformularios()->form3->expressao4 = strip_tags($this->getformularios()->form3->expressao4);
        }
    }


    public function images_filter()
    {
        foreach ($this->getformularios()->form2 as $value) {
            if (!$this->isImageValid($value)) {
                $erro = new Respost(200, false, 'Tipo de imagem não permitido');
                $erro->Return();
            }
        }
    }

    private function isImageValid($image)
    {
        $allowedMimeTypes = array('image/jpeg', 'image/jpg', 'image/png', 'image/PNG');
        $fileMimeType = mime_content_type($image['tmp_name']);

        if (!in_array($fileMimeType, $allowedMimeTypes)) {
            return false;
        }

        return true;
    }

    public function SaveImage($image)
    {

        $destinationFolder = '../drawble/palavras/';
        if (!file_exists($destinationFolder)) {
            mkdir($destinationFolder, 0777, true); 
        }

        $uniqueName = uniqid('image_', true); 
        $extension = pathinfo($image['name'], PATHINFO_EXTENSION);

        $destinationPath = $destinationFolder . $uniqueName . '.' . $extension;

        if (move_uploaded_file($image['tmp_name'], $destinationPath)) {
            return $uniqueName . '.' . $extension;
        } else {
            return false;
        }
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

    private function setAuth(Login $auth)
    {
        $this->auth = $auth->getAuth();
    }
}
