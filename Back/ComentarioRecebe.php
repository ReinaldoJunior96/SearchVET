<?php
	require_once ('../ClassesDAO/UsuarioDAO.php');
	$comentario = new UsuarioDAO();
	$comentario->insertComentario(utf8_decode($_GET['comentario']),$_GET['id'],$_GET['usuario']);




	echo "<script language=\"javascript\">window.history.back();</script>";
	?>