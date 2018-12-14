<!DOCTYPE html>
<html lang="pt-br">
<head>
  <!-- Meta tags Obrigatórias -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.css">
  <!-- Bootstrap CSS -->
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->

  <title>Olá, mundo!</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #6959CD">
    <a class="navbar-brand" href="#">
      <img src="img/cachorro.png" width="30" height="30" class="d-inline-block align-top" alt="">
      <i>VetMaps</i>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Início</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  data-toggle="modal" data-target="#cadClinica" href="#">Login Clínica</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Cadastro
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Clínica</a>
            <a class="dropdown-item" href="#">Usuário</a>
            <!-- <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Algo mais aqui</a> -->
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Buscar Serviços</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contato</a>
          </li>
        </ul>
      <!-- <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
      </form> -->
    </div>
  </nav>
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="img-fluid d-block" src="img/img1.png" alt="Primeiro Slide">
        <div class="carousel-caption d-none d-md-block">
          <h5></h5>
          <p></p>
        </div>
      </div>
      <div class="carousel-item">
        <img class="img-fluid d-block" src="img/img2.png" alt="Segundo Slide">
        <div class="carousel-caption d-none d-md-block">
          <h5>Bem- Vindo a palfaomraa</h5>
          <p>Melhor rede e clinicaaa</p>
        </div>
      </div>
      <div class="carousel-item">
        <img class="img-fluid d-block" src="img/img3.png" alt="Terceiro Slide">
        <div class="carousel-caption d-none d-md-block">
          <h5>Bem- Vindo a palfaomraa</h5>
          <p>Melhor rede e clinicaaa</p>
        </div>    </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Próximo</span>
      </a>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-12 text-center my-3">
          <h1 class="display-4">Bem vindo</h1>
          <p>Rede de Clínica veterinarias</p>
        </div>
      </div>

      <div class="col-12">
        <h4>Quem somos?</h4>
        <p class="text-justify">A VETMAPS é uma plataforma que trabalha com marketing e filtragem de informação, onde é realizada a integração entre proprietários de clínicas veterinárias ou pet shop's e donos de animais.<br>
          Visando o lado dos proprietários de clínicas, pode-se obter uma boa qualidade de marketing digital para sua instituição, através de informações cadastradas pela própria empresa, que serão mostradas para as pessoas que estão à procura desses serviços oferecidos por elas. <br>
        Em relação ao cliente, ele poderá ter maior contato com as empresas, buscando os serviços oferecidos, assim obtendo as informações necessárias de forma rápida e prática para cuidar da melhor forma possível da saúde do seu animal.</p>

        <h4>Comece pelos detalhes</h4>
        <p class="text-justify">Quanto mais específicas forem as informações fornecidas, mais fácil será para o searchvet promover sua clínica junto aos pacientes. Conteúdo de qualidade, como dados para contato, descrições interessantes e detalhes sobre as instalações e serviços que você oferece, tornam o seu perfil mais atrativo para os visitantes.</p>

        <h4>Monitore a sua reputação</h4>
        <p class="text-justify">É importante saber a opinião dos seus pacientes sobre o seu estabelecimento. A página comentários oferece uma visão clara sobre a sua reputação online com uma análise específica dos aspectos avaliados da sua clínica.</p>
      </div>

      <div class="card-deck">
        <div class="card">
          <img class="card-img-top" src="img/img2.png" alt="Imagem de capa do card">
          <div class="card-body">
            <h5 class="card-title">Título do card</h5>
            <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este conteúdo é um pouco maior, para demonstração.</p>
          </div>
          <div class="card-footer">
            <small class="text-muted">Atualizados 3 minutos atrás</small>
          </div>
        </div>
        <div class="card">
          <img class="card-img-top" src="img/img1.png" alt="Imagem de capa do card">
          <div class="card-body">
            <h5 class="card-title">Título do card</h5>
            <p class="card-text">Este é um card com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional.</p>
          </div>
          <div class="card-footer">
            <small class="text-muted">Atualizados 3 minutos atrás</small>
          </div>
        </div>
        <div class="card">
          <img class="card-img-top" src="img/img3.png" alt="Imagem de capa do card">
          <div class="card-body">
            <h5 class="card-title">Título do card</h5>
            <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p>
          </div>
          <div class="card-footer">
            <small class="text-muted">Atualizados 3 minutos atrás</small>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-6">
          <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action active">
              Contato
            </a>
            <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
            <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="btn-group" role="group">
            <a href="#" class="list-group-item list-group-item-action active">
              Social
            </a>
            <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
            <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
            <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
            <a href="#" class="list-group-item list-group-item-action disabled">Vestibulum at eros</a>
          </div>
        </div>
      </div>



    </div>





























    <div class="modal fade" id="cadClinica" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nova mensagem</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <img src="img/img2.png" class="img-fluid">
            <form>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Destinatário:</label>
                <input type="text" class="form-control" id="recipient-name">
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Mensagem:</label>
                <textarea class="form-control" id="message-text"></textarea>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary">Enviar</button>
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