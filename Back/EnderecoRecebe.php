<?php
require_once ('../ClassesDAO/ClinicaDAO.php');

$EnderecoDAO = new ClinicaDAO();
$EnderecoDAO->EditarEndereco($_POST['cep'],utf8_decode($_POST['rua']),utf8_decode($_POST['bairro']),utf8_decode($_POST['cidade']),utf8_decode($_POST['complemento']),$_POST['iden'],$_POST['mapa']);


?>