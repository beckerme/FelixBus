<?php
// Iniciar a sessão
session_start();

// Ligação à base de dados
include 'C:\xampp\htdocs\LPITRAB\basedados\basedados.h';

// Receber dados do formulário
$email = $_POST['email'];
$password = $_POST['password'];

// Preparar a query SQL com JOIN para obter o tipo de utilizador
$sql = "
    SELECT u.*, t.Designacao 
    FROM utilizadores u
    LEFT JOIN tipoutilizador t ON u.TipoUtilizador = t.TipoUtilizador
    WHERE u.email = ?
";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Erro ao preparar a query: " . $conn->error);
}

// Vincular o parâmetro
$stmt->bind_param("s", $email);

// Executar a query
if ($stmt->execute()) {
    // Obter o resultado
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Utilizador encontrado
        $row = $result->fetch_assoc();

        // Verificar a password
        if (password_verify($password, $row['password'])) {
            // Password correta - Guardar informações na sessão
            $_SESSION['user_id'] = $row['_id'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['tipo_utilizador'] = $row['Designacao'];

            echo "Login bem-sucedido!";

            // Redirecionar com base no tipo de utilizador
            switch ($row['Designacao']) {
                case 'Administrador':
                    header("Location: admin_dashboard.php");
                    break;
                case 'Funcionario':
                    header("Location: funcionario_dashboard.php");
                    break;
                case 'Cliente':
                    header("Location: cliente_dashboard.php");
                    break;
                case 'Visitante':
                default:
                    header("Location: visitante_dashboard.php");
                    break;
            }
            exit();
        } else {
            // Password incorreta
            echo "Password incorreta.";
        }
    } else {
        // Utilizador não encontrado
        echo "Utilizador não encontrado.";
    }
} else {
    echo "Erro ao executar a query: " . $stmt->error;
}

// Fechar a ligação
$stmt->close();
$conn->close();
?>
