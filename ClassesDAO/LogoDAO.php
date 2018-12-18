<?php
require_once ('conexao.php');

class LogoDAO extends PDOconectar
{
    public $conn = null;

    function __construct(){$this->conn = PDOconectar::Conectar();}

    public function addLogo($logo){
        $Pega_Email = $this->conn->prepare("SELECT * FROM clinicas WHERE Email='$iden'");
        $Pega_Email->execute();
        $linhasP = $Pega_Email->fetchAll(PDO::FETCH_OBJ);
        foreach ($linhasP as $listar) {
            $cpfRecu = $listar->Identificacao;        
        }
        $insertLogo = $this->conn->prepare("UPDATE logos SET
                                                Foto=?
                                    WHERE Identificacao='$cpfRecu'");
                $insertLogo->bindValue(1, $logo->getLogo());
                $insertLogo->execute();
                echo "<script language=\"javascript\">alert(\"Infor!!\")</script>"; 
                echo "<script language=\"javascript\">window.history.back();</script>";
    }
    public function verLogo($iden)
    {
        try {
            $Pega_Email = $this->conn->prepare("SELECT * FROM clinicas WHERE Email='$iden'");
        $Pega_Email->execute();
        $linhasP = $Pega_Email->fetchAll(PDO::FETCH_OBJ);
        foreach ($linhasP as $listar) {
            $cpfRecu = $listar->Identificacao;        
        }
            $verLogo = $this->conn->prepare("SELECT * FROM logo WHERE Identificacao='$cpf'");
            $verLogo->execute();
            $linhas = $verLogo->fetchAll(PDO::FETCH_OBJ);
            foreach ($linhas as $listar) {
                $foto = $listar->Foto;
                $data = $listar->Data;
                echo "                    
                    <img src='images/".$foto."'>
                ";
            }
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    
    }

}