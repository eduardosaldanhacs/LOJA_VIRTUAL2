<?php
// Conexão com o banco de dados
$conn = new mysqli('localhost', 'root', '', 'loja_informatica');
if ($conn->connect_error) {
    die("Erro ao conectar: " . $conn->connect_error);
}

// Verificar se o ID do item foi enviado
if (isset($_POST['id'])) {
    $id = (int)$_POST['id'];

    // Remover o item do carrinho
    $sql = "DELETE FROM carrinho WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// Redirecionar de volta para o carrinho
header("Location: visualizar_carrinho.php");
exit;
?>
