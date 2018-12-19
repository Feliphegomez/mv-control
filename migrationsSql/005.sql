-- --------------------------------------------------------
-- Host:                         181.129.16.205
-- Versión del servidor:         5.7.24-0ubuntu0.16.04.1 - (Ubuntu)
-- SO del servidor:              Linux
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla admin_mvcontrol.arl
CREATE TABLE IF NOT EXISTS `arl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `id` (`id`),
  KEY `code_key` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.attached_files
CREATE TABLE IF NOT EXISTS `attached_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '0',
  `patch` varchar(250) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.blood_rhs
CREATE TABLE IF NOT EXISTS `blood_rhs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.blood_types
CREATE TABLE IF NOT EXISTS `blood_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.categorys_lots
CREATE TABLE IF NOT EXISTS `categorys_lots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.categorys_services
CREATE TABLE IF NOT EXISTS `categorys_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.categorys_vehicles
CREATE TABLE IF NOT EXISTS `categorys_vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.citys
CREATE TABLE IF NOT EXISTS `citys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `department` int(2) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `departamento_id` (`department`),
  KEY `id` (`id`),
  CONSTRAINT `FK_citys_departments_citys` FOREIGN KEY (`department`) REFERENCES `departments_citys` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1101 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.clients
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_type` int(11) NOT NULL COMMENT 'Tipo de cliente',
  `identification_type` int(11) NOT NULL COMMENT 'Tipo de identificacion',
  `identification_number` varchar(25) DEFAULT NULL COMMENT 'Numero de identificacion',
  `social_reason` varchar(100) DEFAULT NULL COMMENT 'Razon social',
  `tradename` varchar(100) DEFAULT NULL COMMENT 'Nombre comercial',
  `society_type` int(11) NOT NULL COMMENT 'Tipo de sociedad',
  `phone` varchar(20) DEFAULT NULL COMMENT 'Telefono Fijo',
  `phone_mobile` varchar(20) DEFAULT NULL COMMENT 'Telefono Movil',
  `mail` varchar(200) DEFAULT NULL COMMENT 'Correo Electronico',
  `address` varchar(100) DEFAULT NULL COMMENT 'Direccion principal',
  `department_city` int(11) NOT NULL COMMENT 'Departamento de Ciudad',
  `city` int(11) NOT NULL COMMENT 'Ciudad',
  `legal_representative` varchar(250) NOT NULL,
  `comments` text COMMENT 'Observaciones',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `identification_number` (`identification_number`),
  KEY `society_type_id` (`society_type`),
  KEY `city_id` (`city`),
  KEY `FK_clientes_clientes` (`client_type`),
  KEY `FK_clientes_identification_types` (`identification_type`),
  KEY `FK_clients_departments_citys` (`department_city`),
  CONSTRAINT `FK_clientes_clientes` FOREIGN KEY (`client_type`) REFERENCES `client_types` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_clientes_identification_types` FOREIGN KEY (`identification_type`) REFERENCES `identification_types` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_clientes_society_types` FOREIGN KEY (`society_type`) REFERENCES `society_types` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_clients_citys` FOREIGN KEY (`city`) REFERENCES `citys` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_clients_departments_citys` FOREIGN KEY (`department_city`) REFERENCES `departments_citys` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.client_types
CREATE TABLE IF NOT EXISTS `client_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.compensation_funds
CREATE TABLE IF NOT EXISTS `compensation_funds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.contacts_clients
CREATE TABLE IF NOT EXISTS `contacts_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `second_name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) NOT NULL,
  `second_surname` varchar(50) DEFAULT NULL,
  `identification_number` varchar(50) NOT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `number_phone` varchar(50) NOT NULL,
  `number_mobile` varchar(50) DEFAULT NULL,
  `charge` varchar(50) DEFAULT NULL,
  `area` varchar(50) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_contacts_clients_clients` (`client`),
  CONSTRAINT `FK_contacts_clients_clients` FOREIGN KEY (`client`) REFERENCES `clients` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.contacts_employee
