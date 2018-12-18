<?php
require_once ('conexao.php');

class EspecialidadeDAO extends PDOconectar
{

    public $conn = null;

    function __construct()
    {
        $this->conn = PDOconectar::Conectar();
    }
    
	public function especialidades($cadespec)
    {
        $insertespec = $this->conn->prepare("INSERT INTO especialidade(Email,Especialidade)VALUES(?,?)");
        $insertespec->bindValue(1, $cadespec->getEmail());
        $insertespec->bindValue(2, $cadespec->getEspecialidade());
        $insertespec->execute();
        echo "<script language=\"javascript\">alert(\"Verifique seu perfil!!\")</script>";
        echo "<script language=\"javascript\">window.history.back();</script>";

    }
    public function buscarespecialidades($bespec)
    {
        $seleespec = $this->conn->prepare("SELECT * FROM especialidade WHERE Email=?");
        $seleespec->bindValue(1, $bespec);
        $seleespec->execute();
        $linhas = $seleespec->fetchAll(PDO::FETCH_OBJ);    

        echo"<table>
            <caption><h2>Especildiades</h2></caption>";

        foreach ($linhas as $listar) {
            $email_espec = $listar->Email; 
            $espec_All = $listar->Especialidade;  
            echo "
            <tr>
                <td>".$espec_All."</td>
                <td><a href='../../Php/Clinicas/ExcluirEspec.php?Email=".$email_espec."&Espec=".$espec_All."'>Excluir</a></td>
            </tr>     
            ";

        }   
        echo "</table>";
    }

    public function excluirEspec($email,$espec)
    {   
        $delete_espec = $this->conn->prepare("DELETE FROM especialidade WHERE Email='$email' AND Especialidade='$espec'");
        $delete_espec->execute();
        echo "<script language=\"javascript\">window.history.back()</script>";
    }

}