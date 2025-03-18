<?php
	$host = "localhost";
	$user = "root";
	$password = "";
	$database = "felixbus";

	$conn = new mysqli($host, $user, $password, $database);

	// Verificar a ligação
	if ($conn->connect_error) {
		die("Erro na ligação à base de dados: " . $conn->connect_error);
	}

?>