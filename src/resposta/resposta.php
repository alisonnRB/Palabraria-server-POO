<?php

class Respost
{
    private $httpResponse;
    private $state;
    private $resposta;

    public function __construct($code, $state, $resposta = false)
    {
        $this->setHttp($code);
        $this->setState($state);
        $this->setResposta($resposta);
    }

    private function encoded()
    {
        if ($this->getResposta()) {
            $require = [
                'ok' => $this->getState(),
                'response' => $this->getResposta()
            ];
        } else {
            $require = [
                'ok' => $this->getState()
            ];
        }

        return json_encode($require);
    }

    public function Return()
    {
        $resposta = $this->encoded();
        http_response_code($this->getHttp());
        echo $resposta;
        die;
    }

    private function getState()
    {
        return $this->state;
    }

    private function setState($value)
    {
        $this->state = $value;
    }

    private function getResposta()
    {
        return $this->resposta;
    }

    private function setResposta($value)
    {
        $this->resposta = $value;
    }

    private function getHttp()
    {
        return $this->httpResponse;
    }

    private function setHttp($value)
    {
        $this->httpResponse = $value;
    }
}

// Exemplo de uso da classe Respost
// $resposta = new Respost(200, true);
// $resposta->Return();
