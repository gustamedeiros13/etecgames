-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Tempo de geração: 26-Out-2021 às 02:49
-- Versão do servidor: 10.4.18-MariaDB
-- versão do PHP: 7.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `etecgames`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoriasjogos_tb`
--

CREATE TABLE `categoriasjogos_tb` (
  `codcatjogo` int(4) NOT NULL,
  `nomeCatjogo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente_tb`
--

CREATE TABLE `cliente_tb` (
  `CpfCli` int(11) NOT NULL,
  `codusu_FK` int(4) NOT NULL,
  `nomeCli` varchar(100) NOT NULL,
  `foneCli` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor_tb`
--

CREATE TABLE `fornecedor_tb` (
  `codForn` int(4) NOT NULL,
  `nomeForn` varchar(100) NOT NULL,
  `emailForn` varchar(100) NOT NULL,
  `foneForn` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `fornecedor_tb`
--

INSERT INTO `fornecedor_tb` (`codForn`, `nomeForn`, `emailForn`, `foneForn`) VALUES
(13, ' Etec Rodrigo', 'rodrigo@rodrigo.com', '3333-3333');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario_tb`
--

CREATE TABLE `funcionario_tb` (
  `codFun` int(4) NOT NULL,
  `codusu_FK` int(4) NOT NULL,
  `nomeFun` varchar(100) NOT NULL,
  `foneFun` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `funcionario_tb`
--

INSERT INTO `funcionario_tb` (`codFun`, `codusu_FK`, `nomeFun`, `foneFun`) VALUES
(1, 7, 'Rodrigo Tarcis', 123456),
(2, 9, 'Alicia Lopes', 24844677);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogos_tb`
--

CREATE TABLE `jogos_tb` (
  `codJogo` int(4) NOT NULL,
  `nomeJogo` varchar(100) NOT NULL,
  `codcatjogo_Fk` int(4) NOT NULL,
  `codFonecedor_FK` int(4) NOT NULL,
  `valorJogo` float NOT NULL,
  `classificacaoJogo` int(2) NOT NULL,
  `avaliacaoJogo` int(1) NOT NULL,
  `dataLancamentoJogo` date NOT NULL,
  `imgJogo1` varchar(250) NOT NULL,
  `imgJogo2` varchar(250) NOT NULL,
  `imgJogo3` varchar(250) NOT NULL,
  `tamanhoJogo` int(11) NOT NULL,
  `descricaoJogo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_tb`
--

CREATE TABLE `usuario_tb` (
  `codusu` int(4) NOT NULL,
  `emailUsu` varchar(100) NOT NULL,
  `SenhaUsu` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario_tb`
--

INSERT INTO `usuario_tb` (`codusu`, `emailUsu`, `SenhaUsu`) VALUES
(4, 'gustavoh@etec.com.br', '$2y$08$MGANi195rtXdwTpwbcnSYegYjBEeg3obc99cBKe1LWY0lr9bHdQO6'),
(5, 'silvioflorentino@etec.com', '$2y$08$/U3vLT5Qi0ieGox4D9jXz.85f8lEZfVIlZo8.IcRtgIjXAALBg1pe'),
(7, 'rodrigotarcis123@etec.com.br', '$2y$08$h7NK2Yb4K93OjRUEHlCk9.0BLcLfH3QrttC3.TH.AX.4BgYzG/N.6'),
(8, 'gustavo@etec.com.br', '$2y$08$h3VX30wisBoX9N39OurATO9.StJ9z8D2paGEb3X/UUGD6Ibrfvxfi'),
(9, 'alicia@yahoo.com.br', '$2y$08$aabeEcP677BJk89PHF/TK.DEZw8HyAMrlTaTDMjK3D3g4xvI7Jd7C');

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda_tb`
--

CREATE TABLE `venda_tb` (
  `codVenda` int(4) NOT NULL,
  `codjogo_FK` int(4) NOT NULL,
  `codFun_FK` int(4) NOT NULL,
  `CpfCli_FK` int(11) NOT NULL,
  `qtdVenda` int(3) NOT NULL,
  `dataVenda` int(11) NOT NULL,
  `vlVenda` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categoriasjogos_tb`
--
ALTER TABLE `categoriasjogos_tb`
  ADD PRIMARY KEY (`codcatjogo`);

--
-- Índices para tabela `cliente_tb`
--
ALTER TABLE `cliente_tb`
  ADD PRIMARY KEY (`CpfCli`),
  ADD KEY `FK_ClienteUsuario` (`codusu_FK`);

--
-- Índices para tabela `fornecedor_tb`
--
ALTER TABLE `fornecedor_tb`
  ADD PRIMARY KEY (`codForn`);

--
-- Índices para tabela `funcionario_tb`
--
ALTER TABLE `funcionario_tb`
  ADD PRIMARY KEY (`codFun`),
  ADD KEY `FK_FuncionarioUsuario` (`codusu_FK`);

--
-- Índices para tabela `jogos_tb`
--
ALTER TABLE `jogos_tb`
  ADD PRIMARY KEY (`codJogo`),
  ADD KEY `FK_Categoria_Jogo` (`codcatjogo_Fk`),
  ADD KEY `FK_CodigoFornecedor` (`codFonecedor_FK`);

--
-- Índices para tabela `usuario_tb`
--
ALTER TABLE `usuario_tb`
  ADD PRIMARY KEY (`codusu`);

--
-- Índices para tabela `venda_tb`
--
ALTER TABLE `venda_tb`
  ADD PRIMARY KEY (`codVenda`),
  ADD KEY `FK_CodigoFuncionario` (`codFun_FK`),
  ADD KEY `FK_CodigoJogo` (`codjogo_FK`),
  ADD KEY `FK_CodigoClienteCPF` (`CpfCli_FK`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoriasjogos_tb`
--
ALTER TABLE `categoriasjogos_tb`
  MODIFY `codcatjogo` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `fornecedor_tb`
--
ALTER TABLE `fornecedor_tb`
  MODIFY `codForn` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `funcionario_tb`
--
ALTER TABLE `funcionario_tb`
  MODIFY `codFun` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `jogos_tb`
--
ALTER TABLE `jogos_tb`
  MODIFY `codJogo` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario_tb`
--
ALTER TABLE `usuario_tb`
  MODIFY `codusu` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `venda_tb`
--
ALTER TABLE `venda_tb`
  MODIFY `codVenda` int(4) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `cliente_tb`
--
ALTER TABLE `cliente_tb`
  ADD CONSTRAINT `FK_ClienteUsuario` FOREIGN KEY (`codusu_FK`) REFERENCES `usuario_tb` (`codusu`);

--
-- Limitadores para a tabela `funcionario_tb`
--
ALTER TABLE `funcionario_tb`
  ADD CONSTRAINT `FK_FuncionarioUsuario` FOREIGN KEY (`codusu_FK`) REFERENCES `usuario_tb` (`codusu`);

--
-- Limitadores para a tabela `jogos_tb`
--
ALTER TABLE `jogos_tb`
  ADD CONSTRAINT `FK_Categoria_Jogo` FOREIGN KEY (`codcatjogo_Fk`) REFERENCES `categoriasjogos_tb` (`codcatjogo`),
  ADD CONSTRAINT `FK_CodigoFornecedor` FOREIGN KEY (`codFonecedor_FK`) REFERENCES `fornecedor_tb` (`codForn`);

--
-- Limitadores para a tabela `venda_tb`
--
ALTER TABLE `venda_tb`
  ADD CONSTRAINT `FK_CodigoClienteCPF` FOREIGN KEY (`CpfCli_FK`) REFERENCES `cliente_tb` (`CpfCli`),
  ADD CONSTRAINT `FK_CodigoFuncionario` FOREIGN KEY (`codFun_FK`) REFERENCES `funcionario_tb` (`codFun`),
  ADD CONSTRAINT `FK_CodigoJogo` FOREIGN KEY (`codjogo_FK`) REFERENCES `jogos_tb` (`codJogo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
