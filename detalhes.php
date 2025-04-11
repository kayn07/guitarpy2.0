<?php
    require_once 'banco.php';
    $id=$_GET['id'];
    if(isset($id)){
        $produtos = ListarProdutosDetalhes($id);
    } else {
        header('Location: index.php');        
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Guitarpy</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    
    <!--Navigator-->
    <?php require_once 'nav.php'; ?>
    
    <div class="container my-3">
        <div class="content">            

        <div class="row align-items-stretch">
            <?php foreach ($produtos as $produto): ?>
                <div class="col-6" style="display: flex;">
                    <img src="<?= $produto['imagem_link'] ?>" class="w-100 rounded-3" alt="Imagem do produto">
                </div>
                <div class="card shadow col-6 d-flex flex-column justify-content-center">
                    <h3>Nome: <?= $produto['produto_nome'] ?></h3>
                    <p>Categoria: <?= $produto['categoria_nome'] ?></p>
                    <h3>Preço: <?= number_format($produto['produto_preco'], 2, ',', '.') ?></h3>
                    <?php $descricao_curta = substr($produto['produto_descricao'], 0, 100); ?>
                    <p class="card-text short-text">Descrição: <?= $descricao_curta; ?>...</p>
                    <p class="card-text full-text d-none">Descrição: <?= nl2br(htmlspecialchars($produto['produto_descricao'])) ?></p>
                    <?php if (strlen($produto['produto_descricao']) > 100): ?>
                        <button class="btn btn-link p-0 read-more">Ler Mais</button>
                    <?php endif; ?>
                    <a href="comprar.php?id=<?= $produto['produto_id']; ?>" class="btn btn-primary w-100 mt-2">
                        <i class="fas fa-shopping-cart"></i> Comprar
                    </a>
                    <br>
                    <a href="index.php?id=<?= $produto['produto_id']; ?>" class="btn btn-primary w-100">
                        <i class="fas fa-arrow-left"></i> Voltar
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        
        </div>
    </div>

    <!-- Footer -->
    <?php include_once "footer.php"; ?>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".read-more").forEach(button => {
                button.addEventListener("click", function() {
                    let card = this.closest(".card-body");
                    let shortText = card.querySelector(".short-text");
                    let fullText = card.querySelector(".full-text");
                    
                    shortText.classList.toggle("d-none");
                    fullText.classList.toggle("d-none");
                    
                    this.textContent = this.textContent === "Ler Mais" ? "Ler Menos" : "Ler Mais";
                });
            });
        });
    </script>
</body>
</html>