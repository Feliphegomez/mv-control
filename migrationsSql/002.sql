-- --------------------------------------------------------
-- Host:                         181.129.16.203
-- Versión del servidor:         5.7.24-0ubuntu0.16.04.1 - (Ubuntu)
-- SO del servidor:              Linux
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para app_mv
DROP DATABASE IF EXISTS `app_mv`;
CREATE DATABASE IF NOT EXISTS `app_mv` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `app_mv`;

-- Volcando estructura para tabla app_mv.permissions
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `permissions` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Tabla para permisos / Roles';

-- Volcando datos para la tabla app_mv.permissions: ~1 rows (aproximadamente)
DELETE FROM `permissions`;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`, `permissions`) VALUES
	(1, 'Ninguno', '{}');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Volcando estructura para tabla app_mv.persons
DROP TABLE IF EXISTS `persons`;
CREATE TABLE IF NOT EXISTS `persons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `second_name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) NOT NULL,
  `second_surname` varchar(50) DEFAULT NULL,
  `identification_type` int(11) NOT NULL DEFAULT '0',
  `identification_number` varchar(50) NOT NULL,
  `identification_date_expedition` date NOT NULL,
  `birthdate` date NOT NULL,
  `blood_type` int(11) NOT NULL,
  `blood_rh` int(11) NOT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `number_phone` varchar(50) NOT NULL,
  `number_mobile` varchar(50) DEFAULT NULL,
  `company_date_entry` date DEFAULT NULL,
  `company_mail` varchar(50) DEFAULT NULL,
  `company_number_phone` varchar(50) DEFAULT NULL,
  `company_number_mobile` varchar(50) DEFAULT NULL,
  `gang` int(11) NOT NULL,
  `avatar` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `eps` int(11) NOT NULL,
  `arl` int(11) NOT NULL,
  `pension_fund` int(11) NOT NULL,
  `compensation_fund` int(11) NOT NULL,
  `severance_fund` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla app_mv.persons: ~0 rows (aproximadamente)
DELETE FROM `persons`;
/*!40000 ALTER TABLE `persons` DISABLE KEYS */;
INSERT INTO `persons` (`id`, `first_name`, `second_name`, `surname`, `second_surname`, `identification_type`, `identification_number`, `identification_date_expedition`, `birthdate`, `blood_type`, `blood_rh`, `mail`, `number_phone`, `number_mobile`, `company_date_entry`, `company_mail`, `company_number_phone`, `company_number_mobile`, `gang`, `avatar`, `status`, `eps`, `arl`, `pension_fund`, `compensation_fund`, `severance_fund`) VALUES
	(1, 'Andres', 'Felipe', 'Gomez', 'Maya', 1, '1035429360', '2018-11-25', '2018-11-25', 1, 1, 'feliphegomez@gmail.com', '2745002', '3005473082', '2018-11-25', 'soporte@mv.com', NULL, NULL, 0, 0, 1, 1, 1, 1, 1, 1);
/*!40000 ALTER TABLE `persons` ENABLE KEYS */;

-- Volcando estructura para tabla app_mv.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `hash` text NOT NULL,
  `permission_id` int(11) NOT NULL DEFAULT '0',
  `profile_id` int(11) NOT NULL DEFAULT '0',
  `create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_by` int(11) NOT NULL,
  `change` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `change_by` int(11) NOT NULL,
  `delete` timestamp NULL DEFAULT NULL,
  `delete_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `role_id` (`permission_id`),
  KEY `id` (`id`),
  KEY `profile_id` (`profile_id`),
  CONSTRAINT `FK_users_profiles` FOREIGN KEY (`profile_id`) REFERENCES `persons` (`id`),
  CONSTRAINT `FK_users_rols` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Tabla para los usuarios / LogIn';

-- Volcando datos para la tabla app_mv.users: ~2 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `hash`, `permission_id`, `profile_id`, `create`, `create_by`, `change`, `change_by`, `delete`, `delete_by`) VALUES
	(1, 'myuser', '1234', 1, 1, '2018-11-25 21:59:42', 0, '2018-11-25 22:00:35', 1, NULL, NULL),
	(2, 'fg', '1035429360', 1, 1, '2018-11-25 22:01:18', 1, '2018-11-25 22:01:30', 1, NULL, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
