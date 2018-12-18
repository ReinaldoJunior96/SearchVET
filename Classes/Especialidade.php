<?php

class Especialidade
{

    private $email;

    private $especialidade;


    public function __construct(){}

    /**
     *
     *
     */

    public function getEmail()
    {
        return $this->email;
    }
    
    public function getEspecialidade()
    {
        return $this->especialidade;
    }


    /**
     *
     * @param mixed $senha
     */

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setEspecialidade($espec)
    {
        $this->especialidade = $espec;
    }

}
?>
