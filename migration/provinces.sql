# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 192.168.10.10 (MySQL 5.7.17-0ubuntu0.16.04.2)
# Database: gulf
# Generation Time: 2017-08-22 08:14:59 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table provinces
# ------------------------------------------------------------

DROP TABLE IF EXISTS `provinces`;

CREATE TABLE `provinces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  `plate_code` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `plate_code_unique` (`plate_code`),
  KEY `plate_code_index` (`plate_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `provinces` WRITE;
/*!40000 ALTER TABLE `provinces` DISABLE KEYS */;

INSERT INTO `provinces` (`id`, `label`, `plate_code`, `created_at`, `updated_at`)
VALUES
	(1,'Adana',1,NULL,NULL),
	(2,'Adıyaman',2,NULL,NULL),
	(3,'Afyon',3,NULL,NULL),
	(4,'Ağrı',4,NULL,NULL),
	(5,'Aksaray',68,NULL,NULL),
	(6,'Amasya',5,NULL,NULL),
	(7,'Ankara',6,NULL,NULL),
	(8,'Antalya',7,NULL,NULL),
	(9,'Ardahan',75,NULL,NULL),
	(10,'Artvin',8,NULL,NULL),
	(11,'Aydın',9,NULL,NULL),
	(12,'Balıkesir',10,NULL,NULL),
	(13,'Bartın',74,NULL,NULL),
	(14,'Batman',72,NULL,NULL),
	(15,'Bayburt',69,NULL,NULL),
	(16,'Bilecik',11,NULL,NULL),
	(17,'Bingöl',12,NULL,NULL),
	(18,'Bitlis',13,NULL,NULL),
	(19,'Bolu',14,NULL,NULL),
	(20,'Burdur',15,NULL,NULL),
	(21,'Bursa',16,NULL,NULL),
	(22,'Çanakkale',17,NULL,NULL),
	(23,'Çankırı',18,NULL,NULL),
	(24,'Çorum',19,NULL,NULL),
	(25,'Denizli',20,NULL,NULL),
	(26,'Diyarbakır',21,NULL,NULL),
	(27,'Düzce',81,NULL,NULL),
	(28,'Edirne',22,NULL,NULL),
	(29,'Elazığ',23,NULL,NULL),
	(30,'Erzincan',24,NULL,NULL),
	(31,'Erzurum',25,NULL,NULL),
	(32,'Eskişehir',26,NULL,NULL),
	(33,'Gaziantep',27,NULL,NULL),
	(34,'Giresun',28,NULL,NULL),
	(35,'Gümüşhane',29,NULL,NULL),
	(36,'Hakkari',30,NULL,NULL),
	(37,'Hatay',31,NULL,NULL),
	(38,'Iğdır',76,NULL,NULL),
	(39,'Isparta',32,NULL,NULL),
	(40,'İstanbul',34,NULL,NULL),
	(41,'İzmir',35,NULL,NULL),
	(42,'K.Maraş',46,NULL,NULL),
	(43,'Karabük',78,NULL,NULL),
	(44,'Karaman',70,NULL,NULL),
	(45,'Kars',36,NULL,NULL),
	(46,'Kastamonu',37,NULL,NULL),
	(47,'Kayseri',38,NULL,NULL),
	(48,'Kırıkkale',71,NULL,NULL),
	(49,'Kırklareli',39,NULL,NULL),
	(50,'Kırşehir',40,NULL,NULL),
	(51,'Kilis',79,NULL,NULL),
	(52,'Kocaeli',41,NULL,NULL),
	(53,'Konya',42,NULL,NULL),
	(54,'Kütahya',43,NULL,NULL),
	(55,'Malatya',44,NULL,NULL),
	(56,'Manisa',45,NULL,NULL),
	(57,'Mardin',47,NULL,NULL),
	(58,'Mersin',33,NULL,NULL),
	(59,'Muğla',48,NULL,NULL),
	(60,'Muş',49,NULL,NULL),
	(61,'Nevşehir',50,NULL,NULL),
	(62,'Niğde',51,NULL,NULL),
	(63,'Ordu',52,NULL,NULL),
	(64,'Osmaniye',80,NULL,NULL),
	(65,'Rize',53,NULL,NULL),
	(66,'Sakarya',54,NULL,NULL),
	(67,'Samsun',55,NULL,NULL),
	(68,'Siirt',56,NULL,NULL),
	(69,'Sinop',57,NULL,NULL),
	(70,'Sivas',58,NULL,NULL),
	(71,'Şanlıurfa',63,NULL,NULL),
	(72,'Şırnak',73,NULL,NULL),
	(73,'Tekirdağ',59,NULL,NULL),
	(74,'Tokat',60,NULL,NULL),
	(75,'Trabzon',61,NULL,NULL),
	(76,'Tunceli',62,NULL,NULL),
	(77,'Uşak',64,NULL,NULL),
	(78,'Van',65,NULL,NULL),
	(79,'Yalova',77,NULL,NULL),
	(80,'Yozgat',66,NULL,NULL),
	(81,'Zonguldak',67,NULL,NULL);

/*!40000 ALTER TABLE `provinces` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
