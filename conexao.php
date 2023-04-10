<?php
		
	//VB EXPRESS
	// $servidor = "localhost:3306";
	// $usuario = "called63_vb";
	// $senha = "123456";
	// $dbname = "called63_vb";
	
	//LOCALHOST
	$servidor = "localhost";
	$usuario = "root";
	$senha = "";
	$dbname = "cadastro_clientes";
	
	//Criar a conexão
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

	function abrirBanco(){
		// $conexao = new mysqli ("localhost:3306","called63_vb","123456","called63_vb");
		$conexao = new mysqli ("localhost","root","","cadastro_clientes");
			return $conexao;
		}

?>