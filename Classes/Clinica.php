<?php

class Clinica
{

    private $identificacao;

    private $nomeC;

    private $contato;

    private $email;

    private $senha;


    public function __construct(){}

    /**
     *
     *
     */

    public function getSenha()
    {
        return $this->senha;
    }
    
    public function getIdentificacao()
    {
        return $this->identificacao;
    }

    public function getNomeC()
    {
        return $this->nomeC;
    }

    public function getContato()
    {
        return $this->contato;
    }

    public function getEmail()
    {
        return $this->email;
    }

    /**
     *
     * @param mixed $senha
     */

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function setIdentificacao($iden)
    {
        $this->identificacao = $iden;
    }

    public function setNomeC($nome)
    {
        $this->nomeC = $nome;
    }

    public function setContato($telefone)
    {
        $this->contato = $telefone;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
}
?>
