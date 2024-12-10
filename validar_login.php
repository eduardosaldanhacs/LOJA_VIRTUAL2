<?php
session_start();
include("connect.php");

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Prepara a consulta para evitar SQL injection
    $stmt = $conn->prepare("SELECT id, email, senha FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $db_email, $db_senha);
        $stmt->fetch();

        // Verifica se a senha está correta
        if (password_verify($senha, $db_senha)) {
            // Cria uma sessão para o usuário logado
            $_SESSION['usuario_id'] = $id;
            $_SESSION['usuario_email'] = $db_email;
            header("Location: dashboard.php"); // Redireciona para a página principal
            exit();
        } else {
            // Senha incorreta
            header("Location: login.php?erro=true");
            exit();
        }
    } else {
        // Usuário não encontrado
        header("Location: login.php?erro=true");
        exit();
    }
}
?>
