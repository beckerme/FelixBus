<?php
// Inclui o arquivo de conexão com o banco de dados
include('../BaseDeDados/basedados.php');

// Verifica se o arquivo foi incluído corretamente
if (!isset($conn)) {
    die("Erro ao conectar ao banco de dados.");
}

// Captura os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$password = $_POST['password'];
$telefone = $_POST['telefone'];

// Verifica se todos os campos estão preenchidos
if (empty($nome) || empty($email) || empty($password) || empty($telefone)) {
    die("Todos os campos são obrigatórios.");
}

// Verifica se o e-mail já está registrado
$sql = "SELECT * FROM utilizadores WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    die("Já existe um utilizador com este e-mail.");
}

// Criptografa a senha
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Insere o novo utilizador
$sql = "INSERT INTO utilizadores (nome, password, email, Telefone) 
        VALUES ('$nome', '$passwordHash', '$email', '$telefone')";

if (mysqli_query($conn, $sql)) {
    echo "Registo realizado com sucesso! Redirecionando para a página de login...";
    header("Refresh: 2; url=login.php"); // Redireciona após 2 segundos
} else {
    echo "Erro ao registar: " . mysqli_error($conn);
}

// Fecha a conexão
mysqli_close($conn);
?>