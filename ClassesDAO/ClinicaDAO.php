<?php
require_once ('conexao.php');
class ClinicaDAO extends PDOconectar
{
    public $conn = null;

    function __construct(){$this->conn = PDOconectar::Conectar();}

    public function cadastrar($cad)
    {
        $usu = $cad->getIdentificacao();
        $email = $cad->getEmail();
        $Buscar_Clinicas = $this->conn->prepare ("SELECT * FROM clinicas WHERE Identificacao='$usu'");
        $Buscar_Clinicas->execute();
        $verificar = $Buscar_Clinicas->rowCount();
        if ($verificar == 1) {
            echo "<h5 class='text-info my-3'>Fail, CPF/CNPJ já encontram-se cadastrados...</h5>";
        } else {
            $insertC = $this->conn->prepare("INSERT INTO clinicas(Identificacao,Senha,Email)VALUES(?,?,?)");
            $insertC->bindValue(1, $cad->getIdentificacao());
            $insertC->bindValue(2, $cad->getSenha());
            $insertC->bindValue(3, $cad->getEmail());
            $insertC->execute();      
            //Efetua o insert para dar inicio ao endereço logo =D
            $insert = $this->conn->prepare("INSERT INTO enderecos(Identificacao)VALUES(?)");
            $insert->bindValue(1, $cad->getIdentificacao());
            $insert->execute();

            $insertE = $this->conn->prepare("INSERT INTO informacoes(Identificacao)VALUES(?)");
            $insertE->bindValue(1, $cad->getIdentificacao());
            $insertE->execute();

            $insertL = $this->conn->prepare("INSERT INTO logos(Identificacao)VALUES(?)");
            $insertL->bindValue(1, $cad->getIdentificacao());
            $insertL->execute();

            $insertAt = $this->conn->prepare("INSERT INTO autorizado(Nome,Cpf_Cnpj,Email,Status,Data_Cancelamento)VALUES(?,?,?,?,?)");
            $insertAt->bindValue(1, $cad->getNomeC());
            $insertAt->bindValue(2, $cad->getIdentificacao());
            $insertAt->bindValue(3, $cad->getEmail());
            $insertAt->bindValue(4, "teste");
            $insertAt->bindValue(5, date('Y-m-d', strtotime(' + 7 days')));
            $insertAt->execute();
            echo "<h4 class='text-info my-3'>Sucesso</h4";
            
            
            // require_once ('ClinicaDAO.php');
            // $Login_Direto = new ClinicaDAO();
            // $Login_Direto->validarLoginCad($cad->getEmail(), $cad->getSenha());
        }
    }
    public function validarLoginCad($usu, $senha){
        $Validar = $this->conn->prepare ("SELECT * FROM clinicas WHERE Email='$usu' AND Senha='$senha'");
        $Validar->execute();
        $linhas = $Validar->fetchAll(PDO::FETCH_OBJ);
        foreach ($linhas as $listar) {$id = $listar->ID;}
            $Verifica_Status = $this->conn->prepare ("SELECT * FROM autorizado WHERE Email='$usu'");
            $Verifica_Status->execute();
            $linhas = $Verifica_Status->fetchAll(PDO::FETCH_OBJ);
            foreach ($linhas as $listar) {$status = $listar->Status;}
                if ($Validar->rowCount() == 1) {    
                    session_start();                  
                    if($status == 'teste') {    
                        $_SESSION['login'] = $id;
                        $_SESSION['senha'] = $senha;
                        $_SESSION['status'] = "teste";
                        header("Location: Perfil.php");
                    }elseif ($status == 'pago') {
                        $_SESSION['login'] = $id;
                        $_SESSION['senha'] = $senha;
                        $_SESSION['status'] = "pago";
                        header("Location: Perfil.php");
                    }elseif ($status == 'naopago') {
                        $_SESSION['login'] = $id;
                        $_SESSION['senha'] = $senha;
                        $_SESSION['status'] = "naopago";
                        header("Location: Perfil.php");                    
                    }
                }elseif ($Validar->rowCount() == 0) {
                    echo "<h3>Ocorreu um erro!!</a></h3>";
                }
    }
    public function validarLogin($usu, $senha)
    {
        $Validar = $this->conn->prepare ("SELECT * FROM clinicas WHERE Email='$usu' AND Senha='$senha'");
        $Validar->execute();
        $linhas = $Validar->fetchAll(PDO::FETCH_OBJ);
        foreach ($linhas as $listar) {$id = $listar->ID;}
            $Verifica_Status = $this->conn->prepare ("SELECT * FROM autorizado WHERE Email='$usu'");
            $Verifica_Status->execute();
            $linhas = $Verifica_Status->fetchAll(PDO::FETCH_OBJ);
            foreach ($linhas as $listar) {$status = $listar->Status; $dataC = $listar->Data_Cancelamento; $dataI = $listar->Data;}
                $dataHoje = date('Y-m_d');
                if ($Validar->rowCount() == 1) {
                    if($status == 'teste' AND $dataHoje>$dataC) {    
                        session_start();
                        $_SESSION['login'] = $id;
                        $_SESSION['senha'] = $senha;
                        $_SESSION['status'] = "naopago";
                        header("Location: ../Perfil.php");
                    }elseif ($status == 'teste' AND $dataHoje<$dataC) {
                        session_start();
                        $_SESSION['login'] = $id;
                        $_SESSION['senha'] = $senha;
                        $_SESSION['status'] = "teste";
                        header("Location: ../Perfil.php");
                    }elseif ($status == 'pago') {
                        session_start();
                        $_SESSION['login'] = $id;
                        $_SESSION['senha'] = $senha;
                        $_SESSION['status'] = "pago";
                        header("Location: ../Perfil.php");
                    }elseif ($status == 'naopago') {
                        session_start();
                        $_SESSION['login'] = $id;
                        $_SESSION['senha'] = $senha;
                        $_SESSION['status'] = "naopago";
                        header("Location: ../Perfil.php");                    
                    }
                }elseif ($Validar->rowCount() == 0) {
                    echo "<h3>Usuário ou senha Inválido</a></h3>";
                }
    }

