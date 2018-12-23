<?php
require_once ('conexao.php');

class EspecialidadeDAO extends PDOconectar
{

    public $conn = null;

    function __construct()
    {
        $this->conn = PDOconectar::Conectar();
    }
    
	public function especialidades($iden,$espec)
    {
        $Pega_ID = $this->conn->prepare("SELECT * FROM clinicas WHERE ID='$iden'");
        $Pega_ID->execute();
        $linhasP = $Pega_ID->fetchAll(PDO::FETCH_OBJ);
        foreach ($linhasP as $listar) {
            $Email = $listar->Email;        
        }
        $Pega_Email = $this->conn->prepare("SELECT * FROM clinicas WHERE Email='$Email'");
        $Pega_Email->execute();
        $linhasP = $Pega_Email->fetchAll(PDO::FETCH_OBJ);
        foreach ($linhasP as $listar) {
            $cpfRecu = $listar->Identificacao;        
        }
        $insertespec = $this->conn->prepare("INSERT INTO especialidade(Identificacao,Especialidade)VALUES(?,?)");
        $insertespec->bindValue(1, utf8_decode($cpfRecu));
        $insertespec->bindValue(2, utf8_decode($espec));
        $insertespec->execute();
        //echo "<script language=\"javascript\">window.history.back();</script>";

    }
    public function buscarespecialidades($iden)
    {
        $Pega_ID = $this->conn->prepare("SELECT * FROM clinicas WHERE ID='$iden'");
        $Pega_ID->execute();
        $linhasP = $Pega_ID->fetchAll(PDO::FETCH_OBJ);
        foreach ($linhasP as $listar) {
            $Email = $listar->Email;        
        }
        $Pega_Email = $this->conn->prepare("SELECT * FROM clinicas WHERE Email='$Email'");
        $Pega_Email->execute();
        $linhasP = $Pega_Email->fetchAll(PDO::FETCH_OBJ);
        foreach ($linhasP as $listar) {
            $cpfRecu = $listar->Identificacao;        
        }
        $seleespec = $this->conn->prepare("SELECT * FROM especialidade WHERE Identificacao='$cpfRecu'");
        $seleespec->execute();
        $linhas = $seleespec->fetchAll(PDO::FETCH_OBJ);   
        echo "<hr>
            <h4>Sua especildiades</h4>
            <ul class='list-group'>"; 
        foreach ($linhas as $listar) {
            $Iden = $listar->Identificacao;
            $espec_All = $listar->Especialidade;
            echo "        
              <li class='list-group-item d-flex justify-content-between align-items-center'>
                ".utf8_encode($espec_All)."
                <span class='badge badge-light badge-pill'><a href='Back/ApagarEspec.php?id=".$Iden."&espec=".$espec_All."'><i class='fas fa-trash-alt'></i></a></span>
              </li>      
            ";
        }   
        echo " </ul>     
            ";
    }

    public function excluirEspec($iden,$espec)
    {   
        $delete_espec = $this->conn->prepare("DELETE FROM especialidade WHERE Identificacao='$iden' AND Especialidade='$espec'");
        $delete_espec->execute();
        echo "<script language=\"javascript\">window.location='../Especialidades.php'</script>";
    }

}