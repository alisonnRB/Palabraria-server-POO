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
            $this->UpdatePalavra();
        } else if ($this->getForm()->mode == 2) {
            $this->UpdateImages();
        } else if ($this->getForm()->mode == 3) {
            $this->UpdateOthers();
        } else {
            $res = new Respost(200, false, "não autorizado");
            $res->Return();
        }
    }

    protected function UpdatePalavra()
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
        $atuais = $this->serchImages();
        $id = $this->getForm()->id;
        $bd = $this->getForm()->type == "unic" ? "palavras" : "palavras_mod";

        try {

            foreach ($this->getImages() as $key => $value) {
                if ($this->isImageValid($value)) {

                    $nameForSave = $this->substitueIMage($atuais[$key], $value);
                    if ($nameForSave) {
                        $stmt = $this->conect->prepare("UPDATE $bd SET $key = :imageName WHERE id = :id");
                        $stmt->bindParam(':id', $id);
                        $stmt->bindParam(':imageName', $nameForSave);
                        $stmt->execute();
                    }

                } else {
                    $res = new Respost(200, false, "imagem de formato inadequado");
                    $res->Return();
                }

            }

            $res = new Respost(200, true);
            $res->Return();

        } catch (PDOException $e) {

            $res = new Respost(200, false, $e);
            $res->Return();
        }
    }

    private function serchImages()
    {
        try {
            $id = $this->getForm()->id;
            $bd = $this->getForm()->type == "unic" ? "palavras" : "palavras_mod";

            $stmt = $this->conect->prepare("SELECT imagem1, imagem2, imagem3, imagem4, imagem5, imagem6 FROM $bd WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $stmt = $stmt->fetch();

            return $stmt;
        } catch (PDOException $e) {

            $res = new Respost(200, false, "server error");
            $res->Return();
        }
    }

    private function substitueIMage($pastValue, $actualValue)
    {

        $destinationFolder = '../drawble/palavras/';
        if (!file_exists($destinationFolder)) {
            mkdir($destinationFolder, 0777, true);
        }

        $uniqueName = uniqid('image_', true);
        $extension = pathinfo($actualValue['name'], PATHINFO_EXTENSION);
        $destinationPath = $destinationFolder . $uniqueName . '.' . $extension;

        if ($pastValue) {
            $caminhoAntigo = $destinationFolder . $pastValue;

            if (file_exists($caminhoAntigo) && is_file($caminhoAntigo)) {
                unlink($caminhoAntigo);
            }
        }

        if (move_uploaded_file($actualValue['tmp_name'], $destinationPath)) {
            return $uniqueName . '.' . $extension;

        } else {
            return false;
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

    protected function UpdateOthers()
    {
        try {
            $id = $this->getForm()->id;
            $transcricao = $this->getForm()->transcricao;
            $expressao1 = $this->getForm()->expressao1;
            $expressao2 = $this->getForm()->expressao2;
            $expressao3 = $this->getForm()->expressao3;
            $expressao4 = $this->getForm()->expressao4;
            $bd = $this->getForm()->type == "unic" ? "palavras" : "palavras_mod";

            $stmt = $this->conect->prepare("UPDATE $bd SET transcricao = :transcricao, expressao1 = :expressao1, expressao2 = :expressao2, expressao3 = :expressao3, expressao4 = :expressao4 WHERE id = :id");
            $stmt->bindParam(":transcricao", $transcricao);
            $stmt->bindParam(":expressao1", $expressao1);
            $stmt->bindParam(":expressao2", $expressao2);
            $stmt->bindParam(":expressao3", $expressao3);
            $stmt->bindParam(":expressao4", $expressao4);
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

    public function getImages()
    {
        return $this->images;
    }

    private function setimages($value)
    {
        $this->images = $value;
    }
}
