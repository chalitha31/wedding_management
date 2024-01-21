-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.26 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for wedding_management
CREATE DATABASE IF NOT EXISTS `wedding_management` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `wedding_management`;

-- Dumping structure for table wedding_management.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `otp` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `type` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`email`),
  KEY `FK_admin_admin_type` (`type`),
  CONSTRAINT `FK_admin_admin_type` FOREIGN KEY (`type`) REFERENCES `admin_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.admin: ~0 rows (approximately)
INSERT INTO `admin` (`email`, `fname`, `lname`, `otp`, `type`, `status`) VALUES
	('chalithachamod3031@gmail.com', 'chalitha', 'chamod', '64ead74c13e5f', 1, 0);

-- Dumping structure for table wedding_management.admin_type
CREATE TABLE IF NOT EXISTS `admin_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.admin_type: ~2 rows (approximately)
INSERT INTO `admin_type` (`id`, `name`) VALUES
	(1, 'super admin'),
	(2, 'admin');

-- Dumping structure for table wedding_management.booking_payment
CREATE TABLE IF NOT EXISTS `booking_payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(50) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `booking_id` int DEFAULT NULL,
  `card_num` varchar(20) DEFAULT NULL,
  `card_year` varchar(6) DEFAULT NULL,
  `card-month` varchar(5) DEFAULT NULL,
  `paymentNo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `total` double DEFAULT NULL,
  `Amount_paid` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_booking_payment_users` (`user_email`),
  KEY `FK_booking_payment_category` (`category_id`),
  CONSTRAINT `FK_booking_payment_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_booking_payment_users` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.booking_payment: ~3 rows (approximately)
INSERT INTO `booking_payment` (`id`, `user_email`, `category_id`, `booking_id`, `card_num`, `card_year`, `card-month`, `paymentNo`, `date`, `total`, `Amount_paid`) VALUES
	(1, 'cchamod93@gmail.com', 0, 1, '4724474545474744', '2030', '7', '174476', '2023-08-23 00:34:53', 500000, 200000),
	(2, 'cchamod93@gmail.com', 3, 1, '5684678878677867', '2027', '6', '182472', '2023-08-24 21:48:46', 0, 1000),
	(3, 'cchamod93@gmail.com', 0, 2, '5665565656565656', '2024', '4', '196687', '2023-08-24 21:57:29', 1000000, 200000),
	(4, 'cchamod93@gmail.com', 0, 3, '2343435345655476', '2029', '2', '170162', '2023-08-24 22:04:12', 500000, 100000);

-- Dumping structure for table wedding_management.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.category: ~4 rows (approximately)
INSERT INTO `category` (`id`, `name`) VALUES
	(0, '\r\nHotels'),
	(1, 'Dj'),
	(2, 'Photography'),
	(3, 'Vehicles');

-- Dumping structure for table wedding_management.condition
CREATE TABLE IF NOT EXISTS `condition` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.condition: ~2 rows (approximately)
INSERT INTO `condition` (`id`, `name`) VALUES
	(1, 'available'),
	(2, 'not available');

-- Dumping structure for table wedding_management.district
CREATE TABLE IF NOT EXISTS `district` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `province_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_district_province` (`province_id`),
  CONSTRAINT `FK_district_province` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.district: ~25 rows (approximately)
INSERT INTO `district` (`id`, `name`, `province_id`) VALUES
	(1, 'Jaffna', 3),
	(2, 'Kilinochchi', 3),
	(3, 'Mannar', 3),
	(4, 'Mullaitivu', 3),
	(5, 'Vavuniya', 3),
	(6, 'Puttalam', 6),
	(7, 'Kurunegala', 6),
	(8, 'Gampaha', 5),
	(9, 'Colombo', 5),
	(10, 'Anuradhapura', 7),
	(11, 'Polonnaruwa', 7),
	(12, 'Matale', 1),
	(13, 'Kandy', 1),
	(14, 'Nuwara Eliya', 1),
	(15, 'Kegalle', 9),
	(16, 'Ratnapura', 9),
	(17, 'Trincomalee', 2),
	(18, 'Batticaloa', 2),
	(19, 'Ampara', 2),
	(20, 'Badulla', 8),
	(21, 'Monaragala', 8),
	(22, 'Hambantota', 4),
	(23, 'Matara', 4),
	(24, 'Galle', 4),
	(25, 'kaluthara', 5);

-- Dumping structure for table wedding_management.dj
CREATE TABLE IF NOT EXISTS `dj` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `seller_email` varchar(50) DEFAULT NULL,
  `line1` varchar(50) DEFAULT NULL,
  `line2` varchar(50) DEFAULT NULL,
  `districts_id` int DEFAULT NULL,
  `discription` text,
  `company_name` varchar(50) DEFAULT NULL,
  `status` int DEFAULT '0',
  `pay_id` int DEFAULT NULL,
  `register_payment` double DEFAULT NULL,
  `register_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_dj_users` (`seller_email`),
  KEY `FK_dj_district` (`districts_id`),
  KEY `FK_dj_pay_type` (`pay_id`),
  CONSTRAINT `FK_dj_district` FOREIGN KEY (`districts_id`) REFERENCES `district` (`id`),
  CONSTRAINT `FK_dj_pay_type` FOREIGN KEY (`pay_id`) REFERENCES `pay_type` (`id`),
  CONSTRAINT `FK_dj_users` FOREIGN KEY (`seller_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.dj: ~0 rows (approximately)

