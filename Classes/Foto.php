<?php

class Foto
{

    private $foto;
    private $identificacao;


    public function __construct(){}
    
    public function getFoto()
    {
        return $this->foto;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
    }


    public function getIdentificacao()
    {
        return $this->identificacao;
    }

    public function setIdentificacao($iden)
    {
        $this->identificacao = $iden;
    }


}
?>
