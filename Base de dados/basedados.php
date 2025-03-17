<?php
$host = 'localhost';
$dbname = 'felixbus';
$username = 'root';
$password = '';

// Criação da conexão MySQLi
$conn = new mysqli($host, $username, $password_db, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Erro ao conectar à base de dados: " . $conn->connect_error);
}


?>