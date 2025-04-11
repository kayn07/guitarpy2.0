<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Seu Carrinho</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>🛒 Carrinho de Compras</h1>

<?php if (empty($_SESSION['carrinho'])): ?>
    <p>Seu carrinho está vazio.</p>
<?php else: ?>
    <table>
        <tr>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Preço</th>
            <th>Total</th>
            <th>Ação</th>
        </tr>
        <?php 
        $total = 0;
        foreach ($_SESSION['carrinho'] as $id => $item): 
            $subtotal = $item['preco'] * $item['quantidade'];
            $total += $subtotal;
        ?>
        <tr>
            <td><?= $item['nome'] ?></td>
            <td>
                <form action="atualizar.php" method="POST">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="number" name="quantidade" value="<?= $item['quantidade'] ?>" min="1">
                    <button type="submit">Atualizar</button>
                </form>
            </td>
            <td>R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
            <td>R$ <?= number_format($subtotal, 2, ',', '.') ?></td>
            <td>
                <a href="remover.php?id=<?= $id ?>" class="btn-remover">❌</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h3>Total: R$ <?= number_format($total, 2, ',', '.') ?></h3>
    <a href="index.php" class="btn">Continuar Comprando</a>
<?php endif; ?>

</body>
</html>
