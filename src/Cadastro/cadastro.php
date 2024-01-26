<?php


include_once '../login/Login.php';
include_once '../Usuario/Usuario.php';

class Cadastro extends Login
{
    protected $usuario;
    public function __construct(Usuario $usuario = null)
    {
        $this->createConnection();

        if ($usuario instanceof Usuario) {
            $this->setUsuario($usuario);
        }
    }

    public function Decide_user()
    {
        if (!$this->getUsuario()) {
            return false;
        } else if ($this->getUsuario()->getMethod() == 'POST') {
            $this->Create_user();
        } else if ($this->getUsuario()->getMethod() == 'PUT') {
        } else if ($this->getUsuario()->getMethod() == 'PATCH') {
        } else if ($this->getUsuario()->getMethod() == 'GET') {
            $this->search_user();
        } else if ($this->getUsuario()->getMethod() == 'DELETE') {
        }
    }

    private function create_user()
    {
        try {
            $nome = $this->getUsuario()->getUser();
            $senha = $this->Code_pass($this->getUsuario()->getSenha());
            $permition = $this->getUsuario()->getPermition();
            $cadastrante = $this->getUsuario()->getAuth()->id;

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

        } catch (PDOException $e) {
            $erro = new Respost(200, false, "não foi possivel cadastrar!!");
            $erro->Return();
        }
    }

    private function search_user()
    {
        if ($this->getUsuario()->getId() == 0) {
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

    private function Code_pass($value)
    {
        $pass = password_hash($value, PASSWORD_DEFAULT);
        return $pass;
    }


    private function getUsuario()
    {
        return $this->usuario;
    }

    private function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;
    }
}