-- Dumping structure for table wedding_management.dj_booking
CREATE TABLE IF NOT EXISTS `dj_booking` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `time_id` int DEFAULT NULL,
  `packag_id` int DEFAULT NULL,
  `hidden` int DEFAULT '0',
  `order_id` varchar(50) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `order_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'confirmed',
  `pay_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_dj_booking_users` (`user_email`),
  KEY `FK_dj_booking_time` (`time_id`),
  KEY `FK_dj_booking_dj_package` (`packag_id`),
  KEY `FK_dj_booking_pay_type` (`pay_id`),
  CONSTRAINT `FK_dj_booking_dj_package` FOREIGN KEY (`packag_id`) REFERENCES `dj_package` (`id`),
  CONSTRAINT `FK_dj_booking_pay_type` FOREIGN KEY (`pay_id`) REFERENCES `pay_type` (`id`),
  CONSTRAINT `FK_dj_booking_time` FOREIGN KEY (`time_id`) REFERENCES `time` (`id`),
  CONSTRAINT `FK_dj_booking_users` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.dj_booking: ~0 rows (approximately)

-- Dumping structure for table wedding_management.dj_gallary
CREATE TABLE IF NOT EXISTS `dj_gallary` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `dj_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_dj_gallary_dj` (`dj_id`) USING BTREE,
  CONSTRAINT `FK_dj_gallary_dj` FOREIGN KEY (`dj_id`) REFERENCES `dj` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.dj_gallary: ~0 rows (approximately)

-- Dumping structure for table wedding_management.dj_img_logo
CREATE TABLE IF NOT EXISTS `dj_img_logo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dj_id` int DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_dj__img_logo_dj` (`dj_id`),
  CONSTRAINT `FK_dj__img_logo_dj` FOREIGN KEY (`dj_id`) REFERENCES `dj` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.dj_img_logo: ~0 rows (approximately)

