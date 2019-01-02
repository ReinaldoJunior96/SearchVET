-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 02-Jan-2019 às 03:28
-- Versão do servidor: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vetmaps`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `autorizado`
--

CREATE TABLE `autorizado` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Cpf_Cnpj` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Data_Cancelamento` date NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `autorizado`
--

INSERT INTO `autorizado` (`ID`, `Nome`, `Cpf_Cnpj`, `Email`, `Data`, `Data_Cancelamento`, `Status`) VALUES
(1, 'Terra Zoo', '29248658789', 'reinaldojunior272@gmail.com', '2018-12-12 03:00:00', '0000-00-00', 'teste'),
(2, 'Corre berg', '85848484848', 'reinaldo_sz96@hotmail.com', '2018-12-13 18:17:06', '0000-00-00', 'teste'),
(3, 'ggggg', '2342342342', 'gg@gmail.com', '2018-12-13 20:33:39', '0000-00-00', 'teste'),
(4, 'jujuba pet', '25814963', 'asdasda@gmail.com', '2018-12-13 21:49:35', '0000-00-00', 'teste'),
(5, 'testeboot', '23443223443', 'bootstrap@gmail.com', '2018-12-19 00:31:59', '0000-00-00', 'teste'),
(6, 'jujubapet', '25478548598', 'reinaldo@gmail.com', '2018-12-20 23:42:30', '0000-00-00', 'teste'),
(7, 'cornopet', '45678912352', 'corno@gmail.com', '2018-12-20 23:45:13', '0000-00-00', 'teste'),
(13, 'asdasda', '123456789756', 'asdadaa@gmail.com', '2018-12-26 02:42:21', '2018-12-20', 'teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clinicas`
--

