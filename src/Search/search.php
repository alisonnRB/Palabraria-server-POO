<?php


include_once '../login/Login.php';

class Search extends Login
{
    protected $tipo;

    protected $pesquisa;

    protected $index;

    protected $bd;

    public function __construct(string $tipo, string $pesquisa, int $index, string $bd = '')
    {
        $this->createConnection();
        $this->setTipo($tipo);
        $this->setPesquisa($pesquisa);
        $this->setIndex($index);
        $this->setBd($bd);

        $this->decide_search();
    }

    protected function decide_search()
    {
        if ($this->getTipo() == 'normal') {
            $this->normalSearch();
        } else if ($this->getTipo() == 'unic') {
            $this->unicSearch();
        } else if ($this->getTipo() == 'moder') {
            $this->moderSearch();
        }

    }

    private function normalSearch()
    {
        try {
            $palavra = '%' . $this->getPesquisa() . '%';
            $index = $this->getIndex();

            $stmt = $this->conect->prepare("SELECT id, palavra, descricao, imagem1 FROM palavras WHERE (palavra LIKE :palavra) OR (descricao LIKE :palavra) OR (traducao LIKE :palavra) ORDER BY palavra ASC LIMIT 6 OFFSET $index");
            $stmt->bindParam(':palavra', $palavra);
            $stmt->bindParam(':id', $index);
            $stmt->execute();
            $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);


            if ($stmt) {
                $res = new Respost(200, true, $stmt);
                $res->Return();
            } else {
                $res = new Respost(200, false);
                $res->Return();
            }


        } catch (PDOException $e) {
            $res = new Respost(200, false);
            $res->Return();
        }

    }

    private function unicSearch()
    {
        try {
            $index = $this->getIndex();

            $stmt = $this->conect->prepare("SELECT id, palavra, traducao, descricao, imagem1, imagem2, imagem3, imagem4, imagem5, imagem6, transcricao, expressao1, expressao2, expressao3, expressao4 FROM palavras WHERE id = :id");
            $stmt->bindParam(':id', $index);
            $stmt->execute();
            $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($stmt) {
                $res = new Respost(200, true, $stmt);
                $res->Return();
            } else {
                $res = new Respost(200, false);
                $res->Return();
            }

        } catch (PDOException $e) {
            $res = new Respost(200, false);
            $res->Return();
        }

    }

    private function moderSearch()
    {
        try {
            $palavra = '%' . $this->getPesquisa() . '%';
            $index = $this->getIndex();
            $bd = $this->getBd() == "mod" ? 'palavras_mod' : 'palavras';

            $stmt = $this->conect->prepare("SELECT id, palavra, descricao, imagem1 FROM $bd WHERE (palavra LIKE :palavra) OR (descricao LIKE :palavra) OR (traducao LIKE :palavra) ORDER BY palavra ASC LIMIT 6 OFFSET $index");
            $stmt->bindParam(':palavra', $palavra);
            $stmt->bindParam(':id', $index);
            $stmt->execute();
            $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);


            if ($stmt) {
                $res = new Respost(200, true, $stmt);
                $res->Return();
            } else {
                $res = new Respost(200, false, "mi");
                $res->Return();
            }


        } catch (PDOException $e) {
            $res = new Respost(200, false, $e);
            $res->Return();
        }
    }


    public function getTipo()
    {
        return $this->tipo;
    }

    private function setTipo($value)
    {
        $this->tipo = $value;
    }

    public function getPesquisa()
    {
        return $this->pesquisa;
    }

    private function setPesquisa($value)
    {
        $this->pesquisa = $value;
    }

    public function getIndex()
    {
        return $this->index;
    }

    private function setIndex($value)
    {
        $this->index = $value;
    }

    public function getBd()
    {
        return $this->bd;
    }

    private function setBd($value)
    {
        $this->bd = $value;
    }
}