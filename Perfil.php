<?php 
@ob_start();
session_start();
if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)){
	unset($_SESSION['login']);
	unset($_SESSION['senha']);
header('location:index.php');
}
$logado = $_SESSION['login'];
$status = $_SESSION['status'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<!-- Meta tags Obrigatórias -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
	<!-- Bootstrap CSS -->
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->

	<title>VetMaps</title>
  <link rel="icon" href="images/iconeVM.png" type="image/x-icon" />
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-info">
		<a class="navbar-brand" href="#">
			<img src="images/iconeVM.png" width="30" height="30" class="d-inline-block align-top" alt="">
			<i></i>
		</a>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="index.php"><i class="fas fa-home"></i> Início</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#" href="#" data-toggle="modal" data-target="#LoginClinica"><i class="fas fa-user"></i> Login Clínica</a>
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-address-card"></i> Cadastro
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="CadClinica.php">Clínica</a>
						<a class="dropdown-item" href="LoginUsuario.php">Usuário</a>
            <!-- <div class="dropdown-divider"></div>
            	<a class="dropdown-item" href="#">Algo mais aqui</a> -->
            </div>
        </li>
        <li class="nav-item">
        	<a class="nav-link" href="BuscarClinicas.php"><i class="fas fa-search-location"></i> Buscar Serviços</a>
        </li>
        <li class="nav-item">
        	<a class="nav-link" href="#" data-toggle="modal" data-target="#modalContato"><i class="fas fa-envelope"></i> Contato</a>
        </li>
    </ul>
      <!-- <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
    </form> -->
</div>
</nav>

<div class='container my-5'>
	<!-- Botão dropleft padrão -->
	<h3>Atualize seu perfil</h3>
	<div class="dropdown float-sm-right">
		<button class="btn btn-info dropdown-toggle my-2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Menu
		</button>
		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
			<a class="dropdown-item active" href="Perfil.php">Contato</a>
			<a class="dropdown-item" href="EditarEndereco.php">Endereço</a>
			<a class="dropdown-item" href="EditarPerguntas.php">Informações</a>
			<!-- <a class="dropdown-item" href="AddLogo.php">Logomarca</a> -->
			<a class="dropdown-item" href="Especialidades.php">Especialidades</a>
			<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="Back/Sair.php">Sair</a>
		</div>
	</div>
	<?php		
	require_once ('ClassesDAO/ClinicaDAO.php');
	$PerfilC = new ClinicaDAO();	
	if ($status == 'teste') {
		echo "
		<p class='text-sm-left'>Você está em período de teste durante 7 dias, aproveite</p>
		";
		$PerfilC->Logado($logado);
	}elseif ($status == 'pago') {										
		$PerfilC->Logado($logado);
	}elseif ($status == 'naopago') {										
		echo "Período de teste finalizado, entre em contato conosco ou realiza o pagamento do seu boleto.";
	}		

	?>

</div>
<script type='text/javascript'>
	(function()
	{
		if( window.localStorage )
		{
			if( !localStorage.getItem( 'firstLoad' ) )
			{
				localStorage[ 'firstLoad' ] = true;
				window.location.reload();
			} 
			else
				localStorage.removeItem( 'firstLoad' );
		}
	})();

</script>







<hr>
<div class="col-24 text-center">
	<div class="text-center">
		<div class="btn-group" role="group">
			<a class="btn btn-primary" href="#"><i class="fab fa-facebook"></i> Facebook</a>
			<a class="btn btn-warning" href="#"><i class="fab fa-instagram"></i> Instagram</a>
			<a class="btn btn-info" href="#"><i class="fab fa-twitter"></i> Twitter</a>
		</div>
	</div>
	<p class="text-primary"><i>VETMAPS</i> - Rede de Clínicas Veterinárias</p>
</div>
</div>















<!-- Modal CONTATO -->
  <div class="modal fade" id="modalContato" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Contato</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <!-- <span aria-hidden="true">&times;</span> -->
          </button>
        </div>
        <div class="modal-body">
          Entre em contato através do nosso e-mail: <b>suporte@vetmaps.com.br</b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>





  <!-- Modal Login Clinica -->
  <div class="modal fade" id="LoginClinica" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user"></i> Acesse saeu pefil</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <img src="images/user.png" class="img-fluid rounded mx-auto d-block">
          <form method="POST" action="Back/validarLogin.php">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Usuário</label>
              <input type="text" name="iden" class="form-control" id="recipient-name">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Senha</label>
              <input type="password" name="senha" class="form-control" id="recipient-name"><br>
              <h6>Não possui cadastro? <a href="#" class="badge badge-info">Cadastre-se</a></h6>
              <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Entrar</button>
            </div> 
            </div>     
          </form>
        </div>
      </div>
    </div>      
  </div>




<!-- JavaScript (Opcional) -->
<!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>