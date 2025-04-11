<?php
require_once 'banco.php';

// Verifique se o ID foi passado na URL
if (isset($_GET['id'])) {
    $id_categoria = $_GET['id'];

    // Obtenha os dados da categoria
    $mysqli = conectar();
    $sql = "SELECT id, nome, descricao FROM tb_categorias WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id_categoria);
    $stmt->execute();
    $result = $stmt->get_result();
    $categoria = $result->fetch_assoc();
    $stmt->close();
    $mysqli->close();

    // Caso a categoria não seja encontrada
    if (!$categoria) {
        echo "Categoria não encontrada!";
        exit;
    }
} else {
    echo "ID não especificado!";
    exit;
}

// Verifique se o formulário foi submetido para atualizar a categoria
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['txt_nome'];
    $descricao = $_POST['txt_descricao'];

    // Atualize a categoria no banco de dados
    $mysqli = conectar();
    $sql = "UPDATE tb_categorias SET nome = ?, descricao = ? WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssi", $nome, $descricao, $id_categoria);
    $stmt->execute();
    $stmt->close();
    $mysqli->close();

    // Redirecionar após o sucesso
    header("Location: adm_cat.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Categoria</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="shortcut icon" type="logo" href="logo.png"> <!--icone no canto da tela-->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

    <!--Navigator-->
    <?php require_once 'nav.php'; ?>

    <div class="container my-3">
        <div class="content">
            <h3>Editar Categoria</h3>

            <form method="POST">
                <div class="form-group">
                    <label>Nome: </label>
                    <input type="text" name="txt_nome" class="form-control" value="<?= htmlspecialchars($categoria['nome']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Descrição: </label>
                    <input type="text" name="txt_descricao" class="form-control" value="<?= htmlspecialchars($categoria['descricao']) ?>" required>
                </div>
                <input type="submit" value="Atualizar Categoria" class="btn btn-primary mt-2">
            </form>

        </div>
    </div>

    <!-- Footer -->
    <?php include_once "footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