CREATE TABLE IF NOT EXISTS `contacts_employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `second_name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) NOT NULL,
  `second_surname` varchar(50) DEFAULT NULL,
  `identification_number` varchar(50) NOT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `number_phone` varchar(50) NOT NULL,
  `number_mobile` varchar(50) DEFAULT NULL,
  `relationship` varchar(50) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_contacts_clients_clients` (`employee`),
  CONSTRAINT `FK_contacts_employee_contacts_employee` FOREIGN KEY (`employee`) REFERENCES `persons` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.contractors
CREATE TABLE IF NOT EXISTS `contractors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identification_number` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`identification_number`),
  KEY `id` (`id`),
  KEY `code_key` (`identification_number`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.departments_citys
CREATE TABLE IF NOT EXISTS `departments_citys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.drivers_vehicles
CREATE TABLE IF NOT EXISTS `drivers_vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle` int(11) NOT NULL,
  `employee` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_severance_funds_vehicles` (`vehicle`),
  KEY `FK_severance_funds_persons` (`employee`),
  CONSTRAINT `FK_severance_funds_persons` FOREIGN KEY (`employee`) REFERENCES `persons` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_severance_funds_vehicles` FOREIGN KEY (`vehicle`) REFERENCES `vehicles` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.employee_charges
CREATE TABLE IF NOT EXISTS `employee_charges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.employee_tasks
CREATE TABLE IF NOT EXISTS `employee_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.environmental_authorities
CREATE TABLE IF NOT EXISTS `environmental_authorities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.eps
CREATE TABLE IF NOT EXISTS `eps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `id` (`id`),
  KEY `code_key` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.fortnights
CREATE TABLE IF NOT EXISTS `fortnights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.fuel_types
CREATE TABLE IF NOT EXISTS `fuel_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.identification_types
CREATE TABLE IF NOT EXISTS `identification_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.lots
CREATE TABLE IF NOT EXISTS `lots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `zone` int(11) NOT NULL,
  `area` text,
  `payment_type` int(11) NOT NULL,
  `address` text NOT NULL,
  `fortnight` int(11) NOT NULL,
  `latitude` text,
  `longitude` text,
  `description` text,
  `status_registration` int(11) NOT NULL,
  `department_city` int(11) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `id` (`id`),
  KEY `code_key` (`code`),
  KEY `FK_lots_categorys_lots` (`category`),
  KEY `FK_lots_fortnights` (`fortnight`),
  KEY `FK_lots_payments_types` (`payment_type`),
  KEY `FK_lots_zones` (`zone`),
  KEY `FK_lots_status_registrations` (`status_registration`),
  KEY `FK_lots_departments_citys` (`department_city`),
  KEY `FK_lots_citys` (`city`),
  CONSTRAINT `FK_lots_categorys_lots` FOREIGN KEY (`category`) REFERENCES `categorys_lots` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_lots_citys` FOREIGN KEY (`city`) REFERENCES `citys` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_lots_departments_citys` FOREIGN KEY (`department_city`) REFERENCES `departments_citys` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_lots_fortnights` FOREIGN KEY (`fortnight`) REFERENCES `fortnights` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_lots_payments_types` FOREIGN KEY (`payment_type`) REFERENCES `payments_types` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_lots_status_registrations` FOREIGN KEY (`status_registration`) REFERENCES `status_registrations` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_lots_zones` FOREIGN KEY (`zone`) REFERENCES `zones` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.novelty_types
