/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.0.95-community : Database - lithefzj_pos
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`lithefzj_pos` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `lithefzj_pos`;

/*Table structure for table `ci_sessions` */

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `session_id` varchar(32) NOT NULL default '',
  `user_agent` varchar(255) default NULL,
  `ip_address` varchar(20) default NULL,
  `last_activity` int(12) default NULL,
  `user_data` mediumtext,
  PRIMARY KEY  (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `ci_sessions` */

/*Table structure for table `module` */

DROP TABLE IF EXISTS `module`;

CREATE TABLE `module` (
  `id` bigint(20) NOT NULL auto_increment,
  `description` varchar(50) default NULL,
  `link` varchar(100) default NULL,
  `category_id` int(10) default NULL,
  `group` int(10) default NULL,
  `icon` varchar(50) default NULL,
  `order` int(10) default NULL,
  `is_public` tinyint(1) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `module` */

insert  into `module`(`id`,`description`,`link`,`category_id`,`group`,`icon`,`order`,`is_public`) values (1,'User Matrix','userMatrix',1,NULL,NULL,NULL,0),(2,'User Administration','userMatrix/administration',1,NULL,NULL,NULL,0),(3,'Change Password',NULL,2,NULL,NULL,2,1),(8,'Card Type','wps_admin/card_type',3,NULL,NULL,NULL,0),(6,'My Profile','members/profile',2,NULL,NULL,1,1),(9,'My Points','members/points',3,NULL,NULL,NULL,1),(10,'Member Points','wps_admin/memberPoints',3,NULL,NULL,NULL,0),(11,'Members','wps_admin/members',3,NULL,NULL,NULL,0);

/*Table structure for table `module_category` */

DROP TABLE IF EXISTS `module_category`;

CREATE TABLE `module_category` (
  `id` bigint(20) NOT NULL auto_increment,
  `description` varchar(50) default NULL,
  `icon` varchar(50) default NULL,
  `order` int(10) default NULL,
  `is_public` tinyint(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `module_category` */

insert  into `module_category`(`id`,`description`,`icon`,`order`,`is_public`) values (1,'USER MATRIX','/images/icons2/hammer_screwdriver.png',3,0),(2,'MY ACCOUNT','/images/icons/user.png',1,1),(3,'TRANSACTIONS','/images/icons2/databases.png',2,0);

/*Table structure for table `module_group` */

DROP TABLE IF EXISTS `module_group`;

CREATE TABLE `module_group` (
  `id` bigint(20) NOT NULL auto_increment,
  `description` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `module_group` */

insert  into `module_group`(`id`,`description`) values (1,'Super User');

/*Table structure for table `module_group_access` */

DROP TABLE IF EXISTS `module_group_access`;

CREATE TABLE `module_group_access` (
  `id` bigint(20) NOT NULL auto_increment,
  `group_id` int(20) default NULL,
  `module_id` int(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `module_group_access` */

insert  into `module_group_access`(`id`,`group_id`,`module_id`) values (1,1,1),(2,1,2),(3,1,4),(4,2,4),(5,1,5),(6,3,5),(7,3,4),(8,1,6),(9,1,7),(10,1,8),(11,1,10),(12,1,11);

/*Table structure for table `module_group_users` */

DROP TABLE IF EXISTS `module_group_users`;

CREATE TABLE `module_group_users` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `username` varchar(100) default NULL,
  `group_id` int(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `module_group_users` */

insert  into `module_group_users`(`id`,`user_id`,`username`,`group_id`) values (1,1,'darryl.anaud',1);

/*Table structure for table `tbl_card_type` */

DROP TABLE IF EXISTS `tbl_card_type`;

CREATE TABLE `tbl_card_type` (
  `id` int(11) NOT NULL auto_increment,
  `description` char(100) default NULL,
  `price` decimal(10,2) default NULL,
  `DCREATED` date default NULL,
  `TCREATED` time default NULL,
  `DMODIFIED` date default NULL,
  `TMODIFIED` time default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_card_type` */

insert  into `tbl_card_type`(`id`,`description`,`price`,`DCREATED`,`TCREATED`,`DMODIFIED`,`TMODIFIED`) values (1,'Bingo','100.00','2012-11-10',NULL,'2012-11-11','21:00:54'),(2,'Scratch Card','75.00',NULL,NULL,'2012-11-12','21:14:55');

/*Table structure for table `tbl_civil_status` */

DROP TABLE IF EXISTS `tbl_civil_status`;

CREATE TABLE `tbl_civil_status` (
  `civil_status_id` bigint(8) NOT NULL,
  `civil_status` char(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tbl_civil_status` */

insert  into `tbl_civil_status`(`civil_status_id`,`civil_status`) values (1,'Single'),(2,'Married'),(3,'Divorced'),(4,'Separated'),(5,'Widow/ Widower');

/*Table structure for table `tbl_computation` */

DROP TABLE IF EXISTS `tbl_computation`;

CREATE TABLE `tbl_computation` (
  `id` int(11) NOT NULL auto_increment,
  `computation` decimal(10,2) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_computation` */

insert  into `tbl_computation`(`id`,`computation`) values (1,'0.05');

/*Table structure for table `tbl_gender` */

DROP TABLE IF EXISTS `tbl_gender`;

CREATE TABLE `tbl_gender` (
  `gender_id` bigint(8) NOT NULL auto_increment,
  `gender` char(16) NOT NULL,
  PRIMARY KEY  (`gender_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_gender` */

insert  into `tbl_gender`(`gender_id`,`gender`) values (1,'Male'),(2,'Female');

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
  `gender_id` bigint(16) NOT NULL,
  `civil_status_id` bigint(16) NOT NULL,
  `homephone` int(16) default NULL,
  `mobile` int(16) default NULL,
  `email` char(64) default NULL,
  `address` char(64) NOT NULL,
  PRIMARY KEY  (`member_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_members` */

insert  into `tbl_members`(`member_id`,`firstname`,`middlename`,`lastname`,`username`,`password`,`birthdate`,`gender_id`,`civil_status_id`,`homephone`,`mobile`,`email`,`address`) values (1,'Darryl','Campos','Anaud','darryl.anaud','080f8d19721e81ae57ba437c9a6afb82a82979b0','1987-03-21',1,1,0,90380113,'darrylanaud@gmail.com','Davao City'),(2,'Darryl','Campos','Anaud','dcanaud','5fa1b7910c62824737496318bfe5e546dbed7152','1987-03-21',2,3,123,54321,'yelanaud@yahoo.com','Darryl'),(4,'greg','gaite','Hermo','grg021','620e2346262d5d5278033cd21194f5ac48e07740','2012-11-13',1,1,0,0,'greg.hermo@gmail.com','qc'),(5,'TESTER','TEST','TEST','TESTER','6b32c118d039f9474c9244bd0ecccd884b8a5c0c','2012-11-15',1,2,0,0,'richard.base@gmail.com','TEST'),(6,'TEST','TEST','TST','TEST7','47cc2058a0590276862a5ffafb8cea164344e4de','2012-11-08',1,1,0,0,'TEST@mail.com','TEST');

/*Table structure for table `tbl_purchased_cards` */

DROP TABLE IF EXISTS `tbl_purchased_cards`;

CREATE TABLE `tbl_purchased_cards` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `card_type_id` int(11) default NULL,
  `date_purchased` datetime default NULL,
  `quantity` int(11) default NULL,
  `visible` tinyint(1) default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_purchased_cards` */

insert  into `tbl_purchased_cards`(`id`,`user_id`,`card_type_id`,`date_purchased`,`quantity`,`visible`) values (1,1,2,'2012-11-05 00:00:00',5,1),(2,1,1,'2012-11-05 00:00:00',5,1),(3,3,1,'2012-11-08 00:00:00',20,0),(4,1,1,'2012-11-08 00:00:00',10,0),(5,1,1,'2012-11-07 00:00:00',5,1),(6,3,1,'2012-11-07 00:00:00',5,0);

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) default NULL,
  `user_type_code` varchar(10) default 'MEMBER',
  `STUDCODE` int(11) default NULL,
  `STUDIDNO` char(10) default NULL,
  `ADVICODE` int(11) default NULL,
  `ADVIIDNO` char(10) default NULL,
  `PARECODE` int(11) default NULL,
  `PAREIDNO` char(10) default NULL,
  `dmodified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `modified_by` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`id`,`username`,`password`,`salt`,`user_type_code`,`STUDCODE`,`STUDIDNO`,`ADVICODE`,`ADVIIDNO`,`PARECODE`,`PAREIDNO`,`dmodified`,`modified_by`) values (1,'darryl.anaud','080f8d19721e81ae57ba437c9a6afb82a82979b0',NULL,'MEMBER',NULL,NULL,NULL,NULL,NULL,NULL,'2012-11-10 02:54:49',NULL),(2,'dcanaud','4cc48efb67e77fe22198c4f411e6af075f2966e7',NULL,'MEMBER',NULL,NULL,NULL,NULL,NULL,NULL,'2012-11-10 02:55:15',NULL),(3,'richard','b8c0f1a1668d8ae6ed39f67da20cd87dc25a4251',NULL,'MEMBER',NULL,NULL,NULL,NULL,NULL,NULL,'2012-11-10 07:18:53',NULL),(4,'grg021','620e2346262d5d5278033cd21194f5ac48e07740',NULL,'MEMBER',NULL,NULL,NULL,NULL,NULL,NULL,'2012-11-13 09:49:21',NULL),(5,'TESTER','6b32c118d039f9474c9244bd0ecccd884b8a5c0c',NULL,'MEMBER',NULL,NULL,NULL,NULL,NULL,NULL,'2012-11-23 23:53:22',NULL),(6,'TEST7','47cc2058a0590276862a5ffafb8cea164344e4de',NULL,'MEMBER',NULL,NULL,NULL,NULL,NULL,NULL,'2012-11-24 02:38:27',NULL);

/*Table structure for table `tbl_user_type` */

DROP TABLE IF EXISTS `tbl_user_type`;

CREATE TABLE `tbl_user_type` (
  `id` int(11) NOT NULL auto_increment,
  `code` varchar(10) NOT NULL,
  `description` varchar(128) NOT NULL,
  PRIMARY KEY  (`id`,`code`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user_type` */

insert  into `tbl_user_type`(`id`,`code`,`description`) values (1,'ADMIN','Administrator'),(2,'FACU','Faculty'),(3,'STUD','Student'),(4,'PRNT','Parent'),(5,'MEMBER','Member');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
