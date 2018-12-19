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

  <title>Olá, mundo!</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-info">
    <a class="navbar-brand" href="#">
      <img src="img/cachorro.png" width="30" height="30" class="d-inline-block align-top" alt="">
      <i>VetMaps</i>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Início</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" href="#" data-toggle="modal" data-target="#LoginClinica"><i class="fas fa-user"></i> Login Clínica</a>
        </li>

        <li class="nav-item dropdown active">
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

  <div class="container">
    <!-- <div class="row">
      <div class="col-12 text-center my-5">
        <h1 class="text-info"><i>VETMAPS</i></h1>
        <h4>Rede de Clínica Veterinarias</h4>
      </div>
    </div> -->
    <h3 class="text-info my-3">Cadastre sua clínica <i class="fas fa-id-card-alt"></i></h3>
    <form method="POST">
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Clínica</label>
        <div class="col-sm-10">
          <input type="text" name="nomeC" class="form-control" id="inputEmail3" placeholder="">
        </div>
      </div>
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">CPF/CNPJ</label>
        <div class="col-sm-10">
          <input type="number" name="cpf" class="form-control" id="inputEmail3" placeholder="">
        </div>
      </div>
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">E-mail</label>
        <div class="col-sm-10">
          <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="">
        </div>
      </div>
      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Senha</label>
        <div class="col-sm-10">
          <input type="password" name="senha" class="form-control" id="inputPassword3" placeholder="">
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-10">
          <button type="submit" class="btn btn-info btn-lg">Cadastrar</button>
        </div>
      </div>
    </form>
    <?php
    if (!empty(@$_POST['cpf'])) {
      require_once ('Classes/Clinica.php');
      $novaC = new Clinica();
      $novaC->setSenha(utf8_decode(@$_POST['senha']));
      $novaC->setIdentificacao(@$_POST['cpf']);
      $novaC->setEmail(@$_POST['email']);
      $novaC->setNomeC(@$_POST['nomeC']);
      require_once ('ClassesDAO/ClinicaDAO.php');
      $novaCDAO = new ClinicaDAO();
      $novaCDAO->cadastrar($novaC);

    }
    ?>

    <hr>
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











<!-- Modal Login Clinica -->
<div class="modal fade" id="LoginClinica" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user"></i> Acesse seu pefil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="img/user.png" class="img-fluid rounded mx-auto d-block">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Usuário</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Senha</label>
            <input type="password" class="form-control" id="recipient-name">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Entrar</button>
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