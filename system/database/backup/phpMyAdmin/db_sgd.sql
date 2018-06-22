-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 15-Jun-2018 às 03:12
-- Versão do servidor: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sgd`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `atividade`
--

CREATE TABLE `atividade` (
  `idAtividade` int(11) NOT NULL,
  `nome_atividade` varchar(100) NOT NULL,
  `descricao_atividade` varchar(200) NOT NULL,
  `prazo_entrega` date NOT NULL,
  `idConjuntoAtividade` int(11) NOT NULL,
  `idProfessor` int(11) NOT NULL,
  `trofeu_ouro` int(11) DEFAULT '0',
  `trofeu_prata` int(11) DEFAULT '0',
  `trofeu_bronze` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='																																																																																																																																																																																								';

-- --------------------------------------------------------

--
-- Estrutura da tabela `conjunto_atividade`
--

CREATE TABLE `conjunto_atividade` (
  `idConjuntoAtividade` int(11) NOT NULL,
  `nome_conjunto` varchar(45) NOT NULL,
  `idProfessor` int(11) NOT NULL,
  `idDisciplina` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `idDisciplina` int(11) NOT NULL,
  `idProfessor` int(11) NOT NULL,
  `nome_disciplina` varchar(80) NOT NULL,
  `codigo_disciplina` varchar(20) NOT NULL,
  `descricao_disciplina` varchar(200) NOT NULL,
  `status_disciplina` int(11) NOT NULL DEFAULT '1' COMMENT 'O status da disciplina podera assumir os seguintes valores:\n1 => Em Planejamento\n2 => Disponivel\n3 => Finalizada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `participa_disciplina`
--

CREATE TABLE `participa_disciplina` (
  `idAluno` int(11) NOT NULL,
  `idDisciplina` int(11) NOT NULL,
  `status_participacao` int(11) NOT NULL COMMENT 'O status da participação podera assumir os seguintes valores:\n1 => Aceito, pelo professor\n0 => Recusado, pelo professor',
  `idProfessor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `realiza_atividade`
--

CREATE TABLE `realiza_atividade` (
  `idAluno` int(11) NOT NULL,
  `idAtividade` int(11) NOT NULL,
  `anexo` varchar(200) NOT NULL,
  `resposta_aluno` varchar(200) NOT NULL,
  `resposta_professor` varchar(200) NOT NULL,
  `status_avaliacao` int(11) NOT NULL DEFAULT '1' COMMENT 'O status da avaliação podera assumir os seguintes valores:\n1 => Pendente, aguardando avaliação do professor(Não Avaliada)\n2 => Aceita, confirmada pelo professor(Aceita)\n3 => Recusada, não aceita pelo professor(Recusada)',
  `idProfessor` int(11) NOT NULL,
  `idDisciplina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacao_disciplina`
--

CREATE TABLE `solicitacao_disciplina` (
  `idAluno` int(11) NOT NULL,
  `idDisciplina` int(11) NOT NULL,
  `status_solicitacao` int(11) NOT NULL DEFAULT '1' COMMENT 'O status da solicitacao podera assumir os seguintes valores:\n1 => Pendente, aguardando confirmação do professor\n2 => Aceita, pelo professor\n3 => Recusada, pelo professor',
  `justificativa_aluno` varchar(250) NOT NULL,
  `idProfessor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `data` date NOT NULL,
  `email` varchar(80) NOT NULL,
  `senha` varchar(150) NOT NULL,
  `tipo_usuario` int(11) NOT NULL COMMENT 'O tipo de usuario podera assumir os seguintes valores:\n1 => Aluno\n2 => Professor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atividade`
--
ALTER TABLE `atividade`
  ADD PRIMARY KEY (`idAtividade`),
  ADD KEY `fk_atividade_conjunto_atividade1_idx` (`idConjuntoAtividade`);

--
-- Indexes for table `conjunto_atividade`
--
ALTER TABLE `conjunto_atividade`
  ADD PRIMARY KEY (`idConjuntoAtividade`),
  ADD KEY `fk_conjunto_atividade_Usuario1_idx` (`idProfessor`),
  ADD KEY `fk_conjunto_atividade_disciplina1_idx` (`idDisciplina`);

--
-- Indexes for table `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`idDisciplina`),
  ADD KEY `fk_disciplina_Usuario_idx` (`idProfessor`);

--
-- Indexes for table `participa_disciplina`
--
ALTER TABLE `participa_disciplina`
  ADD PRIMARY KEY (`idAluno`,`idDisciplina`),
  ADD KEY `fk_Usuario_has_disciplina_disciplina1_idx` (`idDisciplina`),
  ADD KEY `fk_Usuario_has_disciplina_Usuario1_idx` (`idAluno`);

--
-- Indexes for table `realiza_atividade`
--
ALTER TABLE `realiza_atividade`
  ADD PRIMARY KEY (`idAluno`,`idAtividade`),
  ADD KEY `fk_Usuario_has_atividade_atividade1_idx` (`idAtividade`),
  ADD KEY `fk_Usuario_has_atividade_Usuario1_idx` (`idAluno`);

--
-- Indexes for table `solicitacao_disciplina`
--
ALTER TABLE `solicitacao_disciplina`
  ADD PRIMARY KEY (`idAluno`,`idDisciplina`),
  ADD KEY `fk_Usuario_has_disciplina_disciplina2_idx` (`idDisciplina`),
  ADD KEY `fk_Usuario_has_disciplina_Usuario2_idx` (`idAluno`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atividade`
--
ALTER TABLE `atividade`
  MODIFY `idAtividade` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conjunto_atividade`
--
ALTER TABLE `conjunto_atividade`
  MODIFY `idConjuntoAtividade` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `idDisciplina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `atividade`
--
ALTER TABLE `atividade`
  ADD CONSTRAINT `fk_atividade_conjunto_atividade` FOREIGN KEY (`idConjuntoAtividade`) REFERENCES `conjunto_atividade` (`idConjuntoAtividade`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `conjunto_atividade`
--
ALTER TABLE `conjunto_atividade`
  ADD CONSTRAINT `fk_conjunto_atividade_da_disciplina` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`idDisciplina`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_conjunto_atividade_professor` FOREIGN KEY (`idProfessor`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `fk_disciplina_professor` FOREIGN KEY (`idProfessor`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `participa_disciplina`
--
ALTER TABLE `participa_disciplina`
  ADD CONSTRAINT `fk_Usuario_participa` FOREIGN KEY (`idAluno`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_disciplina_participa` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`idDisciplina`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `realiza_atividade`
--
ALTER TABLE `realiza_atividade`
  ADD CONSTRAINT `fk_aluno_realiza_atividade` FOREIGN KEY (`idAluno`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_atividade_realizada` FOREIGN KEY (`idAtividade`) REFERENCES `atividade` (`idAtividade`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `solicitacao_disciplina`
--
ALTER TABLE `solicitacao_disciplina`
  ADD CONSTRAINT `fk_disciplina_solicitada` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`idDisciplina`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_solicitao_disciplina` FOREIGN KEY (`idAluno`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
