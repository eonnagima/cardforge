# ************************************************************
# Sequel Ace SQL dump
# Version 20075
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: localhost (MySQL 5.5.5-10.4.28-MariaDB)
# Database: cardforge
# Generation Time: 2024-11-20 10:05:28 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `description` text NOT NULL,
  `alias` varchar(300) NOT NULL,
  `img` varchar(300) NOT NULL,
  `price` float(11,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `franchise_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `set_name` varchar(300) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `discount` float(3,2) NOT NULL DEFAULT 0.00,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;

INSERT INTO `products` (`id`, `name`, `description`, `alias`, `img`, `price`, `stock`, `franchise_id`, `category_id`, `set_name`, `release_date`, `discount`, `created`, `updated`)
VALUES
	(1,'test pokemon','efpworjvdpsgk','test-pokemon','/assets/img/products/placeholder.png',5.99,25,2,1,NULL,NULL,0.00,'2024-11-20 00:06:02','2024-11-20 00:06:02'),
	(2,'Pokémon TCG: Scarlet & Violet-Twilight Masquerade Booster Display Box (36 Packs) ','Welcome to the land of Kitakami, where people and Pokémon live  harmoniously with nature. Folktales abound, but not all is as it  seems... Uncover the mystery of the masked Legendary Pokémon Ogerpon,  appearing as four fearsome types of Tera Pokémon ex, and team up with  more newly discovered Pokémon, like Bloodmoon Ursaluna ex and Sinistcha  ex. Growing in power, Greninja, Dragapult, and Magcargo dazzle as Tera  Pokémon ex, and more ACE SPEC cards round out the festivities in the Pokémon TCG: Scarlet & Violet—Twilight Masquerade expansion!','pokmon-tcg-scarlet--violet-twilight-masquerade-booster-display-box-36-packs-','/assets/img/products/placeholder.png',161.64,50,2,1,'Scarlet & Violet-Twilight Masquerade',NULL,0.00,'2024-11-20 00:08:17','2024-11-20 00:08:17'),
	(3,'Test Magic Product','This is a magic product','test-magic-product','/assets/img/products/placeholder.png',9.99,10,4,1,NULL,NULL,0.00,'2024-11-20 00:18:22','2024-11-20 00:18:22'),
	(4,'Test Yu-Gi-Oh Product','This is a Yu-Gi-Oh Product','test-yu-gi-oh-product','/assets/img/products/placeholder.png',12.95,20,3,1,NULL,'2024-11-07',0.00,'2024-11-20 00:19:08','2024-11-20 00:19:08'),
	(5,'Test Digimon Product','This is a test product','test-digimon-product','/assets/img/products/placeholder.png',15.95,12,8,1,NULL,'2024-10-10',0.00,'2024-11-20 00:33:39','2024-11-20 00:33:39');

/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
