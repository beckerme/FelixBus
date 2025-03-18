<?php
// processa_registo.php

// Iniciar a sessão (se necessário)
session_start();

// Ligação à base de dados
include 'C:\xampp\htdocs\LPITRAB\basedados\basedados.h';

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash da password

// Preparar a query SQL
$sql = "INSERT INTO utilizadores (nome, email, telefone, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Erro ao preparar a query: " . $conn->error);
}

// Vincular os parâmetros
$stmt->bind_param("ssss", $nome, $email, $telefone, $password);

// Executar a query
if ($stmt->execute()) {
    echo "Registo efetuado com sucesso!";
} else {
    echo "Erro ao registar: " . $stmt->error;
}

// Fechar a ligação
$stmt->close();
$conn->close();
?>
