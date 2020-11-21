
-- Banco de dados para o sistema comparepizza
CREATE DATABASE IF NOT EXISTS `heroku_3cce715d536db0` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `heroku_3cce715d536db0`;


-- Estrutura para tabela comparepizza.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `IdAdmin` int(10) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(45) DEFAULT NULL,
  `Senha` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`IdAdmin`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Populando a  tabela comparepizza.admin: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`IdAdmin`, `Nome`, `Senha`) VALUES
	(1, 'tcc', 'fam'),
	(2, 'ale', 'ale123');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;


-- Estrutura da tabela comparepizza.cadastrodepizzaria
CREATE TABLE IF NOT EXISTS `cadastrodepizzaria` (
  `IdPizzaria` int(12) NOT NULL,
  `Nome` varchar(50) DEFAULT NULL,
  `Usuario` varchar(50) DEFAULT NULL,
  `Senha` varchar(50) DEFAULT NULL,
  `Endereco` varchar(50) DEFAULT NULL,
  `Numero` varchar(45) DEFAULT NULL,
  `Cep` varchar(50) DEFAULT NULL,
  `Cidade` varchar(50) DEFAULT NULL,
  `Estado` varchar(50) DEFAULT NULL,
  `Pais` varchar(50) DEFAULT NULL,
  `Telefone` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`IdPizzaria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- Populando a  tabela comparepizza.cadastrodepizzaria: ~175 rows (aproximadamente)
/*!40000 ALTER TABLE `cadastrodepizzaria` DISABLE KEYS */;

INSERT INTO `cadastrodepizzaria` (`IdPizzaria`, `Nome`, `Usuario`, `Senha`, `Endereco`, `Numero`, `Cep`, `Cidade`, `Estado`, `Pais`, `Telefone`) VALUES
	(1, 'Tcc', 'Fam', 'fam', 'Rua Augusta', '77', '08567230', 'São Paulo', 'SP', 'BR', '11992125437'),
	(2, 'TccPizza',  'Fam1', 'fam1', 'Rua Augusta', '77', '08567230', 'São Paulo', 'RJ', 'BR', '11992125437');	
/*!40000 ALTER TABLE `cadastrodepizzaria` ENABLE KEYS */;


-- Estrutura da tabela comparepizza.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `IdMenu` int(12) NOT NULL,
  `Nome` varchar(50) DEFAULT NULL,
  `Sabor` varchar(45) DEFAULT NULL,
  `Tamanho` varchar(50) DEFAULT NULL,
  `Preco` double DEFAULT NULL,
  PRIMARY KEY (`IdMenu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Populando a  tabela comparepizza.menu: ~175 rows (aproximadamente)
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;

INSERT INTO `menu` (`IdMenu`, `Nome`, `Sabor`, `Tamanho`, `Preco`) VALUES
	(1, 'Calabresa', 'Defumada', 'Média', '15'),
	(2, 'Queijo', 'Minas', 'Pequena', '10');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;


-- Estrutura para tabela comparepizza.imagens
CREATE TABLE IF NOT EXISTS `imagens` (
  `ChaveImg` int(12) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ChaveImg`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- Populando a  tabela comparepizza.imagens: ~25 rows (aproximadamente)
/*!40000 ALTER TABLE `imagens` DISABLE KEYS */;
INSERT INTO `imagens` (`ChaveImg`, `Nome`) VALUES
	(1, 'Alitascoreanas.jpg'),
	(2, 'Bolitasdepuercoagridulce.jpg'),
	(3, 'Pollo-con-Anacardos.jpg'),
	(4, 'QueijoComBacon.jpg'),
	(5, 'verduras.jpg'),
	(7, 'CalabresaComPimenta.jpg'),
	(8, 'Marguerita.jpg'),
	(9, 'Costillitas.jpg'),
	(10, 'Filete-de-pescado-tempura.png'),
	(11, 'FrangoComQueijo.jpg'),
	(12, 'Resconverduras.jpg'),
	(13, 'Puerco-con-verduras.jpg'),
	(14, 'Puerco-tempura.jpg'),
	(15, 'Rollitosprimaveraconpollo.jpg'),
	(16, 'Salsa-Teriyaki.jpg'),
	(17, 'Sushi.jpg'),
	(18, 'Sushidecamarontempura.jpg'),
	(19, 'Wontondecarne.jpg'),
	(20, 'QuatroQueijos.jpg'),
	(21, 'Rollitosprimaveraconpollo.jpg'),
	(22, 'CogumeloComQueijo.jpg'),
	(23, 'CalabresaComQueijo.jpg'),
	(24, 'Espinafre.jpg'),
	(25, 'PresuntoeQueijo.jpg'),
	(26, 'Fajitasderes.jpg'),
	(27, 'fghfg.jpg');
/*!40000 ALTER TABLE `imagens` ENABLE KEYS */;


-- Estrutura para tabela comparepizza.localizacao
CREATE TABLE IF NOT EXISTS `localizacao` (
  `ChaveLocalizacao` int(12) NOT NULL AUTO_INCREMENT,
  `Cidade` varchar(50) DEFAULT NULL,
  `Estado` varchar(50) DEFAULT NULL,
  `Pais` varchar(50) DEFAULT NULL,
  `Endereco` varchar(50) DEFAULT NULL,
  `Numero` varchar(45) DEFAULT NULL,
  `Cep` varchar(50) DEFAULT NULL,
  `Referencias` varchar(100) DEFAULT NULL,
  `CordenadaLatitudLongitud` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ChaveLocalizacao`)
) ENGINE=InnoDB AUTO_INCREMENT=385 DEFAULT CHARSET=utf8;

-- Populando a  tabela comparepizza.localizacao: ~217 rows (aproximadamente)
/*!40000 ALTER TABLE `localizacao` DISABLE KEYS */;
INSERT INTO `localizacao` (`ChaveLocalizacao`, `Cidade`, `Estado`, `Pais`, `Endereco`, `Numero`, `Cep`, `Referencias`, `CordenadaLatitudLongitud`) VALUES
	(147, 'São Paulo', 'SP', 'BR', 'Rua A', '37', '01415258', 'Fam', ''),
	(148, 'São Paulo', 'SP', 'BR', 'Rua B', '35', '01415358', 'Fam', ''),
	(149, 'São Paulo', 'SP', 'BR', 'Rua C', '37', '01415258', 'Fam', '(-23.5489, -46.6388)');

/*!40000 ALTER TABLE `localizacao` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;

