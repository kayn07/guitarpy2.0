-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14/04/2025 às 19:05
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lojaindustrial`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_categorias`
--

CREATE TABLE `tb_categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_categorias`
--

INSERT INTO `tb_categorias` (`id`, `nome`, `descricao`) VALUES
(30, 'Guitarras Elétricas', 'Guitarras Elétricas'),
(31, 'Guitarras Acústicas', 'Guitarras Acústicas'),
(32, 'Guitarras Semi-Acústicas', 'Guitarras Semi-Acústicas');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_imagens`
--

CREATE TABLE `tb_imagens` (
  `id` int(11) NOT NULL,
  `link` text NOT NULL,
  `id_produto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_imagens`
--

INSERT INTO `tb_imagens` (`id`, `link`, `id_produto`) VALUES
(1, 'https://cdn.awsli.com.br/2500x2500/2609/2609787/produto/297582750/1-ej4a9scpcl.jpg', 1),
(3, 'https://images.all-free-download.com/images/graphiclarge/gibson_les_paul_26560.jpg', 3),
(4, 'https://images.tcdn.com.br/img/img_prod/1089272/guitarra_sx_strato_sst62_vintage_vermelho_375_1_1b5dcc427f795f314863dfeefcfdf20a.jpg', 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_produtos`
--

CREATE TABLE `tb_produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `descricao` text NOT NULL,
  `preco` float NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_produtos`
--

INSERT INTO `tb_produtos` (`id`, `nome`, `descricao`, `preco`, `id_categoria`) VALUES
(1, 'Fender Stratocaster', 'Muito popular no rock, blues e até pop, é uma guitarra versátil, conhecida pelo seu timbre brilhante e sustain', 1800, 30),
(3, 'Gibson Les Paul', '', 2000, 30),
(4, 'SX SST', 'GUITARRA SX STRATO SST62 VINTAGE VERMELHO Modelo: SX SST Série: SX SST62 + estilo ST Tradicional Vintage Plus Cordas: Aço Braço: Maple canadense com reforço em Rosewood Tensor: 2 vias Escala: Rosewood Corpo: Basswood Trastes: 21 Tarraxas: Die-Cast Cromadas Ferragens: Cromadas Ponte: Ponte standard tremolo Escala: 648 mm (25.5″) Largura do nut: 42 mm (1.65″) Escudo: Escudo Clássico Vintage (Mint) Marcação: Dot Perolóide (Bolinha) Captadores: Configuração S-S-S, 3 Captadores simples', 1.65, 30);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_categorias`
--
ALTER TABLE `tb_categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_imagens`
--
ALTER TABLE `tb_imagens`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_categorias`
--
ALTER TABLE `tb_categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de tabela `tb_imagens`
--
ALTER TABLE `tb_imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
