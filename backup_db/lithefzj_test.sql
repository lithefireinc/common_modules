/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.0.95-community : Database - lithefzj_test
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`lithefzj_test` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `lithefzj_test`;

/*Table structure for table `FILECIST` */

DROP TABLE IF EXISTS `FILECIST`;

CREATE TABLE `FILECIST` (
  `CISTIDNO` bigint(8) NOT NULL,
  `CIVISTATUS` char(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `FILECIST` */

insert  into `FILECIST`(`CISTIDNO`,`CIVISTATUS`) values (1,'Single'),(2,'Married'),(3,'Divorced'),(4,'Separated'),(5,'Widow/ Widower');

/*Table structure for table `FILEGEND` */

DROP TABLE IF EXISTS `FILEGEND`;

CREATE TABLE `FILEGEND` (
  `GENDIDNO` bigint(8) NOT NULL auto_increment,
  `GENDER` char(16) NOT NULL,
  PRIMARY KEY  (`GENDIDNO`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `FILEGEND` */

insert  into `FILEGEND`(`GENDIDNO`,`GENDER`) values (1,'Male'),(2,'Female');

/*Table structure for table `MEMBERS` */

DROP TABLE IF EXISTS `MEMBERS`;

CREATE TABLE `MEMBERS` (
  `ID` bigint(16) NOT NULL auto_increment,
  `FIRSTNAME` char(64) NOT NULL,
  `MIDDLENAME` char(64) NOT NULL,
  `LASTNAME` char(64) NOT NULL,
  `USERNAME` char(64) NOT NULL,
  `PASSWORD` char(64) NOT NULL,
  `D_BIRTH` date NOT NULL,
  `GENDIDNO` bigint(16) NOT NULL,
  `CISTIDNO` bigint(16) NOT NULL,
  `HOMEPHONE` int(16) default NULL,
  `MOBILE` int(16) default NULL,
  `EMAIL` char(64) default NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `MEMBERS` */

insert  into `MEMBERS`(`ID`,`FIRSTNAME`,`MIDDLENAME`,`LASTNAME`,`USERNAME`,`PASSWORD`,`D_BIRTH`,`GENDIDNO`,`CISTIDNO`,`HOMEPHONE`,`MOBILE`,`EMAIL`) values (1,'Q','W','E','123','123','1994-11-07',2,5,123,123,'123@123.com');

/*Table structure for table `comments` */

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(16) NOT NULL auto_increment,
  `entry_id` int(16) NOT NULL,
  `body` text NOT NULL,
  `author` varchar(40) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `comments` */

insert  into `comments`(`id`,`entry_id`,`body`,`author`) values (1,1,'my first comment','Malkuth Richard'),(2,1,'Second Comment','Malkuth Richard'),(3,2,'A comment for the second entry','Malkuth Richard');

/*Table structure for table `entries` */

DROP TABLE IF EXISTS `entries`;

CREATE TABLE `entries` (
  `id` int(16) NOT NULL auto_increment,
  `title` varchar(128) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `entries` */

insert  into `entries`(`id`,`title`,`body`) values (1,'first blog entry','the quick brown fox jumps over the lazy dog near the bank of the river'),(2,'second blog entry','the quick brown fox jumps over the lazy dog near the bank of the river');

/*Table structure for table `tbl_civil_status` */

DROP TABLE IF EXISTS `tbl_civil_status`;

CREATE TABLE `tbl_civil_status` (
  `CISTIDNO` bigint(8) NOT NULL,
  `CIVISTATUS` char(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tbl_civil_status` */

insert  into `tbl_civil_status`(`CISTIDNO`,`CIVISTATUS`) values (1,'Single'),(2,'Married'),(3,'Divorced'),(4,'Separated'),(5,'Widow/ Widower');

/*Table structure for table `tbl_gender` */

DROP TABLE IF EXISTS `tbl_gender`;

CREATE TABLE `tbl_gender` (
  `GENDIDNO` bigint(8) NOT NULL auto_increment,
  `GENDER` char(16) NOT NULL,
  PRIMARY KEY  (`GENDIDNO`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_gender` */

insert  into `tbl_gender`(`GENDIDNO`,`GENDER`) values (1,'Male'),(2,'Female');

/*Table structure for table `tbl_members` */

DROP TABLE IF EXISTS `tbl_members`;

CREATE TABLE `tbl_members` (
  `member_id` bigint(16) NOT NULL auto_increment,
  `firstname` char(64) NOT NULL,
  `middlename` char(64) NOT NULL,
  `lastname` char(64) NOT NULL,
  `username` char(64) NOT NULL,
  `password` char(64) NOT NULL,
  `birthdate` date NOT NULL,
  `GENDIDNO` bigint(16) NOT NULL,
  `CISTIDNO` bigint(16) NOT NULL,
  `telephone` int(16) default NULL,
  `cellphone` int(16) default NULL,
  `email` char(64) default NULL,
  PRIMARY KEY  (`member_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_members` */

insert  into `tbl_members`(`member_id`,`firstname`,`middlename`,`lastname`,`username`,`password`,`birthdate`,`GENDIDNO`,`CISTIDNO`,`telephone`,`cellphone`,`email`) values (1,'Q','W','E','123','123','1994-11-07',2,5,123,123,'123@123.com');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
