-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/04/2026 às 00:59
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: adocao_pets_db
--

-- --------------------------------------------------------

--
-- Estrutura para tabela cao
--

CREATE TABLE cao (
  id int(11) NOT NULL,
  nome varchar(100) NOT NULL,
  sexo enum('Macho','Femea') DEFAULT NULL,
  raca enum('Vira-lata','Labrador','Golden Retriever','Pastor Alemao','Bulldog','Poodle') DEFAULT NULL,
  porte enum('Pequeno','Médio','Grande') DEFAULT NULL,
  idade varchar(50) DEFAULT NULL,
  cidade enum('Criciuma SC','Urussanga SC','Cocal SC') DEFAULT NULL,
  castrado enum('Sim','Não') DEFAULT NULL,
  foto varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela denuncia
--

CREATE TABLE denuncia (
  id_denuncia int(11) NOT NULL,
  tipo_denuncia enum('Maus-tratos','Abandono','Negligencia','Outros') NOT NULL,
  endereco varchar(255) NOT NULL,
  descricao text NOT NULL,
  foto varchar(255) DEFAULT NULL,
  anonimo tinyint(1) NOT NULL DEFAULT 1,
  data_denuncia timestamp NOT NULL DEFAULT current_timestamp(),
  estado enum('Aguardando','Pendente','Concluida') NOT NULL DEFAULT 'Aguardando'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela perdipet
--

CREATE TABLE perdipet (
  id int(11) NOT NULL,
  nome_pet varchar(100) DEFAULT NULL,
  local_perdido varchar(255) DEFAULT NULL,
  data_perdido date DEFAULT NULL,
  telefone varchar(20) DEFAULT NULL,
  descricao text DEFAULT NULL,
  foto varchar(255) DEFAULT NULL,
  data_registro timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela usuario
--

CREATE TABLE usuario (
  id int(11) NOT NULL,
  nome varchar(100) NOT NULL,
  email varchar(150) NOT NULL,
  senha varchar(255) NOT NULL,
  cidade varchar(100) NOT NULL,
  data_criacao timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela usuario
--

INSERT INTO usuario (id, nome, email, senha, cidade, data_criacao) VALUES
(1, 'Rikelmme JR', 'rikelmme.15@gmail.com', '$2y$10$QL3KACDF3BBjta4nnb4ck.pvUFo7qYVGgTALMEmnMYX749tiIltgm', 'urussanga', '2026-04-03 23:12:25'),
(6, 'Junior Tavares', 'tuister@gmail.com', '$2y$10$IWAfZOwPKtHd6369XaIPTOGkKEGbi/2FU0w8e5/dnr/1kYN0l0gnO', 'Bahia', '2026-04-07 00:19:59'),
(14, 'Pedro Henrique', 'pedrohenrique.cedup@gmail.com', '$2y$10$C3l5Cj1wnJi1uJ7/ozsojuCp85mVj.Oyb5Bsa/6dX.NJXM6idin4a', 'Criciuma', '2026-04-08 22:36:39');

-- --------------------------------------------------------

--
-- Estrutura para tabela usuario_ong
--

CREATE TABLE usuario_ong (
  id int(11) NOT NULL,
  Nome varchar(100) NOT NULL,
  email varchar(150) NOT NULL,
  telefone varchar(20) DEFAULT NULL,
  cidade varchar(100) DEFAULT NULL,
  senha varchar(255) NOT NULL,
  data_criacao timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela usuario_ong
--

INSERT INTO usuario_ong (id, Nome, email, telefone, cidade, senha, data_criacao) VALUES
(2, 'AMAR ANIMAIS ', 'amaranimais@hotmail.com', '48999597354', 'santa luzia ', '$2y$10$X3x2WExn8/Uyj/8xNgGD2eKmJO8UESKjm/joZFRrdwUajupx08Zj2', '2026-04-08 00:20:44');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela cao
--
ALTER TABLE cao
  ADD PRIMARY KEY (id);

--
-- Índices de tabela denuncia
--
ALTER TABLE denuncia
  ADD PRIMARY KEY (id_denuncia);

--
-- Índices de tabela perdipet
--
ALTER TABLE perdipet
  ADD PRIMARY KEY (id);

--
-- Índices de tabela usuario
--
ALTER TABLE usuario
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY email (email);

--
-- Índices de tabela usuario_ong
--
ALTER TABLE usuario_ong
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY email (email);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela cao
--
ALTER TABLE cao
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela denuncia
--
ALTER TABLE denuncia
  MODIFY id_denuncia int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela perdipet
--
ALTER TABLE perdipet
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela usuario
--
ALTER TABLE usuario
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela usuario_ong
--
ALTER TABLE usuario_ong
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;