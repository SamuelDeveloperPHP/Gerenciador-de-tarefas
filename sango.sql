-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 01 fév. 2023 à 20:40
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sango`
--

-- --------------------------------------------------------

--
-- Structure de la table `demandas`
--

CREATE TABLE `demandas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `modulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prioridade` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `regra_negocio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `data_cadastro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `demandas`
--

INSERT INTO `demandas` (`id`, `titulo`, `modulo`, `data`, `prioridade`, `descricao`, `regra_negocio`, `foto`, `data_cadastro`) VALUES
(15, 'Manual7899', '2', '2022-04-06', 'Alta', 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', NULL, '2022-04-05 01:49:16'),
(16, 'Teste55', '1', '2022-04-05', '2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type sp', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'error impressao.pdf', '2022-04-05 12:02:21'),
(17, 'Procedimento teste', '2', '2022-04-05', '3', 'Procedimento teste', 'Procedimento teste', NULL, '2022-04-06 16:53:29'),
(18, 'Demanda hoje', '1', '2022-04-06', '2', 'Teste', 'teste', NULL, '2022-04-07 00:27:15'),
(19, 'Ajustar ComboBoxte', '2', '2022-04-07', '3', 'Conforme mencionado na reunião do dia 01/07/2021 no vídeo “Reunião Semanal_ Danilo, Leticia e Lobo (2021-07-01 at 11_17 GMT-7)”, trocar a palavra pesquisa por filtros (padronizar. Assim como na Pesquisa por DEP’s, retirar o ‘s, padronizar para FIltro por ', '&quot;Algumas DEPs estão com siglas incorretas na Pesquisa por DEPs.\r\nIncorretas: DEP, MGTCR, MGTRE, MGTNC_CAR, MGTF1_CAR, o correto seria: DED, MGTe_CR, MGTe_RE, MGTe_CO, MGTe_F1, respetiviamente&quot;', 'impressora_mola_solta.jpeg', '2022-04-07 14:08:30'),
(54, 'Ajustar ComboBox', '4', '2022-04-08', '1', 'fsdafasdfsdafdsa', 'fasdfasdfsdafsdfdsafsd', '', '2022-04-08 13:03:04'),
(55, 'Ajuste de Layout25', '4', '2022-04-08', '1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'IMPRESSORAIMG_5976.JPG', '2022-04-08 19:20:02'),
(56, 'Teste hoje new327', '1', '2022-04-14', '3', 'Teste hoje new', 'teste hhhhh', '', '2022-04-14 02:41:37'),
(57, 'Consulta de Avaliação Genética - Ficha do Animal', '4', '2022-04-20', '2', 'Conforme mencionado na reunião do dia 01/07/2021 no vídeo “Reunião Semanal_ Danilo, Leticia e Lobo (2021-07-01 at 11_17 GMT-7)”, na ficha PDF deve-se destacar (com tonalidade diferente) as DEPs que compõem o MGTe (MGTe do NELORE PO: DIPP, D3P, MP120, MP21', 'Teste', 'pasted image 0.png', '2022-04-20 16:16:46');

-- --------------------------------------------------------

--
-- Structure de la table `empresas`
--

CREATE TABLE `empresas` (
  `id_empresa` int(11) NOT NULL,
  `CNPJ` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `xNome` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `xFant` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `IE` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `dia_do_pagamento` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `CEP` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `xLgr` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nro` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `xCpl` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `xBairro` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `id_uf` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `id_municipio` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `fone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `empresas`
--

INSERT INTO `empresas` (`id_empresa`, `CNPJ`, `xNome`, `xFant`, `IE`, `dia_do_pagamento`, `CEP`, `xLgr`, `nro`, `xCpl`, `xBairro`, `id_uf`, `id_municipio`, `fone`, `email`, `senha`, `status`) VALUES
(1, '20.638.179/0001-14', 'RAZAO SOCIAL', 'FANTASIA', 'IEEEE', '10', '87015-280', 'Avenida Brasil', '', 'Cas', 'Zona 05', 'PR', 'Maringá', '31992944332', 'teste', '123', 'Ativo'),
(2, '20.638.179/0001-14', 'RAZAO SOCIAL', 'FANTASIA', 'IEEEE', '10', '87015-280', 'Avenida Brasil', '', 'Cas', 'Zona 05', 'PR', 'Maringá', '31992944332', 'teste25@gmail.com', '123', 'Ativo'),
(3, '45.242.914/0001-05', 'CEA', 'CEAA', 'EEEE', '15', '87015-280', 'Avenida Brasil', '', 'Empresa', 'Zona 05', 'PR', 'Maringá', '31992944332', 'teste22@gmail.com', '123', 'Ativo'),
(4, '20.638.179/0001-14', 'ASDADA', 'FFFFF', 'EEEEE', '11', '87015-280', 'Avenida Brasil', '11', 'Casa', 'Zona 05', 'PR', 'Maringá', '31992944332', 'teste@gmail.com', '123', 'Ativo'),
(5, '20.638.179/0001-14', 'ADASDADADAD', 'ADADAD', '1111', '11', '87015-280', 'Avenida Brasil', '', 'Casa', 'Zona 05', 'PR', 'Maringá', '11', '', 'teste', 'Ativo'),
(6, '20.638.179/0001-14', 'EMPRESAR', 'RRREE', 'IEEE', '10', '32685-090', 'Rua Dezoito de Maio', '356', 'Casa', 'Amazonas', 'MG', 'Betim', '33554488', 'teste@gmail.com', '123', 'Ativo'),
(7, '20.638.179/0001-14', 'EMPRESAR', 'RRREE', 'IEEE', '10', '32685-090', 'Rua Dezoito de Maio', '356', 'Casa', 'Amazonas', 'MG', 'Betim', '33554488', 'teste@gmail.com', '123', 'Ativo'),
(8, '20.638.179/0001-14', 'EMPRESAR', 'RRREE', 'IEEE', '10', '32685-090', 'Rua Dezoito de Maio', '356', 'Casa', 'Amazonas', 'MG', 'Betim', '33554488', 'teste@gmail.com', '123', 'Ativo'),
(9, '20.638.179/0001-14', 'EMPRESAR', 'RRREE', 'IEEE', '10', '32685-090', 'Rua Dezoito de Maio', '356', 'Casa', 'Amazonas', 'MG', 'Betim', '33554488', 'teste@gmail.com', '123', 'Ativo'),
(10, '20.638.179/0001-14', 'EMPRESAR', 'RRREE', 'IEEE', '10', '32685-090', 'Rua Dezoito de Maio', '356', 'Casa', 'Amazonas', 'MG', 'Betim', '33554488', 'teste@gmail.com', '123', 'Ativo'),
(11, '20.638.179/0001-14', 'EMPRESAR', 'RRREE', 'IEEE', '10', '32685-090', 'Rua Dezoito de Maio', '356', 'Casa', 'Amazonas', 'MG', 'Betim', '33554488', 'teste@gmail.com', '123', 'Ativo'),
(12, '20.638.179/0001-14', 'EMPRESAR', 'RRREE', 'IEEE', '10', '32685-090', 'Rua Dezoito de Maio', '356', 'Casa', 'Amazonas', 'MG', 'Betim', '33554488', 'teste@gmail.com', '123', 'Ativo'),
(13, '20.638.179/0001-14', 'RAZAO SOCIAL', '12313123131231231', 'IEEEE', '12', '32687-405', 'Rua Itaú', '', 'Casa', 'Renascer', 'MG', 'Betim', '31992944332', 'guilherme1231', '1231', 'Ativo');

-- --------------------------------------------------------

--
-- Structure de la table `historico`
--

CREATE TABLE `historico` (
  `id` int(11) NOT NULL,
  `demanda_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mensagem` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `data_comentario` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `historico`
--

INSERT INTO `historico` (`id`, `demanda_id`, `user_id`, `mensagem`, `data_comentario`) VALUES
(1, 15, 11, 'Teste de mensagem nas demandas este de mensagem nas demandas Teste de mensagem nas demandas\r\n\r\n', '2022-04-05 00:00:00'),
(3, 15, 11, 'Segundo teste histórico', '2022-04-05 00:00:00'),
(4, 15, 11, 'Segundo teste histórico', '2022-04-05 00:00:00'),
(5, 15, 11, 'Teste inserir histórico', '0000-00-00 00:00:00'),
(6, 15, 11, 'teste', '2022-04-06 00:06:37'),
(7, 16, 11, 'Teste demanda 16', '2022-04-06 00:46:27'),
(8, 17, 11, 'Teste histo', '2022-04-06 16:59:57'),
(18, 18, 11, '73', '2022-04-07 00:53:37'),
(19, 19, 11, 'Favor trocar a cor para azul!', '2022-04-07 14:09:20'),
(20, 54, 11, 'teste', '2022-04-08 13:03:30'),
(21, 55, 11, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '2022-04-08 19:20:57'),
(22, 57, 11, 'testevvvv', '2022-04-20 16:17:23'),
(23, 57, 11, 'teste 2', '2022-04-20 16:17:31'),
(24, 56, 11, 'Teste', '2022-05-12 14:44:48'),
(25, 57, 40, 'Teste', '2022-07-14 08:46:45');

-- --------------------------------------------------------

--
-- Structure de la table `modulos`
--

CREATE TABLE `modulos` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sistema_mod` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `modulos`
--

INSERT INTO `modulos` (`id`, `name`, `sistema_mod`) VALUES
(1, 'Cadastro de usuario', '2'),
(2, 'BACKUP', '2'),
(4, 'Consulta de Avaliação Genética', '2');

-- --------------------------------------------------------

--
-- Structure de la table `nivelacesso`
--

CREATE TABLE `nivelacesso` (
  `id` int(11) NOT NULL,
  `nivel_acesso` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `nivelacesso`
--

INSERT INTO `nivelacesso` (`id`, `nivel_acesso`) VALUES
(1, 'AdminDono'),
(2, 'User');

-- --------------------------------------------------------

--
-- Structure de la table `sistemas`
--

CREATE TABLE `sistemas` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `sistemas`
--

INSERT INTO `sistemas` (`id`, `name`) VALUES
(1, 'ANCP'),
(2, 'Supply Compliance'),
(3, 'Trello');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `tipo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nome_sistema` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `contato` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `nome` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `contato` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nome_sistema` int(11) NOT NULL,
  `senha` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `data_cadastro_tecnico` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `usuarios`
--

INSERT INTO `usuarios` (`id`, `tipo`, `nome`, `email`, `contato`, `nome_sistema`, `senha`, `foto`, `status`, `data_cadastro_tecnico`) VALUES
(1, 'AdminDono', 'Samuel Ferreira', 'samuel_demelo@hotmail.com', '41988885871', 1, 'master123', 'images/uploadsimagem3.jpg', 13, '2022-03-21 22:31:04'),
(2, 'User', 'Admin teste', 'teste@email.com', '5454565688', 2, 'teste123', NULL, 1, '2022-04-08 21:13:01');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `demandas`
--
ALTER TABLE `demandas`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Index pour la table `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `nivelacesso`
--
ALTER TABLE `nivelacesso`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sistemas`
--
ALTER TABLE `sistemas`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `demandas`
--
ALTER TABLE `demandas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT pour la table `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `historico`
--
ALTER TABLE `historico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `nivelacesso`
--
ALTER TABLE `nivelacesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `sistemas`
--
ALTER TABLE `sistemas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