    public function logado($iden)// Informações do perfil
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

        $Dados_Clinica = $this->conn->prepare("SELECT * FROM clinicas WHERE Identificacao='$cpfRecu'");
        $Dados_Clinica->execute();
        $linhas = $Dados_Clinica->fetchAll(PDO::FETCH_OBJ);
        foreach ($linhas as $listar) {
            $email = $listar->Email;
            $senha = $listar->Senha;
            $nome = $listar->Nome;
            $contato = $listar->Contato;           
        }
        echo "
        
            <form method='post' action='./Back/EditarRecebe.php'>
            <input type='hidden' name='iden' value=".$email.">
            <div class='input-group input-group-sm mb-3'>
                <div class='input-group-prepend'>
                    <span class='input-group-text'>Instituição</span>
                </div>
                    <textarea row='1' name='nome' class='form-control' aria-label='Com textarea'>".utf8_encode($nome)."</textarea>
            </div>

            <div class='input-group input-group-sm mb-3'>
                <div class='input-group-prepend'>
                    <span class='input-group-text'>E-mail</span>
                </div>
                    <textarea row='1' name='email' class='form-control' aria-label='Com textarea'>".utf8_encode($email)."</textarea>
            </div>
            <div class='input-group input-group-sm mb-3'>
                <div class='input-group-prepend'>
                    <span class='input-group-text'>Contato</span>
                </div>
                    <textarea row='1' name='contato' class='form-control' aria-label='Com textarea'>".utf8_decode($contato)."</textarea>
            </div>
            <div class='form-group row'>
                <div class='col-sm-10'>
                    <button type='submit' class='btn btn-info btn-lg'>Enviar</button>
                </div>
            </div>
            </form>

