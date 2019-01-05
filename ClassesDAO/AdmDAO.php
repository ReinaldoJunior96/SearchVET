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
      echo "<script language=\"javascript\">window.location.href = 'index.php'</script>";
      // header("Location: AdmLogado.php");

    }elseif ($Validar->rowCount() <= 0) {
      echo "<script language=\"javascript\">alert(\"Usuário Inválido!!\")</script>";
      echo "<script language=\"javascript\">window.history.back();</script>";
    }
  }

  public function Receber()
  {
    $Validar = $this->conn->prepare ("SELECT * FROM autorizado WHERE Status='teste'");
    $Validar->execute();
    $valor = $Validar->rowCount();
    $receber = $valor*50;
    echo "<h3 class='font-weight-medium text-right mb-0'>R$ ".$receber.",00</h3>'";
  }

  public function ContarClinicas()
  {
    $Validar = $this->conn->prepare ("SELECT * FROM autorizado WHERE Status='teste'");
    $Validar->execute();
    $valor = $Validar->rowCount();
    return $valor;
  }

  public function Metas()
  {
    $Meta = 500;
    $Contar =  new AdmDAO();
    $TotalClinicas = $Contar->ContarClinicas();

    $aux = $TotalClinicas*100;
    $div = $aux/$Meta;
    $Pmeta = $div.'%';
    return $Pmeta;
  }

  public function CadastroRecente()
  {
    $Recente = $this->conn->prepare ("SELECT * FROM autorizado WHERE Status='teste' ORDER BY ID DESC LIMIT 0,5");
    $Recente->execute();
    $linhas = $Recente->fetchAll(PDO::FETCH_OBJ);
    foreach ($linhas as $listar) {
        $cpf_cnpj = $listar->Cpf_Cnpj;
        $nome = $listar->Nome;
        $email = $listar->Email;
        echo"
        <tr>
          <td class='font-weight-medium'>
          ".$nome."
          </td>
          <td>
            ".$cpf_cnpj."
          </td>
          <td>
            ".$email."
          </td>
          <td>
            <label class='badge badge-danger'>
              Aguardando...
              <i class='fa fa-spinner fa-spin'></i>
            </label>
          </td>
          <td>
            <a href='#'><button type='button' class='btn btn-outline-success btn-fw'>
              <i class='fa fa-check'></i>Liberar
            </button></a>
          </td>
        </tr>
        ";
      }
  }

  public function Filtro($email,$valor)
  {
    if (empty($email) && !empty($valor == 'teste')) {
      $Filtro = $this->conn->prepare ("SELECT * FROM autorizado WHERE Status='teste' ORDER BY Data desc");
      $Filtro->execute();
      $linhas = $Filtro->fetchAll(PDO::FETCH_OBJ);
      echo "
      

      ";
      foreach ($linhas as $listar) {
        $cpf_cnpj = $listar->Cpf_Cnpj;
        $nome = $listar->Nome;
        $data = $listar->Data;
        $email = $listar->Email;
        echo"
        
        ";
      }
      echo "
        ";
    }elseif (empty($email) && !empty($valor == 'naopago')) {
      $Filtro = $this->conn->prepare ("SELECT * FROM autorizado WHERE Status='naopago'");
      $Filtro->execute();
      $linhas = $Filtro->fetchAll(PDO::FETCH_OBJ);
      echo "
      
      ";
      foreach ($linhas as $listar) {
        $cpf_cnpj = $listar->Cpf_Cnpj;
        $nome = $listar->Nome;
        $data = $listar->Data;
        $email = $listar->Email;
        echo"
        
        ";
      }
      echo "
      ";
    }elseif (!empty($email) && empty($valor)) {
      $Filtro = $this->conn->prepare ("SELECT * FROM autorizado WHERE Email='$email'");
      $Filtro->execute();
      $linhas = $Filtro->fetchAll(PDO::FETCH_OBJ);
      echo "
      
      ";
      foreach ($linhas as $listar) {
        $cpf_cnpj = $listar->Cpf_Cnpj;
        $nome = $listar->Nome;
        $data = $listar->Data;
        $email = $listar->Email;
        echo"
        
        ";
      }
      echo "
      ";
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
