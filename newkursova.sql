-- --------------------------------------------------------
-- Сервер:                       127.0.0.1
-- Версія сервера:               8.0.29 - MySQL Community Server - GPL
-- ОС сервера:                   Win64
-- HeidiSQL Версія:              12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Структура бази даних "kursova"
CREATE DATABASE IF NOT EXISTS `kursova` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `kursova`;


-- Структура таблиці "bookmarks"
CREATE TABLE IF NOT EXISTS `bookmarks` (
  `id_users` int NOT NULL,
  `bookmark_id` int unsigned DEFAULT NULL,
  KEY `Індекс 1` (`id_users`),
  CONSTRAINT `FK_bookmarks_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дані для таблиці "bookmarks"
INSERT INTO `bookmarks` (`id_users`, `bookmark_id`) VALUES
	(4, 1),
	(4, 4),
	(4, 5);

-- Структура таблиці "smartphone"
CREATE TABLE IF NOT EXISTS `smartphone` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `vendor` int unsigned NOT NULL,
  `model` varchar(30) NOT NULL,
  `descript` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8_general_ci DEFAULT NULL,
  `soc` varchar(30) DEFAULT NULL COMMENT 'type',
  `battery` smallint unsigned DEFAULT NULL COMMENT 'mah',
  `display` varchar(12) DEFAULT NULL COMMENT 'resolution',
  `display_type` varchar(12) DEFAULT NULL COMMENT 'type',
  `ram` smallint unsigned DEFAULT NULL COMMENT 'gb',
  `rom` smallint unsigned DEFAULT NULL COMMENT 'gb',
  `weight` smallint unsigned DEFAULT NULL COMMENT 'gram',
  `cam_r1` smallint unsigned DEFAULT NULL COMMENT 'megapixels',
  `cam_r2` smallint unsigned DEFAULT NULL,
  `cam_r3` smallint unsigned DEFAULT NULL,
  `cam_r4` smallint unsigned DEFAULT NULL,
  `cam_f1` smallint unsigned DEFAULT NULL,
  `cam_f2` smallint unsigned DEFAULT NULL,
  `gsm` varchar(30) DEFAULT NULL,
  `os` varchar(20) DEFAULT NULL,
  `diagonal` float DEFAULT NULL,
  `img` varchar(250) DEFAULT NULL,
  `price` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vendor` (`vendor`),
  CONSTRAINT `smartphone_ibfk_1` FOREIGN KEY (`vendor`) REFERENCES `vendor_list` (`id_vendor`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Дані для таблиці "smartphone"
INSERT INTO `smartphone` (`id`, `vendor`, `model`, `descript`, `soc`, `battery`, `display`, `display_type`, `ram`, `rom`, `weight`, `cam_r1`, `cam_r2`, `cam_r3`, `cam_r4`, `cam_f1`, `cam_f2`, `gsm`, `os`, `diagonal`, `img`, `price`) VALUES
	(1, 1, 'Galaxy S7 Edge', 'Натхненні роботами майстрів по склу та ковалів, творці Samsung Galaxy S7 Edge унікальним чином поєднали в ньому майстерність виготовлення зі скла та металу. Створення фантастичного дизайну з чарівними округлими лініями вигину та блискучою скляною поверхнею, що відображає широкий спектр приголомшливих кольорів.', 'Samsung Exynos 8890', 3600, '1440x2560', 'AMOLED', 4, 32, 157, 12, NULL, NULL, NULL, 5, NULL, 'LTE, 3G, 2G', 'Android 8', 5.5, '/img/smartphones/sgs7edge.png', 4000),
	(2, 1, 'Galaxy J5 2017', 'Лінійка J у класифікації Samsung відноситься до початкового рівня, при цьому в ній можна зустріти як найдешевші моделі, так і апарати вартістю 20 000 рублів, які замикають лінійку зверху.', 'Samsung Exynos 7870', 3000, '720x1280', 'Super AMOLED', 2, 16, 160, 13, NULL, NULL, NULL, 13, NULL, 'LTE, 3G, 2G', 'Android 9', 5.2, '/img/smartphones/j5.jpg', 3500),
	(3, 2, 'Redmi Note 8 Pro', 'Робити бізнес, продаючи продукти першої ціни, це завдання не з легких, тому що завжди знайдеться той, хто запропонує ще дешевше. З цієї причини Xiaomi вирішили трохи перепозиціонувати.', 'MediaTek Helio G90T', 4500, '1080x2340', 'IPS', 6, 128, 200, 64, 8, 2, 2, 20, NULL, 'LTE, 3G, 2G', 'Android 10', 6.53, '/img/smartphones/note8pro.jpg', 8000),
	(4, 3, 'iPhone 11', 'Кохання з першого, другого, третього, четвертого, п''ятого, шостого погляду.', 'Apple A13 Bionic', 3110, '828x1792', 'IPS', 4, 64, 194, 12, 12, NULL, NULL, 12, NULL, 'LTE, 3G, 2G', 'iOS', 6.1, '/img/smartphones/iphone11.jpg', 20000),
	(5, 2, 'Redmi Note 8 Pro', NULL, 'Octa-core Max', 4500, '2340x1080', 'IPS', 6, 128, 200, 64, 8, 2, NULL, 2, NULL, 'LTE, 3G, 4G', 'Android 9', 6.53, 'img/smartphones/2RedmiNote8Pro.jpg', 6499);

-- Структура таблиці "users"
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  `login` varchar(30) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `permission` varchar(5) DEFAULT NULL,
  `bookmark` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bookmark` (`bookmark`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- Дані для таблиці "users"
INSERT INTO `users` (`id`, `name`, `login`, `email`, `password`, `permission`, `bookmark`) VALUES
	(4, 'AsmoOne', 'asmoone', 'taras.shynkler.it.2017@lpnu.ua', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'admin', 0),
	(5, 'Kate', 'test', 'katepavlenko14@ukr.net', 'b13c834a65a1c4638ed560d9623f298a09c221d6', 'user', 0),
	(7, 'test', 'test', 'test@test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'user', 0);

-- Структура таблиці "vendor_list"
CREATE TABLE IF NOT EXISTS `vendor_list` (
  `id_vendor` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id_vendor`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Дані для таблиці "vendor_list"
INSERT INTO `vendor_list` (`id_vendor`, `name`) VALUES
	(1, 'Samsung'),
	(2, 'Xiaomi'),
	(3, 'Apple'),
	(4, 'OnePlus');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
