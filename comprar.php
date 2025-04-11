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
            <!-- Formulário de pagamento via PayPal -->
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="sua_conta_paypal@example.com">
    <input type="hidden" name="item_name" value="Produto Exemplo">
    <input type="hidden" name="amount" value="100.00"> <!-- Valor do produto -->
    <input type="hidden" name="currency_code" value="BRL"> <!-- Moeda: Real Brasileiro -->
    <input type="hidden" name="return" value="http://seusite.com/pagamento_sucesso.php">
    <input type="hidden" name="cancel_return" value="http://seusite.com/pagamento_cancelado.php">
    
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-credit-card"></i> Pagar com PayPal
    </button>
</form>



        </div>

            
        </div>
    </div>

    <!-- Footer -->
    <?php include_once "footer.php"; ?>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>