-- Dumping structure for table wedding_management.dj_package
CREATE TABLE IF NOT EXISTS `dj_package` (
  `id` int NOT NULL AUTO_INCREMENT,
  `package_type` varchar(50) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `preview_image` varchar(50) DEFAULT NULL,
  `dj_id` int DEFAULT NULL,
  `status` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_dj_package_hotels` (`dj_id`),
  CONSTRAINT `FK_dj_package_dj` FOREIGN KEY (`dj_id`) REFERENCES `dj` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.dj_package: ~0 rows (approximately)

-- Dumping structure for table wedding_management.dj_package_features
CREATE TABLE IF NOT EXISTS `dj_package_features` (
  `id` int NOT NULL AUTO_INCREMENT,
  `package_id` int DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_dj_package_features_dj_package` (`package_id`),
  CONSTRAINT `FK_dj_package_features_dj_package` FOREIGN KEY (`package_id`) REFERENCES `dj_package` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.dj_package_features: ~0 rows (approximately)

-- Dumping structure for table wedding_management.feedback
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(50) DEFAULT NULL,
  `bok_id` int DEFAULT NULL,
  `feed` text,
  `date` datetime DEFAULT NULL,
  `star` int DEFAULT NULL,
  `booking_table_id` int DEFAULT NULL,
  `status` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_feedback_users` (`user_email`),
  KEY `FK_feedback_category` (`booking_table_id`),
  CONSTRAINT `FK_feedback_category` FOREIGN KEY (`booking_table_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_feedback_users` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.feedback: ~2 rows (approximately)
INSERT INTO `feedback` (`id`, `user_email`, `bok_id`, `feed`, `date`, `star`, `booking_table_id`, `status`) VALUES
	(1, 'cchamod93@gmail.com', 1, 'good package', '2023-08-23 00:50:03', 3, 0, 0),
	(2, 'cchamod93@gmail.com', 1, 'nice', '2023-08-23 00:52:23', 4, 0, 1),
	(3, 'cchamod93@gmail.com', 3, 'fatta ', '2023-08-24 21:51:29', 3, 3, 0);

-- Dumping structure for table wedding_management.feedback_img
CREATE TABLE IF NOT EXISTS `feedback_img` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image` varchar(80) DEFAULT NULL,
  `feedback_user` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_feedback_img_feedback` (`feedback_user`),
  CONSTRAINT `FK_feedback_img_feedback` FOREIGN KEY (`feedback_user`) REFERENCES `feedback` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.feedback_img: ~0 rows (approximately)
INSERT INTO `feedback_img` (`id`, `image`, `feedback_user`) VALUES
	(2, '64e50aefbe219.jpeg', 'cchamod93@gmail.com');

-- Dumping structure for table wedding_management.gallary
CREATE TABLE IF NOT EXISTS `gallary` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image` varchar(100) DEFAULT NULL,
  `hotel_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_gallary_hotels` (`hotel_id`),
  CONSTRAINT `FK_gallary_hotels` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.gallary: ~4 rows (approximately)
INSERT INTO `gallary` (`id`, `image`, `hotel_id`) VALUES
	(1, '64e50249776ee.jpeg', 1),
	(2, '64e5024979186.jpeg', 1),
	(3, '64e502497e19c.jpeg', 1),
	(4, '64e502497ebee.jpeg', 1);

-- Dumping structure for table wedding_management.hotels
CREATE TABLE IF NOT EXISTS `hotels` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `seller_email` varchar(50) DEFAULT NULL,
  `line1` varchar(50) DEFAULT NULL,
  `line2` varchar(50) DEFAULT NULL,
  `districts_id` int DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL,
  `discription` text,
  `status` int DEFAULT '0',
  `pay_id` int DEFAULT NULL,
  `register_payment` double DEFAULT NULL,
  `register_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_hotels_users` (`seller_email`),
  KEY `FK_hotels_district` (`districts_id`),
  KEY `FK_hotels_pay_type` (`pay_id`),
  CONSTRAINT `FK_hotels_district` FOREIGN KEY (`districts_id`) REFERENCES `district` (`id`),
  CONSTRAINT `FK_hotels_pay_type` FOREIGN KEY (`pay_id`) REFERENCES `pay_type` (`id`),
  CONSTRAINT `FK_hotels_users` FOREIGN KEY (`seller_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.hotels: ~1 rows (approximately)
INSERT INTO `hotels` (`id`, `name`, `seller_email`, `line1`, `line2`, `districts_id`, `location`, `discription`, `status`, `pay_id`, `register_payment`, `register_date`) VALUES
	(1, 'Shangri-La', 'sandunpiyarathne95@gmail.com', NULL, NULL, 9, 'https://www.shangri-la.com/colombo/shangrila/weddings-celebrations/', NULL, 0, 1, 7500, '2023-08-23');

-- Dumping structure for table wedding_management.hotel_booking
CREATE TABLE IF NOT EXISTS `hotel_booking` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mobile` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `wedding_date` date NOT NULL,
  `time_id` int DEFAULT NULL,
  `packag_id` int DEFAULT NULL,
  `hidden` int DEFAULT '0',
  `order_id` varchar(50) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `order_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'confirmed',
  `pay_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_booking_users` (`user_email`) USING BTREE,
  KEY `FK_hotel_booking_time` (`time_id`),
  KEY `FK_hotel_booking_packages` (`packag_id`),
  KEY `FK_hotel_booking_pay_type` (`pay_id`),
  CONSTRAINT `FK_booking_users` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`),
  CONSTRAINT `FK_hotel_booking_packages` FOREIGN KEY (`packag_id`) REFERENCES `packages` (`id`),
  CONSTRAINT `FK_hotel_booking_pay_type` FOREIGN KEY (`pay_id`) REFERENCES `pay_type` (`id`),
  CONSTRAINT `FK_hotel_booking_time` FOREIGN KEY (`time_id`) REFERENCES `time` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.hotel_booking: ~3 rows (approximately)
INSERT INTO `hotel_booking` (`id`, `user_email`, `mobile`, `wedding_date`, `time_id`, `packag_id`, `hidden`, `order_id`, `order_date`, `order_status`, `pay_id`) VALUES
	(1, 'cchamod93@gmail.com', '0726548569', '2023-08-25', 1, 1, 0, '64e506c8174d3', '2023-08-23 00:34:40', 'cancel', 1),
	(2, 'cchamod93@gmail.com', '0713772006', '2023-08-25', 1, 2, 0, '64e784e41d37d', '2023-08-24 21:57:16', 'confirmed', 1),
	(3, 'cchamod93@gmail.com', '0716525458', '2023-10-11', 2, 1, 0, '64e7867aebadf', '2023-08-24 22:04:02', 'confirmed', 1);

-- Dumping structure for table wedding_management.hotel_img_logo
CREATE TABLE IF NOT EXISTS `hotel_img_logo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hotel_id` int DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_hotel_img_logo_hotels` (`hotel_id`),
  CONSTRAINT `FK_hotel_img_logo_hotels` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.hotel_img_logo: ~0 rows (approximately)
INSERT INTO `hotel_img_logo` (`id`, `hotel_id`, `image`, `logo`) VALUES
	(1, 1, '64e5024952df8.jpeg', '64e502495319d.jpeg');

-- Dumping structure for table wedding_management.packages
CREATE TABLE IF NOT EXISTS `packages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `package_type` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `preview_image` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `hotel_id` int DEFAULT NULL,
  `status` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_packages_hotels` (`hotel_id`),
  CONSTRAINT `FK_packages_hotels` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table wedding_management.packages: ~2 rows (approximately)
INSERT INTO `packages` (`id`, `package_type`, `price`, `preview_image`, `hotel_id`, `status`) VALUES
	(1, 'GOLD', 500000, '64e502495c036.jpg', 1, 0),
	(2, 'Diamond', 1000000, '64e502496b827.png', 1, 0);

-- Dumping structure for table wedding_management.package_features
CREATE TABLE IF NOT EXISTS `package_features` (
  `id` int NOT NULL AUTO_INCREMENT,
  `package_id` int NOT NULL,
  `title` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_package_features_packages` (`package_id`) USING BTREE,
  CONSTRAINT `FK_package_features_packages` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Dumping data for table wedding_management.package_features: ~19 rows (approximately)
INSERT INTO `package_features` (`id`, `package_id`, `title`) VALUES
	(1, 1, 'One deluxe changing room on the day of the event for the duration of the event'),
	(2, 1, 'Welcome drink'),
	(3, 1, 'Band stand'),
	(4, 1, 'Dance floor'),
	(5, 1, 'Tablecloth with over layers'),
	(6, 1, 'Chair covers with sashes'),
	(7, 1, 'LCD projector with screen'),
	(8, 1, 'Two microphones with state-of-the-art built-in sound system.'),
	(9, 2, 'Welcome drink'),
	(10, 2, ' band stand'),
	(11, 2, ' dance floor'),
	(12, 2, ' and traditional oil lamp (décor by guest)'),
	(13, 2, 'Tablecloth with over layers and chair covers'),
	(14, 2, 'Two Deluxe changing rooms on the day of the wedding for the duration of the event'),
	(15, 2, 'Late checkout till 3 pm - subject to availability'),
	(16, 2, 'Special room rates for additional rooms at Shangri-La Colombo on the night of the wedding'),
	(17, 2, '60-minute couples aromatherapy spa treatment for the bride & groom at CHI'),
	(18, 2, ' The Spa'),
	(19, 2, 'Dinner voucher for two when celebrating your 1st wedding anniversary');

-- Dumping structure for table wedding_management.pay_type
CREATE TABLE IF NOT EXISTS `pay_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.pay_type: ~2 rows (approximately)
INSERT INTO `pay_type` (`id`, `name`) VALUES
	(1, 'paid'),
	(2, 'not paid');

-- Dumping structure for table wedding_management.photography
CREATE TABLE IF NOT EXISTS `photography` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `seller_email` varchar(50) DEFAULT NULL,
  `line1` varchar(50) DEFAULT NULL,
  `line2` varchar(50) DEFAULT NULL,
  `districts_id` int DEFAULT NULL,
  `discription` text,
  `company_name` varchar(50) DEFAULT NULL,
  `status` int DEFAULT '0',
  `pay_id` int DEFAULT NULL,
  `register_payment` double DEFAULT NULL,
  `register_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_photography_users` (`seller_email`),
  KEY `FK_photography_district` (`districts_id`),
  KEY `FK_photography_pay_type_2` (`pay_id`),
  CONSTRAINT `FK_photography_district` FOREIGN KEY (`districts_id`) REFERENCES `district` (`id`),
  CONSTRAINT `FK_photography_pay_type` FOREIGN KEY (`pay_id`) REFERENCES `pay_type` (`id`),
  CONSTRAINT `FK_photography_pay_type_2` FOREIGN KEY (`pay_id`) REFERENCES `pay_type` (`id`),
  CONSTRAINT `FK_photography_users` FOREIGN KEY (`seller_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.photography: ~0 rows (approximately)

-- Dumping structure for table wedding_management.photography_booking
CREATE TABLE IF NOT EXISTS `photography_booking` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `time_id` int DEFAULT NULL,
  `packag_id` int DEFAULT NULL,
  `hidden` int DEFAULT '0',
  `order_id` varchar(50) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `order_status` varchar(50) DEFAULT 'confirmed',
  `pay_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_photography_booking_users` (`user_email`),
  KEY `FK_photography_booking_time` (`time_id`),
  KEY `FK_photography_booking_photography_package` (`packag_id`),
  KEY `FK_photography_booking_pay_type` (`pay_id`),
  CONSTRAINT `FK_photography_booking_pay_type` FOREIGN KEY (`pay_id`) REFERENCES `pay_type` (`id`),
  CONSTRAINT `FK_photography_booking_photography_package` FOREIGN KEY (`packag_id`) REFERENCES `photography_package` (`id`),
  CONSTRAINT `FK_photography_booking_time` FOREIGN KEY (`time_id`) REFERENCES `time` (`id`),
  CONSTRAINT `FK_photography_booking_users` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.photography_booking: ~0 rows (approximately)

-- Dumping structure for table wedding_management.photography_gallary
CREATE TABLE IF NOT EXISTS `photography_gallary` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `photography_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_photogaphy_gallary_photography` (`photography_id`) USING BTREE,
  CONSTRAINT `FK_photogaphy_gallary_photography` FOREIGN KEY (`photography_id`) REFERENCES `photography` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.photography_gallary: ~0 rows (approximately)

-- Dumping structure for table wedding_management.photography_package
CREATE TABLE IF NOT EXISTS `photography_package` (
  `id` int NOT NULL AUTO_INCREMENT,
  `package_type` varchar(50) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `preview_image` varchar(50) DEFAULT NULL,
  `photography_id` int DEFAULT NULL,
  `status` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_photography_package_photography` (`photography_id`),
  CONSTRAINT `FK_photography_package_photography` FOREIGN KEY (`photography_id`) REFERENCES `photography` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.photography_package: ~0 rows (approximately)

-- Dumping structure for table wedding_management.photography_package_features
CREATE TABLE IF NOT EXISTS `photography_package_features` (
  `id` int NOT NULL AUTO_INCREMENT,
  `package_id` int DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_photography_package_features_photography_package` (`package_id`),
  CONSTRAINT `FK_photography_package_features_photography_package` FOREIGN KEY (`package_id`) REFERENCES `photography_package` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.photography_package_features: ~0 rows (approximately)

-- Dumping structure for table wedding_management.photography__img_logo
CREATE TABLE IF NOT EXISTS `photography__img_logo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `photography_id` int DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_photography__img_logo_photography` (`photography_id`),
  CONSTRAINT `FK_photography__img_logo_photography` FOREIGN KEY (`photography_id`) REFERENCES `photography` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.photography__img_logo: ~0 rows (approximately)

-- Dumping structure for table wedding_management.province
CREATE TABLE IF NOT EXISTS `province` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.province: ~9 rows (approximately)
INSERT INTO `province` (`id`, `name`) VALUES
	(1, 'Central Province '),
	(2, 'Eastern Province'),
	(3, 'Northern Province'),
	(4, 'Southern Province'),
	(5, 'Western Province'),
	(6, 'North Western Province'),
	(7, 'North Central Province'),
	(8, 'Uva Province'),
	(9, 'Sabaragamuwa Province');

-- Dumping structure for table wedding_management.register_payment
CREATE TABLE IF NOT EXISTS `register_payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `seller_type` int DEFAULT NULL,
  `seller_mail` varchar(50) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `card_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `card_year` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `card_month` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `payment_no` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_register_payment_user_type` (`seller_type`),
  KEY `FK_register_payment_users` (`seller_mail`),
  CONSTRAINT `FK_register_payment_user_type` FOREIGN KEY (`seller_type`) REFERENCES `user_type` (`id`),
  CONSTRAINT `FK_register_payment_users` FOREIGN KEY (`seller_mail`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.register_payment: ~2 rows (approximately)
INSERT INTO `register_payment` (`id`, `seller_type`, `seller_mail`, `category_id`, `card_number`, `card_year`, `card_month`, `category`, `price`, `date`, `payment_no`) VALUES
	(1, 2, 'sandunpiyarathne95@gmail.com', 1, '1456345345343334', '2028', '6', 'hotel', 7500, '2023-08-23 00:15:57', '259173'),
	(2, 5, 'cchamod93@gmail.com', 1, '2342423243244234', '2029', '3', 'vehicle', 6000, '2023-08-23 00:31:46', '201640'),
	(3, 5, 'cchamod93@gmail.com', 2, '5645456475786876', '2025', '5', 'vehicle', 5000, '2023-08-24 21:47:01', '173014');

-- Dumping structure for table wedding_management.time
CREATE TABLE IF NOT EXISTS `time` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.time: ~2 rows (approximately)
INSERT INTO `time` (`id`, `name`) VALUES
	(1, 'Day'),
	(2, 'Night');

-- Dumping structure for table wedding_management.users
CREATE TABLE IF NOT EXISTS `users` (
  `fname` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `lname` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `user_type_id` int DEFAULT NULL,
  `verification_code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`email`),
  KEY `FK_users_user_type` (`user_type_id`),
  CONSTRAINT `FK_users_user_type` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.users: ~2 rows (approximately)
INSERT INTO `users` (`fname`, `lname`, `email`, `password`, `register_date`, `user_type_id`, `verification_code`) VALUES
	('kawshalya', 'Dissanayake', 'cchamod93@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2023-08-23 00:21:18', 5, NULL),
	('sandun', 'chandika', 'sandunpiyarathne95@gmail.com', '8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414', '2023-08-22 11:42:45', 2, '64e4521681680');

-- Dumping structure for table wedding_management.user_type
CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.user_type: ~5 rows (approximately)
INSERT INTO `user_type` (`id`, `name`) VALUES
	(1, 'user'),
	(2, 'Hotel'),
	(3, 'Photography'),
	(4, 'Dj'),
	(5, 'Vehicle');

-- Dumping structure for table wedding_management.vehical_booking
CREATE TABLE IF NOT EXISTS `vehical_booking` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `extra_date` int DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `vehical_detils_id` int DEFAULT NULL,
  `order_id` varchar(50) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `hidden` int DEFAULT '0',
  `order_status` varchar(50) DEFAULT 'confirmed',
  `pay_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_vehical_booking_users` (`user_email`),
  KEY `FK_vehical_booking_vehicles_details` (`vehical_detils_id`),
  KEY `FK_vehical_booking_pay_type` (`pay_id`),
  CONSTRAINT `FK_vehical_booking_pay_type` FOREIGN KEY (`pay_id`) REFERENCES `pay_type` (`id`),
  CONSTRAINT `FK_vehical_booking_users` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`),
  CONSTRAINT `FK_vehical_booking_vehicles_details` FOREIGN KEY (`vehical_detils_id`) REFERENCES `vehicles_details` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.vehical_booking: ~1 rows (approximately)
INSERT INTO `vehical_booking` (`id`, `user_email`, `booking_date`, `extra_date`, `mobile`, `vehical_detils_id`, `order_id`, `order_date`, `hidden`, `order_status`, `pay_id`) VALUES
	(1, 'cchamod93@gmail.com', '2023-08-30', 3, '0713772006', 3, '64e782dbbb5e5', '2023-08-24 21:48:35', 0, 'confirmed', 1);

-- Dumping structure for table wedding_management.vehicles
CREATE TABLE IF NOT EXISTS `vehicles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `seller_email` varchar(50) DEFAULT NULL,
  `line1` varchar(50) DEFAULT NULL,
  `line2` varchar(50) DEFAULT NULL,
  `districts_id` int DEFAULT NULL,
  `pay_id` int DEFAULT NULL,
  `register_payment` double DEFAULT NULL,
  `register_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_vehicles_users` (`seller_email`),
  KEY `FK_vehicles_district` (`districts_id`),
  KEY `FK_vehicles_pay_type` (`pay_id`),
  CONSTRAINT `FK_vehicles_district` FOREIGN KEY (`districts_id`) REFERENCES `district` (`id`),
  CONSTRAINT `FK_vehicles_pay_type` FOREIGN KEY (`pay_id`) REFERENCES `pay_type` (`id`),
  CONSTRAINT `FK_vehicles_users` FOREIGN KEY (`seller_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.vehicles: ~2 rows (approximately)
INSERT INTO `vehicles` (`id`, `company_name`, `seller_email`, `line1`, `line2`, `districts_id`, `pay_id`, `register_payment`, `register_date`) VALUES
	(1, 'LUXURY CAR RENTAL', 'cchamod93@gmail.com', NULL, NULL, 13, 1, 6000, '2023-08-23'),
	(2, 'MALKEY', 'cchamod93@gmail.com', NULL, NULL, 8, 1, 5000, '2023-08-24');

-- Dumping structure for table wedding_management.vehicles_condition
CREATE TABLE IF NOT EXISTS `vehicles_condition` (
  `id` int NOT NULL AUTO_INCREMENT,
  `condition_name` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.vehicles_condition: ~2 rows (approximately)
INSERT INTO `vehicles_condition` (`id`, `condition_name`) VALUES
	(1, 'Ac'),
	(2, 'Non-Ac');

-- Dumping structure for table wedding_management.vehicles_details
CREATE TABLE IF NOT EXISTS `vehicles_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `company_id` int NOT NULL,
  `model` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `license_no` varchar(50) DEFAULT NULL,
  `register_date` date DEFAULT NULL,
  `condition_id` int DEFAULT NULL,
  `description` text,
  `color` varchar(50) DEFAULT NULL,
  `Price_Per_Mile` double DEFAULT NULL,
  `extra_day_price` double DEFAULT NULL,
  `vehical_number` varchar(50) DEFAULT NULL,
  `status` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_vehicles_details_vehicles-condition` (`condition_id`),
  KEY `FK_vehicles_details_vehicles` (`company_id`) USING BTREE,
  CONSTRAINT `FK_vehicles_details_vehicles` FOREIGN KEY (`company_id`) REFERENCES `vehicles` (`id`),
  CONSTRAINT `FK_vehicles_details_vehicles-condition` FOREIGN KEY (`condition_id`) REFERENCES `vehicles_condition` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.vehicles_details: ~2 rows (approximately)
INSERT INTO `vehicles_details` (`id`, `name`, `company_id`, `model`, `license_no`, `register_date`, `condition_id`, `description`, `color`, `Price_Per_Mile`, `extra_day_price`, `vehical_number`, `status`) VALUES
	(1, 'BENZ', 1, 'GLA 200', '05454874', '2023-08-13', 1, NULL, 'white', 500, 2000, '9855', 0),
	(2, 'BENZ', 1, 'GLA 220d', '456465', '2022-12-07', 2, NULL, 'BLACK', 300, 1500, '46985', 0),
	(3, 'BMW', 2, 'i8', '45465898', '2023-08-09', 1, NULL, 'black', 2500, 3000, 'KRG-3423', 0);

-- Dumping structure for table wedding_management.vehicles_img
CREATE TABLE IF NOT EXISTS `vehicles_img` (
  `id` int NOT NULL AUTO_INCREMENT,
  `img` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `vehical_de_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_vehicles_img_vehicles_details` (`vehical_de_id`),
  CONSTRAINT `FK_vehicles_img_vehicles_details` FOREIGN KEY (`vehical_de_id`) REFERENCES `vehicles_details` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.vehicles_img: ~4 rows (approximately)
INSERT INTO `vehicles_img` (`id`, `img`, `vehical_de_id`) VALUES
	(1, '64e505fbbb469.jpeg', 1),
	(2, '64e505fbbd55e.jpeg', 2),
	(3, '64e7826bbde2e.jpeg', 3),
	(4, '64e7826bbe86c.jpeg', 3),
	(5, '64e7826bbf397.jpg', 3);

-- Dumping structure for table wedding_management.vehicles_img_logo
CREATE TABLE IF NOT EXISTS `vehicles_img_logo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image` varchar(50) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `vehical_details_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_vehicles_img_logo_vehicles_details` (`vehical_details_id`),
  CONSTRAINT `FK_vehicles_img_logo_vehicles_details` FOREIGN KEY (`vehical_details_id`) REFERENCES `vehicles_details` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding_management.vehicles_img_logo: ~2 rows (approximately)
INSERT INTO `vehicles_img_logo` (`id`, `image`, `logo`, `vehical_details_id`) VALUES
	(1, '64e505fbb03f3.jpeg', '64e505fbb4e2e.png', 1),
	(2, '64e505fbb03f3.jpeg', '64e505fbb4e2e.png', 2),
	(3, '64e7826bb6a12.jpeg', '64e7826bb6c82.jpeg', 3);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
