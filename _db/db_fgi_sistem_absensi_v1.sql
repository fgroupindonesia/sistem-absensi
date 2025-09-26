-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.6-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_fgi_sistem_absensi_v1
USE `hestiacpadmin_sistem_absensi_v1`;

-- Dumping structure for table db_fgi_sistem_absensi_v1.table_attendance
CREATE TABLE IF NOT EXISTS `table_attendance` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `id_staff` varchar(4) NOT NULL,
  `signature_pic` varchar(50) DEFAULT NULL,
  `status` enum('hadir','pulang','lembur','izin sakit') DEFAULT NULL,
  `public_token` varchar(7) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_fgi_sistem_absensi_v1.table_bugs_consultation
CREATE TABLE IF NOT EXISTS `table_bugs_consultation` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(75) NOT NULL,
  `priority_bugs` tinyint(1) NOT NULL,
  `description` varchar(200) NOT NULL,
  `screenshot` varchar(200) NOT NULL DEFAULT 'none.jpg',
  `url` varchar(200) NOT NULL,
  `status` enum('pending','under review','cancelled','accepted') DEFAULT NULL,
  `type_work` enum('consultation','bugs') DEFAULT 'bugs',
  `public_token` varchar(7) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_fgi_sistem_absensi_v1.table_checkpoint
CREATE TABLE IF NOT EXISTS `table_checkpoint` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patokan` enum('event','kordinat') DEFAULT NULL,
  `jenis` enum('statis','dinamis') DEFAULT NULL,
  `name` text DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `long` double DEFAULT 0,
  `lat` double DEFAULT 0,
  `status` enum('active','inactive') DEFAULT NULL,
  `data_embed` text DEFAULT NULL,
  `qr_code` varchar(75) DEFAULT NULL,
  `public_token` varchar(50) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_fgi_sistem_absensi_v1.table_division
CREATE TABLE IF NOT EXISTS `table_division` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `division_name` varchar(50) DEFAULT NULL,
  `public_token` varchar(50) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_fgi_sistem_absensi_v1.table_membership
CREATE TABLE IF NOT EXISTS `table_membership` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) NOT NULL,
  `quota_used` int(9) NOT NULL,
  `quota_limit` int(9) NOT NULL,
  `public_token` varchar(7) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_fgi_sistem_absensi_v1.table_staff
CREATE TABLE IF NOT EXISTS `table_staff` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) NOT NULL,
  `unit_division` varchar(75) NOT NULL,
  `division_id` int(11) DEFAULT NULL,
  `whatsapp` varchar(75) NOT NULL,
  `email` varchar(75) NOT NULL,
  `kelamin` tinyint(1) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'inactive',
  `notes` varchar(200) NOT NULL,
  `number_ic` varchar(75) NOT NULL,
  `public_token` varchar(7) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_fgi_sistem_absensi_v1.table_user
CREATE TABLE IF NOT EXISTS `table_user` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(75) NOT NULL,
  `pass` varchar(75) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_type` varchar(75) NOT NULL,
  `whatsapp` varchar(75) NOT NULL,
  `address` varchar(200) NOT NULL,
  `avatar` varchar(100) NOT NULL DEFAULT 'sample.jpg',
  `public_profile` tinyint(1) NOT NULL DEFAULT 0,
  `country` varchar(75) NOT NULL,
  `city` varchar(75) NOT NULL,
  `bio` varchar(200) NOT NULL,
  `membership` varchar(75) NOT NULL DEFAULT 'gratis',
  `status` varchar(7) NOT NULL DEFAULT 'pending',
  `public_token` varchar(7) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
