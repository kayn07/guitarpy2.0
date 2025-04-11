<?php
require_once 'banco.php';

// Verificar se o ID da imagem foi fornecido
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: adm_img.php");
    exit();
}

$id_imagem = $_GET['id'];

// Recuperar os dados da imagem e produtos
$imagem = listarImagemPorId($id_imagem); // Função para listar a imagem pelo ID
$produtos = listarProdutos(); // Lista de todos os produtos

// Verificar se a imagem foi encontrada
if (!$imagem) {
    echo "Imagem não encontrada.";
    exit();
}

// Se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $novo_link = $_POST['txt_link'];
    $novo_produto = $_POST['txt_produto'];

    // Atualizar a imagem no banco de dados
    atualizarImagem($id_imagem, $novo_link, $novo_produto);

    // Redirecionar após a edição
    header("Location: adm_img.php");
    exit();
}

// Funções para listar a imagem por ID e atualizar a imagem
function listarImagemPorId($id) {
    $mysqli = conectar();
    $sql = "SELECT * FROM tb_imagens WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $imagem = $result->fetch_assoc();
    $mysqli->close();
    return $imagem;
}

function atualizarImagem($id, $link, $produto_id) {
    $mysqli = conectar();
    $sql = "UPDATE tb_imagens SET link = ?, id_produto = ? WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sii", $link, $produto_id, $id);
    $stmt->execute();
    $stmt->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Imagem</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="shortcut icon" type="logo" href="logo.png"> <!--icone no canto da tela-->
</head>
<body>

    <?php require_once 'nav.php'; ?>

    <div class="container my-3">
        <h3>Editar Imagem</h3>

        <form method="post" action="editar_img.php?id=<?php echo $imagem['imagem_id']; ?>">
            <div class="form-group">
                <label>Link da Imagem: </label>
                <input type="text" name="txt_link" class="form-control" value="<?php echo $imagem['link']; ?>" required>
            </div>
            <div class="form-group">
                <label>Produto: </label>
                <select name="txt_produto" class="form-control" required>
                    <?php foreach ($produtos as $produto): ?>
                        <option value="<?= $produto['produto_id']; ?>" <?php if ($produto['produto_id'] == $imagem['id_produto']) echo 'selected'; ?>>
                            <?= $produto['produto_nome']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <input type="submit" value="Salvar alterações" class="btn btn-primary mt-2">
        </form>
    </div>

    <!-- Footer -->
    <?php include_once "footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
