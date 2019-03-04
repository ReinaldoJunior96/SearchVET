<?php
/**
* 
*/
class PDOconectar{
	
	function __construct(){	}

	public function conectar(){
		try{
		//$pdo=new PDO("mysql:host=br912.hostgator.com.br;dbname=vetmap88_vetmaps","vetmap88_vetmaps","reinaldo@123");
		$pdo=new PDO("mysql:host=localhost;dbname=vetmaps","root","");
			return $pdo;
		}catch( PDOException $ex ){ echo "Erro: ".$ex->getMessage(); }
	}
}




?>