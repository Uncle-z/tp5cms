/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 5.7.26 : Database - tp5cms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tp5cms` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `tp5cms`;

/*Table structure for table `tp5_admin` */

DROP TABLE IF EXISTS `tp5_admin`;

CREATE TABLE `tp5_admin` (
  `userid` mediumint(6) unsigned NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `roleid` smallint(5) DEFAULT '0',
  `encrypt` varchar(10) DEFAULT NULL,
  `lastloginip` varchar(10) DEFAULT NULL,
  `lastlogintime` int(15) unsigned DEFAULT '0',
  `realname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tp5_admin` */

insert  into `tp5_admin`(`userid`,`username`,`password`,`roleid`,`encrypt`,`lastloginip`,`lastlogintime`,`realname`,`email`) values 
(1,'admin','123456',1,'hahahah',NULL,0,'嘎哈呢',NULL);

/*Table structure for table `tp5_category` */

DROP TABLE IF EXISTS `tp5_category`;

CREATE TABLE `tp5_category` (
  `id` mediumint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tp5_category` */

insert  into `tp5_category`(`id`,`name`) values 
(1,'admin'),
(2,'admin222');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
