/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.27-MariaDB : Database - hwms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`hwms` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `hwms`;

/*Table structure for table `master_admin` */

DROP TABLE IF EXISTS `master_admin`;

CREATE TABLE `master_admin` (
  `user_id` int(99) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `master_admin` */

insert  into `master_admin`(`user_id`,`name`,`phone`,`email`) values 
(1,'Rishvanth','9566663139','rish@gmail.com');

/*Table structure for table `master_delivery` */

DROP TABLE IF EXISTS `master_delivery`;

CREATE TABLE `master_delivery` (
  `user_id` int(99) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '0-not active;1-available;2-booked',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `master_delivery` */

insert  into `master_delivery`(`user_id`,`name`,`phone`,`status`) values 
(1,'Rish','9566663139','2');

/*Table structure for table `master_hospital` */

DROP TABLE IF EXISTS `master_hospital`;

CREATE TABLE `master_hospital` (
  `user_id` bigint(99) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `address` varchar(250) NOT NULL,
  `city` varchar(50) NOT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `master_hospital` */

insert  into `master_hospital`(`user_id`,`name`,`phone`,`email`,`address`,`city`,`latitude`,`longitude`) values 
(1,'BIT Hospital','1234567890','aa','Karur','Karur',1,2),
(2,'Gokul Hospital','234467',NULL,'','Chennai',1,NULL),
(3,'GKL Hospital','15184846546',NULL,'','Karur',1,2),
(4,'Amudha Hospital','184984',NULL,'','Erode',NULL,NULL),
(5,'Apllo Hospital','4141685496\'',NULL,'','Sathy',NULL,NULL);

/*Table structure for table `master_team_manager` */

DROP TABLE IF EXISTS `master_team_manager`;

CREATE TABLE `master_team_manager` (
  `user_id` bigint(99) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `master_team_manager` */

/*Table structure for table `pickup_log` */

DROP TABLE IF EXISTS `pickup_log`;

CREATE TABLE `pickup_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `wastage_id` bigint(20) NOT NULL,
  `delivery` int(99) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0-pending;1-picked up',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pickup_log` */

insert  into `pickup_log`(`id`,`wastage_id`,`delivery`,`date`,`time`,`status`) values 
(1,1,1,'2023-05-20','22:05:00','1'),
(2,2,1,'2023-05-20','09:55:00','1'),
(3,3,1,'2023-05-21','11:04:00','1'),
(4,4,1,'2023-05-19','13:00:00','1'),
(5,4,1,'2023-05-02','14:15:00','1'),
(6,6,1,'2023-05-20','14:38:00','1'),
(7,7,1,'2023-05-20','14:38:00','1');

/*Table structure for table `resource_master` */

DROP TABLE IF EXISTS `resource_master`;

CREATE TABLE `resource_master` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `img` varchar(50) DEFAULT NULL,
  `link` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `resource_master` */

insert  into `resource_master`(`id`,`name`,`img`,`link`) values 
(1,'Dashboard','','dashboard/'),
(2,'Hospitals Wastage',NULL,'wastage/'),
(3,'Admin Status',NULL,'wastage_in/'),
(4,'Garbage Collector Team',NULL,'wastage_slot/'),
(5,'Delivery Booking',NULL,'wastage_delivery/');

/*Table structure for table `user_login` */

DROP TABLE IF EXISTS `user_login`;

CREATE TABLE `user_login` (
  `user_id` int(99) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role` int(99) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user_login` */

insert  into `user_login`(`user_id`,`username`,`password`,`role`) values 
(1,'rish','user',1),
(1,'user','user',2);

/*Table structure for table `user_role` */

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) DEFAULT NULL,
  `resource` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user_role` */

insert  into `user_role`(`id`,`name`,`resource`) values 
(1,'Admin','1-2-3-4-5-'),
(2,'Hospital','2-');

/*Table structure for table `wastage_log` */

DROP TABLE IF EXISTS `wastage_log`;

CREATE TABLE `wastage_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `hospital_⁯id` int(99) NOT NULL,
  `type` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `quanity_kg` int(15) NOT NULL,
  `status` enum('0','1','2','3','4') NOT NULL DEFAULT '0' COMMENT '0-pending;1-accept;2-time alloted;3-rejecte;4-competed',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `wastage_log` */

insert  into `wastage_log`(`id`,`date`,`hospital_⁯id`,`type`,`description`,`quanity_kg`,`status`) values 
(1,'2023-05-16',1,'Infectious','10kgs having',50,'4'),
(2,'2023-05-18',2,'Radioactive','80fegq',80,'4'),
(3,'2023-05-20',3,'Radioactive','khyfk',80,'4'),
(4,'2023-05-17',4,'Non-hazardous','ytfuf',50,'4'),
(5,'2023-05-15',5,'Sharps','gwegweg',50,'0'),
(6,'2023-05-13',2,'Pharmaceutical','efefgege',50,'4'),
(7,'2023-05-12',1,'Non-hazardous','efefgege',100,'4');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
