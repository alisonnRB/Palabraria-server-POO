<?php


include_once '../login/Login.php';

class Search extends Login
{
    protected $tipo;

    protected $pesquisa;

    protected $index;

    public function __construct(string $tipo, string $pesquisa, int $index)
    {
        $this->createConnection();
        $this->setTipo($tipo);
        $this->setPesquisa($pesquisa);
        $this->setIndex($index);

        $this->decide_search();
    }

    protected function decide_search()
    {
        if ($this->getTipo() == 'normal') {
            $this->normalSearch();
        }

    }

    private function normalSearch()
    {
        try {
            $palavra = '%' . $this->getPesquisa() . '%';
            $index = $this->getIndex();

            $stmt = $this->conect->prepare("SELECT id, palavra, descricao, imagem1 FROM palavras WHERE (palavra LIKE :palavra) OR (descricao LIKE :palavra) OR (traducao LIKE :palavra) ORDER BY palavra ASC LIMIT 20 OFFSET $index");
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
}