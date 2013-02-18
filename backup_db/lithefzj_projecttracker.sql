/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.0.95-community : Database - lithefzj_projecttracker
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`lithefzj_projecttracker` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `lithefzj_projecttracker`;

/*Table structure for table `AuthAssignment` */

DROP TABLE IF EXISTS `AuthAssignment`;

CREATE TABLE `AuthAssignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY  (`itemname`,`userid`),
  CONSTRAINT `AuthAssignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `AuthAssignment` */

insert  into `AuthAssignment`(`itemname`,`userid`,`bizrule`,`data`) values ('member','1','return isset($params[\"project\"]) && $params[\"project\"]->isUserInRole(\"member\");','N;'),('member','4','return isset($params[\"project\"]) && $params[\"project\"]->isUserInRole(\"member\");','N;'),('owner','3','return isset($params[\"project\"]) && $params[\"project\"]->isUserInRole(\"owner\");','N;'),('owner','4','return isset($params[\"project\"]) && $params[\"project\"]->isUserInRole(\"owner\");','N;'),('reader','2','return isset($params[\"project\"]) && $params[\"project\"]->isUserInRole(\"reader\");','N;'),('reader','3','return isset($params[\"project\"]) && $params[\"project\"]->isUserInRole(\"reader\");','N;');

/*Table structure for table `AuthItem` */

DROP TABLE IF EXISTS `AuthItem`;

