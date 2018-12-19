<?php 
require_once ('../ClassesDAO/ClinicaDAO.php');
$novaCDAO = new ClinicaDAO();
$novaCDAO->validarLogin(@$_POST['iden'], @$_POST['senha']);

?>