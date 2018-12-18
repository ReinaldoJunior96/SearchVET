<?php
require_once ('conexao.php');
class UsuarioDAO extends PDOconectar
{
    public $conn = null;

    function __construct(){$this->conn = PDOconectar::Conectar();}

    public function VisualizarPerfil($unica,$logado)
    {
        try {
            $fichaUnica = $this->conn->prepare("SELECT * FROM enderecos 
                                                INNER JOIN clinicas ON enderecos.Identificacao = clinicas.Identificacao
                                                INNER JOIN informacoes ON clinicas.Identificacao = informacoes.Identificacao
                                                INNER JOIN logos ON informacoes.Identificacao = logos.Identificacao
                                                WHERE clinicas.Identificacao='$unica'"); 
            $fichaUnica->execute();            
            $linhas = $fichaUnica->fetchAll(PDO::FETCH_OBJ); 
            foreach ($linhas as $listar) {
                //tbl clinica
                $nome = $listar->Nome;
                $contato = $listar->Contato;
                //tbl endereço
                $email = $listar->Email;
                $cep = $listar->CEP;
                $rua = $listar->Rua;
                $bairro = $listar->Bairro;
                $cidade = $listar->Cidade;
                $complemento = $listar->Complemento; 
                $mapa = $listar->Mapa; 
                //tbl informações
                $func = $listar->Funcionamento;
                $servicoM = $listar->Servico_Movel;
                $movelE = $listar->Movel_explica;
                $Att = $listar->Atendimento_A;
                //tbl logos
                $foto = $listar->Foto;
            }
            if ($movelE == null) {
                $pega= "No momento não estamos trabalho com este serviço.";
                $movelE = utf8_decode($pega);
            }
                echo "
                <div>
                <section>
                <button style='background-color:#CC6F83;' class='button small' onClick='window.history.back()'>Voltar</button>  
                <hr>                                     
                <img class='logoc' src='images/".$foto."'><br><br>

                   <br><h2 class='titulo' style='font-size:35px;'>".utf8_encode($nome)."</h2>

                   
                   <hr>
                    <p class='texto' style='font-size: 20px; text-align: justify; position: relative;'>        
                     <b>Rua/Avenida:</b> ".utf8_encode($rua)." <br>
                     <b>Bairro:</b> ".utf8_encode($bairro)."<br>
                     <b>Cidade:</b> ".utf8_encode($cidade)." <br>
                     <b>CEP:</b> ".$cep.".<br>
                     <b>Complemento:</b> ".utf8_encode($complemento)." <br>  <a style='color:red;' href=".$mapa." target='_blank'> Ver endereço no mapa</a>
                    </p>
                 </section>
                </div>    
                <hr>            
                <section>
                                    
                    <p class='texto' style='font-size: 20px; text-align: justify;''>        
                    <b>Contato:</b> ".$contato."<br>
                    <b>E-mail:</b> ".$email."
                    </p>
                </section>
                <hr>
                <section>
                    <h2 class='' style='font-size:28px;'><b>Disponibilidade</b></h2>                        
                    <p class='texto' class='end' style='font-size: 20px; text-align: justify;''>        
                    <b>Horário de Funcionamento:</b> ".$func."
                    </p>
                </section>  
                <hr>            
                <section>
                    <h2 style='font-size:28px;'><b>Serviço Móvel?</b></h2>                        
                    <p class='texto' style='font-size: 20px; text-align: justify;''>        
                    ".utf8_encode($servicoM).", ".utf8_encode($movelE)."
                    </p>
                    </section>
                </div>
                ";

        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function filtro($Filtro,$Filtro2,$logado)
    {
        try {
            if (empty($_GET['filtro']) && empty($_GET['filtro2'])) {
                

            }elseif (empty($_GET['filtro']) && (!empty($_GET['filtro2'] == 'bairro')  || !empty($_GET['filtro2'] == "nClinica"))){
                echo "<center><h3>INFORME O NOME DO BAIRRO OU DA CLÍNICA</h3></center>";

            }elseif (empty($_GET['filtro']) && !empty($_GET['filtro2'] == '24h') ) {                
                $filtro = $this->conn->prepare("SELECT * FROM enderecos 
                                                INNER JOIN clinicas ON enderecos.Identificacao = clinicas.Identificacao
                                                INNER JOIN informacoes ON clinicas.Identificacao = informacoes.Identificacao
                                                WHERE Funcionamento='24Horas'");
                $filtro->execute();
                $contar =  $filtro->rowCount();           
                $linhas = $filtro->fetchAll(PDO::FETCH_OBJ);
                if ($contar>=1) {
                echo "
                <hr>
                <ul class='alt' style='word-wrap: break-word;'>
                               
                ";
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                        <li>
                           <b><a style='font-size:25px;' href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."'>".utf8_encode($nome)."</a></b><br>
                            <p>Ponto de Referência: ".utf8_encode($complemento).".</p>                 
                        </li>

                    ";
                }
                echo "
                </ul> 
                "; 
                }elseif ($contar<=0) {
                    echo "<h1>*Nome incorreto ou nenhuma clínica cadastrada com esse bairroaaaaaa*</h1>";
                }

            }elseif (empty($_GET['filtro']) && !empty($_GET['filtro2'] == 'ServicoM') ) {
                $filtro = $this->conn->prepare("SELECT * FROM enderecos 
                                                INNER JOIN clinicas ON enderecos.Identificacao = clinicas.Identificacao
                                                INNER JOIN informacoes ON clinicas.Identificacao = informacoes.Identificacao
                                                INNER JOIN logos ON informacoes.Identificacao = logos.Identificacao
                                                WHERE Servico_Movel='Sim'");
                $filtro->execute();
                $contar =  $filtro->rowCount();           
                $linhas = $filtro->fetchAll(PDO::FETCH_OBJ);
                if ($contar>=1) {
                echo "
                
                <hr>
                <ul class='alt' style='word-wrap: break-word;'>
                               
                ";
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    $foto = $listar->Foto;
                    echo"
                        <li>
                            <a style='font-size:25px;' href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."'>".utf8_encode($nome)."</a><br>
                            <p><b style='color:black;'>Ponto de Referência: ".utf8_encode($complemento).". </b></p> 
                        
                                            
                        </li>
                    ";
                    // <img src='images/".$foto."' style='width: 100%;'>
                }
                echo "
                </ul> 
                "; 
                }elseif ($contar<=0) {
                    echo "<h1 style='text-align: center;'>*CONDIÇÕES DE BUSCA NÃO ENCONTRADAS*</h1>";
                }

            }elseif (empty($_GET['filtro']) && !empty($_GET['filtro2'] == 'AttGA') ) {
                $filtro = $this->conn->prepare("SELECT * FROM enderecos 
                                                INNER JOIN clinicas ON enderecos.Identificacao = clinicas.Identificacao
                                                INNER JOIN informacoes ON clinicas.Identificacao = informacoes.Identificacao
                                                WHERE Atendimento_A='Sim'");
                $filtro->execute();
                $contar =  $filtro->rowCount();           
                $linhas = $filtro->fetchAll(PDO::FETCH_OBJ);
                if ($contar>=1) {
                echo "
                <hr>
                <ul class='alt' style='word-wrap: break-word;'>
                               
                ";
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                        <li>
                            <a style='font-size:25px;' href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."'>".utf8_encode($nome)."</a><br>
                            <p><b style='color:black;'>Ponto de Referência: ".utf8_encode($complemento).". </b></p>                
                        </li>
                    ";
                }
                echo "
                </ul> 
                "; 
                }elseif ($contar<=0) {
                    echo "<h3 style='text-align: center;'>CONDIÇÕES DE BUSCA NÃO ENCONTRADAS</h3>";
                }

            }elseif (!empty($_GET['filtro']) && !empty($_GET['filtro2'] == '24h') ) {
                $filtro = $this->conn->prepare("SELECT * FROM enderecos 
                                                INNER JOIN clinicas ON enderecos.Identificacao = clinicas.Identificacao
                                                INNER JOIN informacoes ON clinicas.Identificacao = informacoes.Identificacao
                                                WHERE Funcionamento='24Horas' AND Bairro LIKE '%".$Filtro."%'");
                $filtro->execute();
                $contar =  $filtro->rowCount();           
                $linhas = $filtro->fetchAll(PDO::FETCH_OBJ);
                if ($contar>=1) {
                echo "
                <hr>
                <ul class='alt' style='word-wrap: break-word;'>
                               
                ";
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                        <li>
                            <a style='font-size:25px;' href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."'>".utf8_encode($nome)."</a><br>
                            <p><b>Ponto de Referência: ".utf8_encode($complemento).". </b></p>                  
                        </li>
                    ";
                }
                echo "
                </ul> 
                "; 
                }elseif ($contar<=0) {
                    "<h3 style='text-align: center;'>*CONDIÇÕES DE BUSCA NÃO ENCONTRADAS*</h3>";
                }

            }elseif (!empty($_GET['filtro']) && !empty($_GET['filtro2'] == 'ServicoM') ) {
                $filtro = $this->conn->prepare("SELECT * FROM enderecos 
                                                INNER JOIN clinicas ON enderecos.Identificacao = clinicas.Identificacao
                                                INNER JOIN informacoes ON clinicas.Identificacao = informacoes.Identificacao
                                                WHERE Servico_Movel='Sim' AND Bairro LIKE '%".$Filtro."%'");
                $filtro->execute();
                $contar =  $filtro->rowCount();           
                $linhas = $filtro->fetchAll(PDO::FETCH_OBJ);
                if ($contar>=1) {
                echo "
                <hr>
                <ul class='alt' style='word-wrap: break-word;'>
                               
                ";
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                        <li>
                            <a style='font-size:25px;' href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."'>".utf8_encode($nome)."</a><br>
                            <p><b style='color:black;'>Ponto de Referência: ".utf8_encode($complemento).". </b></p>               
                        </li>
                    ";
                }
                echo "
                </ul> 
                "; 
                }elseif ($contar<=0) {
                    "<h3 style='text-align: center;'>*CONDIÇÕES DE BUSCA NÃO ENCONTRADAS*</h3>";
                }

            }elseif (!empty($_GET['filtro']) && !empty($_GET['filtro2'] == 'AttGA') ) {
                $filtro = $this->conn->prepare("SELECT * FROM enderecos 
                                                INNER JOIN clinicas ON enderecos.Identificacao = clinicas.Identificacao
                                                INNER JOIN informacoes ON clinicas.Identificacao = informacoes.Identificacao
                                                WHERE Atendimento_A='Sim' AND Bairro LIKE '%".$Filtro."%'");
                $filtro->execute();
                $contar =  $filtro->rowCount();           
                $linhas = $filtro->fetchAll(PDO::FETCH_OBJ);
                if ($contar>=1) {
                echo "
                <hr>
                <ul class='alt' style='word-wrap: break-word;'>
                               
                ";
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                        <li>
                            <a style='font-size:25px;' href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."'>".utf8_encode($nome)."</a><br>
                            <p><b style='color:black;'>Ponto de Referência: ".utf8_encode($complemento).". </b></p>               
                        </li>
                    ";
                }
                echo "
                </ul> 
                "; 
                }elseif ($contar<=0) {
                    echo "<h3 style='text-align: center;'>*CONDIÇÕES DE BUSCA NÃO ENCONTRADAS*</h3>";
                }

            }elseif (!empty($_GET['filtro']) && !empty($_GET['filtro2'] == 'bairro') ) {
                $filtro = $this->conn->prepare("SELECT * FROM enderecos INNER JOIN clinicas ON  enderecos.Identificacao = clinicas.Identificacao WHERE Bairro LIKE '%".$Filtro."%'");
                $filtro->execute();
                $contar =  $filtro->rowCount();           
                $linhas = $filtro->fetchAll(PDO::FETCH_OBJ);
                if ($contar>=1) {
                echo "
                <hr>
                <ul class='alt' style='word-wrap: break-word;'>
                               
                ";
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                        <li>
                            <a style='font-size:25px;' href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."'>".utf8_encode($nome)."</a><br>
                            <p><b style='color:black;'>Ponto de Referência: ".utf8_encode($complemento).". </b></p>                 
                        </li>
                    ";
                }
                echo "
                </ul> 
                "; 
                }elseif ($contar<=0) {

                    echo "<h3 style='text-align: center;'>*CONDIÇÕES DE BUSCA NÃO ENCONTRADAS*</h3>";
                }

            }elseif (!empty($_GET['filtro']) && !empty($_GET['filtro2'] == 'nClinica') ) {
                $filtro = $this->conn->prepare("SELECT * FROM enderecos INNER JOIN clinicas ON  enderecos.Identificacao = clinicas.Identificacao WHERE Nome LIKE '%".$Filtro."%'");
                $filtro->execute();
                $contar =  $filtro->rowCount();           
                $linhas = $filtro->fetchAll(PDO::FETCH_OBJ);
                    if ($contar>=1) {
                    echo "
                <hr>
                <ul class='alt' style='word-wrap: break-word;'>
                               
                ";
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                        <li>
                            <a style='font-size:25px;' href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."'>".utf8_encode($nome)."</a><br>
                            <p><b style='color:black;'>Ponto de Referência: ".utf8_encode($complemento).". </b></p>                 
                        </li>
                    ";
                }
                echo "
                </ul> 
                "; 
                }elseif ($contar<=0) {
                    echo "<h3 style='text-align: center;'>*CONDIÇÕES DE BUSCA NÃO ENCONTRADAS*</h3>";
                }
            }
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }
    public function insertComentario($comentario,$iden,$logado){
        $insertC = $this->conn->prepare("INSERT INTO comentario(Identificacao,Usuario,Comentario)VALUES(?,?,?)");
        $insertC->bindValue(1, "$iden");
        $insertC->bindValue(2, "$logado");
        $insertC->bindValue(3, "$comentario");
        $insertC->execute();

    }
    public function BuscarComentario($iden,$logado)
    {
            $BuscarComentario = $this->conn->prepare("SELECT * FROM comentario WHERE Identificacao='$iden' ORDER BY data_lancamento DESC"); 
            $BuscarComentario->execute();         //Comentários Gerais 
            $linhas = $BuscarComentario->fetchAll(PDO::FETCH_OBJ); 
            echo "
                <div style='word-wrap: break-word;'>
                <section>
                <h3></h3>                    
                ";
            foreach ($linhas as $listar) {
                $comentario = $listar->Comentario;
                $data = $listar->data_lancamento;
                $usuario = $listar->Usuario;
                $id = $listar->id;

                echo "
                <p class='texto' style='text-align: justify;'>
                ";
                if($usuario==$logado) { 
                    echo"
                    <a style='float:right;' href='./Back/ApagarComentario.php?id=".$id."'>Excluir</a>
                    <b style=''>".$usuario." - ".date('d-m-Y', strtotime($data))."</b><br>
                    ".utf8_encode($comentario)." 
                    <hr>";
                }else{
                    echo"
                    <b style=''>".$usuario." - ".date('d-m-Y', strtotime($data))."</b><br>
                    ".utf8_encode($comentario)." 
                    <hr>";
                }
                echo "    
                </p>
                ";
            }
            echo "                    
                </section>
                </div>                      
                ";

    }
    public function ApagarComentario($selecionado)
    {
        $ApagarComentario = $this->conn->prepare("DELETE FROM comentario WHERE id='$selecionado';"); 
        $ApagarComentario->execute(); 
        echo "
        <script type='text/javascript'>history.go(-1)</script>
        ";
    }
    
    public function CadastrarNormal($nome,$email,$senha){
        $insertC = $this->conn->prepare("INSERT INTO usuario(Nome,Email,Senha)VALUES(?,?,?)");
        $insertC->bindValue(1, $nome);
        $insertC->bindValue(2, $email);
        $insertC->bindValue(3, $senha);
        $insertC->execute();
        require_once ('UsuarioDAO.php');
        $Novo_Busca = new UsuarioDAO();
        $Novo_Busca->validarLogin($email,$senha);

    }
    public function validarLogin($usu, $senha)
    {
        $Validar = $this->conn->prepare ("SELECT * FROM usuario WHERE Email='$usu' AND Senha='$senha'");
        $Validar->execute();
        if ($Validar->rowCount() == 1) {
            session_start();
            $_SESSION['login'] = $usu;
            $_SESSION['senha'] = $senha;
            header("Location:http:BuscarClinica.php?logado=".$usu."");
        }elseif ($Validar->rowCount() <= 0) {
            echo "<h1>Usuário Inválido !!</h1>";
            // echo "<script language=\"javascript\">alert(\"Usuário Inválido!!\")</script>";
            // echo "<script language=\"javascript\">window.history.back();</script>";
        }
        
    }
}
?>