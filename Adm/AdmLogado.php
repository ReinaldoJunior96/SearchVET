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
	<?php 
		session_start();
			if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)){
				unset($_SESSION['login']);
				unset($_SESSION['senha']);
				header('location:index.php');
			}
			$logado = $_SESSION['login'];
	?>

				<!-- Main -->
				<div id="wrapper">
					<div id="main">

						<!-- Content -->
							<section id="content" class="main" style="margin-top: 200px;">
								<h3><b>VETMAPS - ADMINISTRAÇÃO</b></h3>
								<section>
										<form method="POST" action="">
											<?php echo "<input type='hidden' name='usu' value=".$logado."> "; ?>
											<div class="row uniform">
												<div class="6u$ 12u(xsmall)">
													<i>E-mail</i>
													<input type="email" name="email" id="demo-name" value="" placeholder=""/>
												</div>
												<div class="6u$ 12u(xsmall)">
													<i>Filtrar por...</i>
													<select name="filtro" required="">
														<option>Selecione</option>				
														<option value="teste">&emsp;Status: Teste</option>
														<option value="naopago">&emsp;Status: Não pago</option>
													</select>
												</div>	
												<div class="12u$">
													<ul class="actions">
														<li><input type="submit" value="Liberar" class="special" /></li>
													</ul>
												</div>
											</div>
										</form>
										<?php
											if (!empty(@$_POST['filtro'])) {
												require_once ('../ClassesDAO/AdmDAO.php');
												$AdmDAO = new AdmDAO();
												$AdmDAO->Filtro($_POST['email'],$_POST['filtro']);
												
											}
											
										?>
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
							<h2>Contato</h2>
							<dl class="alt">
								<!-- <dt>Address</dt>
								<dd>1234 Somewhere Road &bull; Nashville, TN 00000 &bull; USA</dd> -->
								<dt>Telefone</dt>
								<dd>(000) 000-0000 x 0000</dd>
								<dt>Email</dt>
								<dd>searchvet@gmail.com</dd>
							</dl>
							<ul class="icons">
								<!-- <li><a href="#" class="icon fa-twitter alt"><span class="label">Twitter</span></a></li> -->
								<li><a href="#" class="icon fa-facebook alt"><span class="label">Facebook</span></a></li>
								<li><a href="#" class="icon fa-instagram alt"><span class="label">Instagram</span></a></li>
								<!-- <li><a href="#" class="icon fa-github alt"><span class="label">GitHub</span></a></li>
								<li><a href="#" class="icon fa-dribbble alt"><span class="label">Dribbble</span></a></li> -->
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
			<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery('.toggle-nav').click(function(e) {
						jQuery(this).toggleClass('active');
						jQuery('.menu ul').toggleClass('active');
						e.preventDefault();
					});
				});
			</script>
			<script src="Libraries/zepto.min.js"></script>
	</body>
</html>