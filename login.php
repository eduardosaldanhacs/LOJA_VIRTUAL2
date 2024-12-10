<?php
    include("topo.php");
?>
    <div class="container mt-5 content">
        <h2>Login</h2>
        <?php if (isset($_GET['erro'])): ?>
            <div class="alert alert-danger" role="alert">
                Usuário ou senha incorretos.
            </div>
        <?php endif; ?>
        <form action="validar_login.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
        <div class="mt-3">
            <p>Ainda não tem uma conta? <a href="cadastro.php">Cadastre-se aqui</a>.</p>
        </div>
    </div>

    <!-- Rodapé -->
    <?php 
        include("rodape.php");
    ?>
