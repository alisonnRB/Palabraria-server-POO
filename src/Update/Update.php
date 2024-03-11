<?php


include_once '../login/Login.php';

class Update extends Login
{

    protected $form;

    public function __construct($form)
    {
        $this->createConnection();
        $this->setForm(json_decode($form));
        $this->UpdatePavra();
    }

    protected function UpdatePavra()
    {
        try {
            $id = $this->getForm()->id;
            $palavra = $this->getForm()->palavra;
            $traducao = $this->getForm()->traducao;
            $campo1 = $this->getForm()->campo1;
            $campo2 = $this->getForm()->campo2;
            $desc = $this->getForm()->desc;
            $bd = $this->getForm()->type == "unic" ? "palavras" : "palavras_mod";

            $stmt = $this->conect->prepare("UPDATE $bd SET palavra = :palavra, traducao = :traducao, classificacao1 = :classificacao1, classificacao2 = :classificacao2, descricao = :descricao WHERE id = :id");
            $stmt->bindParam(":palavra", $palavra);
            $stmt->bindParam(":traducao", $traducao);
            $stmt->bindParam(":classificacao1", $campo1);
            $stmt->bindParam(":classificacao2", $campo2);
            $stmt->bindParam(":descricao", $desc);
            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $erro = new Respost(200, true);
            $erro->Return();


        } catch (PDOException $e) {
            $erro = new Respost(200, false, "não foi possivel cadastrar!!");
            $erro->Return();
        }
    }


    public function getForm()
    {
        return $this->form;
    }

    private function setForm($value)
    {
        $this->form = $value;
    }



}