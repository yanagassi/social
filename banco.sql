-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 09-Set-2017 às 18:25
-- Versão do servidor: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banco`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `perguntas`
--

CREATE TABLE `perguntas` (
  `id` int(11) NOT NULL,
  `pergunta` varchar(200) NOT NULL,
  `resposta` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `tiper` varchar(50) NOT NULL,
  `data` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `perguntas`
--

INSERT INTO `perguntas` (`id`, `pergunta`, `resposta`, `status`, `tiper`, `data`) VALUES
(4, 'sdadasdasda', 'a', 1, 'd0c41e848241d570f0d089263363033d', '2017-09-09 13:07'),
(5, 'sadasdasd', 'a', 1, 'f62989b0b15a298e78a599113172d014', '2017-09-09 13:07'),
(6, 'sadasd', 'saasas', 1, '81e5ba76151af92c0cd59cd9a8f60e1c', '2017-09-09 13:07'),
(7, 'asassa', '', 0, 'f19f6a8b257b5bde8975b380bb56112a', '2017-09-09 13:10'),
(11, 'asa', 'kkk\r\n', 1, '5340df581aa556a995c686a2700a74a5', '2017-09-09 13:22');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `senha` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `token` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `sobrenome` varchar(30) NOT NULL,
  `link` varchar(30) NOT NULL,
  `perguntas` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `senha`, `email`, `token`, `foto`, `sobrenome`, `link`, `perguntas`) VALUES
(1, 'admin', 'admin', 'admin', 'a0a76c75f46885bd538159e71d5c18bc', 'default.png', 'admin', 'admin', ''),
(2, 'admin2', 'admin2', 'admin2', '0c571927eb9a034321bef01a84560a4c', 'default.png', 'admin2', 'admin2', ';11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `perguntas`
--
ALTER TABLE `perguntas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `perguntas`
--
ALTER TABLE `perguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
