<?php
require_once 'banco.php';

$categorias = listarCategorias();
echo "</pre>"; //nao tirar pq a categorias vai parar de listar


// Verifique se o ID do produto foi passado na URL
if (isset($_GET['id'])) {
    $id_produto = $_GET['id'];

    // Obtenha os dados do produto
    $mysqli = conectar();
    $sql = "SELECT p.id, p.nome, p.descricao, p.preco, p.id_categoria, c.nome AS categoria_nome 
            FROM tb_produtos p
            JOIN tb_categorias c ON p.id_categoria = c.id
            WHERE p.id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id_produto);
    $stmt->execute();
    $result = $stmt->get_result();
    $produto = $result->fetch_assoc();
    $stmt->close();
    $mysqli->close();

    // Caso o produto não seja encontrado
    if (!$produto) {
        echo "Produto não encontrado!";
        exit;
    }
} else {
    echo "ID não especificado!";
    exit;
}

// Verifique se o formulário foi submetido para atualizar o produto
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['txt_nome'];
    $descricao = $_POST['txt_descricao'];
    $preco = $_POST['txt_preco'];
    $categoria = $_POST['txt_categoria'];

    // Atualize o produto no banco de dados
    $mysqli = conectar();
    $sql = "UPDATE tb_produtos SET nome = ?, descricao = ?, preco = ?, id_categoria = ? WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssdii", $nome, $descricao, $preco, $categoria, $id_produto);
    $stmt->execute();
    $stmt->close();
    $mysqli->close();

    // Redirecionar após o sucesso
    header("Location: adm_prod.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="logo" href="logo.png"> <!--icone no canto da tela-->
</head>
<body>

    <!-- Navegação -->
    <?php require_once 'nav.php'; ?>

    <div class="container my-4">
        <h3>Editar Produto</h3>

        <!-- Formulário para editar o produto -->
        <form method="POST">
            <div class="form-group">
                <label>Nome: </label>
                <input type="text" name="txt_nome" class="form-control" value="<?= htmlspecialchars($produto['nome']) ?>" required>
            </div>
            <div class="form-group">
                <label>Descrição: </label>
                <input type="text" name="txt_descricao" class="form-control" value="<?= htmlspecialchars($produto['descricao']) ?>" required>
            </div>
            <div class="form-group">
                <label>Preço: </label>
                <input type="number" name="txt_preco" class="form-control" value="<?= htmlspecialchars($produto['preco']) ?>" required>
            </div>
            <div class="form-group">
                <label>Categoria: </label>
                <select name="txt_categoria" class="form-control" required>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= $categoria['id']; ?>" <?= $categoria['id'] == $produto['id_categoria'] ? 'selected' : ''; ?>>
                            <?= $categoria['nome']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <input type="submit" value="Atualizar Produto" class="btn btn-primary mt-2">
        </form>
    </div>

    <!-- Rodapé -->
    <?php include_once "footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
