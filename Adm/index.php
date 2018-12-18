<!DOCTYPE HTML>
<!--
	Stellar by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>VETMAPS</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="../assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>

		<!-- Wrapper -->
			
				<!-- <nav class="menu">
					  	<a class="linkmenu" href="index.php"><img class="img" src="" alt="" width="50" height="50"></a>

						<ul class="active listaHeader" >

							<li ><a href="index.php">Início</a></li>
							<li><a href="Login.php">Buscar Clínicas</a></li>
							<li class="current-item"><a href="CadClinica.php">Cadastrar Clínica</a></li>
							<li><a href="LoginClinica.php">Login Clínica</a></li>
							<li><a href="#">Contato</a></li>
						</ul>
						<a class="toggle-nav" href="#">&#9776;</a>
					</nav> -->
				<!-- Header -->
					<!-- <header id="header" class="alt">
						<span class="logo"><img src="images/cachorro.png" alt="" style="width: 25%;" /></span>
						
					</header> -->

				<!-- Main -->
				<div id="wrapper">
					<div id="main" >

						<!-- Content -->
							<section id="content" class="main" style="margin-top: 200px;" >
								<h3><b>VETMAPS - ADMINISTRAÇÃO</b></h3>
								<h3>Acesse sua conta</h3>
								<section style="">
										<form method="post" action="">
											<div class="row uniform">
												<div class="6u$ 12u(xsmall)">
													<i>Usuário</i>
													<input type="text" name="usu" id="demo-name" value="" placeholder="" required="
													" />
												</div>
												<div class="6u$ 12u(xsmall)">
													<i>Senha</i>
													<input type="password" name="senha" id="demo-name" value="" placeholder="" required="
													" />
												</div>
												<div class="12u$">
													<ul class="actions">
														<li><input type="submit" value="Entrar" class="special"/></li>
													</ul>
												</div>
											</div>
										</form>
										<?php
											if (!empty(@$_POST['usu'])) {
												require_once ('../ClassesDAO/AdmDAO.php');
												$LoginDAO = new AdmDAO();
												$LoginDAO->validarLogin($_POST['usu'],$_POST['senha']	);
											}
											
										?>
									</section>
							</section>

					</div>

				<!-- Footer -->
					<footer id="footer">
<!-- 						<section>
							<h2>Aliquam sed mauris</h2>
							<p>Sed lorem ipsum dolor sit amet et nullam consequat feugiat consequat magna adipiscing tempus etiam dolore veroeros. eget dapibus mauris. Cras aliquet, nisl ut viverra sollicitudin, ligula erat egestas velit, vitae tincidunt odio.</p>
							<ul class="actions">
								<li><a href="generic.html" class="button">Learn More</a></li>
							</ul>
						</section> -->
						<section>
							<dl class="alt">
							</dl>
							<ul class="icons">
							</ul>
						</section>
						<!-- <p class="copyright">&copy; Untitled. Design: <a href="https://html5up.net">HTML5 UP</a>.</p> -->
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
	</body>
</html>