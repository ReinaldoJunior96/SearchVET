<?php
require_once ('conexao.php');
class AdmDAO extends PDOconectar
{
  public $conn = null;

  function __construct(){$this->conn = PDOconectar::Conectar();}

  public function validarLogin($usu, $senha)
  {
    $Validar = $this->conn->prepare ("SELECT * FROM usuario_adm WHERE Email='$usu' AND Senha='$senha'");
    $Validar->execute();
    if ($Validar->rowCount() == 1) {
      session_start();
      $_SESSION['login'] = $usu;
      $_SESSION['senha'] = $senha;
      header("Location: AdmLogado.php");

    }elseif ($Validar->rowCount() <= 0) {
      echo "<script language=\"javascript\">alert(\"Usuário Inválido!!\")</script>";
      echo "<script language=\"javascript\">window.history.back();</script>";
    }

  }
  public function Filtro($email,$valor)
  {
    if (empty($email) && !empty($valor == 'teste')) {
      $Filtro = $this->conn->prepare ("SELECT * FROM autorizado WHERE Status='teste' ORDER BY Data desc");
      $Filtro->execute();
      $linhas = $Filtro->fetchAll(PDO::FETCH_OBJ);
      echo "
      <div class='table-wrapper'>
      <table>
      <thead>
      <tr>
      <th><b>Nome</b></th>
      <th>Cpf/Cnpj</th>
      <th>Data Inscrição</th>
      <th></th>
      <th></th>
      </tr>
      </thead>
      <tbody>

      ";
      foreach ($linhas as $listar) {
        $cpf_cnpj = $listar->Cpf_Cnpj;
        $nome = $listar->Nome;
        $data = $listar->Data;
        $email = $listar->Email;
        echo"
        <tr>
        <td>".$nome."</td>
        <td>".$email."</td>
        <td>".$cpf_cnpj."</td>
        <td>".date('d/m/Y', strtotime($data))."</td>
        <td><a href='../Adm/Liberar.php?liberar=".$email."'><button style='background-color:#CC6F83; font-size: 13px;'>Liberar</button></a></td>
        <td><a href='../Adm/Cancelar.php?cancelar=".$email."'><button style='background-color:red; font-size: 13px;'>Bloquear</button></a></td>
        </tr>
        ";
      }
      echo "

      </tbody>
      </table>
      </div>";
    }elseif (empty($email) && !empty($valor == 'naopago')) {
      $Filtro = $this->conn->prepare ("SELECT * FROM autorizado WHERE Status='naopago'");
      $Filtro->execute();
      $linhas = $Filtro->fetchAll(PDO::FETCH_OBJ);
      echo "
      <div class='table-wrapper'>
      <table>
      <thead>
      <tr>
      <th>Nome</th>
      <th>Cpf/Cnpj</th>
      <th>Data</th>
      </tr>
      </thead>
      <tbody>
      <tr>
      ";
      foreach ($linhas as $listar) {
        $cpf_cnpj = $listar->Cpf_Cnpj;
        $nome = $listar->Nome;
        $data = $listar->Data;
        $email = $listar->Email;
        echo"
        <td>".$nome."</td>
        <td>".$email."</td>
        <td>".$cpf_cnpj."</td>
        <td>".date('d-m-Y', strtotime($data))."</td>
        <td><a href='../Adm/Liberar.php?liberar=".$email."'><button style='background-color:#CC6F83; font-size: 13px;'>Liberar</button></a></td>
        <td><a href='../Adm/Cancelar.php?cancelar=".$email."'><button style='background-color:red; font-size: 13px;'>Bloquear</button></a></td>
        ";
      }
      echo "
      </tr>
      </tbody>
      </table>
      </div>";
    }elseif (!empty($email) && empty($valor)) {
      $Filtro = $this->conn->prepare ("SELECT * FROM autorizado WHERE Email='$email'");
      $Filtro->execute();
      $linhas = $Filtro->fetchAll(PDO::FETCH_OBJ);
      echo "
      <div class='table-wrapper'>
      <table>
      <thead>
      <tr>
      <th>Nome</th>
      <th>Cpf/Cnpj</th>
      <th>Data</th>
      </tr>
      </thead>
      <tbody>
      <tr>
      ";
      foreach ($linhas as $listar) {
        $cpf_cnpj = $listar->Cpf_Cnpj;
        $nome = $listar->Nome;
        $data = $listar->Data;
        $email = $listar->Email;
        echo"
        <td>".$nome."</td>
        <td>".$email."</td>
        <td>".$cpf_cnpj."</td>
        <td>".date('d-m-Y', strtotime($data))."</td>
        <td><a href='../Adm/Liberar.php?liberar=".$email."'><button style='background-color:#CC6F83; font-size: 13px;'>Liberar</button></a></td>
        <td><a href='../Adm/Cancelar.php?cancelar=".$email."'><button style='background-color:red; font-size: 13px;'>Bloquear</button></a></td>
        ";
      }
      echo "
      </tr>
      </tbody>
      </table>
      </div>";
    }

  }





  public function LiberarAcesso($email)
  {
    $Liberar = $this->conn->prepare("UPDATE autorizado SET
      Status=?
      WHERE Email='$email'");
      $Liberar->bindValue(1, "pago");
      $Liberar->execute();
      echo "<script language=\"javascript\">window.history.back(-8);</script>";
    }
    public function CancelarAcesso($email)
    {
      $Cancelar = $this->conn->prepare("UPDATE autorizado SET
        Status=?
        WHERE Email='$email'");
        $Cancelar->bindValue(1, "naopago");
        $Cancelar->execute();
        //echo "<script language=\"javascript\">window.history.back(-2);</script>";
      }

    }

    ?>
