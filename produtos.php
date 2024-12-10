<!-- Seção de produtos -->
<div class="container mt-5">
        <h2 class="text-center mb-4">Produtos em Destaque</h2>
        <div class="row" id="produtos">
            <?php
            // Listar produtos
            $sql = "SELECT * FROM produtos";
            $result = $conn->query($sql);
            while ($produto = $result->fetch_assoc()):
            ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="imagens/<?php echo $produto['imagem']; ?>" class="card-img-top" alt="<?php echo $produto['nome']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $produto['nome']; ?></h5>
                            <p class="card-text"><?php echo $produto['descricao']; ?></p>
                            <p class="text-success"><strong>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></strong></p>
                            <button class="btn btn-primary btn-comprar" data-id="<?php echo $produto['id']; ?>">Comprar</button>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>