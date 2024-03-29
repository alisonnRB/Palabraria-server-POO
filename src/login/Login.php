<?php

require_once '../conexao/conexao.php';

require_once "../../vendor/autoload.php";
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;




class Login extends Connection
{
    protected $user;
    protected $senha;
    protected $auth;
    private $key;

    public function __construct($user = false, $senha = false, $token = null)
    {
        $this->createConnection();
        $this->key = Dotenv\Dotenv::createImmutable(dirname(__FILE__, 3));
        $this->key->load();

        if ($token) {
            $infos = $this->decodeToken($token);
            if ($infos) {
                $this->setAuth($infos);
            } else {
                $erro = new Respost(401, false);
                $erro->Return();
            }

        } else {
            $this->setUser($user);
            $this->setSenha($senha);
        }

    }

    public function Verify_user()
    {
        $stmt = $this->conect->prepare("SELECT id, user, senha, tipo FROM usuarios WHERE user = :user");
        $stmt->execute([":user" => $this->getUser()]);
        $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($stmt && $stmt[0]) {
            $stmt = $stmt[0];
            if (password_verify($this->getSenha(), $stmt['senha'])) {
                $token = $this->geraToken($stmt['user'], $stmt['tipo'], $stmt['id']);
                $erro = new Respost(200, true, $token);
                $erro->Return();
            } else {
                $erro = new Respost(200, false, "As senhas não coicidem!!");
                $erro->Return();
            }

        } else {
            $erro = new Respost(200, false, 'Usuário não cadastrado!!');
            $erro->Return();
        }
    }

    public function Verify_auth()
    {
        if ($this->getAuth()) {
            $erro = new Respost(200, true, array('user' => $this->getAuth()->user, 'tipo' => $this->getAuth()->tipo, 'id' => $this->getAuth()->id));
            $erro->Return();
        } else {
            $erro = new Respost(401, false);
            $erro->Return();
        }
    }

    private function geraToken($user, $tipo, $id)
    {

        $payload = array(
            "exp" => time() + 86200,
            "iat" => time(),
            "user" => $user,
            "tipo" => $tipo,
            "id" => $id
        );

        $token = JWT::encode($payload, $_ENV['KEY'], 'HS256');
        return $token;
    }

    private function decodeToken($token)
    {
        try {
            $decoded = JWT::decode($token, new Key($_SERVER['KEY'], 'HS256'));
            return $decoded;
        } catch (Throwable $e) {
            if ($e->getMessage() == 'Expired token') {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    private function getUser()
    {
        return $this->user;
    }

    private function setUser($value)
    {
        if ($value) {
            $value = strip_tags($value);
            $this->user = $value;
        } else {
            $erro = new Respost(200, false, 'O campo de usuario deve ser preenchido!!');
            $erro->Return();
        }
    }

    private function getSenha()
    {
        return $this->senha;
    }

    private function setSenha($value)
    {
        if ($value) {
            $value = strip_tags($value);
            $this->senha = $value;
        } else {
            $erro = new Respost(200, false, 'O campo de senha deve ser preenchido!!');
            $erro->Return();
        }
    }

    public function getAuth()
    {
        return $this->auth;
    }

    private function setAuth($valor)
    {
        $this->auth = $valor;
    }
}

