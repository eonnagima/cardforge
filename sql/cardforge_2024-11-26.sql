# ************************************************************
# Sequel Ace SQL dump
# Version 20075
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: localhost (MySQL 5.5.5-10.4.28-MariaDB)
# Database: cardforge
# Generation Time: 2024-11-26 20:31:33 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table banner_slides
# ------------------------------------------------------------

DROP TABLE IF EXISTS `banner_slides`;

CREATE TABLE `banner_slides` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `img` varchar(300) NOT NULL,
  `logo` varchar(300) NOT NULL,
  `franchise_id` int(11) NOT NULL,
  `img_alt` varchar(300) NOT NULL,
  `logo_alt` varchar(300) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `alias` varchar(300) DEFAULT NULL,
  `franchise_id` int(11) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;

INSERT INTO `categories` (`id`, `name`, `alias`, `franchise_id`, `created`, `updated`)
VALUES
	(1,'Booster Packs','booster-packs',1,'2024-11-12 12:04:01','2024-11-12 12:04:01'),
	(2,'Decks','decks',1,'2024-11-12 12:05:07','2024-11-12 12:05:07'),
	(3,'Elite Trainer Box','elite-trainer-box',2,'2024-11-12 12:05:52','2024-11-12 12:05:52'),
	(4,'Accessories','accessories',1,'2024-11-12 12:11:48','2024-11-12 12:11:48'),
	(9,'Tin Box','tin-box',2,'2024-11-24 10:56:09','2024-11-24 10:56:09'),
	(10,'Boxed Set','boxed-set',2,'2024-11-24 10:57:15','2024-11-24 10:57:15'),
	(11,'Other','other',1,'2024-11-24 11:02:53','2024-11-24 11:02:53');

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
  `alias` varchar(24) NOT NULL,
  `img` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `franchises` WRITE;
/*!40000 ALTER TABLE `franchises` DISABLE KEYS */;

INSERT INTO `franchises` (`id`, `creadted`, `updated`, `name`, `alias`, `img`)
VALUES
	(1,'2024-11-12 12:07:15','2024-11-12 12:07:15','everything','everything','/assets/img/franchises/placeholder.png'),
	(2,'2024-11-12 12:07:59','2024-11-12 12:07:59','Pokémon Trading Card Game','Pokemon','https://res.cloudinary.com/codinari/image/upload/v1732570223/Poke%CC%81mon_Trading_Card_Game_logo.svg_ik5bj2.png'),
	(10,'2024-11-24 11:53:37','2024-11-24 11:53:37','Digimon Card Game','Digimon','https://res.cloudinary.com/codinari/image/upload/v1732445616/zsmllxq8kfs0babyun4m.png');

