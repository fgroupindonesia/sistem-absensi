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
/*DROP DATABASE IF EXISTS `db_fgi_sistem_absensi_v1`;
//CREATE DATABASE IF NOT EXISTS `db_fgi_sistem_absensi_v1` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `fgroupin_sistem_absensi_v1`;

-- Dumping structure for table db_fgi_sistem_absensi_v1.table_attendance
DROP TABLE IF EXISTS `table_attendance`;
CREATE TABLE IF NOT EXISTS `table_attendance` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `id_staff` varchar(4) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(75) NOT NULL,
  `public_token` varchar(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_fgi_sistem_absensi_v1.table_attendance: ~0 rows (approximately)

-- Dumping structure for table db_fgi_sistem_absensi_v1.table_bugs_report
DROP TABLE IF EXISTS `table_bugs_report`;
CREATE TABLE IF NOT EXISTS `table_bugs_report` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(75) NOT NULL,
  `priority_bugs` tinyint(1) NOT NULL,
  `description` varchar(200) NOT NULL,
  `screenshot` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `public_token` varchar(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_fgi_sistem_absensi_v1.table_bugs_report: ~0 rows (approximately)

-- Dumping structure for table db_fgi_sistem_absensi_v1.table_membership
DROP TABLE IF EXISTS `table_membership`;
CREATE TABLE IF NOT EXISTS `table_membership` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) NOT NULL,
  `quota_used` int(9) NOT NULL,
  `quota_limit` int(9) NOT NULL,
  `public_token` varchar(7) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table db_fgi_sistem_absensi_v1.table_membership: ~1 rows (approximately)
REPLACE INTO `table_membership` (`id`, `name`, `quota_used`, `quota_limit`, `public_token`, `date_created`) VALUES
	(7, 'gratis', 0, 5, '3N5n9CQ', '2024-01-19 19:52:28');

-- Dumping structure for table db_fgi_sistem_absensi_v1.table_staff
DROP TABLE IF EXISTS `table_staff`;
CREATE TABLE IF NOT EXISTS `table_staff` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) NOT NULL,
  `unit_division` varchar(75) NOT NULL,
  `whatsapp` varchar(75) NOT NULL,
  `email` varchar(75) NOT NULL,
  `kelamin` tinyint(1) NOT NULL,
  `status` varchar(75) NOT NULL,
  `notes` varchar(200) NOT NULL,
  `number_ic` varchar(75) NOT NULL,
  `public_token` varchar(7) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table db_fgi_sistem_absensi_v1.table_staff: ~1 rows (approximately)
REPLACE INTO `table_staff` (`id`, `name`, `unit_division`, `whatsapp`, `email`, `kelamin`, `status`, `notes`, `number_ic`, `public_token`, `date_created`) VALUES
	(5, 'testing brooo', 'cobain', '929292', 'pria@home.com', 1, 'non-aktif', 'testing brooo', '2929292', '3N5n9CQ', '2024-01-23 20:37:55');

-- Dumping structure for table db_fgi_sistem_absensi_v1.table_user
DROP TABLE IF EXISTS `table_user`;
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table db_fgi_sistem_absensi_v1.table_user: ~1 rows (approximately)
REPLACE INTO `table_user` (`id`, `username`, `pass`, `email`, `user_type`, `whatsapp`, `address`, `avatar`, `public_profile`, `country`, `city`, `bio`, `membership`, `status`, `public_token`, `date_created`) VALUES
	(9, 'contohx', 'contohx', 'contohx@gmail.com', 'company', '9929292', '-', 'sample.jpg', 0, 'indonesia', '-', '-', 'gratis', 'active', '3N5n9CQ', '2024-01-19 19:52:28');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
