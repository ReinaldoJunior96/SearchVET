<?php
require_once ('conexao.php');
class UsuarioDAO extends PDOconectar
{
    public $conn = null;

    function __construct(){$this->conn = PDOconectar::Conectar();}

    public function VisualizarPerfil($unica,$logado)
    {
        try {

            $Comentario = $this->conn->prepare("SELECT * FROM comentario WHERE Identificacao='$unica' ORDER BY data_lancamento DESC"); 
            $Comentario->execute();   
            $NumeroComentarios = $Comentario->rowCount();

            $fichaUnica = $this->conn->prepare("SELECT * FROM enderecos 
                                                INNER JOIN clinicas ON enderecos.Identificacao = clinicas.Identificacao
                                                INNER JOIN informacoes ON clinicas.Identificacao = informacoes.Identificacao
                                                INNER JOIN logos ON informacoes.Identificacao = logos.Identificacao
                                                INNER JOIN especialidade ON logos.Identificacao = especialidade.Identificacao
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
                //tbl especialidade
                $especialidade = $listar->Especialidade;
                //<img class='card-img-top' src='images/".$foto."' alt='Imagem de capa do card'>
            }
            if ($movelE == null) {
                $pega= "No momento não estamos trabalho com este serviço.";
                $movelE = utf8_decode($pega);
            }
                echo "
                <div class='col-12 my-5'>
                    <button type='button' onClick='window.history.back()' class='btn btn-outline-info btn-lg'>Voltar</button>
                    <button type='button' class='btn btn-info float-right'>
                      <a href='Comentario.php?logado=".$logado."&id=".$unica."' class='text-light'>Comentários</a>
                      <span class='badge badge-light'>".$NumeroComentarios."</span>
                    </button>
                </div>    
                <div class='card'>
                  
                  <div class='card-body'>
                    <h2 class='card-title text-center h2'>".utf8_encode($nome)."</h2>
                  </div>
                  
                  <ul class='list-group list-group'>
                    <li class='list-group-item list-group-item-action list-group-item-info text-center'><b><h5>Endereço</h5></b></li>
                    <li class='list-group-item'><b>Cidade</b> <p class='float-right'>".utf8_encode($cidade)."</p></li>
                    <li class='list-group-item'><b>Bairro</b> <p class='float-right'>".utf8_encode($bairro)."</p></li>
                    <li class='list-group-item'><b>Rua/Avenida</b> <p class='float-right'>".utf8_encode($rua)."</p></li>
                    <li class='list-group-item'><b>Complemento</b> <p class='float-right'>".utf8_encode($complemento)."</p></li>
                    <li class='list-group-item text-center'><a href=''><i class='fas fa-map-marked-alt'></i>Ver no mapa</a></li>
                  </ul>
                  
                  <ul class='list-group list-group'>
                   <li class='list-group-item list-group-item-action list-group-item-info text-center'><b><h5>Serviços Diversos</h5></b></li>
                    <li class='list-group-item'><i class='far fa-clock'></i><b> Horário Funcionamento</b> <p class='float-right'>".utf8_encode($func)."</p></li>
                    <li class='list-group-item'><i class='fas fa-ambulance'></i><b> Serviço Móvel</b> <p class='float-right'>".utf8_encode($servicoM).",".utf8_encode($movelE)."</p></li>
                    <li class='list-group-item'><b>Atendimento Grandes Animais</b> <p class='float-right'>".utf8_encode($Att)."</p></li>
                  </ul>
                    
                <ul class='list-group list-group'>
                 <li class='list-group-item list-group-item-action list-group-item-info text-center'><b><h5>Especialidades</h5></b></li>
                "; 
                foreach ($linhas as $listar) {
                //tbl especialidade
                $especialidade = $listar->Especialidade;
                echo "
                    <li class='list-group-item'><b></b> <p class=''><i class='fas fa-angle-right'></i>".utf8_encode($especialidade)."</p></li>
                ";
                }
                echo "
                </ul>
                    </div>
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
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                          <div class='card'> 
                            <div class='card-body'> 
                            <h3 class='card-title'>".utf8_encode($nome)."</h3>
                            <p class='card-text'>Ponto de Referência: ".utf8_encode($complemento)."</p>
                            <a href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."' class='btn btn-primary'>Visitar Perfil</a>
                          </div>
                        </div>
                        <br>
                    ";
                }
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
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                          <div class='card'> 
                            <div class='card-body'> 
                            <h3 class='card-title'>".utf8_encode($nome)."</h3>
                            <p class='card-text'>Ponto de Referência: ".utf8_encode($complemento)."</p>
                            <a href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."' class='btn btn-primary'>Visitar Perfil</a>
                          </div>
                        </div>
                        <br>
                    ";
                }
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
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                          <div class='card'> 
                            <div class='card-body'> 
                            <h3 class='card-title'>".utf8_encode($nome)."</h3>
                            <p class='card-text'>Ponto de Referência: ".utf8_encode($complemento)."</p>
                            <a href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."' class='btn btn-primary'>Visitar Perfil</a>
                          </div>
                        </div>
                        <br>
                    ";
                }
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
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                          <div class='card'> 
                            <div class='card-body'> 
                            <h3 class='card-title'>".utf8_encode($nome)."</h3>
                            <p class='card-text'>Ponto de Referência: ".utf8_encode($complemento)."</p>
                            <a href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."' class='btn btn-primary'>Visitar Perfil</a>
                          </div>
                        </div>
                        <br>
                    ";
                }
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
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                          <div class='card'> 
                            <div class='card-body'> 
                            <h3 class='card-title'>".utf8_encode($nome)."</h3>
                            <p class='card-text'>Ponto de Referência: ".utf8_encode($complemento)."</p>
                            <a href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."' class='btn btn-primary'>Visitar Perfil</a>
                          </div>
                        </div>
                        <br>
                    ";
                }
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
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                          <div class='card'> 
                            <div class='card-body'> 
                            <h3 class='card-title'>".utf8_encode($nome)."</h3>
                            <p class='card-text'>Ponto de Referência: ".utf8_encode($complemento)."</p>
                            <a href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."' class='btn btn-primary'>Visitar Perfil</a>
                          </div>
                        </div>
                        <br>
                    ";
                }
                }elseif ($contar<=0) {
                    echo "<h3 style='text-align: center;'>*CONDIÇÕES DE BUSCA NÃO ENCONTRADAS*</h3>";
                }

            }elseif (!empty($_GET['filtro']) && !empty($_GET['filtro2'] == 'bairro') ) {
                $filtro = $this->conn->prepare("SELECT * FROM enderecos INNER JOIN clinicas ON  enderecos.Identificacao = clinicas.Identificacao WHERE Bairro LIKE '%".$Filtro."%'");
                $filtro->execute();
                $contar =  $filtro->rowCount();           
                $linhas = $filtro->fetchAll(PDO::FETCH_OBJ);
                if ($contar>=1) {
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                          <div class='card'> 
                            <div class='card-body'> 
                            <h3 class='card-title'>".utf8_encode($nome)."</h3>
                            <p class='card-text'>Ponto de Referência: ".utf8_encode($complemento)."</p>
                            <a href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."' class='btn btn-primary'>Visitar Perfil</a>
                          </div>
                        </div>
                        <br>
                    ";
                }
                }elseif ($contar<=0) {

                    echo "<h3 style='text-align: center;'>*CONDIÇÕES DE BUSCA NÃO ENCONTRADAS*</h3>";
                }

            }elseif (!empty($_GET['filtro']) && !empty($_GET['filtro2'] == 'nClinica') ) {
                $filtro = $this->conn->prepare("SELECT * FROM enderecos INNER JOIN clinicas ON  enderecos.Identificacao = clinicas.Identificacao WHERE Nome LIKE '%".$Filtro."%'");
                $filtro->execute();
                $contar =  $filtro->rowCount();           
                $linhas = $filtro->fetchAll(PDO::FETCH_OBJ);
                if ($contar>=1) {
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                          <div class='card'> 
                            <div class='card-body'> 
                            <h3 class='card-title'>".utf8_encode($nome)."</h3>
                            <p class='card-text'>Ponto de Referência: ".utf8_encode($complemento)."</p>
                            <a href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."' class='btn btn-primary'>Visitar Perfil</a>
                          </div>
                        </div>
                        <br>
                    ";
                }
                }elseif ($contar<=0) {
                    echo "<h3 style='text-align: center;'>*CONDIÇÕES DE BUSCA NÃO ENCONTRADAS*</h3>";
                }
                // ==================================================================
            }elseif (!empty($_GET['filtro']) && !empty($_GET['filtro2'] == 'Acupuntura') ) {
                $filtro = $this->conn->prepare("SELECT * FROM enderecos 
                                                INNER JOIN clinicas ON enderecos.Identificacao = clinicas.Identificacao
                                                INNER JOIN especialidade ON clinicas.Identificacao = especialidade.Identificacao
                                                WHERE Especialidade='Acupuntura' AND Bairro LIKE '%".$Filtro."%'");
                $filtro->execute();
                $contar =  $filtro->rowCount();           
                $linhas = $filtro->fetchAll(PDO::FETCH_OBJ);
               if ($contar>=1) {
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                          <div class='card'> 
                            <div class='card-body'> 
                            <h3 class='card-title'>".utf8_encode($nome)."</h3>
                            <p class='card-text'>Ponto de Referência: ".utf8_encode($complemento)."</p>
                            <a href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."' class='btn btn-primary'>Visitar Perfil</a>
                          </div>
                        </div>
                        <br>
                    ";
                }
                }elseif ($contar<=0) {
                    echo "<h3 style='text-align: center;'>*CONDIÇÕES DE BUSCA NÃO ENCONTRADAS*</h3>";
                }
            }elseif (!empty($_GET['filtro']) && !empty($_GET['filtro2'] == 'Analises Laboratoriais') ) {
                $filtro = $this->conn->prepare("SELECT * FROM enderecos 
                                                INNER JOIN clinicas ON enderecos.Identificacao = clinicas.Identificacao
                                                INNER JOIN especialidade ON clinicas.Identificacao = especialidade.Identificacao
                                                WHERE Especialidade='Analises Laboratoriais' AND Bairro LIKE '%".$Filtro."%'");
                $filtro->execute();
                $contar =  $filtro->rowCount();           
                $linhas = $filtro->fetchAll(PDO::FETCH_OBJ);
               if ($contar>=1) {
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                          <div class='card'> 
                            <div class='card-body'> 
                            <h3 class='card-title'>".utf8_encode($nome)."</h3>
                            <p class='card-text'>Ponto de Referência: ".utf8_encode($complemento)."</p>
                            <a href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."' class='btn btn-primary'>Visitar Perfil</a>
                          </div>
                        </div>
                        <br>
                    ";
                }
                }elseif ($contar<=0) {
                    echo "<h3 style='text-align: center;'>*CONDIÇÕES DE BUSCA NÃO ENCONTRADAS*</h3>";
                }
            }elseif (!empty($_GET['filtro']) && !empty($_GET['filtro2'] == 'Cardiologia') ) {
                $filtro = $this->conn->prepare("SELECT * FROM enderecos 
                                                INNER JOIN clinicas ON enderecos.Identificacao = clinicas.Identificacao
                                                INNER JOIN especialidade ON clinicas.Identificacao = especialidade.Identificacao
                                                WHERE Especialidade='Cardiologia' AND Bairro LIKE '%".$Filtro."%'");
                $filtro->execute();
                $contar =  $filtro->rowCount();           
                $linhas = $filtro->fetchAll(PDO::FETCH_OBJ);
               if ($contar>=1) {
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                          <div class='card'> 
                            <div class='card-body'> 
                            <h3 class='card-title'>".utf8_encode($nome)."</h3>
                            <p class='card-text'>Ponto de Referência: ".utf8_encode($complemento)."</p>
                            <a href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."' class='btn btn-primary'>Visitar Perfil</a>
                          </div>
                        </div>
                        <br>
                    ";
                }
                }elseif ($contar<=0) {
                    echo "<h3 style='text-align: center;'>*CONDIÇÕES DE BUSCA NÃO ENCONTRADAS*</h3>";
                }
            }elseif (!empty($_GET['filtro']) && !empty($_GET['filtro2'] == 'Dermatologia') ) {
                $filtro = $this->conn->prepare("SELECT * FROM enderecos 
                                                INNER JOIN clinicas ON enderecos.Identificacao = clinicas.Identificacao
                                                INNER JOIN especialidade ON clinicas.Identificacao = especialidade.Identificacao
                                                WHERE Especialidade='Dermatologia' AND Bairro LIKE '%".$Filtro."%'");
                $filtro->execute();
                $contar =  $filtro->rowCount();           
                $linhas = $filtro->fetchAll(PDO::FETCH_OBJ);
               if ($contar>=1) {
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                          <div class='card'> 
                            <div class='card-body'> 
                            <h3 class='card-title'>".utf8_encode($nome)."</h3>
                            <p class='card-text'>Ponto de Referência: ".utf8_encode($complemento)."</p>
                            <a href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."' class='btn btn-primary'>Visitar Perfil</a>
                          </div>
                        </div>
                        <br>
                    ";
                }
                }elseif ($contar<=0) {
                    echo "<h3 style='text-align: center;'>*CONDIÇÕES DE BUSCA NÃO ENCONTRADAS*</h3>";
                }
            }elseif (!empty($_GET['filtro']) && !empty($_GET['filtro2'] == 'Diagnostico por Imagem') ) {
                $filtro = $this->conn->prepare("SELECT * FROM enderecos 
                                                INNER JOIN clinicas ON enderecos.Identificacao = clinicas.Identificacao
                                                INNER JOIN especialidade ON clinicas.Identificacao = especialidade.Identificacao
                                                WHERE Especialidade='Diagnostico por Imagem' AND Bairro LIKE '%".$Filtro."%'");
                $filtro->execute();
                $contar =  $filtro->rowCount();           
                $linhas = $filtro->fetchAll(PDO::FETCH_OBJ);
               if ($contar>=1) {
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                          <div class='card'> 
                            <div class='card-body'> 
                            <h3 class='card-title'>".utf8_encode($nome)."</h3>
                            <p class='card-text'>Ponto de Referência: ".utf8_encode($complemento)."</p>
                            <a href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."' class='btn btn-primary'>Visitar Perfil</a>
                          </div>
                        </div>
                        <br>
                    ";
                }
                }elseif ($contar<=0) {
                    echo "<h3 style='text-align: center;'>*CONDIÇÕES DE BUSCA NÃO ENCONTRADAS*</h3>";
                }
            }elseif (!empty($_GET['filtro']) && !empty($_GET['filtro2'] == 'Endocrinologia') ) {
                $filtro = $this->conn->prepare("SELECT * FROM enderecos 
                                                INNER JOIN clinicas ON enderecos.Identificacao = clinicas.Identificacao
                                                INNER JOIN especialidade ON clinicas.Identificacao = especialidade.Identificacao
                                                WHERE Especialidade='Endocrinologia' AND Bairro LIKE '%".$Filtro."%'");
                $filtro->execute();
                $contar =  $filtro->rowCount();           
                $linhas = $filtro->fetchAll(PDO::FETCH_OBJ);
               if ($contar>=1) {
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                          <div class='card'> 
                            <div class='card-body'> 
                            <h3 class='card-title'>".utf8_encode($nome)."</h3>
                            <p class='card-text'>Ponto de Referência: ".utf8_encode($complemento)."</p>
                            <a href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."' class='btn btn-primary'>Visitar Perfil</a>
                          </div>
                        </div>
                        <br>
                    ";
                }
                }elseif ($contar<=0) {
                    echo "<h3 style='text-align: center;'>*CONDIÇÕES DE BUSCA NÃO ENCONTRADAS*</h3>";
                }
            }elseif (!empty($_GET['filtro']) && !empty($_GET['filtro2'] == 'Geriatria') ) {
                $filtro = $this->conn->prepare("SELECT * FROM enderecos 
                                                INNER JOIN clinicas ON enderecos.Identificacao = clinicas.Identificacao
                                                INNER JOIN especialidade ON clinicas.Identificacao = especialidade.Identificacao
                                                WHERE Especialidade='Geriatria' AND Bairro LIKE '%".$Filtro."%'");
                $filtro->execute();
                $contar =  $filtro->rowCount();           
                $linhas = $filtro->fetchAll(PDO::FETCH_OBJ);
               if ($contar>=1) {
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                          <div class='card'> 
                            <div class='card-body'> 
                            <h3 class='card-title'>".utf8_encode($nome)."</h3>
                            <p class='card-text'>Ponto de Referência: ".utf8_encode($complemento)."</p>
                            <a href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."' class='btn btn-primary'>Visitar Perfil</a>
                          </div>
                        </div>
                        <br>
                    ";
                }
                }elseif ($contar<=0) {
                    echo "<h3 style='text-align: center;'>*CONDIÇÕES DE BUSCA NÃO ENCONTRADAS*</h3>";
                }
            }elseif (!empty($_GET['filtro']) && !empty($_GET['filtro2'] == 'Neonatologia') ) {
                $filtro = $this->conn->prepare("SELECT * FROM enderecos 
                                                INNER JOIN clinicas ON enderecos.Identificacao = clinicas.Identificacao
                                                INNER JOIN especialidade ON clinicas.Identificacao = especialidade.Identificacao
                                                WHERE Especialidade='Neonatologia' AND Bairro LIKE '%".$Filtro."%'");
                $filtro->execute();
                $contar =  $filtro->rowCount();           
                $linhas = $filtro->fetchAll(PDO::FETCH_OBJ);
               if ($contar>=1) {
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                          <div class='card'> 
                            <div class='card-body'> 
                            <h3 class='card-title'>".utf8_encode($nome)."</h3>
                            <p class='card-text'>Ponto de Referência: ".utf8_encode($complemento)."</p>
                            <a href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."' class='btn btn-primary'>Visitar Perfil</a>
                          </div>
                        </div>
                        <br>
                    ";
                }
                }elseif ($contar<=0) {
                    echo "<h3 style='text-align: center;'>*CONDIÇÕES DE BUSCA NÃO ENCONTRADAS*</h3>";
                }
            }elseif (!empty($_GET['filtro']) && !empty($_GET['filtro2'] == 'Nefrologia') ) {
                $filtro = $this->conn->prepare("SELECT * FROM enderecos 
                                                INNER JOIN clinicas ON enderecos.Identificacao = clinicas.Identificacao
                                                INNER JOIN especialidade ON clinicas.Identificacao = especialidade.Identificacao
                                                WHERE Especialidade='Nefrologia' AND Bairro LIKE '%".$Filtro."%'");
                $filtro->execute();
                $contar =  $filtro->rowCount();           
                $linhas = $filtro->fetchAll(PDO::FETCH_OBJ);
               if ($contar>=1) {
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                          <div class='card'> 
                            <div class='card-body'> 
                            <h3 class='card-title'>".utf8_encode($nome)."</h3>
                            <p class='card-text'>Ponto de Referência: ".utf8_encode($complemento)."</p>
                            <a href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."' class='btn btn-primary'>Visitar Perfil</a>
                          </div>
                        </div>
                        <br>
                    ";
                }
                }elseif ($contar<=0) {
                    echo "<h3 style='text-align: center;'>*CONDIÇÕES DE BUSCA NÃO ENCONTRADAS*</h3>";
                }
            }elseif (!empty($_GET['filtro']) && !empty($_GET['filtro2'] == 'Neurologia') ) {
                $filtro = $this->conn->prepare("SELECT * FROM enderecos 
                                                INNER JOIN clinicas ON enderecos.Identificacao = clinicas.Identificacao
                                                INNER JOIN especialidade ON clinicas.Identificacao = especialidade.Identificacao
                                                WHERE Especialidade='Neurologia' AND Bairro LIKE '%".$Filtro."%'");
                $filtro->execute();
                $contar =  $filtro->rowCount();           
                $linhas = $filtro->fetchAll(PDO::FETCH_OBJ);
               if ($contar>=1) {
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                          <div class='card'> 
                            <div class='card-body'> 
                            <h3 class='card-title'>".utf8_encode($nome)."</h3>
                            <p class='card-text'>Ponto de Referência: ".utf8_encode($complemento)."</p>
                            <a href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."' class='btn btn-primary'>Visitar Perfil</a>
                          </div>
                        </div>
                        <br>
                    ";
                }
                }elseif ($contar<=0) {
                    echo "<h3 style='text-align: center;'>*CONDIÇÕES DE BUSCA NÃO ENCONTRADAS*</h3>";
                }
            }elseif (!empty($_GET['filtro']) && !empty($_GET['filtro2'] == 'Odontologia') ) {
                $filtro = $this->conn->prepare("SELECT * FROM enderecos 
                                                INNER JOIN clinicas ON enderecos.Identificacao = clinicas.Identificacao
                                                INNER JOIN especialidade ON clinicas.Identificacao = especialidade.Identificacao
                                                WHERE Especialidade='Odontologia' AND Bairro LIKE '%".$Filtro."%'");
                $filtro->execute();
                $contar =  $filtro->rowCount();           
                $linhas = $filtro->fetchAll(PDO::FETCH_OBJ);
               if ($contar>=1) {
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                          <div class='card'> 
                            <div class='card-body'> 
                            <h3 class='card-title'>".utf8_encode($nome)."</h3>
                            <p class='card-text'>Ponto de Referência: ".utf8_encode($complemento)."</p>
                            <a href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."' class='btn btn-primary'>Visitar Perfil</a>
                          </div>
                        </div>
                        <br>
                    ";
                }
                }elseif ($contar<=0) {
                    echo "<h3 style='text-align: center;'>*CONDIÇÕES DE BUSCA NÃO ENCONTRADAS*</h3>";
                }
            }elseif (!empty($_GET['filtro']) && !empty($_GET['filtro2'] == 'Oftalmologia') ) {
                $filtro = $this->conn->prepare("SELECT * FROM enderecos 
                                                INNER JOIN clinicas ON enderecos.Identificacao = clinicas.Identificacao
                                                INNER JOIN especialidade ON clinicas.Identificacao = especialidade.Identificacao
                                                WHERE Especialidade='Oftalmologia' AND Bairro LIKE '%".$Filtro."%'");
                $filtro->execute();
                $contar =  $filtro->rowCount();           
                $linhas = $filtro->fetchAll(PDO::FETCH_OBJ);
               if ($contar>=1) {
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                          <div class='card'> 
                            <div class='card-body'> 
                            <h3 class='card-title'>".utf8_encode($nome)."</h3>
                            <p class='card-text'>Ponto de Referência: ".utf8_encode($complemento)."</p>
                            <a href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."' class='btn btn-primary'>Visitar Perfil</a>
                          </div>
                        </div>
                        <br>
                    ";
                }
                }elseif ($contar<=0) {
                    echo "<h3 style='text-align: center;'>*CONDIÇÕES DE BUSCA NÃO ENCONTRADAS*</h3>";
                }
            }elseif (!empty($_GET['filtro']) && !empty($_GET['filtro2'] == 'Oncologia') ) {
                $filtro = $this->conn->prepare("SELECT * FROM enderecos 
                                                INNER JOIN clinicas ON enderecos.Identificacao = clinicas.Identificacao
                                                INNER JOIN especialidade ON clinicas.Identificacao = especialidade.Identificacao
                                                WHERE Especialidade='Oncologia' AND Bairro LIKE '%".$Filtro."%'");
                $filtro->execute();
                $contar =  $filtro->rowCount();           
                $linhas = $filtro->fetchAll(PDO::FETCH_OBJ);
               if ($contar>=1) {
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                          <div class='card'> 
                            <div class='card-body'> 
                            <h3 class='card-title'>".utf8_encode($nome)."</h3>
                            <p class='card-text'>Ponto de Referência: ".utf8_encode($complemento)."</p>
                            <a href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."' class='btn btn-primary'>Visitar Perfil</a>
                          </div>
                        </div>
                        <br>
                    ";
                }
                }elseif ($contar<=0) {
                    echo "<h3 style='text-align: center;'>*CONDIÇÕES DE BUSCA NÃO ENCONTRADAS*</h3>";
                }
            }elseif (!empty($_GET['filtro']) && !empty($_GET['filtro2'] == 'Ortopedia') ) {
                $filtro = $this->conn->prepare("SELECT * FROM enderecos 
                                                INNER JOIN clinicas ON enderecos.Identificacao = clinicas.Identificacao
                                                INNER JOIN especialidade ON clinicas.Identificacao = especialidade.Identificacao
                                                WHERE Especialidade='Ortopedia' AND Bairro LIKE '%".$Filtro."%'");
                $filtro->execute();
                $contar =  $filtro->rowCount();           
                $linhas = $filtro->fetchAll(PDO::FETCH_OBJ);
               if ($contar>=1) {
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                          <div class='card'> 
                            <div class='card-body'> 
                            <h3 class='card-title'>".utf8_encode($nome)."</h3>
                            <p class='card-text'>Ponto de Referência: ".utf8_encode($complemento)."</p>
                            <a href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."' class='btn btn-primary'>Visitar Perfil</a>
                          </div>
                        </div>
                        <br>
                    ";
                }
                }elseif ($contar<=0) {
                    echo "<h3 style='text-align: center;'>*CONDIÇÕES DE BUSCA NÃO ENCONTRADAS*</h3>";
                }
            }elseif (!empty($_GET['filtro']) && !empty($_GET['filtro2'] == 'Traumatologia') ) {
                $filtro = $this->conn->prepare("SELECT * FROM enderecos 
                                                INNER JOIN clinicas ON enderecos.Identificacao = clinicas.Identificacao
                                                INNER JOIN especialidade ON clinicas.Identificacao = especialidade.Identificacao
                                                WHERE Especialidade='Traumatologia' AND Bairro LIKE '%".$Filtro."%'");
                $filtro->execute();
                $contar =  $filtro->rowCount();           
                $linhas = $filtro->fetchAll(PDO::FETCH_OBJ);
               if ($contar>=1) {
                foreach ($linhas as $listar) {
                    $Iden = $listar->Identificacao;
                    $nome = $listar->Nome;
                    $email = $listar->Email;
                    $contato = $listar->Contato;
                    $complemento = $listar->Complemento;
                    echo"
                          <div class='card'> 
                            <div class='card-body'> 
                            <h3 class='card-title'>".utf8_encode($nome)."</h3>
                            <p class='card-text'>Ponto de Referência: ".utf8_encode($complemento)."</p>
                            <a href='./VisualizarPerfil.php?id=".$Iden."&logado=".$logado."' class='btn btn-primary'>Visitar Perfil</a>
                          </div>
                        </div>
                        <br>
                    ";
                }
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
            //style='word-wrap: break-word
            echo "              
                ";
            foreach ($linhas as $listar) {
                $comentario = $listar->Comentario;
                $data = $listar->data_lancamento;
                $usuario = $listar->Usuario;
                $id = $listar->id;
                if($usuario==$logado) { 
                    echo"
                    <span class='d-block p-2 bg-dark text-white'>".$usuario." ~ ".date('d-m-Y', strtotime($data))." <a class='float-right' href='./Back/ApagarComentario.php?id=".$id."'><i class='fas fa-trash-alt'></i></a></span>
                   
                      <p style='word-wrap: break-word' class='text-justify my-2'>".utf8_encode($comentario)."</p>
                   


                    
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
        $insertC->bindValue(1, utf8_decode($nome));
        $insertC->bindValue(2, utf8_decode($email));
        $insertC->bindValue(3, utf8_decode($senha));
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
            //session_start();     
            //$_SESSION['login'] = $usu;
            //$_SESSION['senha'] = $senha;
            echo "<script language=\"javascript\">window.location='BuscarClinicas.php?logado=".$usu."'</script>";
            //header("Location:http: BuscarClinicas.php?logado=".$usu."");
            //var_dump($_SESSION['login']);
            //var_dump($_SESSION['senha']);
        }elseif ($Validar->rowCount() <= 0) {
            echo "<h1>Usuário Inválido !!</h1>";
            // echo "<script language=\"javascript\">alert(\"Usuário Inválido!!\")</script>";
            // echo "<script language=\"javascript\">window.history.back();</script>";
        }
        
    }
}
?>