CREATE TABLE `clinicas` (
  `ID` int(11) NOT NULL,
  `Identificacao` varchar(30) DEFAULT NULL,
  `Senha` varchar(30) DEFAULT NULL,
  `Nome` varchar(100) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Contato` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clinicas`
--

INSERT INTO `clinicas` (`ID`, `Identificacao`, `Senha`, `Nome`, `Email`, `Contato`) VALUES
(1, '29248658789', '123', 'Terra Zoo', 'reinaldojunior272@gmail.com', '989858485'),
(2, '85848484848', '123', 'Corre berg', 'reinaldo_sz96@hotmail.com', '65446456546'),
(3, '2342342342', '123', NULL, 'gg@gmail.com', NULL),
(4, '25814963', '123', NULL, 'asdasda@gmail.com', NULL),
(5, '23443223443', '123', NULL, 'bootstrap@gmail.com', NULL),
(6, '25478548598', '123', NULL, 'reinaldo@gmail.com', NULL),
(7, '45678912352', '123', NULL, 'corno@gmail.com', NULL),
(8, '45678945678', '123', NULL, 'datates@gmail.com', NULL),
(9, '12345678945', '123', NULL, 'testedata@gmail.com', NULL),
(10, '4565464565', '123', NULL, 'asdas@gmail.com', NULL),
(11, '45612345678', '123', NULL, 'adsadada@gmail.com', NULL),
(12, '12312313131', '123', NULL, 'asdasd@gmail.com', NULL),
(13, '1233212332', '123', NULL, 'asdas@gmail.com', NULL),
(14, '123456789756', '123', NULL, 'asdadaa@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE `comentario` (
  `id` int(11) NOT NULL,
  `Identificacao` varchar(255) DEFAULT NULL,
  `Usuario` varchar(255) NOT NULL,
  `Comentario` text,
  `data_lancamento` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `enderecos`
--

CREATE TABLE `enderecos` (
  `ID` int(11) NOT NULL,
  `Identificacao` varchar(30) NOT NULL,
  `CEP` varchar(8) DEFAULT NULL,
  `Rua` varchar(100) DEFAULT NULL,
  `Bairro` varchar(20) DEFAULT NULL,
  `Cidade` varchar(50) DEFAULT NULL,
  `Mapa` varchar(255) NOT NULL,
  `Complemento` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `enderecos`
--

INSERT INTO `enderecos` (`ID`, `Identificacao`, `CEP`, `Rua`, `Bairro`, `Cidade`, `Mapa`, `Complemento`) VALUES
(1, '29248658789', '65060641', 'Avenital tal', 'Angelim', 'São Luis', 'https://goo.gl/maps/3MnUzMJP4UN2', 'perta do pqp'),
(2, '85848484848', '65065730', 'Rua Seis', 'Solar dos Lusitanos', 'São Luís', '', 'Rua de terra'),
(3, '2342342342', NULL, NULL, NULL, NULL, '', NULL),
(4, '25814963', NULL, NULL, NULL, NULL, '', NULL),
(5, '23443223443', NULL, NULL, NULL, NULL, '', NULL),
(6, '25478548598', NULL, NULL, NULL, NULL, '', NULL),
(7, '45678912352', NULL, NULL, NULL, NULL, '', NULL),
(8, '45678945678', NULL, NULL, NULL, NULL, '', NULL),
(9, '12345678945', NULL, NULL, NULL, NULL, '', NULL),
(10, '4565464565', NULL, NULL, NULL, NULL, '', NULL),
(11, '45612345678', NULL, NULL, NULL, NULL, '', NULL),
(12, '12312313131', NULL, NULL, NULL, NULL, '', NULL),
(13, '1233212332', NULL, NULL, NULL, NULL, '', NULL),
(14, '123456789756', NULL, NULL, NULL, NULL, '', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `especialidade`
--

CREATE TABLE `especialidade` (
  `ID` int(11) NOT NULL,
  `Identificacao` varchar(255) NOT NULL,
  `Especialidade` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `especialidade`
--

INSERT INTO `especialidade` (`ID`, `Identificacao`, `Especialidade`) VALUES
(87, '29248658789', 'Dermatologia'),
(88, '29248658789', 'Nefrologia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `informacoes`
--

CREATE TABLE `informacoes` (
  `ID` int(11) NOT NULL,
  `Identificacao` varchar(255) NOT NULL,
  `Funcionamento` varchar(30) DEFAULT NULL,
  `Servico_Movel` varchar(10) DEFAULT NULL,
  `Movel_explica` text,
  `Atendimento_A` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `informacoes`
--

INSERT INTO `informacoes` (`ID`, `Identificacao`, `Funcionamento`, `Servico_Movel`, `Movel_explica`, `Atendimento_A`) VALUES
(1, '29248658789', '24Horas', 'Sim', 'Vishe criança', 'Sim'),
(2, '85848484848', 'Selecione', 'Sim', 'assssssssssssss', 'Sim'),
(3, '2342342342', NULL, NULL, NULL, NULL),
(4, '25814963', NULL, NULL, NULL, NULL),
(5, '23443223443', NULL, NULL, NULL, NULL),
(6, '25478548598', NULL, NULL, NULL, NULL),
(7, '45678912352', NULL, NULL, NULL, NULL),
(8, '45678945678', NULL, NULL, NULL, NULL),
(9, '12345678945', NULL, NULL, NULL, NULL),
(10, '4565464565', NULL, NULL, NULL, NULL),
(11, '45612345678', NULL, NULL, NULL, NULL),
(12, '12312313131', NULL, NULL, NULL, NULL),
(13, '1233212332', NULL, NULL, NULL, NULL),
(14, '123456789756', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `logos`
--

CREATE TABLE `logos` (
  `ID` int(11) NOT NULL,
  `Identificacao` varchar(30) NOT NULL,
  `Foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `logos`
--

INSERT INTO `logos` (`ID`, `Identificacao`, `Foto`) VALUES
(1, '29248658789', '9444906e571420ad2af52e040d4b9e4f.jpg'),
(2, '85848484848', '56276a390b923122b39599c62b2f2048.jpg'),
(3, '2342342342', NULL),
(4, '25814963', NULL),
(5, '23443223443', NULL),
(6, '25478548598', NULL),
(7, '45678912352', NULL),
(8, '45678945678', NULL),
(9, '12345678945', NULL),
(10, '4565464565', NULL),
(11, '45612345678', NULL),
(12, '12312313131', NULL),
(13, '1233212332', NULL),
(14, '123456789756', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`ID`, `Nome`, `Email`, `Senha`) VALUES
(29, 'José Reinaldo Pereira Júnior', 'reinaldojunior272@gmail.com', '123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_adm`
--

CREATE TABLE `usuario_adm` (
  `ID` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autorizado`
--
ALTER TABLE `autorizado`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `clinicas`
--
ALTER TABLE `clinicas`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enderecos`
--
ALTER TABLE `enderecos`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `especialidade`
--
ALTER TABLE `especialidade`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `informacoes`
--
ALTER TABLE `informacoes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `logos`
--
ALTER TABLE `logos`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `usuario_adm`
--
ALTER TABLE `usuario_adm`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `autorizado`
--
ALTER TABLE `autorizado`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `clinicas`
--
ALTER TABLE `clinicas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enderecos`
--
ALTER TABLE `enderecos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `especialidade`
--
ALTER TABLE `especialidade`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `informacoes`
--
ALTER TABLE `informacoes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `logos`
--
ALTER TABLE `logos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `usuario_adm`
--
ALTER TABLE `usuario_adm`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
