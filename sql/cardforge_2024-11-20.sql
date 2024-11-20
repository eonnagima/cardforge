# ************************************************************
# Sequel Ace SQL dump
# Version 20075
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: localhost (MySQL 5.5.5-10.4.28-MariaDB)
# Database: cardforge
# Generation Time: 2024-11-20 11:23:42 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp(),
  `name` varchar(300) NOT NULL,
  `franchise_id` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;

INSERT INTO `categories` (`id`, `created`, `updated`, `name`, `franchise_id`)
VALUES
	(1,'2024-11-12 12:04:01','2024-11-12 12:04:01','booster pack',1),
	(2,'2024-11-12 12:05:07','2024-11-12 12:05:07','decks',1),
	(3,'2024-11-12 12:05:52','2024-11-12 12:05:52','elite trainer box',2),
	(4,'2024-11-12 12:11:48','2024-11-12 12:11:48','accessories',1);

/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table franchises
# ------------------------------------------------------------

DROP TABLE IF EXISTS `franchises`;

CREATE TABLE `franchises` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `creadted` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp(),
  `name` varchar(300) NOT NULL,
  `alias` varchar(24) DEFAULT NULL,
  `img` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `franchises` WRITE;
/*!40000 ALTER TABLE `franchises` DISABLE KEYS */;

INSERT INTO `franchises` (`id`, `creadted`, `updated`, `name`, `alias`, `img`)
VALUES
	(1,'2024-11-12 12:07:15','2024-11-12 12:07:15','everything','everything','/assets/img/franchises/placeholder.png'),
	(2,'2024-11-12 12:07:59','2024-11-12 12:07:59','Pokémon Trading Card Game','Pokemon','/assets/img/franchises/placeholder.png'),
	(3,'2024-11-12 12:08:17','2024-11-12 12:08:17','Yu-Gi-Oh','YuGiOh','/assets/img/franchises/placeholder.png'),
	(4,'2024-11-12 12:08:56','2024-11-12 12:08:56','Magic: The Gathering','Magic','/assets/img/franchises/placeholder.png'),
	(5,'2024-11-12 12:09:39','2024-11-12 12:09:39','Cardfight!! Vanguard','Vanguard','/assets/img/franchises/placeholder.png'),
	(6,'2024-11-12 12:10:30','2024-11-12 12:10:30','Disney Lorcana','Lorcana','/assets/img/franchises/placeholder.png'),
	(7,'2024-11-19 23:10:54','2024-11-19 23:10:54','One Piece Card Game','OnePiece','/assets/img/franchises/placeholder.png'),
	(8,'2024-11-20 00:32:56','2024-11-20 00:32:56','Digimon Card Game','Digimon','/assets/img/franchises/placeholder.png');

/*!40000 ALTER TABLE `franchises` ENABLE KEYS */;
UNLOCK TABLES;


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


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0,
  `login_token` varchar(300) DEFAULT NULL,
  `avatar` varchar(300) NOT NULL DEFAULT 'assets/img/user-avatar/default.jpg',
  `first_name` varchar(300) DEFAULT NULL,
  `last_name` varchar(300) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `language` char(2) DEFAULT 'EN',
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `points` float(11,2) NOT NULL DEFAULT 1000.00,
  `adress_street` varchar(300) DEFAULT NULL,
  `adress_house_num` varchar(20) DEFAULT NULL,
  `adress_extra` varchar(300) DEFAULT NULL,
  `adress_province` varchar(300) DEFAULT NULL,
  `adress_zip_code` varchar(20) DEFAULT NULL,
  `adress_country` char(2) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `email`, `password`, `role`, `login_token`, `avatar`, `first_name`, `last_name`, `date_of_birth`, `phone_number`, `language`, `active`, `points`, `adress_street`, `adress_house_num`, `adress_extra`, `adress_province`, `adress_zip_code`, `adress_country`, `created`, `updated`)
VALUES
	(7,'test@test.com','$2y$10$6/RDS5tWz3JlS6t7Kmjybe5zDfDi..vyBwo40X0w17ZQcAjLE80F2',0,'030d919e525a0130882924534640763d5755f9194fdbe202b2744ea2eb9d357b','assets/img/user-avatar/default.jpg',NULL,NULL,NULL,NULL,'EN',1,100.00,NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-18 22:20:42','2024-11-20 10:58:31'),
	(8,'ben@test.com','$2y$10$HBDF1HXZWzM0pePqPa/omerDn9epYwGEkXJCO.QIEpk7dOYH.SvY.',0,NULL,'assets/img/user-avatar/default.jpg',NULL,NULL,NULL,NULL,'EN',1,100.00,NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-18 22:22:07','2024-11-18 22:22:07'),
	(9,'bendevos@cardforge.be','$2y$10$p.EmsmSRkbLktSNfxyLlae2A9lnJvmxv98TIbHx2/JqWX2EFlcZ3m',1,'032073564e982aaefb49bd83d05455aa91f28ec673d294791d2b84017adf1d73','assets/img/user-avatar/default.jpg',NULL,NULL,NULL,NULL,'EN',1,1000.00,NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-19 17:29:03','2024-11-20 10:57:57');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