CREATE TABLE IF NOT EXISTS `novelty_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.payments_types
CREATE TABLE IF NOT EXISTS `payments_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `title` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.pension_funds
CREATE TABLE IF NOT EXISTS `pension_funds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `permissions` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Tabla para permisos / Roles';

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.persons
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
  `company_date_out` date DEFAULT NULL,
  `company_mail` varchar(50) DEFAULT NULL,
  `company_number_phone` varchar(50) DEFAULT NULL,
  `company_number_mobile` varchar(50) DEFAULT NULL,
  `avatar` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `eps` int(11) NOT NULL,
  `arl` int(11) NOT NULL,
  `pension_fund` int(11) NOT NULL,
  `compensation_fund` int(11) NOT NULL,
  `severance_fund` int(11) NOT NULL,
  `observations` text,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_persons_identification_types` (`identification_type`),
  KEY `FK_persons_eps` (`eps`),
  KEY `FK_persons_arl` (`arl`),
  KEY `FK_persons_status_employee` (`status`),
  KEY `FK_persons_blood_types` (`blood_type`),
  KEY `FK_persons_blood_rhs` (`blood_rh`),
  KEY `FK_persons_pension_funds` (`pension_fund`),
  KEY `FK_persons_compensation_funds` (`compensation_fund`),
  KEY `FK_persons_severance_funds` (`severance_fund`),
  CONSTRAINT `FK_persons_arl` FOREIGN KEY (`arl`) REFERENCES `arl` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_persons_blood_rhs` FOREIGN KEY (`blood_rh`) REFERENCES `blood_rhs` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_persons_blood_types` FOREIGN KEY (`blood_type`) REFERENCES `blood_types` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_persons_compensation_funds` FOREIGN KEY (`compensation_fund`) REFERENCES `compensation_funds` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_persons_eps` FOREIGN KEY (`eps`) REFERENCES `eps` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_persons_identification_types` FOREIGN KEY (`identification_type`) REFERENCES `identification_types` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_persons_pension_funds` FOREIGN KEY (`pension_fund`) REFERENCES `pension_funds` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_persons_severance_funds` FOREIGN KEY (`severance_fund`) REFERENCES `drivers_vehicles` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_persons_status_employee` FOREIGN KEY (`status`) REFERENCES `status_employee` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.services
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `category` int(11) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `description` text NOT NULL,
  `price` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `id` (`id`),
  KEY `FK_services_payments_types` (`payment_type`),
  KEY `FK_services_categorys_services` (`category`),
  CONSTRAINT `FK_services_categorys_services` FOREIGN KEY (`category`) REFERENCES `categorys_services` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_services_payments_types` FOREIGN KEY (`payment_type`) REFERENCES `payments_types` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.severance_funds
CREATE TABLE IF NOT EXISTS `severance_funds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.society_types
CREATE TABLE IF NOT EXISTS `society_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.status_employee
CREATE TABLE IF NOT EXISTS `status_employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.status_registrations
CREATE TABLE IF NOT EXISTS `status_registrations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.status_services
CREATE TABLE IF NOT EXISTS `status_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `color` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`color`),
  KEY `id` (`id`),
  KEY `code_key` (`color`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.status_vehicles
CREATE TABLE IF NOT EXISTS `status_vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.users
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
  CONSTRAINT `FK_users_profiles` FOREIGN KEY (`profile_id`) REFERENCES `persons` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_users_rols` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Tabla para los usuarios / LogIn';

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.vehicles
CREATE TABLE IF NOT EXISTS `vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `license_plate` varchar(50) NOT NULL COMMENT 'Placa',
  `brand` varchar(150) NOT NULL COMMENT 'Marca',
  `model` varchar(150) NOT NULL COMMENT 'Modelo',
  `category` int(11) NOT NULL COMMENT 'Tipo de vehiculo',
  `passangers_capacity` int(11) NOT NULL COMMENT 'Capacidad de pasajeros',
  `fuel` int(11) NOT NULL COMMENT 'Combustible',
  `cilindraje` varchar(50) NOT NULL COMMENT 'Cilindraje',
  `holder` varchar(50) NOT NULL COMMENT 'Titular',
  `identification_number_propietary` varchar(50) NOT NULL COMMENT 'Numero de identificacion del propietario',
  `name_propietary` varchar(250) NOT NULL COMMENT 'Nombre propietario',
  `card_propiety_number` varchar(250) NOT NULL COMMENT 'Numero Tarjeta Propiedad',
  `chassis_number` varchar(100) NOT NULL COMMENT 'Numero chasis',
  `soat_number` varchar(100) NOT NULL COMMENT 'Numero SOAT',
  `third_party_number` varchar(100) NOT NULL COMMENT 'Numero Poliza Terceros',
  `soat_date_expiration` date NOT NULL COMMENT 'Fecha Vencimiento SOAT',
  `third_party_date_expiration` date NOT NULL COMMENT 'Fecha Vencimiento Poliza Terceros',
  `capacity_with_enhancement` varchar(100) NOT NULL COMMENT 'Capacidad con Realce',
  `capacity_without_enhancement` varchar(100) NOT NULL COMMENT 'Capacidad sin Realce',
  `base_weight` varchar(100) NOT NULL COMMENT 'Peso Base Vehiculo',
  `status` int(11) NOT NULL COMMENT 'Estado',
  `property_card_attachment` varchar(100) DEFAULT NULL COMMENT 'Adjunto Tarjeta Propiedad',
  `soat_attachment` varchar(100) DEFAULT NULL COMMENT 'Adjunto SOAT',
  `third_party_attachment` varchar(100) DEFAULT NULL COMMENT 'Adjunto Poliza Terceros',
  `chassis_attachment` varchar(100) DEFAULT NULL COMMENT 'Adjunto Chasis',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_vehicles_categorys_vehicles` (`category`),
  KEY `FK_vehicles_fuel_types` (`fuel`),
  KEY `FK_vehicles_status_vehicles` (`status`),
  CONSTRAINT `FK_vehicles_categorys_vehicles` FOREIGN KEY (`category`) REFERENCES `categorys_vehicles` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_vehicles_fuel_types` FOREIGN KEY (`fuel`) REFERENCES `fuel_types` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_vehicles_status_vehicles` FOREIGN KEY (`status`) REFERENCES `status_vehicles` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla admin_mvcontrol.zones
CREATE TABLE IF NOT EXISTS `zones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

