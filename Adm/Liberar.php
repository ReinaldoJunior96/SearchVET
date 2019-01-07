<?php 
@ob_start();
session_start();
if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)){
  unset($_SESSION['login']);
  unset($_SESSION['senha']);
header('location:login.php');
}
$logado = $_SESSION['login'];

require_once ('../ClassesDAO/AdmDAO.php');
$AdmDAO = new AdmDAO();
$AdmDAO->LiberarAcesso($_GET['liberar']);
?>
