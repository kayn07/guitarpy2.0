<?php
session_start();

if (isset($_POST['id']) && isset($_POST['quantidade'])) {
    $id = $_POST['id'];
    $quantidade = max(1, intval($_POST['quantidade']));

    if (isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id]['quantidade'] = $quantidade;
    }
}

header("Location: carrinho.php");
exit;
?>
