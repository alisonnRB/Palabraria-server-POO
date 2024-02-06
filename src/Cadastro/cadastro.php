<?php


include_once '../login/Login.php';
include_once '../Usuario/Usuario.php';
include_once '../Palavra/Palavra.php';

class Cadastro extends Login
{
    protected $OBJ;
    public function __construct($OBJ)
    {
        $this->createConnection();

        if ($OBJ instanceof Usuario) {
            $this->setOBJ($OBJ);
        } else if ($OBJ instanceof Palavra) {
            $this->setOBJ($OBJ);
        } else {
            $erro = new Respost(200, false, 'erro');
            $erro->Return();
        }
    }

    public function Decide_user()
    {
        if (!$this->getOBJ()) {
            return false;
        } else if ($this->getOBJ()->getMethod() == 'POST') {
            $this->Create_user();
        } else if ($this->getOBJ()->getMethod() == 'GET') {
            $this->search_user();
        } else if ($this->getOBJ()->getMethod() == 'DELETE') {
            $id = $this->getOBJ()->getId();

            $stmt = $this->conect->prepare("SELECT tipo FROM usuarios WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (($stmt[0] && $stmt[0]['tipo'])) {
                if ($this->getOBJ()->list[$this->getOBJ()->getAuth()->tipo] < $this->getOBJ()->list[$stmt[0]['tipo']]) {
                    $this->delete_user();
                } else if ($this->getOBJ()->list[$this->getOBJ()->getAuth()->tipo] == $this->getOBJ()->list[$stmt[0]['tipo']]) {
                    $erro = new Respost(200, false, "Você não pode excluir alguem com mesmo nível!!");
                    $erro->Return();
                } else {
                    $erro = new Respost(200, false, "Você não tem permissão!!");
                    $erro->Return();
                }
            }
        }
    }

    public function Decide_word()
    {
        if (!$this->getOBJ()) {
            return false;
        } else if ($this->getOBJ()->getMethod() == 'POST') {
            $this->create_word();
        }
    }

    private function create_user()
    {
        try {
            $nome = $this->getOBJ()->getUser();
            $senha = $this->Code_pass($this->getOBJ()->getSenha());
            $permition = $this->getOBJ()->getPermition();
            $cadastrante = $this->getOBJ()->getAuth()->id;

            $stmt = $this->conect->prepare("SELECT user FROM usuarios WHERE user = :user");
            $stmt->execute([":user" => $nome]);
            $stmt = $stmt->fetch();

            if ($stmt && $stmt[0]) {
                $erro = new Respost(200, false, "Usuario existente!!");
                $erro->Return();
            }


            $stmt = $this->conect->prepare("INSERT INTO usuarios (user, senha, tipo, cadastrante) VALUES (:user, :senha, :tipo, :cadastrante)");
            $stmt->bindParam(":user", $nome);
            $stmt->bindParam(":senha", $senha);
            $stmt->bindParam(":tipo", $permition);
            $stmt->bindParam(":cadastrante", $cadastrante);
            $stmt->execute();

            $erro = new Respost(200, true);
            $erro->Return();

        } catch (PDOException $e) {
            $erro = new Respost(200, false, "não foi possivel cadastrar!!");
            $erro->Return();
        }
    }

    private function create_word()
    {
        try {
            $palavra = $this->getObj()->getformularios()->form1->ENpalavra;
            $traducao = $this->getObj()->getformularios()->form1->PTpalavra;
            $classificacao1 = $this->getObj()->getformularios()->form1->campo1;
            $classificacao2 = $this->getObj()->getformularios()->form1->campo2;
            $descricao = $this->getObj()->getformularios()->form1->descricao;

            $consulta = "INSERT INTO palavras (palavra, traducao, descricao, classificacao1, classificacao2, cadastrante";
            $itens = " VALUES (:palavra, :traducao, :descricao, :classificacao1, :classificacao2, :cadastrante";
            $list = [
                ':palavra' => $palavra,
                ':traducao' => $traducao,
                ':descricao' => $descricao,
                ':classificacao1' => $classificacao1,
                ':classificacao2' => $classificacao2,
                ':cadastrante' => $this->getOBJ()->getAuth()->id
            ];


            $this->imagem_defined($consulta, $itens, $list);


            if($this->getOBJ()->getformularios()->form3){
                if($this->getOBJ()->getformularios()->form3->transcricao){
                    $consulta = $consulta . ", transcricao";
                    $itens = $itens .", :transcricao";
                    $list[':transcricao'] = $this->getOBJ()->getformularios()->form3->transcricao;
                }

                if($this->getOBJ()->getformularios()->form3->expressao1){
                    $consulta = $consulta . ", expressao1";
                    $itens = $itens .  ", :expressao1";
                    $list[':expressao1'] = $this->getOBJ()->getformularios()->form3->expressao1;
                }

                if($this->getOBJ()->getformularios()->form3->expressao2){
                    $consulta = $consulta . ", expressao2";
                    $itens = $itens . ", :expressao2";
                    $list[':expressao2'] = $this->getOBJ()->getformularios()->form3->expressao2;
                }

                if($this->getOBJ()->getformularios()->form3->expressao3){
                    $consulta = $consulta .", expressao3";
                    $itens = $itens . ", :expressao3";
                    $list[':expressao3'] = $this->getOBJ()->getformularios()->form3->expressao3;
                }

                if($this->getOBJ()->getformularios()->form3->expressao4){
                    $consulta = $consulta . ", expressao4";
                    $itens = $itens . ", :expressao4";
                    $list[':expressao4'] = $this->getOBJ()->getformularios()->form3->expressao4;
                }
            }


            $consulta = $consulta . ') ' . $itens . ')';

            $stmt = $this->conect->prepare($consulta);
            $stmt->execute($list);

        } catch (PDOException $e) {
            $erro = new Respost(200, false, $e);
            $erro->Return();
        }
    }

    protected function imagem_defined(&$consulta, &$itens, &$list)
    {

        $count = 0;

        foreach ($this->getOBJ()->getformularios()->form2 as $image) {
            $count += 1;
            if ($image) {
                
                $name = $this->getOBJ()->SaveImage($image);

                $consulta = $consulta . ', imagem' . $count;
                $itens = $itens . ', :imagem' . $count;
                $list[':imagem' . $count] = $name;

            }
        }
    }

    private function search_user()
    {
        if ($this->getOBJ()->getId() == 0) {
            try {
                $stmt = $this->conect->prepare('SELECT id, user, tipo FROM usuarios');
                $stmt->execute();
                $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $erro = new Respost(200, true, $stmt);
                $erro->Return();

            } catch (PDOException $e) {
                $erro = new Respost(200, false, "não foi possivel Buscar!!");
                $erro->Return();
            }

        }
    }

    private function delete_user()
    {
        try {
            $id = $this->getOBJ()->getId();
            $stmt = $this->conect->prepare("DELETE FROM usuarios WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $erro = new Respost(200, true);
            $erro->Return();

        } catch (PDOException $e) {
            $erro = new Respost(200, false, "não foi possivel cadastrar!!");
            $erro->Return();
        }

    }

    private function Code_pass($value)
    {
        $pass = password_hash($value, PASSWORD_DEFAULT);
        return $pass;
    }


    private function getOBJ()
    {
        return $this->OBJ;
    }

    private function setOBJ($value)
    {
        $this->OBJ = $value;
    }
}