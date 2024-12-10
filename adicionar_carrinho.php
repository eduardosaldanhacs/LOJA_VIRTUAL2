<?php
// Conexão com o banco de dados
$conn = new mysqli('localhost', 'root', '', 'loja_informatica');
if ($conn->connect_error) {
    die("Erro ao conectar: " . $conn->connect_error);
}

// Verificar se o ID foi enviado
if (isset($_POST['id'])) {
    $produtoId = (int)$_POST['id'];

    // Verificar se o produto já está no carrinho
    $checkSql = "SELECT * FROM carrinho WHERE produto_id = ?";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("i", $produtoId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Atualizar quantidade
        $updateSql = "UPDATE carrinho SET quantidade = quantidade + 1 WHERE produto_id = ?";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("i", $produtoId);
        $stmt->execute();
    } else {
        // Adicionar novo produto
        $insertSql = "INSERT INTO carrinho (produto_id, quantidade) VALUES (?, 1)";
        $stmt = $conn->prepare($insertSql);
        $stmt->bind_param("i", $produtoId);
        $stmt->execute();
    }

    echo "Produto adicionado ao carrinho!";
} else {
    echo "ID do produto não recebido.";
}
?>
