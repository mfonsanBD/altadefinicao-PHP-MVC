-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.13-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura para tabela sistema.acabamento
CREATE TABLE IF NOT EXISTS `acabamento` (
  `idAcabamento` int(11) NOT NULL AUTO_INCREMENT,
  `nomeAcabamento` varchar(150) NOT NULL,
  PRIMARY KEY (`idAcabamento`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sistema.acabamento: ~11 rows (aproximadamente)
DELETE FROM `acabamento`;
/*!40000 ALTER TABLE `acabamento` DISABLE KEYS */;
INSERT INTO `acabamento` (`idAcabamento`, `nomeAcabamento`) VALUES
	(1, 'Bainha e Ilhós'),
	(2, 'Tubete e Corda Lateral'),
	(3, 'Bainha e Ilhós + Reforço com Corda'),
	(4, 'Tubete e Corda Topo'),
	(6, 'UV Total 1/0'),
	(8, 'Corte e Vinco'),
	(9, 'Blocagem'),
	(10, 'Dobra'),
	(11, 'Serrilha'),
	(12, 'Furo 3mm'),
	(13, 'Canteamento');
/*!40000 ALTER TABLE `acabamento` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nomeCategoria` varchar(100) NOT NULL,
  `slugCategoria` varchar(100) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sistema.categoria: ~2 rows (aproximadamente)
DELETE FROM `categoria`;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` (`idCategoria`, `nomeCategoria`, `slugCategoria`) VALUES
	(1, 'Comunicação Visual', ''),
	(2, 'Impressão Offset', '');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `idTipoCliente` int(11) NOT NULL,
  `telefoneCliente` varchar(15) NOT NULL,
  `celularCliente` varchar(15) NOT NULL,
  `whatsappCliente` varchar(15) NOT NULL,
  `slugCliente` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sistema.cliente: ~0 rows (aproximadamente)
DELETE FROM `cliente`;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema.colaboradores
CREATE TABLE IF NOT EXISTS `colaboradores` (
  `idColaborador` int(11) NOT NULL AUTO_INCREMENT,
  `nomeColaborador` varchar(100) NOT NULL,
  `cargoColaborador` varchar(100) NOT NULL,
  `fotoColaborador` varchar(36) NOT NULL,
  PRIMARY KEY (`idColaborador`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sistema.colaboradores: ~5 rows (aproximadamente)
DELETE FROM `colaboradores`;
/*!40000 ALTER TABLE `colaboradores` DISABLE KEYS */;
INSERT INTO `colaboradores` (`idColaborador`, `nomeColaborador`, `cargoColaborador`, `fotoColaborador`) VALUES
	(7, 'Mike Santos', 'Arte Finalista', '476ceb0f6a6098b13286c0a009e3d67b.jpg'),
	(8, 'Valdeir Foli', 'CEO', '8446091efaf2283cae4d579c508c5043.jpg'),
	(9, 'Daniel Almeida', 'Gerente', '071dbfe1e9a7f752feabbc90bc42fdce.jpg'),
	(10, 'Kamilly Foli', 'Administração', 'ee140d2f4f64c3c47228ae9f9bf0014a.jpg'),
	(11, 'Junior Nascimento', 'Corte Eletrônico/Router', '12d13688fbd741a41f0e3455e6187292.jpg');
/*!40000 ALTER TABLE `colaboradores` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema.cor
CREATE TABLE IF NOT EXISTS `cor` (
  `idCor` int(11) NOT NULL AUTO_INCREMENT,
  `nomeCor` varchar(50) NOT NULL,
  PRIMARY KEY (`idCor`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sistema.cor: ~2 rows (aproximadamente)
DELETE FROM `cor`;
/*!40000 ALTER TABLE `cor` DISABLE KEYS */;
INSERT INTO `cor` (`idCor`, `nomeCor`) VALUES
	(1, '4/0'),
	(2, '4/1'),
	(3, '4/4');
/*!40000 ALTER TABLE `cor` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema.endereco
CREATE TABLE IF NOT EXISTS `endereco` (
  `idEndereco` int(11) NOT NULL AUTO_INCREMENT,
  `idCliente` int(11) NOT NULL,
  `logradouroEndereco` varchar(250) NOT NULL,
  `numeroEndereco` int(6) NOT NULL,
  `complementoEndereco` varchar(100) NOT NULL,
  `bairroEndereco` varchar(100) NOT NULL,
  `cidadeEndereco` varchar(100) NOT NULL,
  `estadoEndereco` varchar(2) NOT NULL,
  `cepEndereco` varchar(9) NOT NULL,
  PRIMARY KEY (`idEndereco`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sistema.endereco: ~0 rows (aproximadamente)
DELETE FROM `endereco`;
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema.formato
CREATE TABLE IF NOT EXISTS `formato` (
  `idFormato` int(11) NOT NULL AUTO_INCREMENT,
  `idProduto` int(11) NOT NULL,
  `nomeFormato` varchar(50) NOT NULL,
  PRIMARY KEY (`idFormato`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sistema.formato: ~14 rows (aproximadamente)
DELETE FROM `formato`;
/*!40000 ALTER TABLE `formato` DISABLE KEYS */;
INSERT INTO `formato` (`idFormato`, `idProduto`, `nomeFormato`) VALUES
	(1, 0, '9x5'),
	(2, 0, '9x10'),
	(3, 0, '10x14'),
	(4, 0, '10x15'),
	(5, 0, '20x14'),
	(6, 0, '20x28'),
	(7, 0, '28x40'),
	(8, 0, '18x20'),
	(9, 0, '10x28'),
	(10, 0, '9x20'),
	(11, 0, '20x42'),
	(12, 0, '56x40'),
	(13, 0, '10x42'),
	(14, 0, '14x30'),
	(15, 0, '28x50'),
	(16, 0, '10x56');
/*!40000 ALTER TABLE `formato` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema.forma_pagamento
CREATE TABLE IF NOT EXISTS `forma_pagamento` (
  `idFormaPagamento` int(11) NOT NULL AUTO_INCREMENT,
  `nomeFormaPagamento` varchar(100) NOT NULL,
  PRIMARY KEY (`idFormaPagamento`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sistema.forma_pagamento: ~4 rows (aproximadamente)
DELETE FROM `forma_pagamento`;
/*!40000 ALTER TABLE `forma_pagamento` DISABLE KEYS */;
INSERT INTO `forma_pagamento` (`idFormaPagamento`, `nomeFormaPagamento`) VALUES
	(1, 'Dinheiro'),
	(2, 'Transferência'),
	(3, 'Cartão de Débito'),
	(4, 'Cartão de Crédito');
/*!40000 ALTER TABLE `forma_pagamento` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema.gramatura
CREATE TABLE IF NOT EXISTS `gramatura` (
  `idGramatura` int(11) NOT NULL AUTO_INCREMENT,
  `idProduto` int(11) NOT NULL,
  `nomeGramatura` varchar(4) NOT NULL,
  PRIMARY KEY (`idGramatura`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sistema.gramatura: ~6 rows (aproximadamente)
DELETE FROM `gramatura`;
/*!40000 ALTER TABLE `gramatura` DISABLE KEYS */;
INSERT INTO `gramatura` (`idGramatura`, `idProduto`, `nomeGramatura`) VALUES
	(1, 0, '250'),
	(2, 0, '300'),
	(3, 0, '115'),
	(4, 0, '80'),
	(5, 0, '150'),
	(6, 0, '90');
/*!40000 ALTER TABLE `gramatura` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema.midia
CREATE TABLE IF NOT EXISTS `midia` (
  `idMidia` int(11) NOT NULL AUTO_INCREMENT,
  `nomeMidia` varchar(150) NOT NULL,
  PRIMARY KEY (`idMidia`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sistema.midia: ~18 rows (aproximadamente)
DELETE FROM `midia`;
/*!40000 ALTER TABLE `midia` DISABLE KEYS */;
INSERT INTO `midia` (`idMidia`, `nomeMidia`) VALUES
	(1, 'Adesivo Fosco Premium'),
	(2, 'Adesivo Brilho Premium'),
	(4, 'Lona Backlight'),
	(5, 'Lona Brilho'),
	(6, 'Adesivo Vinil Transparente'),
	(7, 'Adesivo Vinil Fosco Premium'),
	(8, 'Adesivo Vinil Brilho'),
	(9, 'Adesivo Vinil Fosco'),
	(10, 'Adesivo Vinil Brilho Premium'),
	(11, 'Adesivo Vinil Brilho Automotivo'),
	(12, 'Adesivo Vinil Transparente Retroverso'),
	(13, 'Adesivo Vinil Blackout'),
	(14, 'Adesivo Vinil Microperfurado'),
	(15, 'Adesivo Vinil Fosco Automotivo'),
	(16, 'Adesivo Vinil Fosco Blackout'),
	(17, 'Adesivo Brilho Automotivo'),
	(18, 'Adesivo Fosco Automotivo'),
	(19, 'Lona Fosca'),
	(20, 'Lona Bracklight U.V');
/*!40000 ALTER TABLE `midia` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema.papel
CREATE TABLE IF NOT EXISTS `papel` (
  `idPapel` int(11) NOT NULL AUTO_INCREMENT,
  `nomePapel` varchar(100) NOT NULL,
  PRIMARY KEY (`idPapel`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sistema.papel: ~4 rows (aproximadamente)
DELETE FROM `papel`;
/*!40000 ALTER TABLE `papel` DISABLE KEYS */;
INSERT INTO `papel` (`idPapel`, `nomePapel`) VALUES
	(1, 'Couchê Brilho'),
	(2, 'DuoDesign'),
	(3, 'Supremo'),
	(4, 'Couchê Fosco');
/*!40000 ALTER TABLE `papel` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema.pedido
CREATE TABLE IF NOT EXISTS `pedido` (
  `idPedido` int(11) NOT NULL AUTO_INCREMENT,
  `idCliente` int(11) NOT NULL,
  `idProduto` int(11) NOT NULL,
  `idMidia` int(11) NOT NULL,
  `idAcabamento` int(11) NOT NULL,
  `idValorProdutoTipoCliente` int(11) NOT NULL,
  `idFormaPagamento` int(11) NOT NULL,
  `codigoPedido` varchar(150) NOT NULL,
  `statusPagamento` tinyint(1) NOT NULL DEFAULT 0,
  `altura` varchar(5) NOT NULL,
  `largura` varchar(5) NOT NULL,
  `statusPedido` tinyint(1) NOT NULL DEFAULT 0,
  `dataPedido` datetime NOT NULL,
  `observacaoPedido` text NOT NULL,
  `quantidadeProduto` int(6) NOT NULL,
  `arquivo` varchar(37) NOT NULL,
  PRIMARY KEY (`idPedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sistema.pedido: ~0 rows (aproximadamente)
DELETE FROM `pedido`;
/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedido` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema.postagem
CREATE TABLE IF NOT EXISTS `postagem` (
  `idPostagem` int(11) NOT NULL AUTO_INCREMENT,
  `tituloPostagem` varchar(150) NOT NULL,
  `textoPostagem` text NOT NULL,
  `imagemPostagem` varchar(36) NOT NULL,
  `statusPostagem` tinyint(4) NOT NULL DEFAULT 0,
  `dataPostagem` datetime NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `slugPostagem` varchar(160) NOT NULL,
  PRIMARY KEY (`idPostagem`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sistema.postagem: ~0 rows (aproximadamente)
DELETE FROM `postagem`;
/*!40000 ALTER TABLE `postagem` DISABLE KEYS */;
INSERT INTO `postagem` (`idPostagem`, `tituloPostagem`, `textoPostagem`, `imagemPostagem`, `statusPostagem`, `dataPostagem`, `idUsuario`, `slugPostagem`) VALUES
	(4, 'Carré com Feijão', '<p>gsasagdsagdsagdgfdshfd</p>', 'c1fc3d3158c98aa8378e6fd82e5e21d6.jpg', 1, '2020-08-14 17:17:18', 1, 'carre-com-feijao');
/*!40000 ALTER TABLE `postagem` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema.produto
CREATE TABLE IF NOT EXISTS `produto` (
  `idProduto` int(11) NOT NULL AUTO_INCREMENT,
  `nomeProduto` varchar(150) NOT NULL,
  `fotoProduto` varchar(36) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `slugProduto` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProduto`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sistema.produto: ~1 rows (aproximadamente)
DELETE FROM `produto`;
/*!40000 ALTER TABLE `produto` DISABLE KEYS */;
INSERT INTO `produto` (`idProduto`, `nomeProduto`, `fotoProduto`, `idCategoria`, `slugProduto`) VALUES
	(30, 'Lona', 'ab6fa2fdf0e3620eb3e2aff63ba235a5.jpg', 1, NULL);
/*!40000 ALTER TABLE `produto` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema.quantidade
CREATE TABLE IF NOT EXISTS `quantidade` (
  `idQuantidade` int(11) NOT NULL AUTO_INCREMENT,
  `idProduto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  PRIMARY KEY (`idQuantidade`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sistema.quantidade: ~12 rows (aproximadamente)
DELETE FROM `quantidade`;
/*!40000 ALTER TABLE `quantidade` DISABLE KEYS */;
INSERT INTO `quantidade` (`idQuantidade`, `idProduto`, `quantidade`) VALUES
	(1, 0, 1),
	(2, 0, 2),
	(3, 0, 5),
	(4, 0, 10),
	(5, 0, 20),
	(6, 0, 50),
	(7, 0, 100),
	(8, 0, 1000),
	(9, 0, 2000),
	(10, 0, 3000),
	(11, 0, 5000),
	(12, 0, 10000);
/*!40000 ALTER TABLE `quantidade` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema.tipocliente
CREATE TABLE IF NOT EXISTS `tipocliente` (
  `idTipoCliente` int(11) NOT NULL AUTO_INCREMENT,
  `nomeTipoCliente` varchar(150) NOT NULL,
  PRIMARY KEY (`idTipoCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sistema.tipocliente: ~2 rows (aproximadamente)
DELETE FROM `tipocliente`;
/*!40000 ALTER TABLE `tipocliente` DISABLE KEYS */;
INSERT INTO `tipocliente` (`idTipoCliente`, `nomeTipoCliente`) VALUES
	(1, 'Final'),
	(2, 'Revendedor');
/*!40000 ALTER TABLE `tipocliente` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `tipoUsuario` int(11) NOT NULL,
  `nomeUsuario` varchar(50) NOT NULL,
  `sobrenomeUsuario` varchar(50) NOT NULL,
  `emailUsuario` varchar(150) NOT NULL,
  `senhaUsuario` varchar(32) NOT NULL,
  `hashUsuario` varchar(32) DEFAULT NULL,
  `codigoUsuario` varchar(6) DEFAULT NULL,
  `permissaoUsuario` tinyint(1) NOT NULL DEFAULT 0,
  `fotoUsuario` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sistema.usuario: ~1 rows (aproximadamente)
DELETE FROM `usuario`;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`idUsuario`, `tipoUsuario`, `nomeUsuario`, `sobrenomeUsuario`, `emailUsuario`, `senhaUsuario`, `hashUsuario`, `codigoUsuario`, `permissaoUsuario`, `fotoUsuario`) VALUES
	(1, 1, 'Alta', 'Definição', 'altadefinicaocaxias@gmail.com', '202cb962ac59075b964b07152d234b70', NULL, NULL, 1, 'usuario.jpg');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema.valor_produto_tipocliente
CREATE TABLE IF NOT EXISTS `valor_produto_tipocliente` (
  `idValorProdutoTipoCliente` int(11) NOT NULL AUTO_INCREMENT,
  `idProduto` int(11) NOT NULL,
  `idTipoCliente` int(11) NOT NULL,
  `valor` float(12,2) NOT NULL,
  PRIMARY KEY (`idValorProdutoTipoCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sistema.valor_produto_tipocliente: ~3 rows (aproximadamente)
DELETE FROM `valor_produto_tipocliente`;
/*!40000 ALTER TABLE `valor_produto_tipocliente` DISABLE KEYS */;
INSERT INTO `valor_produto_tipocliente` (`idValorProdutoTipoCliente`, `idProduto`, `idTipoCliente`, `valor`) VALUES
	(1, 27, 2, 20.00),
	(2, 27, 1, 40.00),
	(4, 28, 2, 25.00),
	(5, 28, 1, 40.00);
/*!40000 ALTER TABLE `valor_produto_tipocliente` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
