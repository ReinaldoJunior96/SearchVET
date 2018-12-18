<?php

class Usuario
{

    private $email;

    private $senha;


    public function __construct(){}

    /**
     *
     *
     */

    public function getEmail()
    {
        return $this->email;
    }
    
    public function getSenha()
    {
        return $this->senha;
    }


    /**
     *
     * @param mixed $senha
     */

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

}
?>
