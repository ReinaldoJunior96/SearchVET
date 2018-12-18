<?php
require_once ('../ClassesDAO/ClinicaDAO.php');

$EnderecoDAO = new ClinicaDAO();
$EnderecoDAO->EditarInformacoes($_POST['funcionamento'],utf8_decode($_POST['servicoM']),utf8_decode($_POST['infoMovel']),utf8_decode($_POST['atendimento']),$_POST['iden']);


?>