# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 192.168.10.10 (MySQL 5.7.17-0ubuntu0.16.04.2)
# Database: askmilazim
# Generation Time: 2017-08-23 14:05:30 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table members
# ------------------------------------------------------------

DROP TABLE IF EXISTS `members`;

CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(190) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `activation_token` varchar(100) DEFAULT NULL,
  `forgot_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `activated` int(11) DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `profession_id` int(11) DEFAULT NULL,
  `marital_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `members_id` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;

INSERT INTO `members` (`id`, `name`, `email`, `password`, `remember_token`, `activation_token`, `forgot_token`, `created_at`, `updated_at`, `deleted_at`, `activated`, `gender`, `birth_date`, `city_id`, `province_id`, `profession_id`, `marital_status`)
VALUES
	(1,NULL,'m.zahirr@hotmail.com','$2y$10$Vm08BshsHx82.HwyG00Ee.IF75XAst8cwC0j2i0CGKHYJgNuHRELW',NULL,'34e329978823707e9829c4a48b9bcc4b',NULL,'2017-08-17 14:32:34','2017-08-17 14:33:22',NULL,NULL,1,'2017-08-17',34,34,34,0),
	(2,NULL,'m.zahirr1@hotmail.com','$2y$10$jYf5Spg5QsDm7tbo4L0Q6OlTJbYpW731wVl8cCZpEoJMWvP2VNcr2',NULL,'2679dffc55aecf99e74abff38d77c948',NULL,'2017-08-22 14:26:14','2017-08-22 14:26:14',NULL,NULL,1,'2017-08-22',7,70,6,0),
	(3,NULL,'m.zahirr12@hotmail.com','$2y$10$k/UTZvdq7q6qLg7xKuME3uqDcOK8XKinFaQ3GNxL5F/Ew.tHIA.qC',NULL,'29d327e490858b92aa8795b3c8298345',NULL,'2017-08-22 14:28:34','2017-08-22 14:28:34',NULL,NULL,1,'2017-08-22',1,1,897,1);

/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
