<?php
session_start();
$conn = new PDO("mysql:host=localhost;dbname=loja", "root", "");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Buscar produto no banco
    $query = $conn->prepare("SELECT * FROM produtos WHERE id = ?");
    $query->execute([$id]);
    $produto = $query->fetch();

    if ($produto) {
        // Se o produto já está no carrinho, aumenta a quantidade
        if (isset($_SESSION['carrinho'][$id])) {
            $_SESSION['carrinho'][$id]['quantidade']++;
        } else {
            $_SESSION['carrinho'][$id] = [
                'nome' => $produto['nome'],
                'preco' => $produto['preco'],
                'quantidade' => 1
            ];
        }
    }
}

// Redireciona de volta à página anterior
header("Location: carrinho.php");
exit;
