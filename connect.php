<?php
// Conexão com o banco de dados
$conn = new mysqli('localhost', 'root', '', 'loja_informatica');
if ($conn->connect_error) {
    die("Erro ao conectar: " . $conn->connect_error);
}

// Consultar produtos
$sql = "SELECT * FROM produtos";
$result = $conn->query($sql);
?>