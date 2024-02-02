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
        }else if($OBJ instanceof Palavra){
            $this->setOBJ($OBJ);
        }else{
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
        if(!$this->getOBJ()){
            return false;
        }else if($this->getOBJ()->getMethod() == 'POST'){
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

    private function create_word(){

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