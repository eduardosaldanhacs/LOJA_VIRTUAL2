<?php 

// Inicia a sessão
session_start();

// Verifica se o usuário já está logado
if (isset($_SESSION['usuario_id'])) {
    header("Location: dashboard.php"); // Redireciona para o painel de controle se já estiver logado
    exit();
}

include("connect.php");
// Consultar os produtos no carrinho
$sql = "SELECT c.id, p.nome, p.preco, c.quantidade, (p.preco * c.quantidade) AS total, p.imagem
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
    <title>Loja de Informática</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Div para o gif de carregamento -->
    <div id="loading" style="display:none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999;">
        <img src="imagens/loading.gif" alt="Carregando...">
    </div>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Loja de Informática</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Início</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Produtos</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contato</a></li>

                <!-- Adicionando o Dropdown de Categorias -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categorias
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="produtos.php?categoria=placa_mae">Placa mãe</a></li>
                        <li><a class="dropdown-item" href="#">Processadores</a></li>
                        <li><a class="dropdown-item" href="#">Categoria 3</a></li>
                        <!-- Adicione mais categorias conforme necessário -->
                    </ul>
                </li>
            </ul>

            <!-- Botões Login e Carrinho -->
            <div class="d-flex">
                <a href="login.php" class="btn btn-outline-light me-2">Login</a>

                <!-- Ícone do Carrinho com Dropdown -->
                <div class="btn-group">
                    <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-cart"></i> Carrinho
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <div id="carrinho">
                            <?php if (!empty($carrinho)): ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Imagem</th>
                                            <th>Produto</th>
                                            <th>Preço Unitário</th>
                                            <th>Quantidade</th>
                                            <th>Total</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody id="itens-carrinho">
                                        <?php foreach ($carrinho as $item): ?>
                                            <tr data-id="<?php echo $item['id']; ?>">
                                                <td><img src="imagens/<?php echo $item['imagem']; ?>" alt="<?php echo $item['nome']; ?>" style="width: 50px;"></td>
                                                <td><?php echo $item['nome']; ?></td>
                                                <td>R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></td>
                                                <td><?php echo $item['quantidade']; ?></td>
                                                <td>R$ <?php echo number_format($item['total'], 2, ',', '.'); ?></td>
                                                <td><button class="btn btn-danger btn-sm btn-remover" data-id="<?php echo $item['id']; ?>">Remover</button></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" class="text-end">Total Geral:</th>
                                            <th>R$ <?php echo number_format($totalGeral, 2, ',', '.'); ?></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <!-- Botão de Finalizar Compra -->
                                <div class="text-center mt-3">
                                    <a href="finalizar_compra.php" class="btn btn-success">Finalizar Compra</a>
                                </div>
                            <?php else: ?>
                                <p class="text-center">Seu carrinho está vazio.</p>
                            <?php endif; ?>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

