<?php
session_start();
$conn = new PDO("mysql:host=localhost;dbname=loja", "root", "");

$query = $conn->query("SELECT * FROM produtos");
$produtos = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Loja Online</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Produtos Disponíveis</h1>

<div class="produtos">
    <?php foreach ($produtos as $produto): ?>
        <div class="produto">
            <img src="<?= $produto['imagem'] ?>" alt="<?= $produto['nome'] ?>">
            <h3><?= $produto['nome'] ?></h3>
            <p>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
            <a href="adicionar.php?id=<?= $produto['id'] ?>" class="btn">🛒 Adicionar ao Carrinho</a>
        </div>
    <?php endforeach; ?>
</div>

<a href="carrinho.php" class="btn-carrinho">🛒 Ver Carrinho</a>

</body>
</html>
