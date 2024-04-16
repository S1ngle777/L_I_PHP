-- --------------------------------------------------------
-- Хост:                         localhost
-- Версия сервера:               11.3.2-MariaDB - mariadb.org binary distribution
-- Операционная система:         Win64
-- HeidiSQL Версия:              12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Дамп структуры базы данных event_platform
CREATE DATABASE IF NOT EXISTS `event_platform` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE `event_platform`;

-- Дамп структуры для таблица event_platform.events
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `number_seats` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Дамп данных таблицы event_platform.events: ~3 rows (приблизительно)
INSERT INTO `events` (`id`, `name`, `price`, `number_seats`, `date`) VALUES
	(1, 'Circus', 100.00, 50, '2023-12-31 12:00:00'),
	(2, 'New Year', 200.00, 100, '2024-01-01 00:00:00'),
	(3, 'Day of the city', 0.00, 150, '2024-04-12 18:00:00');

-- Дамп структуры для таблица event_platform.event_records
CREATE TABLE IF NOT EXISTS `event_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `event_id` (`event_id`),
  CONSTRAINT `event_records_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `event_records_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Дамп данных таблицы event_platform.event_records: ~4 rows (приблизительно)
INSERT INTO `event_records` (`id`, `user_id`, `event_id`) VALUES
	(1, 2, 1),
	(2, 2, 1),
	(3, 3, 1),
	(4, 4, 3);

-- Дамп структуры для таблица event_platform.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Дамп данных таблицы event_platform.roles: ~2 rows (приблизительно)
INSERT INTO `roles` (`id`, `name`) VALUES
	(1, 'manager'),
	(2, 'user');

-- Дамп структуры для таблица event_platform.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Дамп данных таблицы event_platform.users: ~5 rows (приблизительно)
INSERT INTO `users` (`id`, `name`, `surname`, `email`, `role_id`, `token`, `password`) VALUES
	(1, 'John', 'Doe', 'john.doe@example.com', 1, NULL, NULL),
	(2, 'Jane', 'Doe', 'jane.doe@example.com', 2, NULL, NULL),
	(3, '123', '123', '123@gmail.com', 1, NULL, '$2y$10$VQx28hOTYtISNdPrWCOTIOUOJTtoKlNKX0T09mLnfH4RCNkgOvu4C'),
	(4, 'Nikita', 'Nikita', 'nikita@gmail.com', 2, NULL, '$2y$10$Yq/sXtQlY7uFhyKcXlYfKegL6F7aOj2kpent98.aQ31UkLsF9wQBq'),
	(5, 'admin', 'admin', 'admin@gmail.com', 1, NULL, '$2y$10$CdEIgpa6Zb1LfSdpSkhogenEcbVHYZXtFqVV.bkIGTvl2Pa6dVkmu');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
