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
    $Validar = $this->conn->prepare ("SELECT * FROM autorizado WHERE Status='pago'");
    $Validar->execute();
    $valor = $Validar->rowCount();
    $receber = $valor*50;
    echo "<h3 class='font-weight-medium text-right mb-0'>R$ ".$receber.",00</h3>'";
  }

  public function ContarClinicas()
  {
    $Validar = $this->conn->prepare ("SELECT * FROM autorizado WHERE Status='pago'");
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
            <div class='ticket-actions col-md-2'>
              <div class='btn-group dropdown'>
                <button type='button' class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                  Ações
                </button>
                <div class='dropdown-menu'>                                   
                  <div class='dropdown-divider'></div>
                    <a class='dropdown-item' href='../Adm/Liberar.php?liberar=".$email."'>
                    <i class='fa fa-check text-success fa-fw'></i>Liberar</a>
                    <a class='dropdown-item' href='../Adm/Cancelar.php?Cancelar=".$email."'>
                    <i class='fa fa-times text-danger fa-fw'></i>Cancelar</a>
                  </div>
                </div>
              </div>
          </td>
        </tr>
        ";
      }
  }

  public function MostrarClinicas()
  {
    $Buscar = $this->conn->prepare ("SELECT * FROM autorizado");
    $Buscar->execute();
    $linhas = $Buscar->fetchAll(PDO::FETCH_OBJ);
    foreach ($linhas as $listar) {
        $cpf_cnpj = $listar->Cpf_Cnpj;
        $nome = $listar->Nome;
        $email = $listar->Email;
        $status = $listar->Status;
        echo"
        <tr>
                <td>".$nome."</td>
                <td>".$cpf_cnpj."</td>
                <td>".$email."</td>
                <td>".$status."</td>
                <td>
                  <div class='ticket-actions col-md-2'>
                    <div class='btn-group dropdown'>
                    <button type='button' class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    Ações
                    </button>
                    <div class='dropdown-menu'>                                   
                  <div class='dropdown-divider'></div>
                    <a class='dropdown-item' href='../Adm/Liberar.php?liberar=".$email."'>
                    <i class='fa fa-check text-success fa-fw'></i>Liberar</a>
                    <a class='dropdown-item' href='../Adm/Cancelar.php?Cancelar=".$email."'>
                    <i class='fa fa-times text-danger fa-fw'></i>Cancelar</a>
                  </div>
                </div>
              </div>
          </td>
            </tr>
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
    echo "<script language=\"javascript\">window.location.href = '../Dashboard/index.php'</script>";
  }

  public function CancelarAcesso($email)
  {
    $Cancelar = $this->conn->prepare("UPDATE autorizado SET
      Status=?
      WHERE Email='$email'");
    $Cancelar->bindValue(1, "naopago");
    $Cancelar->execute();
    echo "<script language=\"javascript\">window.location.href = '../Dashboard/index.php'</script>";
  }

}

?>
