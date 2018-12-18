<?php
require_once ('../Classes/Clinica.php');
require_once ('../ClassesDAO/ClinicaDAO.php');
$editar = new Clinica();
$editar->setNomeC(utf8_decode($_POST['nome']));
$editar->setContato(utf8_decode($_POST['contato']));
$editar->setEmail(utf8_decode($_POST['email']));

$editarDAO = new ClinicaDAO();
$editarDAO->EditarPerfil($editar,$_POST['iden']);


?>