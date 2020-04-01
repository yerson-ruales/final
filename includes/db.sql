-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table test.appuser
CREATE TABLE IF NOT EXISTS `appuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(80) NOT NULL,
  `celular` varchar(80) NOT NULL,
  `whatsapp` varchar(80) NOT NULL,
  `direccion` varchar(80) NOT NULL,
  `ciudad` varchar(80) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table test.appuser: ~0 rows (approximately)
/*!40000 ALTER TABLE `appuser` DISABLE KEYS */;
/*!40000 ALTER TABLE `appuser` ENABLE KEYS */;

-- Dumping structure for table test.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(50) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table test.categorias: ~9 rows (approximately)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
REPLACE INTO `categorias` (`id`, `nombre`) VALUES
	(1, 'Ninguna'),
	(2, 'Tecnologia'),
	(3, 'Electrodomstics'),
	(1, 'Ninguna'),
	(2, 'Tecnologia'),
	(3, 'Electrodomstics'),
	(1, 'Ninguna'),
	(2, 'Tecnologia'),
	(3, 'Electrodomstics');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Dumping structure for table test.log
CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quien` char(50) DEFAULT NULL,
  `que` char(50) DEFAULT NULL,
  `cuando` datetime DEFAULT CURRENT_TIMESTAMP,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table test.log: ~0 rows (approximately)
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;

-- Dumping structure for table test.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `productname` varchar(255) NOT NULL,
  `productprice` varchar(255) NOT NULL,
  `productimage` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table test.products: ~0 rows (approximately)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
