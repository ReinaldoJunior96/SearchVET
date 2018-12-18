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

            $insertAt = $this->conn->prepare("INSERT INTO autorizado(Nome,Cpf_Cnpj,Email,Status)VALUES(?,?,?,?)");
            $insertAt->bindValue(1, $cad->getNomeC());
            $insertAt->bindValue(2, $cad->getIdentificacao());
            $insertAt->bindValue(3, $cad->getEmail());
            $insertAt->bindValue(4, "teste");
            $insertAt->execute();
            echo "<h4 class='text-info my-3'>Sucesso !!</h4";
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
            foreach ($linhas as $listar) {$status = $listar->Status;}
                if ($Validar->rowCount() == 1) {
                    session_start();
                    if($status == 'teste') {    
                        session_start();
                        $_SESSION['login'] = $id;
                        $_SESSION['senha'] = $senha;
                        $_SESSION['status'] = "teste";
                        header("Location: Perfil.php");
                    }elseif ($status == 'pago') {
                        session_start();
                        $_SESSION['login'] = $id;
                        $_SESSION['senha'] = $senha;
                        $_SESSION['status'] = "pago";
                        header("Location: Perfil.php");
                    }elseif ($status == 'naopago') {
                        session_start();
                        $_SESSION['login'] = $id;
                        $_SESSION['senha'] = $senha;
                        $_SESSION['status'] = "naopago";
                        header("Location: Perfil.php");                    
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
        <div id='main' class='container'>
             <h3>Bem Vindo(a), ".$nome."</h3>
            <form method='post' action='./Back/EditarRecebe.php'>
                <input type='hidden' name='iden' value=".$email.">
                    <div class='row uniform'>

                        <div class='6u 12u(xsmall)'>
                            Nome Instituição
                            <textarea name='nome' rows='1'>".utf8_encode($nome)."</textarea>
                        </div>
                        <div class='6u 12u$(xsmall)'>
                            E-mail          
                            <textarea name='email' rows='1'>".utf8_encode($email)."</textarea>
                        </div>                        
                        <div class='6u 12u$(xsmall)'>
                            Contato
                            <textarea name='contato' rows='1'>".utf8_decode($contato)."</textarea>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='12u'>
                            <ul class='actions'>
                                <br><li><input type='submit' class='style1' value='Enviar' style='background-color:#CC6F83' /></li>
                            </ul>
                        </div>
                    </div>
                </form>
        </div>
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
        <div id='main' class='container'>
            <section>
                <form method='post' action='./Back/EnderecoRecebe.php'>
                <input type='hidden' name='iden' value=".$Email." >
                    <div class='row uniform'>
                        <div class='6u 12u(xsmall)'>
                        CEP
                            <input type='text' name='cep' id='cep' value=".@$cep.">
                        </div>       

                        <div class='6u 12u(xsmall)'>
                        Rua
                            <textarea name='rua' rows='1' id='rua'>".utf8_encode(@$rua)."</textarea>
                        </div>
                       
                        <div class='6u 12u(xsmall)'>
                         Bairro
                            <textarea name='bairro' rows='1' id='bairro'>".utf8_encode(@$bairro)."</textarea>
                        </div>
                       
                        <div class='6u 12u(xsmall)'>
                         Cidade
                            <textarea name='cidade' rows='1' id='cidade'>".utf8_encode(@$cidade)."</textarea>
                        </div>

                        <div class='6u 12u(xsmall)'>
                        Complemento (Informe pontos de referência, paradas etc...)
                            <textarea name='complemento' rows='3' placeholder=''>".utf8_encode(@$complemento)."</textarea>
                        </div>

                        <div class='6u 12u(xsmall)'>
                        Link para mapa <br>
                        Para inserir o link no mapa siga as instruções abaixo:<br>
                            1) Abra o link: <a style='color:red;' href='https://www.google.com.br/maps' target='_blank' >Abrir mapa aqui</a>  <br>    
                            2) No canto superior esquerdo, insira seu endereço ou procure no mapa o endereço que você deseja inserir <br>
                            3) Feito isso confirme no mesmo lado se o endereço está correndo, se sim, selecione o botão compartilhar <br>
                            4) Selecione copiar link e cole na caixa de texto abaixo.     
                            <input type='text' name='mapa' value=".@$mapa." >  
                                     
                        </div>
                    </div>
                        <div class='row'>
                            <div class='12u'>
                                <ul class='actions'>
                                    <br><li><input type='submit' class='style1' value='Editar' style='background-color:#CC6F83' /></li>
                                </ul>
                            </div>
                        </div>
                </form>
            </section>
        </div>
        <hr>
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
        <div id='main' class='container'>
            <section>
                <form method='post' action='./Back/InformacoesRecebe.php'>
                <input type='hidden' name='iden' value=".$Email." >
                    <div class='row uniform'>
                        <div class='6u 12u(xsmall)'>
                        Horário de Funcionamento? <b>".$funcionamento."</b>
                            <select name='funcionamento'>
                                <option>Selecione</option>
                                <option value='08:00 - 17:00 horas'>08:00 - 17:00horas</option>
                                <option value='08:00 - 12:00 Horas'>08:00 - 12:00Horas</option>
                                <option value='12:00 - 18:00 horas'>12:00 - 18:00horas</option>
                                <option value='24Horas'>24Horas</option>
                            </select>
                        </div>       

                        <div class='6u 12u(xsmall)'>
                        Sua instituição possiu SERVIÇO MÓVEL? <b>".@$servicoM."</b>
                            <select name='servicoM'>
                                <option>Selecione</option>
                                <option value='Sim'>Sim</option>
                                <option value='Não'>Não</option>
                            </select>
                        </div>
                       
                        <div class='6u 12u(xsmall)'>
                         Se SIM para Serviço Móvel, explique como funciona.
                            <textarea name='infoMovel' rows='2'>".utf8_encode(@$movelE)."</textarea>
                        </div>
                       
                        <div class='6u 12u(xsmall)'>
                         Sua instituição atende animais de grande porte? <b>".utf8_encode(@$att)."</b>
                            <select name='atendimento'>
                                <option>Selecione</option>
                                <option value='Sim'>Sim</option>
                                <option value='Não'>Não</option>
                            </select>
                        </div>
                    </div>
                        <div class='row'>
                            <div class='12u'>
                                <ul class='actions'>
                                    <br><li><input type='submit' class='style1' value='Editar' style='background-color:#CC6F83' /></li>
                                </ul>
                            </div>
                        </div>
                </form>
            </section>
        </div>
        <hr>
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
    

}

?>
