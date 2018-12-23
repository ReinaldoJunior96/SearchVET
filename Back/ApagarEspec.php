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

require_once ('../ClassesDAO/EspecialidadeDAO.php');
$ApagarC = new EspecialidadeDAO();
$ApagarC->excluirEspec($_GET['id'],$_GET['espec']);


?>