/*!40000 ALTER TABLE `franchises` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table order
# ------------------------------------------------------------

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `status` varchar(300) NOT NULL DEFAULT 'Order is being processed',
  `shipping_street` varchar(300) NOT NULL,
  `shipping_house_number` varchar(10) NOT NULL,
  `shipping_extra` varchar(300) NOT NULL,
  `shipping_zip` varchar(10) NOT NULL,
  `shipping_country` char(2) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table order_has_products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `order_has_products`;

CREATE TABLE `order_has_products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table product_images
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_images`;

CREATE TABLE `product_images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `url` varchar(300) NOT NULL,
  `alt` varchar(300) NOT NULL,
  `primary_image` tinyint(1) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;

INSERT INTO `product_images` (`id`, `product_id`, `url`, `alt`, `primary_image`, `created`, `updated`)
VALUES
	(1,2,'https://www.pokemoncenter.com/images/DAMRoot/High/10000/P9505_699-86340_01.jpg','Pokémon TCG: Scarlet & Violet-Twilight Masquerade Booster Display Box (36 Packs)',1,'2024-11-23 19:20:32','2024-11-23 19:20:32'),
	(2,2,'https://www.pokemoncenter.com/images/DAMRoot/High/10000/P9505_699-86340_02.jpg','Pokémon TCG: Scarlet & Violet-Twilight Masquerade Booster Display Box (36 Packs)',0,'2024-11-23 19:21:19','2024-11-23 19:21:19'),
	(3,2,'https://www.pokemoncenter.com/images/DAMRoot/High/10000/P9505_699-86340_03.jpg','Pokémon TCG: Scarlet & Violet-Twilight Masquerade Booster Display Box (36 Packs)',0,'2024-11-23 19:21:47','2024-11-23 19:21:47'),
	(5,11,'https://res.cloudinary.com/codinari/image/upload/v1732569868/tjnlyipfh6owasku8qwn.jpg','Pokémon TCG: Ditto Quartet Playmat',1,'2024-11-25 22:24:28','2024-11-25 22:24:28'),
	(6,11,'https://res.cloudinary.com/codinari/image/upload/v1732569869/bnizzi5xpyj6imqsxhtq.jpg','Pokémon TCG: Ditto Quartet Playmat',0,'2024-11-25 22:24:30','2024-11-25 22:24:30'),
	(7,11,'https://res.cloudinary.com/codinari/image/upload/v1732569871/upzzkgcfw3ssvucjfxxe.jpg','Pokémon TCG: Ditto Quartet Playmat',0,'2024-11-25 22:24:32','2024-11-25 22:24:32');

/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_reviews
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_reviews`;

CREATE TABLE `product_reviews` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `text` int(11) NOT NULL,
  `anonymous` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `description` text NOT NULL,
  `details` text DEFAULT NULL,
  `alias` varchar(300) NOT NULL,
  `price` float(11,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `franchise_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `set_name` varchar(300) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;

INSERT INTO `products` (`id`, `name`, `description`, `details`, `alias`, `price`, `stock`, `franchise_id`, `category_id`, `set_name`, `release_date`, `created`, `updated`)
VALUES
	(2,'Pokémon TCG: Scarlet & Violet-Twilight Masquerade Booster Display Box (36 Packs) ','Welcome to the land of Kitakami, where people and Pokémon live  harmoniously with nature. Folktales abound, but not all is as it  seems... Uncover the mystery of the masked Legendary Pokémon Ogerpon,  appearing as four fearsome types of Tera Pokémon ex, and team up with  more newly discovered Pokémon, like Bloodmoon Ursaluna ex and Sinistcha  ex. Growing in power, Greninja, Dragapult, and Magcargo dazzle as Tera  Pokémon ex, and more ACE SPEC cards round out the festivities in the Pokémon TCG: Scarlet & Violet—Twilight Masquerade expansion!',NULL,'pokmon-tcg-scarlet--violet-twilight-masquerade-booster-display-box-36-packs-',161.64,50,2,1,'Scarlet & Violet-Twilight Masquerade',NULL,'2024-11-20 00:08:17','2024-11-20 00:08:17'),
	(11,'Pokémon TCG: Ditto Quartet Playmat','Adorable Ditto show off their different moods on this Pokémon TCG accessory that reminds you it\'s OK to be yourself! Made of grippy neoprene, this playmat is a prime place to play a game or even to put underneath your mouse while you use the computer.','    Perfectly purple artwork featuring Ditto\r\n    Durable neoprene grips to desks, tables, and other hard surfaces\r\n    Provides ample space for your cards during gameplay\r\n    Multiple playmats (sold separately) can be stacked for extra cushioning or rotated to create a custom display\r\n    Part of the Ditto Quartet collection\r\n    Pokémon Center Original\r\n\r\nMore Details:\r\n\r\n    Item Dimensions: 24 x 14 x 0.1 IN\r\n    Country Of Origin: Made in Taiwan. Printed in the USA.\r\n    Materials: 100% neoprene\r\n    Item Weight: 7.6 OZ','pokmon-tcg-ditto-quartet-playmat',25.00,10,2,4,NULL,NULL,'2024-11-25 22:24:27','2024-11-25 22:24:27');

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
  `wallet` float(11,2) NOT NULL DEFAULT 1000.00,
  `adress_street` varchar(300) DEFAULT NULL,
  `adress_number` varchar(20) DEFAULT NULL,
  `adress_extra` varchar(300) DEFAULT NULL,
  `adress_city` int(11) DEFAULT NULL,
  `adress_zip` varchar(20) DEFAULT NULL,
  `adress_country` char(2) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `email`, `password`, `role`, `login_token`, `avatar`, `first_name`, `last_name`, `date_of_birth`, `phone_number`, `language`, `active`, `wallet`, `adress_street`, `adress_number`, `adress_extra`, `adress_city`, `adress_zip`, `adress_country`, `created`, `updated`)
VALUES
	(7,'test@test.com','$2y$10$6/RDS5tWz3JlS6t7Kmjybe5zDfDi..vyBwo40X0w17ZQcAjLE80F2',0,'1083e1f9b93d9af046374d9b1eda65cf5726f4ffe64745ed264acc2dfcc41ed4','https://media.istockphoto.com/id/1437816897/nl/foto/business-woman-manager-or-human-resources-portrait-for-career-success-company-we-are-hiring-or.jpg?s=612x612&w=0&k=20&c=Y3jQM2Q5nPfpt1Pj9Rnvl8cn8RFssbf3yu_xGnc2lds=','Jane','Doe','2000-08-11','123-456-7890','EN',1,120.00,NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-18 22:20:42','2024-11-26 20:26:20'),
	(8,'ben@test.com','$2y$10$HBDF1HXZWzM0pePqPa/omerDn9epYwGEkXJCO.QIEpk7dOYH.SvY.',0,NULL,'https://res.cloudinary.com/codinari/image/upload/v1732362678/rxtz6j9unmhj7wliqdya.jpg',NULL,NULL,NULL,NULL,'EN',1,100.00,NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-18 22:22:07','2024-11-18 22:22:07'),
	(9,'bendevos@cardforge.eu','$2y$10$p.EmsmSRkbLktSNfxyLlae2A9lnJvmxv98TIbHx2/JqWX2EFlcZ3m',1,'7180e7fb5d882e11a0685a7c1024677eceada4ab534b6f4624fc4b232c667792','https://res.cloudinary.com/codinari/image/upload/v1732375312/jangryq0x9hrksd4vdri.jpg',NULL,NULL,NULL,NULL,'EN',1,1000.00,NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-19 17:29:03','2024-11-26 09:52:45');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table wishlist
# ------------------------------------------------------------

DROP TABLE IF EXISTS `wishlist`;

CREATE TABLE `wishlist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
