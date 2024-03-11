<?php


include_once '../login/Login.php';

class Update extends Login
{

    protected $form;
    protected $images;

    public function __construct($form, $images = false)
    {
        $this->createConnection();
        $this->setForm(json_decode($form));

        if ($images) {
            $this->setimages($images);
        }

        if ($this->getForm()->mode == 1) {
            $this->UpdatePavra();
        }else if($this->getForm()->mode == 2){
            $this->UpdateImages();
        }

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

    protected function UpdateImages()
    {
        try{

        }catch(PDOException $e){

        }
    }

    private function serchImages()
    {
        
    }


    public function getForm()
    {
        return $this->form;
    }

    private function setForm($value)
    {
        $this->form = $value;
    }

    public function getImages()
    {
        return $this->images;
    }

    private function setimages($value)
    {
        $this->images = $value;
    }



}