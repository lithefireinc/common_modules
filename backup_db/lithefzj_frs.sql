/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.0.95-community : Database - lithefzj_frs
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`lithefzj_frs` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `lithefzj_frs`;

/*Table structure for table `RESEITEM` */

DROP TABLE IF EXISTS `RESEITEM`;

CREATE TABLE `RESEITEM` (
  `id` int(11) NOT NULL auto_increment,
  `reservation_id` int(11) default NULL,
  `item_id` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `RESEITEM` */

insert  into `RESEITEM`(`id`,`reservation_id`,`item_id`) values (1,2,2);

/*Table structure for table `RESERVATIONS` */

DROP TABLE IF EXISTS `RESERVATIONS`;

CREATE TABLE `RESERVATIONS` (
  `id` int(11) NOT NULL auto_increment,
  `CONFIRMNO` char(10) NOT NULL,
  `DATEREQUESTED` date default NULL,
  `DATEFROM` date default NULL,
  `DATETO` date default NULL,
  `TIMESTART` time default NULL,
  `TIMEEND` time default NULL,
  `FACIIDNO` char(7) default NULL,
  `PURPOSE` text,
  `REQUESTED_BY` char(50) default NULL,
  `REQUESTED_BY_ID` char(11) default NULL,
  `MODIFIED_BY` char(50) default NULL,
  `APPROVER` char(50) default NULL,
  `APPROVER_ID` char(11) default NULL,
  `REASON` text,
  `STATUS` char(50) default NULL,
  `DCREATED` date default NULL,
  `TCREATED` time default NULL,
  `DMODIFIED` date default NULL,
  `TMODIFIED` time default NULL,
  PRIMARY KEY  (`id`,`CONFIRMNO`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `RESERVATIONS` */

insert  into `RESERVATIONS`(`id`,`CONFIRMNO`,`DATEREQUESTED`,`DATEFROM`,`DATETO`,`TIMESTART`,`TIMEEND`,`FACIIDNO`,`PURPOSE`,`REQUESTED_BY`,`REQUESTED_BY_ID`,`MODIFIED_BY`,`APPROVER`,`APPROVER_ID`,`REASON`,`STATUS`,`DCREATED`,`TCREATED`,`DMODIFIED`,`TMODIFIED`) values (1,'0000000001','2012-07-28','2012-07-30','2012-07-30','05:00:00','07:00:00','0000002','Basketball Practice','apple.aala','3F7N010259','apple.aala',NULL,NULL,NULL,'Cancelled','2012-07-28','06:11:46','2012-07-28','06:11:46'),(2,'0000000002','2012-07-29','2012-07-30','2012-07-30','08:00:00','10:00:00','0000001','Film Viewing','apple.aala','3F7N010259','apple.aala','darryl.anaud','0','Cancelled by requestor','Cancelled','2012-07-29','08:07:15','2012-07-29','13:25:24');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `module` */

insert  into `module`(`id`,`description`,`link`,`category_id`,`group`,`icon`,`order`,`is_public`) values (1,'User Matrix','userMatrix',1,NULL,NULL,NULL,0),(2,'User Administration','userMatrix/administration',1,NULL,NULL,NULL,0),(3,'Change Password',NULL,2,NULL,NULL,NULL,1),(4,'Reservation','facility/reservation',3,NULL,NULL,NULL,0),(5,'Reservation Approval','facility/approveReservation',3,NULL,NULL,NULL,0);

/*Table structure for table `module_category` */

DROP TABLE IF EXISTS `module_category`;

CREATE TABLE `module_category` (
  `id` bigint(20) NOT NULL auto_increment,
  `description` varchar(50) default NULL,
  `icon` varchar(50) default NULL,
  `order` int(10) default NULL,
  `is_public` tinyint(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `module_category` */

insert  into `module_category`(`id`,`description`,`icon`,`order`,`is_public`) values (1,'USER MATRIX','/images/icons2/hammer_screwdriver.png',NULL,0),(2,'MY ACCOUNT','/images/icons/user.png',NULL,1),(3,'FACILITIES','/images/icons/package.png',NULL,NULL);

/*Table structure for table `module_group` */

DROP TABLE IF EXISTS `module_group`;

CREATE TABLE `module_group` (
  `id` bigint(20) NOT NULL auto_increment,
  `description` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `module_group` */

insert  into `module_group`(`id`,`description`) values (1,'Super User'),(2,'Student'),(3,'Pmms.staff');

/*Table structure for table `module_group_access` */

DROP TABLE IF EXISTS `module_group_access`;

CREATE TABLE `module_group_access` (
  `id` bigint(20) NOT NULL auto_increment,
  `group_id` int(20) default NULL,
  `module_id` int(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `module_group_access` */

insert  into `module_group_access`(`id`,`group_id`,`module_id`) values (1,1,1),(2,1,2),(3,1,4),(4,2,4),(5,1,5),(6,3,5),(7,3,4);

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

insert  into `module_group_users`(`id`,`user_id`,`username`,`group_id`) values (1,1,'darryl.anaud',1),(2,NULL,'richard.base',1),(3,NULL,'maribeth.rivas',1),(4,NULL,'niz.nolasco',1),(5,NULL,'apple.aala',2),(6,NULL,'test.admin',3);

/*Table structure for table `swp_sessions` */

DROP TABLE IF EXISTS `swp_sessions`;

CREATE TABLE `swp_sessions` (
  `session_id` varchar(32) NOT NULL default '',
  `user_agent` varchar(255) default NULL,
  `ip_address` varchar(20) default NULL,
  `last_activity` int(12) default NULL,
  `user_data` mediumtext,
  PRIMARY KEY  (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `swp_sessions` */

insert  into `swp_sessions`(`session_id`,`user_agent`,`ip_address`,`last_activity`,`user_data`) values ('497f3ae4a65c56cd8d5606f00b776efd','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/536.5 (KHTML, like Gecko) Chrome/19.0.1084.52 Safari/536.5','192.168.100.127',1338379962,'a:9:{s:9:\"user_data\";s:0:\"\";s:8:\"identity\";s:12:\"darryl.anaud\";s:8:\"userName\";s:12:\"darryl.anaud\";s:8:\"username\";s:12:\"darryl.anaud\";s:7:\"user_id\";s:1:\"1\";s:8:\"userType\";s:5:\"ADMIN\";s:8:\"userCode\";N;s:4:\"code\";N;s:6:\"userId\";s:1:\"1\";}'),('b64bd7ecf9e829e396fa7e138c4d04b2','Mozilla/5.0 (Windows NT 6.1; rv:12.0) Gecko/20100101 Firefox/12.0','192.168.100.127',1338380008,'a:9:{s:9:\"user_data\";s:0:\"\";s:8:\"identity\";s:10:\"apple.aala\";s:8:\"userName\";s:10:\"apple.aala\";s:8:\"username\";s:10:\"apple.aala\";s:7:\"user_id\";s:2:\"12\";s:8:\"userType\";s:4:\"STUD\";s:8:\"userCode\";s:10:\"3F7N010259\";s:4:\"code\";s:3:\"287\";s:6:\"userId\";s:2:\"12\";}'),('405447935de59fc2fd8f290574ac0973','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/536.5 (KHTML, like Gecko) Chrome/19.0.1084.52 Safari/536.5','0.0.0.0',1338388056,'a:9:{s:9:\"user_data\";s:0:\"\";s:8:\"identity\";s:12:\"darryl.anaud\";s:8:\"userName\";s:12:\"darryl.anaud\";s:8:\"username\";s:12:\"darryl.anaud\";s:7:\"user_id\";s:1:\"1\";s:8:\"userType\";s:5:\"ADMIN\";s:8:\"userCode\";N;s:4:\"code\";N;s:6:\"userId\";s:1:\"1\";}'),('069d69eb1e3a17eff0ca235da7443e88','Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0','0.0.0.0',1338390711,'a:9:{s:9:\"user_data\";s:0:\"\";s:8:\"identity\";s:10:\"apple.aala\";s:8:\"userName\";s:10:\"apple.aala\";s:8:\"username\";s:10:\"apple.aala\";s:7:\"user_id\";s:2:\"12\";s:8:\"userType\";s:4:\"STUD\";s:8:\"userCode\";s:10:\"3F7N010259\";s:4:\"code\";s:3:\"287\";s:6:\"userId\";s:2:\"12\";}'),('75a0fbfc6b3eef04042b35bedfd88bee','Mozilla/5.0 (Windows NT 6.1; rv:12.0) Gecko/20100101 Firefox/12.0','192.168.100.127',1338428074,'a:9:{s:9:\"user_data\";s:0:\"\";s:8:\"identity\";s:12:\"darryl.anaud\";s:8:\"userName\";s:12:\"darryl.anaud\";s:8:\"username\";s:12:\"darryl.anaud\";s:7:\"user_id\";s:1:\"1\";s:8:\"userType\";s:5:\"ADMIN\";s:8:\"userCode\";N;s:4:\"code\";N;s:6:\"userId\";s:1:\"1\";}'),('5958448b8394cc286d59c3a6e733a65a','Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0','0.0.0.0',1338430886,''),('d09eaa656481573d1840c8b3e0aa4213','Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0','0.0.0.0',1338781613,''),('5b151f72cb7483836211cec804d1262d','Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0','0.0.0.0',1338908649,'a:9:{s:9:\"user_data\";s:0:\"\";s:8:\"identity\";s:10:\"apple.aala\";s:8:\"userName\";s:10:\"apple.aala\";s:8:\"username\";s:10:\"apple.aala\";s:7:\"user_id\";s:2:\"12\";s:8:\"userType\";s:4:\"STUD\";s:8:\"userCode\";s:10:\"3F7N010259\";s:4:\"code\";s:3:\"287\";s:6:\"userId\";s:2:\"12\";}'),('6c28fd67e4b4d02b0198b4969164d589','Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0','0.0.0.0',1338955398,'a:9:{s:9:\"user_data\";s:0:\"\";s:8:\"identity\";s:12:\"darryl.anaud\";s:8:\"userName\";s:12:\"darryl.anaud\";s:8:\"username\";s:12:\"darryl.anaud\";s:7:\"user_id\";s:1:\"1\";s:8:\"userType\";s:5:\"ADMIN\";s:8:\"userCode\";N;s:4:\"code\";N;s:6:\"userId\";s:1:\"1\";}'),('8b3fd149400d2f257339bedc29635461','Mozilla/5.0 (Windows NT 6.1; WOW64; rv:13.0) Gecko/20100101 Firefox/13.0','0.0.0.0',1339033998,'');

/*Table structure for table `tbl_logs` */

DROP TABLE IF EXISTS `tbl_logs`;

CREATE TABLE `tbl_logs` (
  `id` bigint(20) NOT NULL auto_increment,
  `userId` bigint(20) NOT NULL,
  `actionType` varchar(50) NOT NULL,
  `time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_logs` */

insert  into `tbl_logs`(`id`,`userId`,`actionType`,`time`) values (1,1,'LOGOUT','2012-04-02 13:07:08'),(2,1,'LOGIN','2012-04-02 13:07:17'),(3,1,'LOGIN','2012-04-04 04:52:33'),(4,1,'LOGIN','2012-04-23 05:09:02'),(5,1,'LOGIN','2012-04-24 04:15:56'),(6,1,'LOGIN','2012-04-24 12:24:36'),(7,1,'LOGIN','2012-04-24 16:03:40'),(8,1,'LOGIN','2012-04-25 01:38:18'),(9,1,'LOGIN','2012-04-25 06:12:42'),(10,1,'LOGIN','2012-04-25 06:24:58'),(11,1,'LOGIN','2012-04-25 14:30:17'),(12,1,'LOGOUT','2012-04-25 14:44:36'),(13,1,'LOGIN','2012-04-26 10:53:29'),(14,1,'LOGIN','2012-04-26 11:15:39'),(15,1,'LOGIN','2012-04-26 11:19:58'),(16,1,'LOGIN','2012-04-26 11:26:53'),(17,1,'LOGIN','2012-04-26 11:28:32'),(18,1,'LOGIN','2012-04-26 11:30:53'),(19,1,'LOGIN','2012-04-26 11:31:30'),(20,1,'LOGOUT','2012-04-26 11:34:05'),(21,1,'LOGIN','2012-04-26 11:34:12'),(22,1,'LOGOUT','2012-04-26 11:34:59'),(23,1,'LOGIN','2012-04-26 11:39:49'),(24,0,'LOGOUT','2012-04-26 11:51:45'),(25,1,'LOGIN','2012-04-26 11:51:51'),(26,1,'LOGIN','2012-04-26 12:17:10'),(27,1,'LOGIN','2012-04-26 12:17:23'),(28,1,'LOGIN','2012-04-26 12:18:13'),(29,1,'LOGIN','2012-04-26 12:18:41'),(30,1,'LOGIN','2012-04-26 12:19:34'),(31,1,'LOGIN','2012-04-26 12:20:52'),(32,1,'LOGIN','2012-04-26 12:21:31'),(33,1,'LOGIN','2012-04-26 12:23:39'),(34,1,'LOGIN','2012-04-26 12:24:02'),(35,1,'LOGIN','2012-04-26 12:24:34'),(36,1,'LOGIN','2012-04-26 12:24:46'),(37,1,'LOGIN','2012-04-26 12:27:08'),(38,1,'LOGIN','2012-04-26 13:39:12'),(39,1,'LOGIN','2012-04-26 17:23:19'),(40,1,'LOGIN','2012-04-26 17:29:22'),(41,1,'LOGIN','2012-04-26 17:32:43'),(42,1,'LOGIN','2012-04-26 17:33:34'),(43,1,'LOGIN','2012-04-26 17:39:09'),(44,1,'LOGIN','2012-04-26 17:52:18'),(45,1,'LOGIN','2012-04-27 03:34:01'),(46,1,'LOGIN','2012-04-27 03:35:56'),(47,1,'LOGIN','2012-04-27 03:41:51'),(48,1,'LOGIN','2012-04-27 03:47:33'),(49,1,'LOGIN','2012-04-27 03:47:58'),(50,0,'LOGOUT','2012-04-27 04:16:56'),(51,0,'LOGOUT','2012-04-27 04:16:59');

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` char(40) default NULL,
  `user_type_code` varchar(10) default NULL,
  `STUDCODE` int(11) default NULL,
  `STUDIDNO` char(10) default NULL,
  `ADVICODE` int(11) default NULL,
  `ADVIIDNO` char(10) default NULL,
  `PARECODE` int(11) default NULL,
  `PAREIDNO` char(10) default NULL,
  `dmodified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `modified_by` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`id`,`username`,`password`,`salt`,`user_type_code`,`STUDCODE`,`STUDIDNO`,`ADVICODE`,`ADVIIDNO`,`PARECODE`,`PAREIDNO`,`dmodified`,`modified_by`) values (1,'darryl.anaud','916cb67aa119d20627f839ad29a5068bbee2ca83',NULL,'ADMIN',NULL,NULL,NULL,NULL,NULL,NULL,'2012-04-30 20:19:07',NULL),(2,'richard.base','cee8da72db7d001cb40ae3314887380cc4a6882e',NULL,'ADMIN',NULL,NULL,NULL,NULL,NULL,NULL,'2012-05-02 03:52:53',NULL),(3,'maribeth.rivas','1409957c57942079d4139f6c8cdf647d4b32cfc2',NULL,'ADMIN',NULL,NULL,NULL,NULL,NULL,NULL,'2012-05-02 03:52:31',NULL),(5,'niz.nolasco','37e5c9b2528b6c6e8fc4da450626efd0d77f669f',NULL,'ADMIN',NULL,NULL,NULL,NULL,NULL,NULL,'2012-05-02 03:52:43',NULL),(12,'apple.aala','85ecc3653e1fbee400eefba07b9adc2d7b79e62e',NULL,'STUD',287,'3F7N010259',NULL,NULL,NULL,NULL,'2012-05-03 17:30:28',NULL),(13,'test.admin','14fb1e49a92d35e952854a9f4a9740252025b0d5',NULL,'ADMIN',NULL,NULL,NULL,NULL,NULL,NULL,'2012-07-30 13:25:20',NULL);

/*Table structure for table `tbl_user_type` */

DROP TABLE IF EXISTS `tbl_user_type`;

CREATE TABLE `tbl_user_type` (
  `id` int(11) NOT NULL auto_increment,
  `code` varchar(10) NOT NULL,
  `description` varchar(128) NOT NULL,
  PRIMARY KEY  (`id`,`code`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user_type` */

insert  into `tbl_user_type`(`id`,`code`,`description`) values (1,'ADMIN','Administrator'),(2,'FACU','Faculty'),(3,'STUD','Student'),(4,'PRNT','Parent');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `ip_address` int(10) unsigned NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) default NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) default NULL,
  `forgotten_password_code` varchar(40) default NULL,
  `forgotten_password_time` int(11) unsigned default NULL,
  `remember_code` varchar(40) default NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned default NULL,
  `active` tinyint(1) unsigned default NULL,
  `first_name` varchar(50) default NULL,
  `last_name` varchar(50) default NULL,
  `company` varchar(100) default NULL,
  `phone` varchar(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`ip_address`,`username`,`password`,`salt`,`email`,`activation_code`,`forgotten_password_code`,`forgotten_password_time`,`remember_code`,`created_on`,`last_login`,`active`,`first_name`,`last_name`,`company`,`phone`) values (1,2130706433,'administrator','59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4','9462e8eee0','admin@admin.com','',NULL,NULL,NULL,1268889823,1335492532,1,'Admin','istrator','ADMIN','0'),(2,0,'darryl anaud','e57d26b28da707386623c789e2c218be90dcb467',NULL,'darrylanaud@gmail.com',NULL,NULL,NULL,NULL,1335492973,1335493396,1,'darryl','anaud','lfs','123-456-7891');

/*Table structure for table `users_groups` */

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `users_groups` */

insert  into `users_groups`(`id`,`user_id`,`group_id`) values (1,1,1),(2,1,2),(3,2,2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
