<?php
// Definindo as configurações de conexão
$host = 'localhost';
$dbname = 'felixbus';  // Nome da base de dados
$username = 'root';  // Nome de utilizador
$password_db = '';   // Senha do banco de dados

// Criação da conexão MySQLi
$conn = new mysqli($host, $username, $password_db, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Erro ao conectar à base de dados: " . $conn->connect_error);
}
?>
