<footer class="bg-dark text-white text-center py-3 mt-5">
    <p>&copy; 2024 Loja de Informática - Todos os direitos reservados.</p>
</footer>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Ícones Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Adicionar ao carrinho
            $('.btn-comprar').click(function() {
                var produtoId = $(this).data('id');
                var $btn = $(this);  // Referência ao botão de "Comprar"

                // Substituir o texto do botão pelo gif de carregamento
                $btn.html('<img src="imagens/loading.gif" alt="Carregando..." style="width: 20px; height: 20px;">');
                
                $.ajax({
                    url: 'adicionar_carrinho.php',
                    type: 'POST',
                    data: { id: produtoId },
                    success: function(response) {
                        // Atualizar o conteúdo do carrinho dentro do dropdown
                        $('#carrinho').load(' #carrinho');
                        alert('Produto adicionado ao carrinho!');
                    },
                    error: function() {
                        alert('Erro ao adicionar o produto.');
                    },
                    complete: function() {
                        // Restaurar o texto do botão depois que a requisição for concluída
                        $btn.html('Comprar');
                    }
                });
            });

            // Remover produto do carrinho
            $(document).on('click', '.btn-remover', function() {
                var itemId = $(this).data('id');
                var $btn = $(this);  // Referência ao botão de "Remover"

                // Substituir o texto do botão pelo gif de carregamento
                $btn.html('<img src="imagens/loading.gif" alt="Carregando..." style="width: 20px; height: 20px;">');

                $.ajax({
                    url: 'remover_carrinho.php',
                    type: 'POST',
                    data: { id: itemId },
                    success: function(response) {
                        // Atualizar o conteúdo do carrinho dentro do dropdown
                        $('#carrinho').load(' #carrinho');
                        alert('Produto removido do carrinho.');
                    },
                    error: function() {
                        alert('Erro ao remover o produto.');
                    },
                    complete: function() {
                        // Restaurar o texto do botão depois que a requisição for concluída
                        $btn.html('Remover');
                    }
                });
            });
        });
    </script>
</body>
</html>