
Todos os arquivos nesta tarefa
Hoje

adocao_pets_db_revised.sql
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
-- Banco de dados: `adocao_pets_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `caes`
--

CREATE TABLE `caes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `sexo` ENUM('Macho','Femea') DEFAULT NULL,
  `raca` ENUM('Vira-lata','Labrador','Golden Retriever','Pastor Alemao','Bulldog','Poodle') DEFAULT NULL,
  `porte` ENUM('Pequeno','Médio','Grande') DEFAULT NULL,
  `idade` VARCHAR(50) DEFAULT NULL,
  `cidade` ENUM('Criciuma SC','Urussanga SC','Cocal SC') DEFAULT NULL,
  `castrado` BOOLEAN DEFAULT NULL,
  `foto` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `denuncias`
--

CREATE TABLE `denuncias` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo_denuncia` ENUM('Maus-tratos','Abandono','Negligencia','Outros') NOT NULL,
  `endereco` VARCHAR(255) NOT NULL,
  `descricao` TEXT NOT NULL,
  `foto` VARCHAR(255) DEFAULT NULL,
  `anonimo` BOOLEAN NOT NULL DEFAULT TRUE,
  `data_denuncia` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `estado` ENUM('Aguardando','Pendente','Concluida') NOT NULL DEFAULT 'Aguardando',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pets_perdidos`
--

CREATE TABLE `pets_perdidos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_pet` VARCHAR(100) DEFAULT NULL,
  `local_perdido` VARCHAR(255) DEFAULT NULL,
  `data_perdido` DATE DEFAULT NULL,
  `telefone` VARCHAR(20) DEFAULT NULL,
  `descricao` TEXT DEFAULT NULL,
  `foto` VARCHAR(255) DEFAULT NULL,
  `data_registro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL UNIQUE,
  `senha` VARCHAR(255) NOT NULL,
  `cidade` VARCHAR(100) NOT NULL,
  `data_criacao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Inserindo dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `cidade`, `data_criacao`) VALUES
(1, 'Rikelmme JR', 'rikelmme.15@gmail.com', '$2y$10$QL3KACDF3BBjta4nnb4ck.pvUFo7qYVGgTALMEmnMYX749tiIltgm', 'urussanga', '2026-04-03 23:12:25'),
(6, 'Junior Tavares', 'tuister@gmail.com', '$2y$10$IWAfZOwPKtHd6369XaIPTOGkKEGbi/2FU0w8e5/dnr/1kYN0l0gnO', 'Bahia', '2026-04-07 00:19:59'),
(14, 'Pedro Henrique', 'pedrohenrique.cedup@gmail.com', '$2y$10$C3l5Cj1wnJi1uJ7/ozsojuCp85mVj.Oyb5Bsa/6dX.NJXM6idin4a', 'Criciuma', '2026-04-08 22:36:39');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ongs`
--

CREATE TABLE `ongs` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL UNIQUE,
  `telefone` VARCHAR(20) DEFAULT NULL,
  `cidade` VARCHAR(100) DEFAULT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `data_criacao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Inserindo dados para a tabela `ongs`
--

INSERT INTO `ongs` (`id`, `nome`, `email`, `telefone`, `cidade`, `senha`, `data_criacao`) VALUES
(2, 'AMAR ANIMAIS ', 'amaranimais@hotmail.com', '48999597354', 'santa luzia ', '$2y$10$X3x2WExn8/Uyj/8xNgGD2eKmJO8UESKjm/joZFRrdwUajupx08Zj2', '2026-04-08 00:20:44');

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `caes`
--
ALTER TABLE `caes`
  MODIFY `id` INT UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `denuncias`
--
ALTER TABLE `denuncias`
  MODIFY `id` INT UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `pets_perdidos`
--
ALTER TABLE `pets_perdidos`
  MODIFY `id` INT UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` INT UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `ongs`
--
ALTER TABLE `ongs`
  MODIFY `id` INT UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;