CREATE TABLE `AuthItem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY  (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `AuthItem` */

insert  into `AuthItem`(`name`,`type`,`description`,`bizrule`,`data`) values ('createIssue',0,'create a new issue',NULL,'N;'),('createProject',0,'create a new project',NULL,'N;'),('createUser',0,'create a new user',NULL,'N;'),('deleteIssue',0,'delete an issue from a project',NULL,'N;'),('deleteProject',0,'delete a project',NULL,'N;'),('deleteUser',0,'remove a user from a project',NULL,'N;'),('member',2,'',NULL,'N;'),('owner',2,'',NULL,'N;'),('reader',2,'',NULL,'N;'),('readIssue',0,'readissue information',NULL,'N;'),('readProject',0,'read project information',NULL,'N;'),('readUser',0,'read user profile information',NULL,'N;'),('updateIssue',0,'update issue information',NULL,'N;'),('updateProject',0,'update project information',NULL,'N;'),('updateUser',0,'update a users information',NULL,'N;');

/*Table structure for table `AuthItemChild` */

DROP TABLE IF EXISTS `AuthItemChild`;

CREATE TABLE `AuthItemChild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY  (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `AuthItemChild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `AuthItemChild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `AuthItemChild` */

insert  into `AuthItemChild`(`parent`,`child`) values ('member','createIssue'),('owner','createProject'),('owner','createUser'),('member','deleteIssue'),('owner','deleteProject'),('owner','deleteUser'),('owner','member'),('member','reader'),('owner','reader'),('reader','readIssue'),('reader','readProject'),('reader','readUser'),('member','updateIssue'),('owner','updateProject'),('owner','updateUser');

/*Table structure for table `tbl_comment` */

DROP TABLE IF EXISTS `tbl_comment`;

CREATE TABLE `tbl_comment` (
  `id` int(11) NOT NULL auto_increment,
  `content` text NOT NULL,
  `issue_id` int(11) default NULL,
  `create_time` datetime default NULL,
  `create_user_id` int(11) default NULL,
  `update_time` datetime default NULL,
  `update_user_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_comment_issue` (`issue_id`),
  KEY `FK_comment_author` (`create_user_id`),
  CONSTRAINT `FK_comment_author` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`),
  CONSTRAINT `FK_comment_issue` FOREIGN KEY (`issue_id`) REFERENCES `tbl_issue` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_comment` */

insert  into `tbl_comment`(`id`,`content`,`issue_id`,`create_time`,`create_user_id`,`update_time`,`update_user_id`) values (1,'Please mark as started',1,'2011-09-11 09:01:04',3,'2011-09-11 09:01:04',3),(2,'Awts',1,'2011-09-11 09:01:52',3,'2011-09-11 09:01:52',3),(3,'Test comment issue 2',3,'2011-09-11 09:43:36',1,'2011-09-11 09:43:36',1);

/*Table structure for table `tbl_issue` */

DROP TABLE IF EXISTS `tbl_issue`;

CREATE TABLE `tbl_issue` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(128) default NULL,
  `description` text,
  `project_id` int(11) default NULL,
  `type_id` int(11) default NULL,
  `status_id` int(11) default NULL,
  `owner_id` int(11) default NULL,
  `requester_id` int(11) default NULL,
  `create_time` datetime default NULL,
  `create_user_id` int(11) default NULL,
  `update_time` datetime default NULL,
  `update_user_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_issue_project` (`project_id`),
  KEY `FK_issue_requester` (`requester_id`),
  KEY `FK_issue_owner` (`owner_id`),
  CONSTRAINT `FK_issue_owner` FOREIGN KEY (`owner_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_issue_project` FOREIGN KEY (`project_id`) REFERENCES `tbl_project` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_issue_requester` FOREIGN KEY (`requester_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_issue` */

insert  into `tbl_issue`(`id`,`name`,`description`,`project_id`,`type_id`,`status_id`,`owner_id`,`requester_id`,`create_time`,`create_user_id`,`update_time`,`update_user_id`) values (1,'Project 1 Issue 1','Project 1 Issue 1 Description',1,2,1,1,1,NULL,NULL,'2011-09-11 14:10:13',3),(3,'Issue 2','Issue 2 Description',1,1,1,2,1,NULL,NULL,NULL,NULL),(4,'My Requests Module','Employee My Request Module',1,1,0,3,3,'2011-09-11 08:36:33',3,'2011-09-11 08:36:33',3);

/*Table structure for table `tbl_project` */

DROP TABLE IF EXISTS `tbl_project`;

CREATE TABLE `tbl_project` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(128) default NULL,
  `description` text,
  `create_time` datetime default NULL,
  `create_user_id` int(11) default NULL,
  `update_time` datetime default NULL,
  `update_user_id` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_project` */

insert  into `tbl_project`(`id`,`name`,`description`,`create_time`,`create_user_id`,`update_time`,`update_user_id`) values (1,'Test Project 1','Test project number one','2010-01-01 00:00:00',1,'2010-01-01 00:00:00',1),(2,'Test Project 2','Test project number two','2010-01-01 00:00:00',1,'2011-09-10 19:20:37',3),(4,'Test Project','Test Project Description 12345','0000-00-00 00:00:00',NULL,'0000-00-00 00:00:00',NULL),(5,'HRIS V2','Human Resource Information System Version 2','2011-09-17 12:44:22',3,'2011-09-17 12:44:22',3),(6,'OGS V1','Online Grading System','2011-09-17 12:50:30',3,'2011-09-17 12:50:30',3),(7,'Filam Website','Filam Hardware Website','2011-09-17 12:59:27',4,'2011-09-17 12:59:27',4);

/*Table structure for table `tbl_project_user_assignment` */

DROP TABLE IF EXISTS `tbl_project_user_assignment`;

CREATE TABLE `tbl_project_user_assignment` (
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `create_time` datetime default NULL,
  `create_user_id` int(11) default NULL,
  `update_time` datetime default NULL,
  `update_user_id` int(11) default NULL,
  PRIMARY KEY  (`project_id`,`user_id`),
  KEY `FK_user_project` (`user_id`),
  CONSTRAINT `FK_project_user` FOREIGN KEY (`project_id`) REFERENCES `tbl_project` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_user_project` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_project_user_assignment` */

insert  into `tbl_project_user_assignment`(`project_id`,`user_id`,`create_time`,`create_user_id`,`update_time`,`update_user_id`) values (1,1,NULL,NULL,NULL,NULL),(1,2,NULL,NULL,NULL,NULL),(1,3,NULL,NULL,NULL,NULL),(1,4,NULL,NULL,NULL,NULL),(2,3,NULL,NULL,NULL,NULL),(5,3,NULL,NULL,NULL,NULL),(5,4,NULL,NULL,NULL,NULL),(6,3,NULL,NULL,NULL,NULL),(7,3,NULL,NULL,NULL,NULL),(7,4,NULL,NULL,NULL,NULL);

/*Table structure for table `tbl_project_user_role` */

DROP TABLE IF EXISTS `tbl_project_user_role`;

CREATE TABLE `tbl_project_user_role` (
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role` varchar(64) NOT NULL,
  PRIMARY KEY  (`project_id`,`user_id`,`role`),
  KEY `user_id` (`user_id`),
  KEY `role` (`role`),
  CONSTRAINT `tbl_project_user_role_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `tbl_project` (`id`),
  CONSTRAINT `tbl_project_user_role_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`),
  CONSTRAINT `tbl_project_user_role_ibfk_3` FOREIGN KEY (`role`) REFERENCES `AuthItem` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_project_user_role` */

insert  into `tbl_project_user_role`(`project_id`,`user_id`,`role`) values (1,1,'member'),(1,2,'reader'),(1,3,'owner'),(2,3,'reader'),(5,3,'owner'),(6,3,'owner'),(7,3,'reader'),(1,4,'member'),(5,4,'member'),(7,4,'owner');

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL auto_increment,
  `email` varchar(256) NOT NULL,
  `username` varchar(256) default NULL,
  `password` varchar(256) default NULL,
  `last_login_time` datetime default NULL,
  `create_time` datetime default NULL,
  `create_user_id` int(11) default NULL,
  `update_time` datetime default NULL,
  `update_user_id` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`id`,`email`,`username`,`password`,`last_login_time`,`create_time`,`create_user_id`,`update_time`,`update_user_id`) values (1,'test1@notanaddress.com','Test_User_One','5a105e8b9d40e1329780d62ea2265d8a','2011-09-11 09:43:05',NULL,NULL,NULL,NULL),(2,'test2@notanaddress.com','Test_User_Two','ad0234829205b9033196ba818f7a872b','2011-09-16 00:02:16',NULL,NULL,NULL,NULL),(3,'darrylanaud@gmail.com','darrylanaud','edfd5576c4ebaae7aca1c222d52fa8b4','2011-10-01 09:00:42','2011-09-09 13:57:25',0,'2011-09-09 13:57:25',0),(4,'leighsparadise@gmail.com','leigh','098f6bcd4621d373cade4e832627b4f6','2011-09-19 00:08:44','2011-09-16 00:11:07',NULL,'2011-09-16 00:11:07',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
