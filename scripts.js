// scripts.js

let carrinho = []; // Array para armazenar os itens do carrinho

// Função para adicionar um item ao carrinho
function adicionarAoCarrinho(nomeDoItem, preco) {
    carrinho.push({ nome: nomeDoItem, preco: preco });
    atualizarCarrinho();
}

// Função para atualizar a contagem de itens no botão de carrinho
function atualizarCarrinho() {
    const botaoCarrinho = document.querySelector(".botao-carrinho");
    botaoCarrinho.innerHTML = `🛒 Carrinho (${carrinho.length})`;
}

// Função para abrir o carrinho e mostrar os itens
function abrirCarrinho() {
    let itens = "Itens no Carrinho:\n";
    carrinho.forEach(item => {
        itens += `${item.nome} - R$${item.preco}\n`;
    });
    if (carrinho.length === 0) {
        itens = "O carrinho está vazio!";
    }
    alert(itens);
}
