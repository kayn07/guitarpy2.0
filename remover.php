<?php
session_start();

if (isset($_GET['id'])) {
    unset($_SESSION['carrinho'][$_GET['id']]);
}

header("Location: carrinho.php");
exit;
?>
