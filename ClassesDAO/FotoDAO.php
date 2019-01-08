<?php
require_once ('./Classes/Foto.php');
require_once ('conexao.php');

class FotoDAO extends PDOconectar
{
    public $conn = null;

    function __construct(){$this->conn = PDOconectar::Conectar();}

    public function EditarInformacoes($obj,$name_foto)
    {
        $iden = $obj->getIdentificacao();
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
        
        $Premios = $this->conn->prepare("UPDATE logos SET
                                                Foto=?
                                    WHERE Identificacao='$cpfRecu'");
                $Premios->bindValue(1, $name_foto);
                $Premios->execute();
                //echo "<script language=\"javascript\">window.history.back();</script>";
    }
     public function verFoto($iden)
    {        
        try {

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
            $seleficha = $this->conn->prepare("SELECT * FROM logos WHERE Identificacao='$cpfRecu'");
            $seleficha->execute();
            $linhas = $seleficha->fetchAll(PDO::FETCH_OBJ);
            foreach ($linhas as $listar) {
                $foto = $listar->Foto;
                echo "                    
                    <img src='images/".$foto."'>
                "; 

            }
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    
    }
        
    }
?>