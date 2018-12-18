<?php 

require_once ('../ClassesDAO/UsuarioDAO.php');
$ApagarC = new UsuarioDAO();
$ApagarC->ApagarComentario($_GET['id']);


?>