<?php
// Conexão com o banco de dados
$conn = new mysqli('localhost', 'root', '', 'loja_informatica');
if ($conn->connect_error) {
    die("Erro ao conectar: " . $conn->connect_error);
}

// Consultar os produtos no carrinho
$sql = "SELECT c.id, p.nome, p.preco, c.quantidade, (p.preco * c.quantidade) AS total
        FROM carrinho c
        JOIN produtos p ON c.produto_id = p.id";
$result = $conn->query($sql);

// Calcular o total geral
$totalGeral = 0;
$carrinho = [];
while ($row = $result->fetch_assoc()) {
    $carrinho[] = $row;
    $totalGeral += $row['total'];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Carrinho de Compras</h1>
        <?php if (!empty($carrinho)): ?>
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Preço Unitário</th>
                        <th>Quantidade</th>
                        <th>Total</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($carrinho as $item): ?>
                        <tr>
                            <td><?php echo $item['nome']; ?></td>
                            <td>R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></td>
                            <td><?php echo $item['quantidade']; ?></td>
                            <td>R$ <?php echo number_format($item['total'], 2, ',', '.'); ?></td>
                            <td>
                                <form action="remover_carrinho.php" method="POST" class="d-inline">
                                    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Remover</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">Total Geral:</th>
                        <th>R$ <?php echo number_format($totalGeral, 2, ',', '.'); ?></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
            <div class="text-end">
                <a href="finalizar_compra.php" class="btn btn-success">Finalizar Compra</a>
            </div>
        <?php else: ?>
            <p class="text-center mt-4">Seu carrinho está vazio.</p>
        <?php endif; ?>
    </div>
</body>
</html>
