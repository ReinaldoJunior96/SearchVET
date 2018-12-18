<!DOCTYPE html>
<html>
<head>
	<title></title>
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
	<?php
	require_once ('../ClassesDAO/AdmDAO.php');
	$AdmDAO = new AdmDAO();
	$AdmDAO->CancelarAcesso($_GET['cancelar']);
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
</body>
</html>