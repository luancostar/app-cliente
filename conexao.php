<?php

// $servidor = "localhost:3306";
// 	$usuario = "called63_tracking";
// 	$senha = "5j7ZA{v1rN,#";
// 	$dbname = "called63_tracking";

//LOCALHOST
$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "tracking";

//Criar a conexão
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

function abrirBanco()
{
	// $conexao = new mysqli ("localhost:3306","called63_tracking","5j7ZA{v1rN,#","called63_tracking");
	$conexao = new mysqli("localhost", "root", "", "tracking");
	return $conexao;
}
