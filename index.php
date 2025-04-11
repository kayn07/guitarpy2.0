<?php
    require_once 'banco.php';
    $id_cat = $_GET ['cat'] ?? null; 
    if ($id_cat) {
        $produtos = listarProdutosIndexCategoria($id_cat);
    } else {
    $produtos = listarProdutosIndex();
    }
    $categorias = listarCategorias();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Guitarpy</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="shortcut icon" type="logo" href="logo.png"> <!--icone no canto da tela-->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    
    
    <!--Navigator-->
    <?php require_once 'nav.php'; ?>
    
    <!--Banner-->
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/banner/1.png" class="d-block w-100" alt="Banner 1">
            </div>
            <div class="carousel-item">
                <img src="img/banner/2.png" class="d-block w-100" alt="Banner 2">
            </div>
            <div class="carousel-item">
                <img src="img/banner/3.png" class="d-block w-100" alt="Banner 2">
            </div>
            <div class="carousel-item">
                <img src="img/banner/4.png" class="d-block w-100" alt="Banner 2">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Próximo</span>
        </button>
    </div>

    <div class="container my-3">
        <div class="content">            

        <div class="col-12 mb-4">
            <?php foreach ($categorias as $categoria): ?>
                <a href="index.php?cat=<?= $categoria['id']; ?>" class="btn btn-primary"><?= $categoria['nome']; ?></a>
                <?php endforeach; ?>
        </div>

            <!-- Cards de Produtos -->
            <div class="row">
            
            <?php foreach ($produtos as $produto): ?>
                <div class="col-md-4 mb-4">
    <div class="card h-100 d-flex flex-column">
        <img src="<?= $produto['imagem_link']; ?>" class="card-img-top img-fluid" style="height: 200px; object-fit: cover;" alt="Produto">
        <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?= $produto['produto_nome']; ?></h5>
            <?php $descricao_curta = substr($produto['produto_descricao'], 0, 100); ?>
            <p class="card-text short-text">Descrição: <?= $descricao_curta; ?>...</p>
            <p class="card-text full-text d-none">Descrição: <?= $produto['produto_descricao']; ?></p>
            <p class="card-text">Preço: <?= $produto['produto_preco']; ?></p>
            <p class="card-text">Categoria: <?= $produto['categoria_nome']; ?></p>
            <div class="mt-auto">
                <?php if (strlen($produto['produto_descricao']) > 100): ?>
                    <button class="btn btn-link p-0 read-more">Ler Mais</button>
                <?php endif; ?>
                <a href="detalhes.php?id=<?= $produto['produto_id']; ?>" class="btn btn-primary w-100 mt-2">Comprar</a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".read-more").forEach(button => {
            button.addEventListener("click", function() {
                let card = this.closest(".card-body");
                card.querySelector(".short-text").classList.toggle("d-none");
                card.querySelector(".full-text").classList.toggle("d-none");
                this.textContent = this.textContent === "Ler Mais" ? "Ler Menos" : "Ler Mais";
            });
        });
    });
</script>
            <?php endforeach; ?>

            </div>
            
        </div>
    </div>

    <!-- Footer -->
    <?php include_once "footer.php"; ?>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>