        ";
    }

    public function EditarPerfil($editar,$iden)
    {
        $Pega_Email = $this->conn->prepare("SELECT * FROM clinicas WHERE Email='$iden'");
        $Pega_Email->execute();
        $linhasP = $Pega_Email->fetchAll(PDO::FETCH_OBJ);
        foreach ($linhasP as $listar) {
            $cpfRecu = $listar->Identificacao;        
        }
    $Premios = $this->conn->prepare("UPDATE clinicas SET
                                                Nome=?,
                                                Email=?,                                                    
                                                Contato=?
                                            WHERE Identificacao='$cpfRecu'");
                $Premios->bindValue(1, $editar->getNomeC());
                $Premios->bindValue(2, $editar->getEmail());
                $Premios->bindValue(3, $editar->getContato());
                $Premios->execute();
                echo "<script language=\"javascript\">window.history.back();</script>";
    }
    public function Endereco($iden)
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
        $Dados_Clinica = $this->conn->prepare("SELECT * FROM enderecos WHERE Identificacao='$cpfRecu'");
        $Dados_Clinica->execute();
        $linhas = $Dados_Clinica->fetchAll(PDO::FETCH_OBJ);
        foreach ($linhas as $listar) {
            $cep = $listar->CEP;
            $rua = $listar->Rua;
            $bairro = $listar->Bairro;
            $cidade = $listar->Cidade;
            $complemento = $listar->Complemento;       
            $mapa = $listar->Mapa;     

        }
        echo "
        <form method='post' action='./Back/EnderecoRecebe.php'>
            <input type='hidden' name='iden' value=".$Email.">
            <div class='input-group input-group-sm mb-3'>
                <div class='input-group-prepend'>
                    <span class='input-group-text'>CEP</span>
                </div>
                    <textarea row='1' name='cep' id='cep' class='form-control' aria-label='Com textarea'>".@$cep."</textarea>
            </div>

            <div class='input-group input-group-sm mb-3'>
                <div class='input-group-prepend'>
                    <span class='input-group-text'>Rua</span>
                </div>
                    <textarea name='rua' rows='1' id='rua' class='form-control' aria-label='Com textarea'>".utf8_encode(@$rua)."</textarea>
            </div>
            <div class='input-group input-group-sm mb-3'>
                <div class='input-group-prepend'>
                    <span class='input-group-text'>Bairro</span>
                </div>
                    <textarea name='bairro' rows='1' id='bairro' class='form-control' aria-label='Com textarea'>".utf8_encode(@$bairro)."</textarea>
            </div>
            <div class='input-group input-group-sm mb-3'>
                <div class='input-group-prepend'>
                    <span class='input-group-text'>Cidade</span>
                </div>
                    <textarea name='cidade' rows='1' id='cidade' class='form-control' aria-label='Com textarea'>".utf8_encode(@$cidade)."</textarea>
            </div>
            <div class='input-group input-group-sm mb-3'>
                <div class='input-group-prepend'>
                    <span class='input-group-text'>Complemento</span>
                </div>
                    <textarea row='1' name='complemento' class='form-control' aria-label='Com textarea'>".utf8_encode(@$complemento)."</textarea>
            </div>
            <div class='6u 12u(xsmall)'>
                        Para inserir o link no mapa siga as instruções abaixo:<br>
                            1) Abra o link: <a style='color:red;' href='https://www.google.com.br/maps' target='_blank' >Abrir mapa aqui</a>  <br>    
                            2) No canto superior esquerdo, insira seu endereço ou procure no mapa o endereço que você deseja inserir <br>
                            3) Feito isso confirme no mesmo lado se o endereço está correndo, se sim, selecione o botão compartilhar <br>
                            4) Selecione copiar link e cole na caixa de texto abaixo.  
                        </div>
            <div class='input-group input-group-sm mb-3'>
                <div class='input-group-prepend'>
                    <span class='input-group-text'>Localização Maps</span>
                </div>
                    <textarea row='1' name='mapa' class='form-control' aria-label='Com textarea'>".@$mapa."</textarea>
            </div>
            <div class='form-group row'>
            <div class='col-sm-10'>
              <button type='submit' class='btn btn-info btn-lg'>Enviar</button>
            </div>
            </form>
          </div>
        </div>



        ";
    }
    public function EditarEndereco($cep,$rua,$bairro,$cidade,$complemento,$iden,$mapa)
    {
        $Pega_Email = $this->conn->prepare("SELECT * FROM clinicas WHERE Email='$iden'");
        $Pega_Email->execute();
        $linhasP = $Pega_Email->fetchAll(PDO::FETCH_OBJ);
        foreach ($linhasP as $listar) {
            $cpfRecu = $listar->Identificacao;        
        }
    $Premios = $this->conn->prepare("UPDATE enderecos SET
                                                CEP=?,
                                                Rua=?,
                                                Bairro=?,            
                                                Cidade=?,                                        
                                                Complemento=?,
                                                Mapa=?
                                            WHERE Identificacao='$cpfRecu'");
                $Premios->bindValue(1, $cep);
                $Premios->bindValue(2, $rua);
                $Premios->bindValue(3, $bairro);
                $Premios->bindValue(4, $cidade);
                $Premios->bindValue(5, $complemento);
                $Premios->bindValue(6, $mapa);
                $Premios->execute();
                echo "<script language=\"javascript\">window.history.back();</script>";
    }
    public function Informacoes($iden)
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
        $Dados_Clinica = $this->conn->prepare("SELECT * FROM informacoes WHERE Identificacao='$cpfRecu'");
        $Dados_Clinica->execute();
        $linhas = $Dados_Clinica->fetchAll(PDO::FETCH_OBJ);
        foreach ($linhas as $listar) {
           $funcionamento = $listar->Funcionamento;
           $servicoM = $listar->Servico_Movel;
           $movelE = $listar->Movel_explica;
           $att =  $listar->Atendimento_A;
        }
        echo "
        <form method='post' action='./Back/InformacoesRecebe.php'>
        <input type='hidden' name='iden' value=".$Email." >

        <div class='input-group mb-3'>
          <div class='input-group-prepend'>
            <label class='input-group-text' for='inputGroupSelect01'>Funcionamento:<b> ".$funcionamento."</b></label>
          </div>
          <select name='funcionamento' class='custom-select' id='inputGroupSelect01'>
            <option>Selecione...</option>
                                <option value='08:00 - 17:00 horas'>08:00 - 17:00horas</option>
                                <option value='08:00 - 12:00 Horas'>08:00 - 12:00Horas</option>
                                <option value='12:00 - 18:00 horas'>12:00 - 18:00horas</option>
                                <option value='24Horas'>24Horas</option>
          </select>
        </div>

        <div class='input-group mb-3'>
          <div class='input-group-prepend'>
            <label class='input-group-text' for='inputGroupSelect01'>Serivço Móvel: <b>".@$servicoM."</b> </label>
          </div>
          <select name='servicoM' class='custom-select' id='inputGroupSelect01'>
                                <option>Selecione...</option>
                                <option value='Sim'>Sim</option>
                                <option value='Não'>Não</option>
          </select>
        </div>

        <div class='input-group mb-3'>
          <div class='input-group-prepend'>
            <label class='input-group-text' for='inputGroupSelect01'>Att. Grandes Animais: <b>".utf8_encode(@$att)."</b></label>
          </div>
          <select  name='atendimento' class='custom-select' id='inputGroupSelect01'>
            <option>Selecione</option>
                                <option value='Sim'>Sim</option>
                                <option value='Não'>Não</option>
          </select>
        </div>

        <div class='input-group input-group-lg mb-3'>
            <div class='input-group-prepend'>
                <span class='input-group-text'>Funcionamento serviço móvel, explique</span>
            </div>
            <textarea name='infoMovel' name='mapa' class='form-control' aria-label='Com textarea'>".utf8_encode(@$movelE)."</textarea>
            </div>
            <div class='form-group row'>
            <div class='col-sm-10'>
              <button type='submit' class='btn btn-info btn-lg'>Enviar</button>
            </div>
        </form>
        ";
    }
    public function EditarInformacoes($funcionamento,$servicoM,$movelE,$att,$iden)
    {
        $Pega_Email = $this->conn->prepare("SELECT * FROM clinicas WHERE Email='$iden'");
        $Pega_Email->execute();
        $linhasP = $Pega_Email->fetchAll(PDO::FETCH_OBJ);
        foreach ($linhasP as $listar) {
            $cpfRecu = $listar->Identificacao;        
        }
    $Premios = $this->conn->prepare("UPDATE informacoes SET
                                                Funcionamento=?,
                                                Servico_Movel=?,
                                                Movel_explica=?,            
                                                Atendimento_A=?
                                    WHERE Identificacao='$cpfRecu'");
                $Premios->bindValue(1, $funcionamento);
                $Premios->bindValue(2, $servicoM);
                $Premios->bindValue(3, $movelE);
                $Premios->bindValue(4, $att);
                $Premios->execute();
                echo "<script language=\"javascript\">window.history.back();</script>";
    }


    public function teste()
    {        
        $Pega_Email = $this->conn->prepare("SELECT * FROM autorizado WHERE Email='reinaldojunior272@gmail.com'");
        $Pega_Email->execute();
        $linhasP = $Pega_Email->fetchAll(PDO::FETCH_OBJ);
        foreach ($linhasP as $listar) {
            $data = $listar->Data;    
        }
        $datahh = date('d/m/Y', strtotime(' + 0 days'));
        echo "$datahh";
        //echo "$datahh";
        // date($data,'Ymd H:i:s');
        // echo "<br>";
        // $today = date("Y-m-d");  
        // $todaysete = date("Ymd")-7;  
        // echo "Data de hoje menos 7 : $todaysete <br>";
        // echo "Data de hoje : $today <br>";


        // if ($todaysete<=$data) {
        //     echo "assinatura canncelada";
        // }elseif ($todaysete>=$data) {
        //     echo "nada acontece";
        // }
    }

}

?>
