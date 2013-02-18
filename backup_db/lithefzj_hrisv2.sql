/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.0.95-community : Database - lithefzj_hrisv2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`lithefzj_hrisv2` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `lithefzj_hrisv2`;

/*Table structure for table `filecalo` */

DROP TABLE IF EXISTS `filecalo`;

CREATE TABLE `filecalo` (
  `caloid` int(11) NOT NULL auto_increment,
  `calllog` char(47) default NULL,
  `ACTIVATED` tinyint(1) default NULL,
  `DCREATED` date default NULL,
  `TCREATED` time default NULL,
  `DMODIFIED` date default NULL,
  `TMODIFIED` time default NULL,
  PRIMARY KEY  (`caloid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `filecalo` */

insert  into `filecalo`(`caloid`,`calllog`,`ACTIVATED`,`DCREATED`,`TCREATED`,`DMODIFIED`,`TMODIFIED`) values (1,'Sick Call Log',1,NULL,NULL,NULL,NULL),(2,'Emergency Call Log',1,NULL,NULL,NULL,NULL);

/*Table structure for table `filecourse` */

DROP TABLE IF EXISTS `filecourse`;

CREATE TABLE `filecourse` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(128) default NULL,
  `level_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `filecourse` */

/*Table structure for table `filedepartment` */

DROP TABLE IF EXISTS `filedepartment`;

CREATE TABLE `filedepartment` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(128) default NULL,
  `dmodified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `filedepartment` */

/*Table structure for table `fileedle` */

DROP TABLE IF EXISTS `fileedle`;

CREATE TABLE `fileedle` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(128) default NULL,
  `dmodified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `fileedle` */

/*Table structure for table `fileemployeecategory` */

DROP TABLE IF EXISTS `fileemployeecategory`;

CREATE TABLE `fileemployeecategory` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(128) default NULL,
  `dmodified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `fileemployeecategory` */

/*Table structure for table `fileemployeestatus` */

DROP TABLE IF EXISTS `fileemployeestatus`;

CREATE TABLE `fileemployeestatus` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(128) default NULL,
  `dmodified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `fileemployeestatus` */

/*Table structure for table `fileposition` */

DROP TABLE IF EXISTS `fileposition`;

CREATE TABLE `fileposition` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(128) default NULL,
  `dmodified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `fileposition` */

/*Table structure for table `fileschool` */

DROP TABLE IF EXISTS `fileschool`;

CREATE TABLE `fileschool` (
  `id` bigint(20) NOT NULL auto_increment,
  `description` varchar(128) default NULL,
  `abbreviation` varchar(20) default NULL,
  `school_address` varchar(250) default NULL,
  `dmodified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `fileschool` */

/*Table structure for table `filetrainingtype` */

DROP TABLE IF EXISTS `filetrainingtype`;

CREATE TABLE `filetrainingtype` (
  `id` bigint(20) NOT NULL auto_increment,
  `description` varchar(128) default NULL,
  `dmodified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `filetrainingtype` */

/*Table structure for table `groups` */

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `groups` */

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
) ENGINE=MyISAM AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;

/*Data for the table `module` */

insert  into `module`(`id`,`description`,`link`,`category_id`,`group`,`icon`,`order`,`is_public`) values (1,'Logout','main/logout',1,NULL,'',0,0),(64,'My Requests','apps/myRequest',21,NULL,NULL,0,1),(63,'My Profile','user',20,1,NULL,1,1),(62,'User Access Control','userMatrix',6,NULL,NULL,0,0),(61,'Employee Information','hr',19,NULL,NULL,0,0),(65,'Approver Setup','approver',24,NULL,NULL,0,0),(66,'Change Password','user/changePassword',20,1,NULL,2,1),(68,'Approvals','apps/myApproval',23,NULL,NULL,0,0),(69,'Call Logs','admin/callLog',23,NULL,NULL,0,0),(70,'Leave Setup','admin/leaveSetup',24,NULL,NULL,0,0),(71,'Holiday Setup','admin/holidaySetup',24,NULL,NULL,0,0),(72,'Memo','admin/memo',23,NULL,NULL,0,0),(73,'Notification','admin/notification',23,NULL,NULL,0,0),(74,'Suspension','admin/suspension',23,NULL,NULL,0,0),(75,'My Memo','user/memo',25,NULL,NULL,0,1),(76,'My Notification','user/notification',25,NULL,NULL,0,1),(77,'My Suspension','user/suspension',25,NULL,NULL,0,1),(78,'Employee Status','filereference/employeeStatus',26,NULL,NULL,0,0),(79,'Department','filereference/department',26,NULL,NULL,0,0),(80,'Position','filereference/position',26,NULL,NULL,0,0),(81,'Client Purpose','filereference/clientPurpose',26,NULL,NULL,0,0),(82,'My DTR','user/dtr',27,NULL,NULL,0,1),(83,'DTR','admin/dtr',28,NULL,NULL,0,0),(84,'User Administration','userMatrix/administration',6,NULL,NULL,0,0),(85,'Company Setup','admin/companySetup',24,NULL,NULL,0,0),(86,'My Whereabouts','user/whereabouts',27,NULL,NULL,0,1),(87,'Whereabouts','admin/whereabouts',28,NULL,NULL,0,0),(88,'Force Leave','admin/forceLeave',23,NULL,NULL,0,0),(89,'Leaves','admin/leaves',28,NULL,NULL,0,0),(90,'Exemption','admin/exemption',23,NULL,NULL,0,0),(91,'Leave Reset','admin/leaveReset',24,NULL,NULL,0,0),(92,'Upload DTR','admin/uploadDtr',NULL,NULL,NULL,NULL,1);

/*Table structure for table `module_category` */

DROP TABLE IF EXISTS `module_category`;

CREATE TABLE `module_category` (
  `id` bigint(20) NOT NULL auto_increment,
  `description` varchar(50) default NULL,
  `icon` varchar(50) default NULL,
  `order` int(10) default NULL,
  `is_public` tinyint(1) default NULL,
  `url` varchar(128) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Data for the table `module_category` */

insert  into `module_category`(`id`,`description`,`icon`,`order`,`is_public`,`url`) values (1,'ACCESS','/images/icons/key.png',1,0,NULL),(2,'FILE REFERENCE','/images/icons/folder.png',4,0,NULL),(21,'MY APPLICATIONS','/images/icons/application_form.png',2,NULL,NULL),(20,'MY ACCOUNT','/images/icons/user.png',1,NULL,NULL),(6,'USER MATRIX','/images/icons2/hammer_screwdriver.png',10,0,NULL),(8,'SUPPORT','/images/icons/lifebuoy.png',7,1,NULL),(19,'HR','/images/icons/group.png',6,0,NULL),(22,'LOGOUT',NULL,99,1,'main/logout'),(23,'APPLICATIONS','/images/icons2/user_business.png',7,0,NULL),(24,'SETUP','/images/icons/wrench.png',8,NULL,NULL),(25,'MY NOTICES','/images/icons/email_error.png',4,NULL,NULL),(26,'FILE REFERENCES','/images/icons/folder.png',5,NULL,NULL),(27,'MY REPORTS','/images/icons2/report.png',3,NULL,NULL),(28,'REPORTS','/images/icons/report.png',9,NULL,NULL);

/*Table structure for table `module_group` */

DROP TABLE IF EXISTS `module_group`;

CREATE TABLE `module_group` (
  `id` bigint(20) NOT NULL auto_increment,
  `description` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `module_group` */

insert  into `module_group`(`id`,`description`) values (1,'Super User');

/*Table structure for table `module_group_access` */

DROP TABLE IF EXISTS `module_group_access`;

CREATE TABLE `module_group_access` (
  `id` bigint(20) NOT NULL auto_increment,
  `group_id` int(20) default NULL,
  `module_id` int(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=165 DEFAULT CHARSET=latin1;

/*Data for the table `module_group_access` */

insert  into `module_group_access`(`id`,`group_id`,`module_id`) values (132,1,64),(141,1,62),(140,1,61),(139,1,68),(138,1,65),(143,1,69),(144,1,70),(145,1,71),(146,1,72),(147,1,73),(148,1,74),(149,1,75),(150,1,78),(151,1,79),(153,1,80),(154,1,81),(155,1,82),(156,1,83),(157,1,84),(158,1,85),(159,1,87),(160,1,88),(161,1,89),(162,1,90),(163,1,91);

/*Table structure for table `module_group_users` */

DROP TABLE IF EXISTS `module_group_users`;

CREATE TABLE `module_group_users` (
  `id` bigint(20) NOT NULL auto_increment,
  `username` varchar(100) default NULL,
  `group_id` int(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `module_group_users` */

insert  into `module_group_users`(`id`,`username`,`group_id`) values (1,'admin',1);

/*Table structure for table `supplier` */

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier` (
  `SUPPIDNO` int(11) NOT NULL auto_increment,
  `SUPPLIERNAME` varchar(250) NOT NULL,
  `STYPEIDNO` int(11) NOT NULL,
  `ADDRESS01` varchar(250) NOT NULL,
  `ADDRESS02` varchar(250) default NULL,
  `ADDRESS03` varchar(250) default NULL,
  `PHONE` varchar(16) default NULL,
  `FAXNO` varchar(16) default NULL,
  `MOBILE` varchar(16) default NULL,
  `WEBSITE` varchar(128) default NULL,
  `EMAIL` varchar(128) default NULL,
  `LOGO` varchar(128) default NULL,
  `MAP` varchar(128) default NULL,
  `active` tinyint(4) NOT NULL,
  `DMODIFIED` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`SUPPIDNO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `supplier` */

/*Table structure for table `tbl_app_flow` */

DROP TABLE IF EXISTS `tbl_app_flow`;

CREATE TABLE `tbl_app_flow` (
  `id` int(11) NOT NULL auto_increment,
  `employee_group_id` int(11) default NULL,
  `app_type_id` int(11) default NULL,
  `app_tree_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_tbl_app_flow_emp_group` (`employee_group_id`),
  KEY `FK_tbl_app_flow_tree` (`app_tree_id`),
  KEY `FK_tbl_app_flow_app_type` (`app_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_app_flow` */

insert  into `tbl_app_flow`(`id`,`employee_group_id`,`app_type_id`,`app_tree_id`) values (1,1,1,1),(2,1,2,1),(3,1,4,1),(4,1,6,1),(5,1,5,1);

/*Table structure for table `tbl_app_group` */

DROP TABLE IF EXISTS `tbl_app_group`;

CREATE TABLE `tbl_app_group` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(128) default NULL,
  `date_created` date default NULL,
  `time_created` time default NULL,
  `date_modified` date default NULL,
  `time_modified` time default NULL,
  `created_by` varchar(128) default NULL,
  `modified_by` varchar(128) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_app_group` */

insert  into `tbl_app_group`(`id`,`description`,`date_created`,`time_created`,`date_modified`,`time_modified`,`created_by`,`modified_by`) values (1,'Admin',NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `tbl_app_group_members` */

DROP TABLE IF EXISTS `tbl_app_group_members`;

CREATE TABLE `tbl_app_group_members` (
  `id` int(11) NOT NULL auto_increment,
  `app_group_id` int(11) default NULL,
  `employee_id` int(11) default NULL,
  `start_date` date default NULL,
  `end_date` date default NULL,
  `action_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `is_expired` tinyint(1) default '0',
  PRIMARY KEY  (`id`),
  KEY `FK_tbl_app_group_id` (`app_group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_app_group_members` */

insert  into `tbl_app_group_members`(`id`,`app_group_id`,`employee_id`,`start_date`,`end_date`,`action_timestamp`,`is_expired`) values (1,1,1,'2012-10-20',NULL,'2012-10-19 21:56:04',0);

/*Table structure for table `tbl_app_status` */

DROP TABLE IF EXISTS `tbl_app_status`;

CREATE TABLE `tbl_app_status` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(128) default NULL,
  `modified_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `modified_by` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_app_status` */

insert  into `tbl_app_status`(`id`,`description`,`modified_time`,`modified_by`) values (1,'Pending','2011-09-15 18:33:58',NULL),(2,'Approved','2011-09-15 18:34:02',NULL),(3,'Denied','2011-09-15 18:34:05',NULL),(4,'Cancelled','2011-09-15 18:34:10',NULL),(5,'System Void','2011-09-15 23:37:04',NULL);

/*Table structure for table `tbl_app_tree` */

DROP TABLE IF EXISTS `tbl_app_tree`;

CREATE TABLE `tbl_app_tree` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(128) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_app_tree` */

insert  into `tbl_app_tree`(`id`,`description`) values (1,'Test approver');

/*Table structure for table `tbl_app_tree_details` */

DROP TABLE IF EXISTS `tbl_app_tree_details`;

CREATE TABLE `tbl_app_tree_details` (
  `id` int(11) NOT NULL auto_increment,
  `app_tree_id` int(11) default NULL,
  `app_group_id` int(11) default NULL,
  `parent` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_tbl_app_tree_details_app_tree` (`app_tree_id`),
  KEY `FK_tbl_app_tree_details_app_group` (`app_group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_app_tree_details` */

insert  into `tbl_app_tree_details`(`id`,`app_tree_id`,`app_group_id`,`parent`) values (1,1,1,NULL);

/*Table structure for table `tbl_app_type` */

DROP TABLE IF EXISTS `tbl_app_type`;

CREATE TABLE `tbl_app_type` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(128) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_app_type` */

insert  into `tbl_app_type`(`id`,`description`) values (1,'OT'),(2,'Leave'),(4,'Client Schedule'),(5,'TITO'),(6,'Training');

/*Table structure for table `tbl_application_audit` */

DROP TABLE IF EXISTS `tbl_application_audit`;

CREATE TABLE `tbl_application_audit` (
  `id` int(11) NOT NULL auto_increment,
  `application_pk` int(11) default NULL,
  `app_type_id` int(11) default NULL,
  `app_type` varchar(128) default NULL,
  `action_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `approver_id` int(11) default NULL,
  `requestor` int(11) default NULL,
  `employee_group_id` int(11) default NULL,
  `app_group_id` int(11) default NULL,
  `app_tree_id` int(11) default NULL,
  `remarks` text,
  `status_id` int(11) default NULL,
  `is_active` tinyint(1) default NULL,
  `voided_by` int(11) default NULL,
  `force_leave_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `approver_id` (`approver_id`),
  KEY `requestor` (`requestor`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_application_audit` */

insert  into `tbl_application_audit`(`id`,`application_pk`,`app_type_id`,`app_type`,`action_timestamp`,`approver_id`,`requestor`,`employee_group_id`,`app_group_id`,`app_tree_id`,`remarks`,`status_id`,`is_active`,`voided_by`,`force_leave_id`) values (1,1,2,'Leave','2012-10-25 14:35:08',1,101,1,1,1,'ok',2,1,NULL,NULL),(2,1,1,'OT','2012-10-30 23:20:29',1,102,1,1,1,'No',2,1,NULL,NULL),(3,1,4,'Client Schedule','2012-10-30 23:19:29',1,102,1,1,1,'Yes',2,1,NULL,NULL),(4,1,6,'Training','2012-10-30 22:09:43',1,102,1,1,1,'Approved',2,1,NULL,NULL),(5,2,1,'OT','2012-10-30 23:21:06',1,101,1,1,1,'No',3,1,NULL,NULL),(6,2,6,'Training','2012-10-30 23:21:15',1,101,1,1,1,'Y',2,1,NULL,NULL),(7,2,4,'Client Schedule','2012-10-30 23:21:24',1,101,1,1,1,'Y',2,1,NULL,NULL),(8,2,2,'Leave','2012-11-05 22:47:28',1,101,1,1,1,'Force Leave by admin',2,1,NULL,2),(9,3,1,'OT','2012-11-08 09:43:58',NULL,101,1,1,1,NULL,1,1,NULL,NULL);

/*Table structure for table `tbl_call_log` */

DROP TABLE IF EXISTS `tbl_call_log`;

CREATE TABLE `tbl_call_log` (
  `id` int(11) NOT NULL auto_increment,
  `employee_id` int(11) default NULL,
  `call_log_type_id` int(11) default NULL,
  `date_from` date default NULL,
  `date_to` date default NULL,
  `portion` char(20) default NULL,
  `no_days` float default NULL,
  `date_requested` date default NULL,
  `requested_by` int(11) default NULL,
  `modified_by` int(11) default NULL,
  `reason` char(128) default NULL,
  `leave_filed` tinyint(1) default '0',
  `leave_id` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tbl_call_log` */

/*Table structure for table `tbl_client_schedule` */

DROP TABLE IF EXISTS `tbl_client_schedule`;

CREATE TABLE `tbl_client_schedule` (
  `id` int(11) NOT NULL auto_increment,
  `employee_id` int(11) default NULL,
  `date_scheduled` date default NULL,
  `time_in` time default NULL,
  `time_out` time default NULL,
  `type` char(50) default NULL,
  `client_id` int(11) default NULL,
  `contact_person_id` int(11) default NULL,
  `purpose_id` int(11) default NULL,
  `date_requested` date default NULL,
  `agenda` varchar(128) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_client_schedule` */

insert  into `tbl_client_schedule`(`id`,`employee_id`,`date_scheduled`,`time_in`,`time_out`,`type`,`client_id`,`contact_person_id`,`purpose_id`,`date_requested`,`agenda`) values (1,102,'2012-10-31','09:00:00','18:00:00','Client',1242,5,1,'2012-10-30','Test CS'),(2,101,'2012-11-06','08:00:00','12:00:00','Client',1110,5,18,'2012-10-30','Test');

/*Table structure for table `tbl_company_setup` */

DROP TABLE IF EXISTS `tbl_company_setup`;

CREATE TABLE `tbl_company_setup` (
  `id` int(11) NOT NULL auto_increment,
  `time_in` time default NULL,
  `time_out` time default NULL,
  `sick_leave_grace_period` float default NULL,
  `vacation_leave_grace_period` float default NULL,
  `vl_limit` float default NULL,
  `sl_limit` float default NULL,
  `el_limit` float default NULL,
  `ml_limit` float default NULL,
  `pl_limit` float default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_company_setup` */

insert  into `tbl_company_setup`(`id`,`time_in`,`time_out`,`sick_leave_grace_period`,`vacation_leave_grace_period`,`vl_limit`,`sl_limit`,`el_limit`,`ml_limit`,`pl_limit`) values (1,'08:00:00','17:00:00',2,2,6,6,0,60,7);

/*Table structure for table `tbl_dtr` */

DROP TABLE IF EXISTS `tbl_dtr`;

CREATE TABLE `tbl_dtr` (
  `id` int(11) NOT NULL auto_increment,
  `biometrics_id` char(15) default NULL,
  `dtr_log` datetime default NULL,
  `dtr_date` date default NULL,
  `dtr_time` time default NULL,
  `DCREATED` date default NULL,
  `TCREATED` time default NULL,
  `DMODIFIED` date default NULL,
  `TMODIFIED` time default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=631 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_dtr` */

insert  into `tbl_dtr`(`id`,`biometrics_id`,`dtr_log`,`dtr_date`,`dtr_time`,`DCREATED`,`TCREATED`,`DMODIFIED`,`TMODIFIED`) values (1,'11111','2012-07-02 09:00:00','2012-07-02','09:00:00',NULL,NULL,NULL,NULL),(2,'11111','2012-07-02 18:00:00','2012-07-02','18:00:00',NULL,NULL,NULL,NULL),(3,'11111','2012-07-03 09:00:00','2012-07-03','09:00:00',NULL,NULL,NULL,NULL),(4,'11111','2012-07-03 18:00:00','2012-07-03','18:00:00',NULL,NULL,NULL,NULL),(5,'11111','2012-07-04 09:00:00','2012-07-04','09:00:00',NULL,NULL,NULL,NULL),(6,'11111','2012-07-04 18:00:00','2012-07-04','18:00:00',NULL,NULL,NULL,NULL),(7,'11111','2012-07-05 09:00:00','2012-07-05','09:00:00',NULL,NULL,NULL,NULL),(8,'11111','2012-07-05 18:00:00','2012-07-05','18:00:00',NULL,NULL,NULL,NULL),(9,'11111','2012-07-06 09:00:00','2012-07-06','09:00:00',NULL,NULL,NULL,NULL),(10,'11111','2012-07-06 18:00:00','2012-07-06','18:00:00',NULL,NULL,NULL,NULL),(15,'11111','2012-07-09 09:00:00','2012-07-09','09:00:00',NULL,NULL,NULL,NULL),(16,'11111','2012-07-09 18:00:00','2012-07-09','18:00:00',NULL,NULL,NULL,NULL),(17,'11111','2012-07-10 09:00:00','2012-07-10','09:00:00',NULL,NULL,NULL,NULL),(18,'11111','2012-07-10 18:00:00','2012-07-10','18:00:00',NULL,NULL,NULL,NULL),(19,'11111','2012-07-11 09:00:00','2012-07-11','09:00:00',NULL,NULL,NULL,NULL),(20,'11111','2012-07-11 18:00:00','2012-07-11','18:00:00',NULL,NULL,NULL,NULL),(21,'11111','2012-07-12 09:00:00','2012-07-12','09:00:00',NULL,NULL,NULL,NULL),(22,'11111','2012-07-12 18:00:00','2012-07-12','18:00:00',NULL,NULL,NULL,NULL),(23,'11111','2012-07-13 09:00:00','2012-07-13','09:00:00',NULL,NULL,NULL,NULL),(24,'11111','2012-07-13 18:00:00','2012-07-13','18:00:00',NULL,NULL,NULL,NULL),(29,'11111','2012-07-16 09:00:00','2012-07-16','09:00:00',NULL,NULL,NULL,NULL),(30,'11111','2012-07-16 18:00:00','2012-07-16','18:00:00',NULL,NULL,NULL,NULL),(31,'11111','2012-07-17 09:00:00','2012-07-17','09:00:00',NULL,NULL,NULL,NULL),(32,'11111','2012-07-17 18:00:00','2012-07-17','18:00:00',NULL,NULL,NULL,NULL),(33,'11111','2012-07-18 09:00:00','2012-07-18','09:00:00',NULL,NULL,NULL,NULL),(34,'11111','2012-07-18 18:00:00','2012-07-18','18:00:00',NULL,NULL,NULL,NULL),(35,'11111','2012-07-19 09:00:00','2012-07-19','09:00:00',NULL,NULL,NULL,NULL),(36,'11111','2012-07-19 18:00:00','2012-07-19','18:00:00',NULL,NULL,NULL,NULL),(37,'11111','2012-07-20 09:00:00','2012-07-20','09:00:00',NULL,NULL,NULL,NULL),(38,'11111','2012-07-20 18:00:00','2012-07-20','18:00:00',NULL,NULL,NULL,NULL),(43,'11111','2012-07-23 09:00:00','2012-07-23','09:00:00',NULL,NULL,NULL,NULL),(44,'11111','2012-07-23 18:00:00','2012-07-23','18:00:00',NULL,NULL,NULL,NULL),(45,'11111','2012-07-24 09:00:00','2012-07-24','09:00:00',NULL,NULL,NULL,NULL),(46,'11111','2012-07-24 18:00:00','2012-07-24','18:00:00',NULL,NULL,NULL,NULL),(47,'11111','2012-07-25 09:00:00','2012-07-25','09:00:00',NULL,NULL,NULL,NULL),(48,'11111','2012-07-25 18:00:00','2012-07-25','18:00:00',NULL,NULL,NULL,NULL),(49,'11111','2012-07-26 09:00:00','2012-07-26','09:00:00',NULL,NULL,NULL,NULL),(50,'11111','2012-07-26 18:00:00','2012-07-26','18:00:00',NULL,NULL,NULL,NULL),(51,'11111','2012-07-27 09:00:00','2012-07-27','09:00:00',NULL,NULL,NULL,NULL),(52,'11111','2012-07-27 18:00:00','2012-07-27','18:00:00',NULL,NULL,NULL,NULL),(57,'11111','2012-07-30 09:00:00','2012-07-30','09:00:00',NULL,NULL,NULL,NULL),(58,'11111','2012-07-30 18:00:00','2012-07-30','18:00:00',NULL,NULL,NULL,NULL),(59,'11111','2012-07-31 09:00:00','2012-07-31','09:00:00',NULL,NULL,NULL,NULL),(60,'11111','2012-07-31 18:00:00','2012-07-31','18:00:00',NULL,NULL,NULL,NULL),(61,'11111','2012-08-01 09:00:00','2012-08-01','09:00:00',NULL,NULL,NULL,NULL),(62,'11111','2012-08-01 18:00:00','2012-08-01','18:00:00',NULL,NULL,NULL,NULL),(63,'11111','2012-08-02 09:00:00','2012-08-02','09:00:00',NULL,NULL,NULL,NULL),(64,'11111','2012-08-02 18:00:00','2012-08-02','18:00:00',NULL,NULL,NULL,NULL),(65,'11111','2012-08-03 09:00:00','2012-08-03','09:00:00',NULL,NULL,NULL,NULL),(66,'11111','2012-08-03 18:00:00','2012-08-03','18:00:00',NULL,NULL,NULL,NULL),(71,'11111','2012-08-06 09:00:00','2012-08-06','09:00:00',NULL,NULL,NULL,NULL),(72,'11111','2012-08-06 18:00:00','2012-08-06','18:00:00',NULL,NULL,NULL,NULL),(73,'11111','2012-08-07 09:00:00','2012-08-07','09:00:00',NULL,NULL,NULL,NULL),(74,'11111','2012-08-07 18:00:00','2012-08-07','18:00:00',NULL,NULL,NULL,NULL),(75,'11111','2012-08-08 09:00:00','2012-08-08','09:00:00',NULL,NULL,NULL,NULL),(76,'11111','2012-08-08 18:00:00','2012-08-08','18:00:00',NULL,NULL,NULL,NULL),(77,'11111','2012-08-09 09:00:00','2012-08-09','09:00:00',NULL,NULL,NULL,NULL),(78,'11111','2012-08-09 18:00:00','2012-08-09','18:00:00',NULL,NULL,NULL,NULL),(79,'11111','2012-08-10 09:00:00','2012-08-10','09:00:00',NULL,NULL,NULL,NULL),(80,'11111','2012-08-10 18:00:00','2012-08-10','18:00:00',NULL,NULL,NULL,NULL),(85,'11111','2012-08-13 09:00:00','2012-08-13','09:00:00',NULL,NULL,NULL,NULL),(86,'11111','2012-08-13 18:00:00','2012-08-13','18:00:00',NULL,NULL,NULL,NULL),(87,'11111','2012-08-14 09:00:00','2012-08-14','09:00:00',NULL,NULL,NULL,NULL),(88,'11111','2012-08-14 18:00:00','2012-08-14','18:00:00',NULL,NULL,NULL,NULL),(89,'11111','2012-08-15 09:00:00','2012-08-15','09:00:00',NULL,NULL,NULL,NULL),(90,'11111','2012-08-15 18:00:00','2012-08-15','18:00:00',NULL,NULL,NULL,NULL),(91,'11111','2012-08-16 09:00:00','2012-08-16','09:00:00',NULL,NULL,NULL,NULL),(92,'11111','2012-08-16 18:00:00','2012-08-16','18:00:00',NULL,NULL,NULL,NULL),(93,'11111','2012-08-17 09:00:00','2012-08-17','09:00:00',NULL,NULL,NULL,NULL),(94,'11111','2012-08-17 18:00:00','2012-08-17','18:00:00',NULL,NULL,NULL,NULL),(99,'11111','2012-08-20 09:00:00','2012-08-20','09:00:00',NULL,NULL,NULL,NULL),(100,'11111','2012-08-20 18:00:00','2012-08-20','18:00:00',NULL,NULL,NULL,NULL),(101,'11111','2012-08-21 09:00:00','2012-08-21','09:00:00',NULL,NULL,NULL,NULL),(102,'11111','2012-08-21 18:00:00','2012-08-21','18:00:00',NULL,NULL,NULL,NULL),(103,'11111','2012-08-22 09:00:00','2012-08-22','09:00:00',NULL,NULL,NULL,NULL),(104,'11111','2012-08-22 18:00:00','2012-08-22','18:00:00',NULL,NULL,NULL,NULL),(105,'11111','2012-08-23 09:00:00','2012-08-23','09:00:00',NULL,NULL,NULL,NULL),(106,'11111','2012-08-23 18:00:00','2012-08-23','18:00:00',NULL,NULL,NULL,NULL),(107,'11111','2012-08-24 09:00:00','2012-08-24','09:00:00',NULL,NULL,NULL,NULL),(108,'11111','2012-08-24 18:00:00','2012-08-24','18:00:00',NULL,NULL,NULL,NULL),(113,'11111','2012-08-27 09:00:00','2012-08-27','09:00:00',NULL,NULL,NULL,NULL),(114,'11111','2012-08-27 18:00:00','2012-08-27','18:00:00',NULL,NULL,NULL,NULL),(115,'11111','2012-08-28 09:00:00','2012-08-28','09:00:00',NULL,NULL,NULL,NULL),(116,'11111','2012-08-28 18:00:00','2012-08-28','18:00:00',NULL,NULL,NULL,NULL),(117,'11111','2012-08-29 09:00:00','2012-08-29','09:00:00',NULL,NULL,NULL,NULL),(118,'11111','2012-08-29 18:00:00','2012-08-29','18:00:00',NULL,NULL,NULL,NULL),(119,'11111','2012-08-30 09:00:00','2012-08-30','09:00:00',NULL,NULL,NULL,NULL),(120,'11111','2012-08-30 18:00:00','2012-08-30','18:00:00',NULL,NULL,NULL,NULL),(121,'11111','2012-08-31 09:00:00','2012-08-31','09:00:00',NULL,NULL,NULL,NULL),(122,'11111','2012-08-31 18:00:00','2012-08-31','18:00:00',NULL,NULL,NULL,NULL),(127,'11111','2012-09-03 09:00:00','2012-09-03','09:00:00',NULL,NULL,NULL,NULL),(128,'11111','2012-09-03 18:00:00','2012-09-03','18:00:00',NULL,NULL,NULL,NULL),(129,'11111','2012-09-04 09:00:00','2012-09-04','09:00:00',NULL,NULL,NULL,NULL),(130,'11111','2012-09-04 18:00:00','2012-09-04','18:00:00',NULL,NULL,NULL,NULL),(131,'11111','2012-09-05 09:00:00','2012-09-05','09:00:00',NULL,NULL,NULL,NULL),(132,'11111','2012-09-05 18:00:00','2012-09-05','18:00:00',NULL,NULL,NULL,NULL),(133,'11111','2012-09-06 09:00:00','2012-09-06','09:00:00',NULL,NULL,NULL,NULL),(134,'11111','2012-09-06 18:00:00','2012-09-06','18:00:00',NULL,NULL,NULL,NULL),(135,'11111','2012-09-07 09:00:00','2012-09-07','09:00:00',NULL,NULL,NULL,NULL),(136,'11111','2012-09-07 18:00:00','2012-09-07','18:00:00',NULL,NULL,NULL,NULL),(141,'11111','2012-09-10 09:00:00','2012-09-10','09:00:00',NULL,NULL,NULL,NULL),(142,'11111','2012-09-10 18:00:00','2012-09-10','18:00:00',NULL,NULL,NULL,NULL),(143,'11111','2012-09-11 09:00:00','2012-09-11','09:00:00',NULL,NULL,NULL,NULL),(144,'11111','2012-09-11 18:00:00','2012-09-11','18:00:00',NULL,NULL,NULL,NULL),(145,'11111','2012-09-12 09:00:00','2012-09-12','09:00:00',NULL,NULL,NULL,NULL),(146,'11111','2012-09-12 18:00:00','2012-09-12','18:00:00',NULL,NULL,NULL,NULL),(147,'11111','2012-09-13 09:00:00','2012-09-13','09:00:00',NULL,NULL,NULL,NULL),(148,'11111','2012-09-13 18:00:00','2012-09-13','18:00:00',NULL,NULL,NULL,NULL),(149,'11111','2012-09-14 09:00:00','2012-09-14','09:00:00',NULL,NULL,NULL,NULL),(150,'11111','2012-09-14 18:00:00','2012-09-14','18:00:00',NULL,NULL,NULL,NULL),(155,'11111','2012-09-17 09:00:00','2012-09-17','09:00:00',NULL,NULL,NULL,NULL),(156,'11111','2012-09-17 18:00:00','2012-09-17','18:00:00',NULL,NULL,NULL,NULL),(157,'11111','2012-09-18 09:00:00','2012-09-18','09:00:00',NULL,NULL,NULL,NULL),(158,'11111','2012-09-18 18:00:00','2012-09-18','18:00:00',NULL,NULL,NULL,NULL),(159,'11111','2012-09-19 09:00:00','2012-09-19','09:00:00',NULL,NULL,NULL,NULL),(160,'11111','2012-09-19 18:00:00','2012-09-19','18:00:00',NULL,NULL,NULL,NULL),(161,'11111','2012-09-20 09:00:00','2012-09-20','09:00:00',NULL,NULL,NULL,NULL),(162,'11111','2012-09-20 18:00:00','2012-09-20','18:00:00',NULL,NULL,NULL,NULL),(163,'11111','2012-09-21 09:00:00','2012-09-21','09:00:00',NULL,NULL,NULL,NULL),(164,'11111','2012-09-21 18:00:00','2012-09-21','18:00:00',NULL,NULL,NULL,NULL),(169,'11111','2012-09-24 09:00:00','2012-09-24','09:00:00',NULL,NULL,NULL,NULL),(170,'11111','2012-09-24 18:00:00','2012-09-24','18:00:00',NULL,NULL,NULL,NULL),(171,'11111','2012-09-25 09:00:00','2012-09-25','09:00:00',NULL,NULL,NULL,NULL),(172,'11111','2012-09-25 18:00:00','2012-09-25','18:00:00',NULL,NULL,NULL,NULL),(173,'11111','2012-09-26 09:00:00','2012-09-26','09:00:00',NULL,NULL,NULL,NULL),(174,'11111','2012-09-26 18:00:00','2012-09-26','18:00:00',NULL,NULL,NULL,NULL),(175,'11111','2012-09-27 09:00:00','2012-09-27','09:00:00',NULL,NULL,NULL,NULL),(176,'11111','2012-09-27 18:00:00','2012-09-27','18:00:00',NULL,NULL,NULL,NULL),(177,'11111','2012-09-28 09:00:00','2012-09-28','09:00:00',NULL,NULL,NULL,NULL),(178,'11111','2012-09-28 18:00:00','2012-09-28','18:00:00',NULL,NULL,NULL,NULL),(183,'11111','2012-10-01 09:00:00','2012-10-01','09:00:00',NULL,NULL,NULL,NULL),(184,'11111','2012-10-01 18:00:00','2012-10-01','18:00:00',NULL,NULL,NULL,NULL),(185,'11111','2012-10-02 09:00:00','2012-10-02','09:00:00',NULL,NULL,NULL,NULL),(186,'11111','2012-10-02 18:00:00','2012-10-02','18:00:00',NULL,NULL,NULL,NULL),(187,'11111','2012-10-03 09:00:00','2012-10-03','09:00:00',NULL,NULL,NULL,NULL),(188,'11111','2012-10-03 18:00:00','2012-10-03','18:00:00',NULL,NULL,NULL,NULL),(189,'11111','2012-10-04 09:00:00','2012-10-04','09:00:00',NULL,NULL,NULL,NULL),(190,'11111','2012-10-04 18:00:00','2012-10-04','18:00:00',NULL,NULL,NULL,NULL),(191,'11111','2012-10-05 09:00:00','2012-10-05','09:00:00',NULL,NULL,NULL,NULL),(192,'11111','2012-10-05 18:00:00','2012-10-05','18:00:00',NULL,NULL,NULL,NULL),(197,'11111','2012-10-08 09:00:00','2012-10-08','09:00:00',NULL,NULL,NULL,NULL),(198,'11111','2012-10-08 18:00:00','2012-10-08','18:00:00',NULL,NULL,NULL,NULL),(199,'11111','2012-10-09 09:00:00','2012-10-09','09:00:00',NULL,NULL,NULL,NULL),(200,'11111','2012-10-09 18:00:00','2012-10-09','18:00:00',NULL,NULL,NULL,NULL),(201,'11111','2012-10-10 09:00:00','2012-10-10','09:00:00',NULL,NULL,NULL,NULL),(202,'11111','2012-10-10 18:00:00','2012-10-10','18:00:00',NULL,NULL,NULL,NULL),(203,'11111','2012-10-11 09:00:00','2012-10-11','09:00:00',NULL,NULL,NULL,NULL),(204,'11111','2012-10-11 18:00:00','2012-10-11','18:00:00',NULL,NULL,NULL,NULL),(205,'11111','2012-10-12 09:00:00','2012-10-12','09:00:00',NULL,NULL,NULL,NULL),(206,'11111','2012-10-12 18:00:00','2012-10-12','18:00:00',NULL,NULL,NULL,NULL),(211,'11111','2012-10-15 09:00:00','2012-10-15','09:00:00',NULL,NULL,NULL,NULL),(212,'11111','2012-10-15 18:00:00','2012-10-15','18:00:00',NULL,NULL,NULL,NULL),(213,'11111','2012-10-16 09:00:00','2012-10-16','09:00:00',NULL,NULL,NULL,NULL),(214,'11111','2012-10-16 18:00:00','2012-10-16','18:00:00',NULL,NULL,NULL,NULL),(215,'11111','2012-10-17 09:00:00','2012-10-17','09:00:00',NULL,NULL,NULL,NULL),(216,'11111','2012-10-17 18:00:00','2012-10-17','18:00:00',NULL,NULL,NULL,NULL),(217,'11111','2012-10-18 09:00:00','2012-10-18','09:00:00',NULL,NULL,NULL,NULL),(218,'11111','2012-10-18 18:00:00','2012-10-18','18:00:00',NULL,NULL,NULL,NULL),(219,'11111','2012-10-19 09:00:00','2012-10-19','09:00:00',NULL,NULL,NULL,NULL),(220,'11111','2012-10-19 18:00:00','2012-10-19','18:00:00',NULL,NULL,NULL,NULL),(225,'11111','2012-10-22 09:00:00','2012-10-22','09:00:00',NULL,NULL,NULL,NULL),(226,'11111','2012-10-22 18:00:00','2012-10-22','18:00:00',NULL,NULL,NULL,NULL),(227,'11111','2012-10-23 09:00:00','2012-10-23','09:00:00',NULL,NULL,NULL,NULL),(228,'11111','2012-10-23 18:00:00','2012-10-23','18:00:00',NULL,NULL,NULL,NULL),(229,'11111','2012-10-24 09:00:00','2012-10-24','09:00:00',NULL,NULL,NULL,NULL),(230,'11111','2012-10-24 18:00:00','2012-10-24','18:00:00',NULL,NULL,NULL,NULL),(233,'11111','2012-10-26 09:00:00','2012-10-26','09:00:00',NULL,NULL,NULL,NULL),(234,'11111','2012-10-26 18:00:00','2012-10-26','18:00:00',NULL,NULL,NULL,NULL),(239,'11111','2012-10-29 09:00:00','2012-10-29','09:00:00',NULL,NULL,NULL,NULL),(240,'11111','2012-10-29 18:00:00','2012-10-29','18:00:00',NULL,NULL,NULL,NULL),(241,'11111','2012-10-30 09:00:00','2012-10-30','09:00:00',NULL,NULL,NULL,NULL),(242,'11111','2012-10-30 18:00:00','2012-10-30','18:00:00',NULL,NULL,NULL,NULL),(243,'22222','2012-07-23 09:00:00','2012-07-23','09:00:00',NULL,NULL,NULL,NULL),(244,'22222','2012-07-23 18:00:00','2012-07-23','18:00:00',NULL,NULL,NULL,NULL),(245,'22222','2012-07-24 09:00:00','2012-07-24','09:00:00',NULL,NULL,NULL,NULL),(246,'22222','2012-07-24 18:00:00','2012-07-24','18:00:00',NULL,NULL,NULL,NULL),(247,'22222','2012-07-25 09:00:00','2012-07-25','09:00:00',NULL,NULL,NULL,NULL),(248,'22222','2012-07-25 18:00:00','2012-07-25','18:00:00',NULL,NULL,NULL,NULL),(249,'22222','2012-07-26 09:00:00','2012-07-26','09:00:00',NULL,NULL,NULL,NULL),(250,'22222','2012-07-26 18:00:00','2012-07-26','18:00:00',NULL,NULL,NULL,NULL),(251,'22222','2012-07-27 09:00:00','2012-07-27','09:00:00',NULL,NULL,NULL,NULL),(252,'22222','2012-07-27 18:00:00','2012-07-27','18:00:00',NULL,NULL,NULL,NULL),(257,'22222','2012-07-30 09:00:00','2012-07-30','09:00:00',NULL,NULL,NULL,NULL),(258,'22222','2012-07-30 18:00:00','2012-07-30','18:00:00',NULL,NULL,NULL,NULL),(259,'22222','2012-07-31 09:00:00','2012-07-31','09:00:00',NULL,NULL,NULL,NULL),(260,'22222','2012-07-31 18:00:00','2012-07-31','18:00:00',NULL,NULL,NULL,NULL),(261,'22222','2012-08-01 09:00:00','2012-08-01','09:00:00',NULL,NULL,NULL,NULL),(262,'22222','2012-08-01 18:00:00','2012-08-01','18:00:00',NULL,NULL,NULL,NULL),(263,'22222','2012-08-02 09:00:00','2012-08-02','09:00:00',NULL,NULL,NULL,NULL),(264,'22222','2012-08-02 18:00:00','2012-08-02','18:00:00',NULL,NULL,NULL,NULL),(265,'22222','2012-08-03 09:00:00','2012-08-03','09:00:00',NULL,NULL,NULL,NULL),(266,'22222','2012-08-03 18:00:00','2012-08-03','18:00:00',NULL,NULL,NULL,NULL),(271,'22222','2012-08-06 09:00:00','2012-08-06','09:00:00',NULL,NULL,NULL,NULL),(272,'22222','2012-08-06 18:00:00','2012-08-06','18:00:00',NULL,NULL,NULL,NULL),(273,'22222','2012-08-07 09:00:00','2012-08-07','09:00:00',NULL,NULL,NULL,NULL),(274,'22222','2012-08-07 18:00:00','2012-08-07','18:00:00',NULL,NULL,NULL,NULL),(275,'22222','2012-08-08 09:00:00','2012-08-08','09:00:00',NULL,NULL,NULL,NULL),(276,'22222','2012-08-08 18:00:00','2012-08-08','18:00:00',NULL,NULL,NULL,NULL),(277,'22222','2012-08-09 09:00:00','2012-08-09','09:00:00',NULL,NULL,NULL,NULL),(278,'22222','2012-08-09 18:00:00','2012-08-09','18:00:00',NULL,NULL,NULL,NULL),(279,'22222','2012-08-10 09:00:00','2012-08-10','09:00:00',NULL,NULL,NULL,NULL),(280,'22222','2012-08-10 18:00:00','2012-08-10','18:00:00',NULL,NULL,NULL,NULL),(285,'22222','2012-08-13 09:00:00','2012-08-13','09:00:00',NULL,NULL,NULL,NULL),(286,'22222','2012-08-13 18:00:00','2012-08-13','18:00:00',NULL,NULL,NULL,NULL),(287,'22222','2012-08-14 09:00:00','2012-08-14','09:00:00',NULL,NULL,NULL,NULL),(288,'22222','2012-08-14 18:00:00','2012-08-14','18:00:00',NULL,NULL,NULL,NULL),(289,'22222','2012-08-15 09:00:00','2012-08-15','09:00:00',NULL,NULL,NULL,NULL),(290,'22222','2012-08-15 18:00:00','2012-08-15','18:00:00',NULL,NULL,NULL,NULL),(291,'22222','2012-08-16 09:00:00','2012-08-16','09:00:00',NULL,NULL,NULL,NULL),(292,'22222','2012-08-16 18:00:00','2012-08-16','18:00:00',NULL,NULL,NULL,NULL),(293,'22222','2012-08-17 09:00:00','2012-08-17','09:00:00',NULL,NULL,NULL,NULL),(294,'22222','2012-08-17 18:00:00','2012-08-17','18:00:00',NULL,NULL,NULL,NULL),(299,'22222','2012-08-20 09:00:00','2012-08-20','09:00:00',NULL,NULL,NULL,NULL),(300,'22222','2012-08-20 18:00:00','2012-08-20','18:00:00',NULL,NULL,NULL,NULL),(301,'22222','2012-08-21 09:00:00','2012-08-21','09:00:00',NULL,NULL,NULL,NULL),(302,'22222','2012-08-21 18:00:00','2012-08-21','18:00:00',NULL,NULL,NULL,NULL),(303,'22222','2012-08-22 09:00:00','2012-08-22','09:00:00',NULL,NULL,NULL,NULL),(304,'22222','2012-08-22 18:00:00','2012-08-22','18:00:00',NULL,NULL,NULL,NULL),(305,'22222','2012-08-23 09:00:00','2012-08-23','09:00:00',NULL,NULL,NULL,NULL),(306,'22222','2012-08-23 18:00:00','2012-08-23','18:00:00',NULL,NULL,NULL,NULL),(307,'22222','2012-08-24 09:00:00','2012-08-24','09:00:00',NULL,NULL,NULL,NULL),(308,'22222','2012-08-24 18:00:00','2012-08-24','18:00:00',NULL,NULL,NULL,NULL),(313,'22222','2012-08-27 09:00:00','2012-08-27','09:00:00',NULL,NULL,NULL,NULL),(314,'22222','2012-08-27 18:00:00','2012-08-27','18:00:00',NULL,NULL,NULL,NULL),(315,'22222','2012-08-28 09:00:00','2012-08-28','09:00:00',NULL,NULL,NULL,NULL),(316,'22222','2012-08-28 18:00:00','2012-08-28','18:00:00',NULL,NULL,NULL,NULL),(317,'22222','2012-08-29 09:00:00','2012-08-29','09:00:00',NULL,NULL,NULL,NULL),(318,'22222','2012-08-29 18:00:00','2012-08-29','18:00:00',NULL,NULL,NULL,NULL),(319,'22222','2012-08-30 09:00:00','2012-08-30','09:00:00',NULL,NULL,NULL,NULL),(320,'22222','2012-08-30 18:00:00','2012-08-30','18:00:00',NULL,NULL,NULL,NULL),(321,'22222','2012-08-31 09:00:00','2012-08-31','09:00:00',NULL,NULL,NULL,NULL),(322,'22222','2012-08-31 18:00:00','2012-08-31','18:00:00',NULL,NULL,NULL,NULL),(327,'22222','2012-09-03 09:00:00','2012-09-03','09:00:00',NULL,NULL,NULL,NULL),(328,'22222','2012-09-03 18:00:00','2012-09-03','18:00:00',NULL,NULL,NULL,NULL),(329,'22222','2012-09-04 09:00:00','2012-09-04','09:00:00',NULL,NULL,NULL,NULL),(330,'22222','2012-09-04 18:00:00','2012-09-04','18:00:00',NULL,NULL,NULL,NULL),(331,'22222','2012-09-05 09:00:00','2012-09-05','09:00:00',NULL,NULL,NULL,NULL),(332,'22222','2012-09-05 18:00:00','2012-09-05','18:00:00',NULL,NULL,NULL,NULL),(333,'22222','2012-09-06 09:00:00','2012-09-06','09:00:00',NULL,NULL,NULL,NULL),(334,'22222','2012-09-06 18:00:00','2012-09-06','18:00:00',NULL,NULL,NULL,NULL),(335,'22222','2012-09-07 09:00:00','2012-09-07','09:00:00',NULL,NULL,NULL,NULL),(336,'22222','2012-09-07 18:00:00','2012-09-07','18:00:00',NULL,NULL,NULL,NULL),(341,'22222','2012-09-10 09:00:00','2012-09-10','09:00:00',NULL,NULL,NULL,NULL),(342,'22222','2012-09-10 18:00:00','2012-09-10','18:00:00',NULL,NULL,NULL,NULL),(343,'22222','2012-09-11 09:00:00','2012-09-11','09:00:00',NULL,NULL,NULL,NULL),(344,'22222','2012-09-11 18:00:00','2012-09-11','18:00:00',NULL,NULL,NULL,NULL),(345,'22222','2012-09-12 09:00:00','2012-09-12','09:00:00',NULL,NULL,NULL,NULL),(346,'22222','2012-09-12 18:00:00','2012-09-12','18:00:00',NULL,NULL,NULL,NULL),(347,'22222','2012-09-13 09:00:00','2012-09-13','09:00:00',NULL,NULL,NULL,NULL),(348,'22222','2012-09-13 18:00:00','2012-09-13','18:00:00',NULL,NULL,NULL,NULL),(349,'22222','2012-09-14 09:00:00','2012-09-14','09:00:00',NULL,NULL,NULL,NULL),(350,'22222','2012-09-14 18:00:00','2012-09-14','18:00:00',NULL,NULL,NULL,NULL),(355,'22222','2012-09-17 09:00:00','2012-09-17','09:00:00',NULL,NULL,NULL,NULL),(356,'22222','2012-09-17 18:00:00','2012-09-17','18:00:00',NULL,NULL,NULL,NULL),(357,'22222','2012-09-18 09:00:00','2012-09-18','09:00:00',NULL,NULL,NULL,NULL),(358,'22222','2012-09-18 18:00:00','2012-09-18','18:00:00',NULL,NULL,NULL,NULL),(359,'22222','2012-09-19 09:00:00','2012-09-19','09:00:00',NULL,NULL,NULL,NULL),(360,'22222','2012-09-19 18:00:00','2012-09-19','18:00:00',NULL,NULL,NULL,NULL),(361,'22222','2012-09-20 09:00:00','2012-09-20','09:00:00',NULL,NULL,NULL,NULL),(362,'22222','2012-09-20 18:00:00','2012-09-20','18:00:00',NULL,NULL,NULL,NULL),(363,'22222','2012-09-21 09:00:00','2012-09-21','09:00:00',NULL,NULL,NULL,NULL),(364,'22222','2012-09-21 18:00:00','2012-09-21','18:00:00',NULL,NULL,NULL,NULL),(369,'22222','2012-09-24 09:00:00','2012-09-24','09:00:00',NULL,NULL,NULL,NULL),(370,'22222','2012-09-24 18:00:00','2012-09-24','18:00:00',NULL,NULL,NULL,NULL),(371,'22222','2012-09-25 09:00:00','2012-09-25','09:00:00',NULL,NULL,NULL,NULL),(372,'22222','2012-09-25 18:00:00','2012-09-25','18:00:00',NULL,NULL,NULL,NULL),(373,'22222','2012-09-26 09:00:00','2012-09-26','09:00:00',NULL,NULL,NULL,NULL),(374,'22222','2012-09-26 18:00:00','2012-09-26','18:00:00',NULL,NULL,NULL,NULL),(375,'22222','2012-09-27 09:00:00','2012-09-27','09:00:00',NULL,NULL,NULL,NULL),(376,'22222','2012-09-27 18:00:00','2012-09-27','18:00:00',NULL,NULL,NULL,NULL),(377,'22222','2012-09-28 09:00:00','2012-09-28','09:00:00',NULL,NULL,NULL,NULL),(378,'22222','2012-09-28 18:00:00','2012-09-28','18:00:00',NULL,NULL,NULL,NULL),(383,'22222','2012-10-01 09:00:00','2012-10-01','09:00:00',NULL,NULL,NULL,NULL),(384,'22222','2012-10-01 18:00:00','2012-10-01','18:00:00',NULL,NULL,NULL,NULL),(385,'22222','2012-10-02 09:00:00','2012-10-02','09:00:00',NULL,NULL,NULL,NULL),(386,'22222','2012-10-02 18:00:00','2012-10-02','18:00:00',NULL,NULL,NULL,NULL),(387,'22222','2012-10-03 09:00:00','2012-10-03','09:00:00',NULL,NULL,NULL,NULL),(388,'22222','2012-10-03 18:00:00','2012-10-03','18:00:00',NULL,NULL,NULL,NULL),(389,'22222','2012-10-04 09:00:00','2012-10-04','09:00:00',NULL,NULL,NULL,NULL),(390,'22222','2012-10-04 18:00:00','2012-10-04','18:00:00',NULL,NULL,NULL,NULL),(391,'22222','2012-10-05 09:00:00','2012-10-05','09:00:00',NULL,NULL,NULL,NULL),(392,'22222','2012-10-05 18:00:00','2012-10-05','18:00:00',NULL,NULL,NULL,NULL),(397,'22222','2012-10-08 09:00:00','2012-10-08','09:00:00',NULL,NULL,NULL,NULL),(398,'22222','2012-10-08 18:00:00','2012-10-08','18:00:00',NULL,NULL,NULL,NULL),(399,'22222','2012-10-09 09:00:00','2012-10-09','09:00:00',NULL,NULL,NULL,NULL),(400,'22222','2012-10-09 18:00:00','2012-10-09','18:00:00',NULL,NULL,NULL,NULL),(401,'22222','2012-10-10 09:00:00','2012-10-10','09:00:00',NULL,NULL,NULL,NULL),(402,'22222','2012-10-10 18:00:00','2012-10-10','18:00:00',NULL,NULL,NULL,NULL),(403,'22222','2012-10-11 09:00:00','2012-10-11','09:00:00',NULL,NULL,NULL,NULL),(404,'22222','2012-10-11 18:00:00','2012-10-11','18:00:00',NULL,NULL,NULL,NULL),(405,'22222','2012-10-12 09:00:00','2012-10-12','09:00:00',NULL,NULL,NULL,NULL),(406,'22222','2012-10-12 18:00:00','2012-10-12','18:00:00',NULL,NULL,NULL,NULL),(411,'22222','2012-10-15 09:00:00','2012-10-15','09:00:00',NULL,NULL,NULL,NULL),(412,'22222','2012-10-15 18:00:00','2012-10-15','18:00:00',NULL,NULL,NULL,NULL),(413,'22222','2012-10-16 09:00:00','2012-10-16','09:00:00',NULL,NULL,NULL,NULL),(414,'22222','2012-10-16 18:00:00','2012-10-16','18:00:00',NULL,NULL,NULL,NULL),(415,'22222','2012-10-17 09:00:00','2012-10-17','09:00:00',NULL,NULL,NULL,NULL),(416,'22222','2012-10-17 18:00:00','2012-10-17','18:00:00',NULL,NULL,NULL,NULL),(417,'22222','2012-10-18 09:00:00','2012-10-18','09:00:00',NULL,NULL,NULL,NULL),(418,'22222','2012-10-18 18:00:00','2012-10-18','18:00:00',NULL,NULL,NULL,NULL),(419,'22222','2012-10-19 09:00:00','2012-10-19','09:00:00',NULL,NULL,NULL,NULL),(420,'22222','2012-10-19 18:00:00','2012-10-19','18:00:00',NULL,NULL,NULL,NULL),(425,'22222','2012-10-22 09:00:00','2012-10-22','09:00:00',NULL,NULL,NULL,NULL),(426,'22222','2012-10-22 18:00:00','2012-10-22','18:00:00',NULL,NULL,NULL,NULL),(427,'22222','2012-10-23 09:00:00','2012-10-23','09:00:00',NULL,NULL,NULL,NULL),(428,'22222','2012-10-23 18:00:00','2012-10-23','18:00:00',NULL,NULL,NULL,NULL),(429,'22222','2012-10-24 09:00:00','2012-10-24','09:00:00',NULL,NULL,NULL,NULL),(430,'22222','2012-10-24 18:00:00','2012-10-24','18:00:00',NULL,NULL,NULL,NULL),(431,'22222','2012-10-25 09:00:00','2012-10-25','09:00:00',NULL,NULL,NULL,NULL),(432,'22222','2012-10-25 18:00:00','2012-10-25','18:00:00',NULL,NULL,NULL,NULL),(433,'22222','2012-10-26 09:00:00','2012-10-26','09:00:00',NULL,NULL,NULL,NULL),(434,'22222','2012-10-26 18:00:00','2012-10-26','18:00:00',NULL,NULL,NULL,NULL),(439,'22222','2012-10-29 09:00:00','2012-10-29','09:00:00',NULL,NULL,NULL,NULL),(440,'22222','2012-10-29 18:00:00','2012-10-29','18:00:00',NULL,NULL,NULL,NULL),(441,'22222','2012-10-30 09:00:00','2012-10-30','09:00:00',NULL,NULL,NULL,NULL),(442,'22222','2012-10-30 18:00:00','2012-10-30','18:00:00',NULL,NULL,NULL,NULL),(445,'33333','2012-07-30 09:00:00','2012-07-30','09:00:00',NULL,NULL,NULL,NULL),(446,'33333','2012-07-30 18:00:00','2012-07-30','18:00:00',NULL,NULL,NULL,NULL),(447,'33333','2012-07-31 09:00:00','2012-07-31','09:00:00',NULL,NULL,NULL,NULL),(448,'33333','2012-07-31 18:00:00','2012-07-31','18:00:00',NULL,NULL,NULL,NULL),(449,'33333','2012-08-01 09:00:00','2012-08-01','09:00:00',NULL,NULL,NULL,NULL),(450,'33333','2012-08-01 18:00:00','2012-08-01','18:00:00',NULL,NULL,NULL,NULL),(451,'33333','2012-08-02 09:00:00','2012-08-02','09:00:00',NULL,NULL,NULL,NULL),(452,'33333','2012-08-02 18:00:00','2012-08-02','18:00:00',NULL,NULL,NULL,NULL),(453,'33333','2012-08-03 09:00:00','2012-08-03','09:00:00',NULL,NULL,NULL,NULL),(454,'33333','2012-08-03 18:00:00','2012-08-03','18:00:00',NULL,NULL,NULL,NULL),(459,'33333','2012-08-06 09:00:00','2012-08-06','09:00:00',NULL,NULL,NULL,NULL),(460,'33333','2012-08-06 18:00:00','2012-08-06','18:00:00',NULL,NULL,NULL,NULL),(461,'33333','2012-08-07 09:00:00','2012-08-07','09:00:00',NULL,NULL,NULL,NULL),(462,'33333','2012-08-07 18:00:00','2012-08-07','18:00:00',NULL,NULL,NULL,NULL),(463,'33333','2012-08-08 09:00:00','2012-08-08','09:00:00',NULL,NULL,NULL,NULL),(464,'33333','2012-08-08 18:00:00','2012-08-08','18:00:00',NULL,NULL,NULL,NULL),(465,'33333','2012-08-09 09:00:00','2012-08-09','09:00:00',NULL,NULL,NULL,NULL),(466,'33333','2012-08-09 18:00:00','2012-08-09','18:00:00',NULL,NULL,NULL,NULL),(467,'33333','2012-08-10 09:00:00','2012-08-10','09:00:00',NULL,NULL,NULL,NULL),(468,'33333','2012-08-10 18:00:00','2012-08-10','18:00:00',NULL,NULL,NULL,NULL),(473,'33333','2012-08-13 09:00:00','2012-08-13','09:00:00',NULL,NULL,NULL,NULL),(474,'33333','2012-08-13 18:00:00','2012-08-13','18:00:00',NULL,NULL,NULL,NULL),(475,'33333','2012-08-14 09:00:00','2012-08-14','09:00:00',NULL,NULL,NULL,NULL),(476,'33333','2012-08-14 18:00:00','2012-08-14','18:00:00',NULL,NULL,NULL,NULL),(477,'33333','2012-08-15 09:00:00','2012-08-15','09:00:00',NULL,NULL,NULL,NULL),(478,'33333','2012-08-15 18:00:00','2012-08-15','18:00:00',NULL,NULL,NULL,NULL),(479,'33333','2012-08-16 09:00:00','2012-08-16','09:00:00',NULL,NULL,NULL,NULL),(480,'33333','2012-08-16 18:00:00','2012-08-16','18:00:00',NULL,NULL,NULL,NULL),(481,'33333','2012-08-17 09:00:00','2012-08-17','09:00:00',NULL,NULL,NULL,NULL),(482,'33333','2012-08-17 18:00:00','2012-08-17','18:00:00',NULL,NULL,NULL,NULL),(487,'33333','2012-08-20 09:00:00','2012-08-20','09:00:00',NULL,NULL,NULL,NULL),(488,'33333','2012-08-20 18:00:00','2012-08-20','18:00:00',NULL,NULL,NULL,NULL),(489,'33333','2012-08-21 09:00:00','2012-08-21','09:00:00',NULL,NULL,NULL,NULL),(490,'33333','2012-08-21 18:00:00','2012-08-21','18:00:00',NULL,NULL,NULL,NULL),(491,'33333','2012-08-22 09:00:00','2012-08-22','09:00:00',NULL,NULL,NULL,NULL),(492,'33333','2012-08-22 18:00:00','2012-08-22','18:00:00',NULL,NULL,NULL,NULL),(493,'33333','2012-08-23 09:00:00','2012-08-23','09:00:00',NULL,NULL,NULL,NULL),(494,'33333','2012-08-23 18:00:00','2012-08-23','18:00:00',NULL,NULL,NULL,NULL),(495,'33333','2012-08-24 09:00:00','2012-08-24','09:00:00',NULL,NULL,NULL,NULL),(496,'33333','2012-08-24 18:00:00','2012-08-24','18:00:00',NULL,NULL,NULL,NULL),(501,'33333','2012-08-27 09:00:00','2012-08-27','09:00:00',NULL,NULL,NULL,NULL),(502,'33333','2012-08-27 18:00:00','2012-08-27','18:00:00',NULL,NULL,NULL,NULL),(503,'33333','2012-08-28 09:00:00','2012-08-28','09:00:00',NULL,NULL,NULL,NULL),(504,'33333','2012-08-28 18:00:00','2012-08-28','18:00:00',NULL,NULL,NULL,NULL),(505,'33333','2012-08-29 09:00:00','2012-08-29','09:00:00',NULL,NULL,NULL,NULL),(506,'33333','2012-08-29 18:00:00','2012-08-29','18:00:00',NULL,NULL,NULL,NULL),(507,'33333','2012-08-30 09:00:00','2012-08-30','09:00:00',NULL,NULL,NULL,NULL),(508,'33333','2012-08-30 18:00:00','2012-08-30','18:00:00',NULL,NULL,NULL,NULL),(509,'33333','2012-08-31 09:00:00','2012-08-31','09:00:00',NULL,NULL,NULL,NULL),(510,'33333','2012-08-31 18:00:00','2012-08-31','18:00:00',NULL,NULL,NULL,NULL),(515,'33333','2012-09-03 09:00:00','2012-09-03','09:00:00',NULL,NULL,NULL,NULL),(516,'33333','2012-09-03 18:00:00','2012-09-03','18:00:00',NULL,NULL,NULL,NULL),(517,'33333','2012-09-04 09:00:00','2012-09-04','09:00:00',NULL,NULL,NULL,NULL),(518,'33333','2012-09-04 18:00:00','2012-09-04','18:00:00',NULL,NULL,NULL,NULL),(519,'33333','2012-09-05 09:00:00','2012-09-05','09:00:00',NULL,NULL,NULL,NULL),(520,'33333','2012-09-05 18:00:00','2012-09-05','18:00:00',NULL,NULL,NULL,NULL),(521,'33333','2012-09-06 09:00:00','2012-09-06','09:00:00',NULL,NULL,NULL,NULL),(522,'33333','2012-09-06 18:00:00','2012-09-06','18:00:00',NULL,NULL,NULL,NULL),(523,'33333','2012-09-07 09:00:00','2012-09-07','09:00:00',NULL,NULL,NULL,NULL),(524,'33333','2012-09-07 18:00:00','2012-09-07','18:00:00',NULL,NULL,NULL,NULL),(529,'33333','2012-09-10 09:00:00','2012-09-10','09:00:00',NULL,NULL,NULL,NULL),(530,'33333','2012-09-10 18:00:00','2012-09-10','18:00:00',NULL,NULL,NULL,NULL),(531,'33333','2012-09-11 09:00:00','2012-09-11','09:00:00',NULL,NULL,NULL,NULL),(532,'33333','2012-09-11 18:00:00','2012-09-11','18:00:00',NULL,NULL,NULL,NULL),(533,'33333','2012-09-12 09:00:00','2012-09-12','09:00:00',NULL,NULL,NULL,NULL),(534,'33333','2012-09-12 18:00:00','2012-09-12','18:00:00',NULL,NULL,NULL,NULL),(535,'33333','2012-09-13 09:00:00','2012-09-13','09:00:00',NULL,NULL,NULL,NULL),(536,'33333','2012-09-13 18:00:00','2012-09-13','18:00:00',NULL,NULL,NULL,NULL),(537,'33333','2012-09-14 09:00:00','2012-09-14','09:00:00',NULL,NULL,NULL,NULL),(538,'33333','2012-09-14 18:00:00','2012-09-14','18:00:00',NULL,NULL,NULL,NULL),(543,'33333','2012-09-17 09:00:00','2012-09-17','09:00:00',NULL,NULL,NULL,NULL),(544,'33333','2012-09-17 18:00:00','2012-09-17','18:00:00',NULL,NULL,NULL,NULL),(545,'33333','2012-09-18 09:00:00','2012-09-18','09:00:00',NULL,NULL,NULL,NULL),(546,'33333','2012-09-18 18:00:00','2012-09-18','18:00:00',NULL,NULL,NULL,NULL),(547,'33333','2012-09-19 09:00:00','2012-09-19','09:00:00',NULL,NULL,NULL,NULL),(548,'33333','2012-09-19 18:00:00','2012-09-19','18:00:00',NULL,NULL,NULL,NULL),(549,'33333','2012-09-20 09:00:00','2012-09-20','09:00:00',NULL,NULL,NULL,NULL),(550,'33333','2012-09-20 18:00:00','2012-09-20','18:00:00',NULL,NULL,NULL,NULL),(551,'33333','2012-09-21 09:00:00','2012-09-21','09:00:00',NULL,NULL,NULL,NULL),(552,'33333','2012-09-21 18:00:00','2012-09-21','18:00:00',NULL,NULL,NULL,NULL),(557,'33333','2012-09-24 09:00:00','2012-09-24','09:00:00',NULL,NULL,NULL,NULL),(558,'33333','2012-09-24 18:00:00','2012-09-24','18:00:00',NULL,NULL,NULL,NULL),(559,'33333','2012-09-25 09:00:00','2012-09-25','09:00:00',NULL,NULL,NULL,NULL),(560,'33333','2012-09-25 18:00:00','2012-09-25','18:00:00',NULL,NULL,NULL,NULL),(561,'33333','2012-09-26 09:00:00','2012-09-26','09:00:00',NULL,NULL,NULL,NULL),(562,'33333','2012-09-26 18:00:00','2012-09-26','18:00:00',NULL,NULL,NULL,NULL),(563,'33333','2012-09-27 09:00:00','2012-09-27','09:00:00',NULL,NULL,NULL,NULL),(564,'33333','2012-09-27 18:00:00','2012-09-27','18:00:00',NULL,NULL,NULL,NULL),(565,'33333','2012-09-28 09:00:00','2012-09-28','09:00:00',NULL,NULL,NULL,NULL),(566,'33333','2012-09-28 18:00:00','2012-09-28','18:00:00',NULL,NULL,NULL,NULL),(571,'33333','2012-10-01 09:00:00','2012-10-01','09:00:00',NULL,NULL,NULL,NULL),(572,'33333','2012-10-01 18:00:00','2012-10-01','18:00:00',NULL,NULL,NULL,NULL),(573,'33333','2012-10-02 09:00:00','2012-10-02','09:00:00',NULL,NULL,NULL,NULL),(574,'33333','2012-10-02 18:00:00','2012-10-02','18:00:00',NULL,NULL,NULL,NULL),(575,'33333','2012-10-03 09:00:00','2012-10-03','09:00:00',NULL,NULL,NULL,NULL),(576,'33333','2012-10-03 18:00:00','2012-10-03','18:00:00',NULL,NULL,NULL,NULL),(577,'33333','2012-10-04 09:00:00','2012-10-04','09:00:00',NULL,NULL,NULL,NULL),(578,'33333','2012-10-04 18:00:00','2012-10-04','18:00:00',NULL,NULL,NULL,NULL),(579,'33333','2012-10-05 09:00:00','2012-10-05','09:00:00',NULL,NULL,NULL,NULL),(580,'33333','2012-10-05 18:00:00','2012-10-05','18:00:00',NULL,NULL,NULL,NULL),(585,'33333','2012-10-08 09:00:00','2012-10-08','09:00:00',NULL,NULL,NULL,NULL),(586,'33333','2012-10-08 18:00:00','2012-10-08','18:00:00',NULL,NULL,NULL,NULL),(587,'33333','2012-10-09 09:00:00','2012-10-09','09:00:00',NULL,NULL,NULL,NULL),(588,'33333','2012-10-09 18:00:00','2012-10-09','18:00:00',NULL,NULL,NULL,NULL),(589,'33333','2012-10-10 09:00:00','2012-10-10','09:00:00',NULL,NULL,NULL,NULL),(590,'33333','2012-10-10 18:00:00','2012-10-10','18:00:00',NULL,NULL,NULL,NULL),(591,'33333','2012-10-11 09:00:00','2012-10-11','09:00:00',NULL,NULL,NULL,NULL),(592,'33333','2012-10-11 18:00:00','2012-10-11','18:00:00',NULL,NULL,NULL,NULL),(593,'33333','2012-10-12 09:00:00','2012-10-12','09:00:00',NULL,NULL,NULL,NULL),(594,'33333','2012-10-12 18:00:00','2012-10-12','18:00:00',NULL,NULL,NULL,NULL),(599,'33333','2012-10-15 09:00:00','2012-10-15','09:00:00',NULL,NULL,NULL,NULL),(600,'33333','2012-10-15 18:00:00','2012-10-15','18:00:00',NULL,NULL,NULL,NULL),(601,'33333','2012-10-16 09:00:00','2012-10-16','09:00:00',NULL,NULL,NULL,NULL),(602,'33333','2012-10-16 18:00:00','2012-10-16','18:00:00',NULL,NULL,NULL,NULL),(603,'33333','2012-10-17 09:00:00','2012-10-17','09:00:00',NULL,NULL,NULL,NULL),(604,'33333','2012-10-17 18:00:00','2012-10-17','18:00:00',NULL,NULL,NULL,NULL),(605,'33333','2012-10-18 09:00:00','2012-10-18','09:00:00',NULL,NULL,NULL,NULL),(606,'33333','2012-10-18 18:00:00','2012-10-18','18:00:00',NULL,NULL,NULL,NULL),(607,'33333','2012-10-19 09:00:00','2012-10-19','09:00:00',NULL,NULL,NULL,NULL),(608,'33333','2012-10-19 18:00:00','2012-10-19','18:00:00',NULL,NULL,NULL,NULL),(613,'33333','2012-10-22 09:00:00','2012-10-22','09:00:00',NULL,NULL,NULL,NULL),(614,'33333','2012-10-22 18:00:00','2012-10-22','18:00:00',NULL,NULL,NULL,NULL),(615,'33333','2012-10-23 09:00:00','2012-10-23','09:00:00',NULL,NULL,NULL,NULL),(616,'33333','2012-10-23 18:00:00','2012-10-23','18:00:00',NULL,NULL,NULL,NULL),(617,'33333','2012-10-24 09:00:00','2012-10-24','09:00:00',NULL,NULL,NULL,NULL),(618,'33333','2012-10-24 18:00:00','2012-10-24','18:00:00',NULL,NULL,NULL,NULL),(619,'33333','2012-10-25 09:00:00','2012-10-25','09:00:00',NULL,NULL,NULL,NULL),(620,'33333','2012-10-25 18:00:00','2012-10-25','18:00:00',NULL,NULL,NULL,NULL),(621,'33333','2012-10-26 09:00:00','2012-10-26','09:00:00',NULL,NULL,NULL,NULL),(622,'33333','2012-10-26 18:00:00','2012-10-26','18:00:00',NULL,NULL,NULL,NULL),(627,'33333','2012-10-29 09:00:00','2012-10-29','09:00:00',NULL,NULL,NULL,NULL),(628,'33333','2012-10-29 18:00:00','2012-10-29','18:00:00',NULL,NULL,NULL,NULL),(629,'33333','2012-10-30 09:00:00','2012-10-30','09:00:00',NULL,NULL,NULL,NULL),(630,'33333','2012-10-30 18:00:00','2012-10-30','18:00:00',NULL,NULL,NULL,NULL);

/*Table structure for table `tbl_educational_background` */

DROP TABLE IF EXISTS `tbl_educational_background`;

CREATE TABLE `tbl_educational_background` (
  `id` int(11) NOT NULL auto_increment,
  `employee_id` int(11) default NULL,
  `school_id` int(11) default NULL,
  `course_id` int(11) default NULL,
  `date_start` date default NULL,
  `date_end` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tbl_educational_background` */

/*Table structure for table `tbl_employee_group` */

DROP TABLE IF EXISTS `tbl_employee_group`;

CREATE TABLE `tbl_employee_group` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(128) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_employee_group` */

insert  into `tbl_employee_group`(`id`,`description`) values (1,'Test Group');

/*Table structure for table `tbl_employee_group_members` */

DROP TABLE IF EXISTS `tbl_employee_group_members`;

CREATE TABLE `tbl_employee_group_members` (
  `id` int(11) NOT NULL auto_increment,
  `employee_group_id` int(11) default NULL,
  `employee_id` int(11) default NULL,
  `start_date` date default NULL,
  `end_date` date default NULL,
  `action_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_employee_group_members` */

insert  into `tbl_employee_group_members`(`id`,`employee_group_id`,`employee_id`,`start_date`,`end_date`,`action_timestamp`) values (1,1,101,'2012-08-01',NULL,'2012-10-19 22:09:18'),(2,1,102,'2012-08-01',NULL,'2012-10-19 22:09:25');

/*Table structure for table `tbl_employee_info` */

DROP TABLE IF EXISTS `tbl_employee_info`;

CREATE TABLE `tbl_employee_info` (
  `id` int(11) NOT NULL auto_increment,
  `employee_idno` char(10) default NULL,
  `lastname` varchar(128) NOT NULL,
  `firstname` varchar(128) NOT NULL,
  `middlename` varchar(128) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `civil_status` varchar(9) NOT NULL,
  `email` varchar(64) default NULL,
  `birthdate` date NOT NULL,
  `birth_place` varchar(128) NOT NULL,
  `address` varchar(250) NOT NULL,
  `provincial_address` varchar(250) default NULL,
  `fathers_name` varchar(250) default NULL,
  `fathers_occupation` varchar(128) default NULL,
  `mothers_name` varchar(250) default NULL,
  `mothers_occupation` varchar(128) default NULL,
  `CITIIDNO` varchar(5) default NULL,
  `spouse_name` varchar(250) default NULL,
  `spouse_occupation` varchar(128) default NULL,
  `childrens_name` varchar(250) default NULL,
  `telephone` varchar(50) default NULL,
  `mobile` varchar(50) default NULL,
  `department` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `salary` varchar(50) default NULL,
  `employee_category` int(11) NOT NULL,
  `employee_status` int(11) NOT NULL,
  `sss` varchar(50) default NULL,
  `tin` varchar(50) default NULL,
  `date_hired` date default NULL,
  `resigned` char(1) default 'N',
  `date_resigned` date default NULL,
  `reason` varchar(128) default NULL,
  `emergency_contact` varchar(250) default NULL,
  `emergency_phone` varchar(50) default NULL,
  `emergency_address` varchar(250) default NULL,
  `username` varchar(128) default NULL,
  `password` varchar(128) default NULL,
  `user_type` varchar(20) default 'USER',
  `biometrics_id` char(15) default NULL,
  `is_delete` tinyint(1) default '0',
  `ACTIVATED` tinyint(1) default '1',
  PRIMARY KEY  (`id`),
  KEY `FK_tbl_employee_info_dept` (`department`),
  KEY `FK_tbl_employee_info_emca` (`employee_category`),
  KEY `FK_tbl_employee_info_emst` (`employee_status`),
  KEY `FK_tbl_employee_info_posi` (`position`)
) ENGINE=MyISAM AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_employee_info` */

insert  into `tbl_employee_info`(`id`,`employee_idno`,`lastname`,`firstname`,`middlename`,`gender`,`civil_status`,`email`,`birthdate`,`birth_place`,`address`,`provincial_address`,`fathers_name`,`fathers_occupation`,`mothers_name`,`mothers_occupation`,`CITIIDNO`,`spouse_name`,`spouse_occupation`,`childrens_name`,`telephone`,`mobile`,`department`,`position`,`salary`,`employee_category`,`employee_status`,`sss`,`tin`,`date_hired`,`resigned`,`date_resigned`,`reason`,`emergency_contact`,`emergency_phone`,`emergency_address`,`username`,`password`,`user_type`,`biometrics_id`,`is_delete`,`ACTIVATED`) values (1,'admin','admin','admin','admin','M','Single',NULL,'1987-02-01','admin','admin','admin','admin','admin','admin','admin','00001','admin','admin','admin','admin','admin',1,1,'admin',1,1,'admin','admin','2012-09-20','N',NULL,NULL,'admin','admin','admin','admin','781dfaf9ea370ff78f7477d02ff000b25facfe01','ADMIN',NULL,0,1),(101,'54321','Test 1','Test 1','Test 1','M','Single','test1@gmail.com','2012-10-20','Test 1','Test 1','Test 1','Test 1','Test 1','Test 1','Test 1','00001',NULL,NULL,NULL,'Test 1','Test 1',6,1,NULL,2,1,NULL,NULL,'2012-07-02','N',NULL,NULL,NULL,NULL,NULL,'test1','25d55ad283aa400af464c76d713c07ad','USER','11111',0,1),(102,'22222','Test 2','Test 2','Test 2','M','Married','test2@yahoo.co','1982-01-30','Test 2','Test 2','Test 2','Test 2','Test 2','Test 2','Test 2','00001',NULL,NULL,NULL,'Test 2','Test 2',23,1,NULL,2,1,NULL,NULL,'2012-07-23','N',NULL,NULL,NULL,NULL,NULL,'test2','25d55ad283aa400af464c76d713c07ad','USER','22222',0,1),(103,'33333','Test 3','Test 3','Test 3','F','Married','test3@admin.com','2012-10-20','Test 3','Test 3','Test 3','Test 3','Test 3','Test 3','Test 3','00001',NULL,NULL,NULL,'Test 3','Test 3',21,2,NULL,2,1,NULL,NULL,'2012-07-29','N',NULL,NULL,NULL,NULL,NULL,'test3','25d55ad283aa400af464c76d713c07ad','USER','33333',0,1);

/*Table structure for table `tbl_employee_info_copy` */

DROP TABLE IF EXISTS `tbl_employee_info_copy`;

CREATE TABLE `tbl_employee_info_copy` (
  `id` bigint(20) NOT NULL auto_increment,
  `lastname` varchar(128) NOT NULL,
  `firstname` varchar(128) NOT NULL,
  `middlename` varchar(128) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `civil_status` varchar(9) NOT NULL,
  `email` varchar(64) default NULL,
  `birthdate` date NOT NULL,
  `birth_place` varchar(128) NOT NULL,
  `address` varchar(250) NOT NULL,
  `provincial_address` varchar(250) default NULL,
  `fathers_name` varchar(250) default NULL,
  `fathers_occupation` varchar(128) default NULL,
  `mothers_name` varchar(250) default NULL,
  `mothers_occupation` varchar(128) default NULL,
  `citizenship` varchar(128) default NULL,
  `spouse_name` varchar(250) default NULL,
  `spouse_occupation` varchar(128) default NULL,
  `childrens_name` varchar(250) default NULL,
  `telephone` varchar(50) default NULL,
  `mobile` varchar(50) default NULL,
  `department` bigint(20) NOT NULL,
  `position` bigint(20) NOT NULL,
  `salary` varchar(50) default NULL,
  `employee_category` bigint(20) NOT NULL,
  `employee_status` bigint(20) NOT NULL,
  `sss` varchar(50) default NULL,
  `tin` varchar(50) default NULL,
  `date_hired` date default NULL,
  `date_resigned` date default NULL,
  `reason` varchar(128) default NULL,
  `emergency_contact` varchar(250) default NULL,
  `emergency_phone` varchar(50) default NULL,
  `emergency_address` varchar(250) default NULL,
  `username` varchar(128) default NULL,
  `password` varchar(128) default NULL,
  `is_delete` tinyint(1) default '0',
  PRIMARY KEY  (`id`),
  KEY `FK_tbl_employee_info_dept` (`department`),
  KEY `FK_tbl_employee_info_emca` (`employee_category`),
  KEY `FK_tbl_employee_info_emst` (`employee_status`),
  KEY `FK_tbl_employee_info_posi` (`position`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_employee_info_copy` */

insert  into `tbl_employee_info_copy`(`id`,`lastname`,`firstname`,`middlename`,`gender`,`civil_status`,`email`,`birthdate`,`birth_place`,`address`,`provincial_address`,`fathers_name`,`fathers_occupation`,`mothers_name`,`mothers_occupation`,`citizenship`,`spouse_name`,`spouse_occupation`,`childrens_name`,`telephone`,`mobile`,`department`,`position`,`salary`,`employee_category`,`employee_status`,`sss`,`tin`,`date_hired`,`date_resigned`,`reason`,`emergency_contact`,`emergency_phone`,`emergency_address`,`username`,`password`,`is_delete`) values (1,'Anaud','Darryl','Campos','M','Single','darrylanaud@gmail.com','2011-04-30','Cotabato City','Dumanlas, Buhangin, Davao City','','Virgilio Anaud','COO','Concepcion Anaud','Housewife','filipino','','',NULL,'3004615','09234477228',1,1,'30000',1,1,'','','2011-04-25',NULL,'','','','','darryl.anaud','098f6bcd4621d373cade4e832627b4f6',0),(2,'Rivas','Maribeth','G','F','Single','leighsparadise@gmail.com','2011-04-30','Davao City','Davao City','','abn','ab','ab','ab','Filipino','','',NULL,'','',4,1,'25000',1,1,'','','2011-04-30',NULL,'','','','','maribeth.rivas','25d55ad283aa400af464c76d713c07ad',1),(3,'Enova','John','E','M','Single','john.enova@gmail.com','2011-04-30','sample','Davao City','sample','Da','sdf','sdf','fsdfdsf','Filipino',NULL,NULL,NULL,NULL,'09234412356',1,1,'25000',1,1,NULL,NULL,'2011-04-26',NULL,NULL,NULL,NULL,NULL,'john.enova','25d55ad283aa400af464c76d713c07ad',0),(4,'Piatos','Edmund','Arellano','M','Married','eapiatos@yahoo.com','2011-04-30','davao','Davao City',NULL,'a','a','a','a','Filipino',NULL,NULL,NULL,NULL,NULL,1,2,NULL,1,1,NULL,NULL,'2011-04-27',NULL,NULL,NULL,NULL,NULL,'edmund.piatos','25d55ad283aa400af464c76d713c07ad',0),(5,'Mendoza','Jasmine','T','F','Married','jm@yahoo.com','2011-04-30','davao city','Davao City Philippines',NULL,'a','a','a','a','Filipino',NULL,NULL,NULL,NULL,NULL,1,3,NULL,1,1,NULL,NULL,'2011-04-28',NULL,NULL,NULL,NULL,NULL,'jmendoza','6c42264bad29e6ac66b833f6f1921068',0),(6,'Hall','Dean','William','M','Single','wqewq@yahoo.com','1981-05-25','davao','test','test','test','test','test','test','filipino','test','test','test','234-6978','+639278350960',4,1,'60000',2,1,'48787-45487','45445-88978-7878','2011-05-02','2011-02-16','rerere','ere','212478','erer','dean.hall','25d55ad283aa400af464c76d713c07ad',0);

/*Table structure for table `tbl_employee_leave_credits` */

DROP TABLE IF EXISTS `tbl_employee_leave_credits`;

CREATE TABLE `tbl_employee_leave_credits` (
  `id` int(11) NOT NULL auto_increment,
  `employee_id` int(11) NOT NULL,
  `vacation_leave` float default '0',
  `sick_leave` float default '0',
  `paternity_leave` float default '0',
  `maternity_leave` float default '0',
  `emergency_leave` float default '0',
  `year` char(4) default NULL,
  `DCREATED` date default NULL,
  `TCREATED` time default NULL,
  `DMODIFIED` date default NULL,
  `TMODIFIED` time default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_employee_leave_credits` */

insert  into `tbl_employee_leave_credits`(`id`,`employee_id`,`vacation_leave`,`sick_leave`,`paternity_leave`,`maternity_leave`,`emergency_leave`,`year`,`DCREATED`,`TCREATED`,`DMODIFIED`,`TMODIFIED`) values (1,1,6,6,7,0,0,'2012',NULL,NULL,NULL,NULL),(2,101,6,6,7,0,0,'2012',NULL,NULL,NULL,NULL),(3,102,6,6,7,0,0,'2012',NULL,NULL,NULL,NULL);

/*Table structure for table `tbl_employee_movement` */

DROP TABLE IF EXISTS `tbl_employee_movement`;

CREATE TABLE `tbl_employee_movement` (
  `id` bigint(20) NOT NULL auto_increment,
  `employee_id` bigint(20) unsigned default NULL,
  `department_id` bigint(20) unsigned default NULL,
  `position_id` bigint(20) unsigned default NULL,
  `salary` decimal(10,2) default NULL,
  `movement_date` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tbl_employee_movement` */

/*Table structure for table `tbl_employee_schedule` */

DROP TABLE IF EXISTS `tbl_employee_schedule`;

CREATE TABLE `tbl_employee_schedule` (
  `id` int(11) NOT NULL auto_increment,
  `employee_id` int(11) default NULL,
  `date_time_in` date default NULL,
  `time_in` time default NULL,
  `date_time_out` date default NULL,
  `time_out` time default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tbl_employee_schedule` */

/*Table structure for table `tbl_employment_history` */

DROP TABLE IF EXISTS `tbl_employment_history`;

CREATE TABLE `tbl_employment_history` (
  `id` int(11) NOT NULL auto_increment,
  `employee_id` int(11) NOT NULL,
  `company` varchar(128) NOT NULL,
  `company_address` varchar(250) default NULL,
  `position` varchar(128) NOT NULL,
  `date_start` date default NULL,
  `date_end` date default NULL,
  `reason_for_leaving` varchar(250) default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_tbl_employment_history_employee_id` (`employee_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tbl_employment_history` */

/*Table structure for table `tbl_exemption` */

DROP TABLE IF EXISTS `tbl_exemption`;

CREATE TABLE `tbl_exemption` (
  `id` int(11) NOT NULL auto_increment,
  `employee_id` int(11) default NULL,
  `app_type` int(11) default NULL,
  `date_to` date default NULL,
  `reason` char(100) default NULL,
  `date_requested` date default NULL,
  `requested_by` int(11) default NULL,
  `modified_by` int(11) default NULL,
  `DMODIFIED` date default NULL,
  `TMODIFIED` time default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tbl_exemption` */

/*Table structure for table `tbl_force_leave` */

DROP TABLE IF EXISTS `tbl_force_leave`;

CREATE TABLE `tbl_force_leave` (
  `id` int(11) NOT NULL auto_increment,
  `employee_id` int(11) default NULL,
  `date_from` date default NULL,
  `date_to` date default NULL,
  `no_days` float default NULL,
  `leave_type` int(11) default NULL,
  `date_requested` date default NULL,
  `reason` varchar(128) default NULL,
  `requested_by` int(11) default NULL,
  `status` char(15) default NULL,
  `modified_by` int(11) default NULL,
  `DMODIFIED` timestamp NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_force_leave` */

insert  into `tbl_force_leave`(`id`,`employee_id`,`date_from`,`date_to`,`no_days`,`leave_type`,`date_requested`,`reason`,`requested_by`,`status`,`modified_by`,`DMODIFIED`) values (2,101,'2012-11-05','2012-11-05',1,8,'2012-11-05','Test force leave',1,'Approved',NULL,'2012-11-05 08:47:28');

/*Table structure for table `tbl_holiday` */

DROP TABLE IF EXISTS `tbl_holiday`;

CREATE TABLE `tbl_holiday` (
  `id` int(11) NOT NULL auto_increment,
  `holiday_name` char(47) default NULL,
  `holiday_date` date default NULL,
  `type` char(20) default NULL,
  `requested_by` int(11) default NULL,
  `modified_by` int(11) default NULL,
  `description` char(128) default NULL,
  `DCREATED` date default NULL,
  `TCREATED` time default NULL,
  `DMODIFIED` date default NULL,
  `TMODIFIED` time default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tbl_holiday` */

/*Table structure for table `tbl_leave_application` */

DROP TABLE IF EXISTS `tbl_leave_application`;

CREATE TABLE `tbl_leave_application` (
  `id` int(11) NOT NULL auto_increment,
  `employee_id` int(11) default NULL,
  `date_from` date default NULL,
  `date_to` date default NULL,
  `no_days` float default NULL,
  `portion` char(10) default NULL,
  `leave_type` int(11) default NULL,
  `date_requested` date default NULL,
  `reason` varchar(128) default NULL,
  `force_leave_id` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_leave_application` */

insert  into `tbl_leave_application`(`id`,`employee_id`,`date_from`,`date_to`,`no_days`,`portion`,`leave_type`,`date_requested`,`reason`,`force_leave_id`) values (1,101,'2012-10-25','2012-10-25',1,'WHOLE DAY',1,'2012-10-20','Test',NULL),(2,101,'2012-11-05','2012-11-05',1,NULL,1,'2012-11-05','Test force leave',2);

/*Table structure for table `tbl_leave_reset` */

DROP TABLE IF EXISTS `tbl_leave_reset`;

CREATE TABLE `tbl_leave_reset` (
  `id` int(11) NOT NULL auto_increment,
  `year` year(4) default NULL,
  `reset_date` date default NULL,
  `is_active` tinyint(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_leave_reset` */

insert  into `tbl_leave_reset`(`id`,`year`,`reset_date`,`is_active`) values (1,2012,'2012-01-01',NULL),(2,2013,'2013-01-01',NULL);

/*Table structure for table `tbl_leave_type` */

DROP TABLE IF EXISTS `tbl_leave_type`;

CREATE TABLE `tbl_leave_type` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(128) default NULL,
  `ACTIVATED` tinyint(1) default '1',
  `dcreated` date default NULL,
  `tcreated` time default NULL,
  `dmodified` date default NULL,
  `tmodified` time default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_leave_type` */

insert  into `tbl_leave_type`(`id`,`description`,`ACTIVATED`,`dcreated`,`tcreated`,`dmodified`,`tmodified`) values (1,'Vacation Leave',1,NULL,NULL,NULL,NULL),(2,'Sick Leave',1,NULL,NULL,NULL,NULL),(3,'Emergency Leave',1,NULL,NULL,NULL,NULL),(4,'Unpaid Vacation Leave',1,NULL,NULL,NULL,NULL),(5,'Unpaid Sick Leave',1,NULL,NULL,NULL,NULL),(6,'Maternity Leave',0,NULL,NULL,NULL,NULL),(7,'Paternity Leave',0,NULL,NULL,NULL,NULL),(8,'Force Leave',0,NULL,NULL,NULL,NULL),(9,'Offset Leave',1,NULL,NULL,NULL,NULL);

/*Table structure for table `tbl_lithefire` */

DROP TABLE IF EXISTS `tbl_lithefire`;

CREATE TABLE `tbl_lithefire` (
  `lithefire` char(40) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tbl_lithefire` */

/*Table structure for table `tbl_logs` */

DROP TABLE IF EXISTS `tbl_logs`;

CREATE TABLE `tbl_logs` (
  `id` bigint(20) NOT NULL auto_increment,
  `userId` bigint(20) NOT NULL,
  `actionType` varchar(50) NOT NULL,
  `time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tbl_logs` */

/*Table structure for table `tbl_memo` */

DROP TABLE IF EXISTS `tbl_memo`;

CREATE TABLE `tbl_memo` (
  `id` int(11) NOT NULL auto_increment,
  `employee_id` int(11) default NULL,
  `date_requested` date default NULL,
  `date_effective` date default NULL,
  `reason` char(128) default NULL,
  `requested_by` int(11) default NULL,
  `modified_by` int(11) default NULL,
  `DCREATED` date default NULL,
  `TCREATED` time default NULL,
  `DMODIFIED` date default NULL,
  `TMODIFIED` time default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_memo` */

insert  into `tbl_memo`(`id`,`employee_id`,`date_requested`,`date_effective`,`reason`,`requested_by`,`modified_by`,`DCREATED`,`TCREATED`,`DMODIFIED`,`TMODIFIED`) values (1,101,'2012-10-30','2012-11-05','Test Memo',1,NULL,'2012-10-30','23:23:12','2012-10-30','23:23:12'),(2,102,'2012-10-30','2012-10-30','Test 2',1,NULL,'2012-10-30','23:29:41','2012-10-30','23:29:41');

/*Table structure for table `tbl_notification` */

DROP TABLE IF EXISTS `tbl_notification`;

CREATE TABLE `tbl_notification` (
  `id` int(11) NOT NULL auto_increment,
  `employee_id` int(11) default NULL,
  `message` char(128) default NULL,
  `date_requested` date default NULL,
  `requested_by` int(11) default NULL,
  `modified_by` int(11) default NULL,
  `DCREATED` date default NULL,
  `TCREATED` time default NULL,
  `DMODIFIED` date default NULL,
  `TMODIFIED` time default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_notification` */

insert  into `tbl_notification`(`id`,`employee_id`,`message`,`date_requested`,`requested_by`,`modified_by`,`DCREATED`,`TCREATED`,`DMODIFIED`,`TMODIFIED`) values (1,102,'Test notify','2012-10-30',1,NULL,'2012-10-30','23:30:23','2012-10-30','23:30:23');

/*Table structure for table `tbl_ot_application` */

DROP TABLE IF EXISTS `tbl_ot_application`;

CREATE TABLE `tbl_ot_application` (
  `id` int(11) NOT NULL auto_increment,
  `employee_id` int(11) default NULL,
  `date_from` datetime default NULL,
  `date_to` datetime default NULL,
  `reason` varchar(250) default NULL,
  `date_requested` date default NULL,
  `no_hours` decimal(12,2) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ot_application` */

insert  into `tbl_ot_application`(`id`,`employee_id`,`date_from`,`date_to`,`reason`,`date_requested`,`no_hours`) values (1,102,'2012-10-29 18:00:00','2012-10-29 21:00:00','Test overtime','2012-10-30','3.00'),(2,101,'2012-10-30 18:00:00','2012-10-30 20:00:00','Test1 OT ','2012-10-30','2.00'),(3,101,'2012-11-08 18:30:00','2012-11-08 20:30:00','Something :)','2012-11-08','2.00');

/*Table structure for table `tbl_schedule_interval` */

DROP TABLE IF EXISTS `tbl_schedule_interval`;

CREATE TABLE `tbl_schedule_interval` (
  `id` int(11) NOT NULL auto_increment,
  `description` char(50) default NULL,
  `date_from` date default NULL,
  `date_to` date default NULL,
  `is_active` tinyint(1) default NULL,
  `is_posted` tinyint(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_schedule_interval` */

insert  into `tbl_schedule_interval`(`id`,`description`,`date_from`,`date_to`,`is_active`,`is_posted`) values (1,'July 01, 2012 to July 15, 2012','2012-07-01','2012-07-15',1,0);

/*Table structure for table `tbl_suspension` */

DROP TABLE IF EXISTS `tbl_suspension`;

CREATE TABLE `tbl_suspension` (
  `id` int(11) NOT NULL auto_increment,
  `employee_id` int(11) default NULL,
  `date_from` date default NULL,
  `date_to` date default NULL,
  `portion` char(20) default NULL,
  `no_days` float default NULL,
  `date_requested` date default NULL,
  `requested_by` int(11) default NULL,
  `modified_by` int(11) default NULL,
  `reason` char(128) default NULL,
  `leave_type_id` int(11) default NULL,
  `leave_application_id` int(11) default NULL,
  `status` char(15) default NULL,
  `DCREATED` date default NULL,
  `TCREATED` time default NULL,
  `DMODIFIED` date default NULL,
  `TMODIFIED` time default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_suspension` */

insert  into `tbl_suspension`(`id`,`employee_id`,`date_from`,`date_to`,`portion`,`no_days`,`date_requested`,`requested_by`,`modified_by`,`reason`,`leave_type_id`,`leave_application_id`,`status`,`DCREATED`,`TCREATED`,`DMODIFIED`,`TMODIFIED`) values (1,101,'2012-11-02','2012-11-02','WHOLE DAY',1,'2012-11-05',1,NULL,'Test',0,NULL,'Approved','2012-11-05','22:44:28','2012-11-05','22:44:28');

/*Table structure for table `tbl_tito_application` */

DROP TABLE IF EXISTS `tbl_tito_application`;

CREATE TABLE `tbl_tito_application` (
  `id` int(11) NOT NULL auto_increment,
  `employee_id` int(11) default NULL,
  `date_time_in` date default NULL,
  `time_in` time default NULL,
  `date_time_out` date default NULL,
  `time_out` time default NULL,
  `reason` varchar(250) default NULL,
  `date_requested` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tbl_tito_application` */

/*Table structure for table `tbl_training` */

DROP TABLE IF EXISTS `tbl_training`;

CREATE TABLE `tbl_training` (
  `id` bigint(20) NOT NULL auto_increment,
  `employee_id` bigint(20) NOT NULL,
  `type` char(20) default NULL,
  `training_type_id` bigint(20) default NULL,
  `date_start` date default NULL,
  `date_end` date default NULL,
  `start_time` time default NULL,
  `end_time` time default NULL,
  `supplier_id` bigint(20) default NULL,
  `location` varchar(250) default NULL,
  `title` varchar(128) default NULL,
  `details` varchar(250) default NULL,
  `date_requested` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_training` */

insert  into `tbl_training`(`id`,`employee_id`,`type`,`training_type_id`,`date_start`,`date_end`,`start_time`,`end_time`,`supplier_id`,`location`,`title`,`details`,`date_requested`) values (1,102,'Supplier',1,'2012-11-05','2012-11-05','08:00:00','17:00:00',6,'#5 Ideal St., cor. McCollough\nBrgy. Addition Hills\nMandaluyong City, Philippines','Test Training','Test Training Details','2012-10-30'),(2,101,'Client',1,'2012-11-05','2012-11-05','13:00:00','17:00:00',1242,'UP  TechnoPark, \nC.P. Garcia Ave., Diliman, \nQuezon City','Test1 training','Test','2012-10-30');

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) default NULL,
  `user_type_code` varchar(10) default 'USER',
  `dmodified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `modified_by` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`id`,`username`,`password`,`salt`,`user_type_code`,`dmodified`,`modified_by`) values (1,'admin','056ec104380cba0da9d113e7cd6d6d909e891cf0',NULL,'ADMIN','2012-10-19 21:53:46',NULL),(101,'test1','fef4cea54a44d22726e8eadca7d9124b81c718c8',NULL,'USER','2012-11-07 19:42:10',NULL),(102,'test2','8c332f2596287099a36e9bf7becd152eb1ef03ed',NULL,'USER','2012-10-19 22:22:21',NULL),(103,'test3','25d55ad283aa400af464c76d713c07ad',NULL,'USER','2012-10-19 22:31:03',NULL);

/*Table structure for table `tbl_user_type` */

DROP TABLE IF EXISTS `tbl_user_type`;

CREATE TABLE `tbl_user_type` (
  `id` int(11) NOT NULL auto_increment,
  `code` varchar(10) NOT NULL,
  `description` varchar(128) NOT NULL,
  PRIMARY KEY  (`id`,`code`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user_type` */

insert  into `tbl_user_type`(`id`,`code`,`description`) values (1,'ADMIN','Administrator'),(2,'USER','Employee');

/*Table structure for table `tbl_whereabouts` */

DROP TABLE IF EXISTS `tbl_whereabouts`;

CREATE TABLE `tbl_whereabouts` (
  `id` int(11) NOT NULL auto_increment,
  `interval_id` int(11) default NULL,
  `employee_id` int(11) default NULL,
  `app_type` int(11) default '0',
  `application_pk` int(11) default '0',
  `dtr_date` date default NULL,
  `time_in` char(20) default NULL,
  `time_out` char(20) default NULL,
  `schedule_start` char(20) default NULL,
  `schedule_end` char(20) default NULL,
  `restday` char(1) default 'N',
  `is_leave` char(1) default 'N',
  `client_schedule` char(1) default 'N',
  `force_leave` char(1) default 'N',
  `call_log` char(1) default 'N',
  `training` char(1) default 'N',
  `mins_late` float default NULL,
  `mins_undertime` float default NULL,
  `mins_absent` float default NULL,
  `mins_reg_work` float default NULL,
  PRIMARY KEY  (`id`),
  KEY `employee_id` (`employee_id`),
  KEY `interval_id` (`interval_id`)
) ENGINE=MyISAM AUTO_INCREMENT=43735516 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_whereabouts` */

insert  into `tbl_whereabouts`(`id`,`interval_id`,`employee_id`,`app_type`,`application_pk`,`dtr_date`,`time_in`,`time_out`,`schedule_start`,`schedule_end`,`restday`,`is_leave`,`client_schedule`,`force_leave`,`call_log`,`training`,`mins_late`,`mins_undertime`,`mins_absent`,`mins_reg_work`) values (43735109,1,101,0,0,'2013-02-13','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734882,1,1,0,0,'2013-02-13','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735108,1,101,0,0,'2013-02-12','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735107,1,101,0,0,'2013-02-11','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735106,1,101,0,0,'2013-02-10','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734881,1,1,0,0,'2013-02-12','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735105,1,101,0,0,'2013-02-09','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735104,1,101,0,0,'2013-02-08','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735103,1,101,0,0,'2013-02-07','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735102,1,101,0,0,'2013-02-06','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734880,1,1,0,0,'2013-02-11','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735101,1,101,0,0,'2013-02-05','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735100,1,101,0,0,'2013-02-04','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735099,1,101,0,0,'2013-02-03','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735098,1,101,0,0,'2013-02-02','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735097,1,101,0,0,'2013-02-01','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735096,1,101,0,0,'2013-01-31','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734879,1,1,0,0,'2013-02-10','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735095,1,101,0,0,'2013-01-30','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735094,1,101,0,0,'2013-01-29','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735093,1,101,0,0,'2013-01-28','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734878,1,1,0,0,'2013-02-09','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735092,1,101,0,0,'2013-01-27','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735091,1,101,0,0,'2013-01-26','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735090,1,101,0,0,'2013-01-25','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735089,1,101,0,0,'2013-01-24','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735088,1,101,0,0,'2013-01-23','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734877,1,1,0,0,'2013-02-08','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735087,1,101,0,0,'2013-01-22','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734876,1,1,0,0,'2013-02-07','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735086,1,101,0,0,'2013-01-21','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734875,1,1,0,0,'2013-02-06','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735085,1,101,0,0,'2013-01-20','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735084,1,101,0,0,'2013-01-19','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735083,1,101,0,0,'2013-01-18','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735082,1,101,0,0,'2013-01-17','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735081,1,101,0,0,'2013-01-16','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734874,1,1,0,0,'2013-02-05','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734873,1,1,0,0,'2013-02-04','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734872,1,1,0,0,'2013-02-03','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734871,1,1,0,0,'2013-02-02','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735080,1,101,0,0,'2013-01-15','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734870,1,1,0,0,'2013-02-01','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735079,1,101,0,0,'2013-01-14','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735078,1,101,0,0,'2013-01-13','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734869,1,1,0,0,'2013-01-31','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734868,1,1,0,0,'2013-01-30','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735077,1,101,0,0,'2013-01-12','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735076,1,101,0,0,'2013-01-11','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735075,1,101,0,0,'2013-01-10','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735074,1,101,0,0,'2013-01-09','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734867,1,1,0,0,'2013-01-29','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734866,1,1,0,0,'2013-01-28','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734865,1,1,0,0,'2013-01-27','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735073,1,101,0,0,'2013-01-08','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735072,1,101,0,0,'2013-01-07','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734864,1,1,0,0,'2013-01-26','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734863,1,1,0,0,'2013-01-25','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734862,1,1,0,0,'2013-01-24','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735071,1,101,0,0,'2013-01-06','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735070,1,101,0,0,'2013-01-05','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734861,1,1,0,0,'2013-01-23','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734860,1,1,0,0,'2013-01-22','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735515,1,103,0,0,'2013-02-13','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734859,1,1,0,0,'2013-01-21','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735069,1,101,0,0,'2013-01-04','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734858,1,1,0,0,'2013-01-20','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735068,1,101,0,0,'2013-01-03','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735067,1,101,0,0,'2013-01-02','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735514,1,103,0,0,'2013-02-12','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735066,1,101,0,0,'2013-01-01','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735513,1,103,0,0,'2013-02-11','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734857,1,1,0,0,'2013-01-19','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735065,1,101,0,0,'2012-12-31','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735064,1,101,0,0,'2012-12-30','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734856,1,1,0,0,'2013-01-18','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735512,1,103,0,0,'2013-02-10','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735063,1,101,0,0,'2012-12-29','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735511,1,103,0,0,'2013-02-09','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735062,1,101,0,0,'2012-12-28','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735510,1,103,0,0,'2013-02-08','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735061,1,101,0,0,'2012-12-27','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735060,1,101,0,0,'2012-12-26','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734855,1,1,0,0,'2013-01-17','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734854,1,1,0,0,'2013-01-16','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735509,1,103,0,0,'2013-02-07','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735059,1,101,0,0,'2012-12-25','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734853,1,1,0,0,'2013-01-15','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735058,1,101,0,0,'2012-12-24','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735057,1,101,0,0,'2012-12-23','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735508,1,103,0,0,'2013-02-06','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735056,1,101,0,0,'2012-12-22','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735055,1,101,0,0,'2012-12-21','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735507,1,103,0,0,'2013-02-05','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735054,1,101,0,0,'2012-12-20','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735053,1,101,0,0,'2012-12-19','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734852,1,1,0,0,'2013-01-14','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735052,1,101,0,0,'2012-12-18','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734851,1,1,0,0,'2013-01-13','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735051,1,101,0,0,'2012-12-17','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735506,1,103,0,0,'2013-02-04','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735050,1,101,0,0,'2012-12-16','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735049,1,101,0,0,'2012-12-15','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735505,1,103,0,0,'2013-02-03','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735048,1,101,0,0,'2012-12-14','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735047,1,101,0,0,'2012-12-13','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735046,1,101,0,0,'2012-12-12','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734850,1,1,0,0,'2013-01-12','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735045,1,101,0,0,'2012-12-11','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734849,1,1,0,0,'2013-01-11','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734848,1,1,0,0,'2013-01-10','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735044,1,101,0,0,'2012-12-10','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735043,1,101,0,0,'2012-12-09','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735042,1,101,0,0,'2012-12-08','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735504,1,103,0,0,'2013-02-02','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735041,1,101,0,0,'2012-12-07','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735503,1,103,0,0,'2013-02-01','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735040,1,101,0,0,'2012-12-06','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735039,1,101,0,0,'2012-12-05','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735038,1,101,0,0,'2012-12-04','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734847,1,1,0,0,'2013-01-09','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734846,1,1,0,0,'2013-01-08','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735502,1,103,0,0,'2013-01-31','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735037,1,101,0,0,'2012-12-03','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735036,1,101,0,0,'2012-12-02','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734845,1,1,0,0,'2013-01-07','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734844,1,1,0,0,'2013-01-06','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735035,1,101,0,0,'2012-12-01','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735501,1,103,0,0,'2013-01-30','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735034,1,101,0,0,'2012-11-30','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735033,1,101,0,0,'2012-11-29','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735032,1,101,0,0,'2012-11-28','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735031,1,101,0,0,'2012-11-27','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735500,1,103,0,0,'2013-01-29','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735030,1,101,0,0,'2012-11-26','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735029,1,101,0,0,'2012-11-25','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734843,1,1,0,0,'2013-01-05','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735028,1,101,0,0,'2012-11-24','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734842,1,1,0,0,'2013-01-04','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735027,1,101,0,0,'2012-11-23','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735499,1,103,0,0,'2013-01-28','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735026,1,101,0,0,'2012-11-22','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735025,1,101,0,0,'2012-11-21','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735024,1,101,0,0,'2012-11-20','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735498,1,103,0,0,'2013-01-27','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735497,1,103,0,0,'2013-01-26','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735496,1,103,0,0,'2013-01-25','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735023,1,101,0,0,'2012-11-19','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735022,1,101,0,0,'2012-11-18','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735495,1,103,0,0,'2013-01-24','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734841,1,1,0,0,'2013-01-03','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735494,1,103,0,0,'2013-01-23','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735493,1,103,0,0,'2013-01-22','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735021,1,101,0,0,'2012-11-17','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735020,1,101,0,0,'2012-11-16','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735019,1,101,0,0,'2012-11-15','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734840,1,1,0,0,'2013-01-02','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735018,1,101,0,0,'2012-11-14','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734839,1,1,0,0,'2013-01-01','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735492,1,103,0,0,'2013-01-21','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735017,1,101,0,0,'2012-11-13','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735016,1,101,0,0,'2012-11-12','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735015,1,101,0,0,'2012-11-11','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735014,1,101,0,0,'2012-11-10','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735013,1,101,0,0,'2012-11-09','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735012,1,101,0,0,'2012-11-08','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735491,1,103,0,0,'2013-01-20','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735011,1,101,0,0,'2012-11-07','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734838,1,1,0,0,'2012-12-31','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735010,1,101,4,2,'2012-11-06','CLIENT SCHEDULE','CLIENT SCHEDULE',NULL,NULL,'N','N','Y','N','N','N',NULL,NULL,NULL,NULL),(43735009,1,101,6,2,'2012-11-05','FORCE LEAVE','FORCE LEAVE',NULL,NULL,'N','Y','N','Y','N','Y',NULL,NULL,NULL,NULL),(43735008,1,101,0,0,'2012-11-04','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735007,1,101,0,0,'2012-11-03','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735006,1,101,0,0,'2012-11-02','SUSPENDED','SUSPENDED',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734837,1,1,0,0,'2012-12-30','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735490,1,103,0,0,'2013-01-19','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735005,1,101,0,0,'2012-11-01','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735004,1,101,0,0,'2012-10-31','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734836,1,1,0,0,'2012-12-29','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735003,1,101,0,0,'2012-10-30','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735002,1,101,0,0,'2012-10-29','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735001,1,101,0,0,'2012-10-28','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735000,1,101,0,0,'2012-10-27','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734835,1,1,0,0,'2012-12-28','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734999,1,101,0,0,'2012-10-26','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735489,1,103,0,0,'2013-01-18','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735488,1,103,0,0,'2013-01-17','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734998,1,101,2,1,'2012-10-25','VACATION LEAVE','VACATION LEAVE',NULL,NULL,'N','Y','N','N','N','N',NULL,NULL,NULL,NULL),(43734997,1,101,0,0,'2012-10-24','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735487,1,103,0,0,'2013-01-16','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734834,1,1,0,0,'2012-12-27','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734996,1,101,0,0,'2012-10-23','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734995,1,101,0,0,'2012-10-22','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734833,1,1,0,0,'2012-12-26','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735486,1,103,0,0,'2013-01-15','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734994,1,101,0,0,'2012-10-21','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734832,1,1,0,0,'2012-12-25','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734993,1,101,0,0,'2012-10-20','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734992,1,101,0,0,'2012-10-19','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734991,1,101,0,0,'2012-10-18','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734831,1,1,0,0,'2012-12-24','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734990,1,101,0,0,'2012-10-17','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735315,1,102,0,0,'2013-02-13','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735485,1,103,0,0,'2013-01-14','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734989,1,101,0,0,'2012-10-16','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735484,1,103,0,0,'2013-01-13','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734830,1,1,0,0,'2012-12-23','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734988,1,101,0,0,'2012-10-15','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734987,1,101,0,0,'2012-10-14','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734829,1,1,0,0,'2012-12-22','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735314,1,102,0,0,'2013-02-12','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735483,1,103,0,0,'2013-01-12','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734986,1,101,0,0,'2012-10-13','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735482,1,103,0,0,'2013-01-11','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735481,1,103,0,0,'2013-01-10','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734985,1,101,0,0,'2012-10-12','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735480,1,103,0,0,'2013-01-09','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734828,1,1,0,0,'2012-12-21','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734984,1,101,0,0,'2012-10-11','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734827,1,1,0,0,'2012-12-20','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734983,1,101,0,0,'2012-10-10','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735479,1,103,0,0,'2013-01-08','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734826,1,1,0,0,'2012-12-19','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734982,1,101,0,0,'2012-10-09','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735478,1,103,0,0,'2013-01-07','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735477,1,103,0,0,'2013-01-06','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734981,1,101,0,0,'2012-10-08','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734825,1,1,0,0,'2012-12-18','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734824,1,1,0,0,'2012-12-17','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734823,1,1,0,0,'2012-12-16','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734980,1,101,0,0,'2012-10-07','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734979,1,101,0,0,'2012-10-06','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735476,1,103,0,0,'2013-01-05','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734822,1,1,0,0,'2012-12-15','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734978,1,101,0,0,'2012-10-05','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735313,1,102,0,0,'2013-02-11','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735475,1,103,0,0,'2013-01-04','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734821,1,1,0,0,'2012-12-14','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735474,1,103,0,0,'2013-01-03','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734977,1,101,0,0,'2012-10-04','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734820,1,1,0,0,'2012-12-13','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735473,1,103,0,0,'2013-01-02','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734976,1,101,0,0,'2012-10-03','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734819,1,1,0,0,'2012-12-12','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735472,1,103,0,0,'2013-01-01','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734818,1,1,0,0,'2012-12-11','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735471,1,103,0,0,'2012-12-31','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734975,1,101,0,0,'2012-10-02','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735470,1,103,0,0,'2012-12-30','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735469,1,103,0,0,'2012-12-29','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735312,1,102,0,0,'2013-02-10','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734974,1,101,0,0,'2012-10-01','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734817,1,1,0,0,'2012-12-10','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734973,1,101,0,0,'2012-09-30','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734816,1,1,0,0,'2012-12-09','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734815,1,1,0,0,'2012-12-08','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735468,1,103,0,0,'2012-12-28','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734814,1,1,0,0,'2012-12-07','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734813,1,1,0,0,'2012-12-06','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734812,1,1,0,0,'2012-12-05','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735467,1,103,0,0,'2012-12-27','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734972,1,101,0,0,'2012-09-29','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734971,1,101,0,0,'2012-09-28','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735466,1,103,0,0,'2012-12-26','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734811,1,1,0,0,'2012-12-04','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735465,1,103,0,0,'2012-12-25','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734970,1,101,0,0,'2012-09-27','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734810,1,1,0,0,'2012-12-03','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735464,1,103,0,0,'2012-12-24','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734809,1,1,0,0,'2012-12-02','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734969,1,101,0,0,'2012-09-26','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734808,1,1,0,0,'2012-12-01','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734807,1,1,0,0,'2012-11-30','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735463,1,103,0,0,'2012-12-23','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735462,1,103,0,0,'2012-12-22','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734968,1,101,0,0,'2012-09-25','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735311,1,102,0,0,'2013-02-09','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734967,1,101,0,0,'2012-09-24','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735461,1,103,0,0,'2012-12-21','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734806,1,1,0,0,'2012-11-29','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734966,1,101,0,0,'2012-09-23','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735460,1,103,0,0,'2012-12-20','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734805,1,1,0,0,'2012-11-28','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734804,1,1,0,0,'2012-11-27','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734965,1,101,0,0,'2012-09-22','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734964,1,101,0,0,'2012-09-21','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735459,1,103,0,0,'2012-12-19','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734963,1,101,0,0,'2012-09-20','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734803,1,1,0,0,'2012-11-26','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734802,1,1,0,0,'2012-11-25','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735458,1,103,0,0,'2012-12-18','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734962,1,101,0,0,'2012-09-19','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734961,1,101,0,0,'2012-09-18','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734960,1,101,0,0,'2012-09-17','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735310,1,102,0,0,'2013-02-08','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735457,1,103,0,0,'2012-12-17','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734801,1,1,0,0,'2012-11-24','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735456,1,103,0,0,'2012-12-16','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734959,1,101,0,0,'2012-09-16','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735455,1,103,0,0,'2012-12-15','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734958,1,101,0,0,'2012-09-15','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734800,1,1,0,0,'2012-11-23','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735454,1,103,0,0,'2012-12-14','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734799,1,1,0,0,'2012-11-22','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734798,1,1,0,0,'2012-11-21','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734957,1,101,0,0,'2012-09-14','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734797,1,1,0,0,'2012-11-20','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734956,1,101,0,0,'2012-09-13','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734796,1,1,0,0,'2012-11-19','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734955,1,101,0,0,'2012-09-12','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735453,1,103,0,0,'2012-12-13','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735309,1,102,0,0,'2013-02-07','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734795,1,1,0,0,'2012-11-18','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734954,1,101,0,0,'2012-09-11','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734794,1,1,0,0,'2012-11-17','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734953,1,101,0,0,'2012-09-10','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735452,1,103,0,0,'2012-12-12','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734793,1,1,0,0,'2012-11-16','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735451,1,103,0,0,'2012-12-11','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734792,1,1,0,0,'2012-11-15','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735308,1,102,0,0,'2013-02-06','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735450,1,103,0,0,'2012-12-10','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734952,1,101,0,0,'2012-09-09','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735449,1,103,0,0,'2012-12-09','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734791,1,1,0,0,'2012-11-14','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734790,1,1,0,0,'2012-11-13','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735448,1,103,0,0,'2012-12-08','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734789,1,1,0,0,'2012-11-12','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734951,1,101,0,0,'2012-09-08','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735447,1,103,0,0,'2012-12-07','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734950,1,101,0,0,'2012-09-07','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735446,1,103,0,0,'2012-12-06','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734949,1,101,0,0,'2012-09-06','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734788,1,1,0,0,'2012-11-11','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734948,1,101,0,0,'2012-09-05','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734787,1,1,0,0,'2012-11-10','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734947,1,101,0,0,'2012-09-04','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735445,1,103,0,0,'2012-12-05','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734786,1,1,0,0,'2012-11-09','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735444,1,103,0,0,'2012-12-04','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735307,1,102,0,0,'2013-02-05','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734946,1,101,0,0,'2012-09-03','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734785,1,1,0,0,'2012-11-08','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734945,1,101,0,0,'2012-09-02','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735443,1,103,0,0,'2012-12-03','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734944,1,101,0,0,'2012-09-01','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734784,1,1,0,0,'2012-11-07','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735306,1,102,0,0,'2013-02-04','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734783,1,1,0,0,'2012-11-06','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735442,1,103,0,0,'2012-12-02','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734943,1,101,0,0,'2012-08-31','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734782,1,1,0,0,'2012-11-05','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734781,1,1,0,0,'2012-11-04','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734942,1,101,0,0,'2012-08-30','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735441,1,103,0,0,'2012-12-01','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735305,1,102,0,0,'2013-02-03','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734780,1,1,0,0,'2012-11-03','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734941,1,101,0,0,'2012-08-29','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734779,1,1,0,0,'2012-11-02','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735440,1,103,0,0,'2012-11-30','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734940,1,101,0,0,'2012-08-28','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734778,1,1,0,0,'2012-11-01','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735439,1,103,0,0,'2012-11-29','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734939,1,101,0,0,'2012-08-27','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734938,1,101,0,0,'2012-08-26','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735304,1,102,0,0,'2013-02-02','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735303,1,102,0,0,'2013-02-01','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734937,1,101,0,0,'2012-08-25','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734777,1,1,0,0,'2012-10-31','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735302,1,102,0,0,'2013-01-31','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735438,1,103,0,0,'2012-11-28','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734936,1,101,0,0,'2012-08-24','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734935,1,101,0,0,'2012-08-23','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734776,1,1,0,0,'2012-10-30','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735437,1,103,0,0,'2012-11-27','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734934,1,101,0,0,'2012-08-22','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735436,1,103,0,0,'2012-11-26','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735301,1,102,0,0,'2013-01-30','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735300,1,102,0,0,'2013-01-29','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734775,1,1,0,0,'2012-10-29','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734774,1,1,0,0,'2012-10-28','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734933,1,101,0,0,'2012-08-21','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734773,1,1,0,0,'2012-10-27','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734932,1,101,0,0,'2012-08-20','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735299,1,102,0,0,'2013-01-28','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734931,1,101,0,0,'2012-08-19','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735435,1,103,0,0,'2012-11-25','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734772,1,1,0,0,'2012-10-26','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735298,1,102,0,0,'2013-01-27','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734930,1,101,0,0,'2012-08-18','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735434,1,103,0,0,'2012-11-24','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734771,1,1,0,0,'2012-10-25','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734770,1,1,0,0,'2012-10-24','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734929,1,101,0,0,'2012-08-17','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734928,1,101,0,0,'2012-08-16','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734927,1,101,0,0,'2012-08-15','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734926,1,101,0,0,'2012-08-14','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734769,1,1,0,0,'2012-10-23','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735297,1,102,0,0,'2013-01-26','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735433,1,103,0,0,'2012-11-23','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734768,1,1,0,0,'2012-10-22','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734925,1,101,0,0,'2012-08-13','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734924,1,101,0,0,'2012-08-12','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734923,1,101,0,0,'2012-08-11','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734767,1,1,0,0,'2012-10-21','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735432,1,103,0,0,'2012-11-22','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735296,1,102,0,0,'2013-01-25','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734766,1,1,0,0,'2012-10-20','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734922,1,101,0,0,'2012-08-10','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734765,1,1,0,0,'2012-10-19','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734921,1,101,0,0,'2012-08-09','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735295,1,102,0,0,'2013-01-24','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734764,1,1,0,0,'2012-10-18','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735431,1,103,0,0,'2012-11-21','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735294,1,102,0,0,'2013-01-23','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734920,1,101,0,0,'2012-08-08','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735293,1,102,0,0,'2013-01-22','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734919,1,101,0,0,'2012-08-07','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734763,1,1,0,0,'2012-10-17','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735292,1,102,0,0,'2013-01-21','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734918,1,101,0,0,'2012-08-06','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735430,1,103,0,0,'2012-11-20','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734917,1,101,0,0,'2012-08-05','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735291,1,102,0,0,'2013-01-20','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735429,1,103,0,0,'2012-11-19','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735290,1,102,0,0,'2013-01-19','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734916,1,101,0,0,'2012-08-04','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734915,1,101,0,0,'2012-08-03','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734762,1,1,0,0,'2012-10-16','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735289,1,102,0,0,'2013-01-18','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735428,1,103,0,0,'2012-11-18','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734914,1,101,0,0,'2012-08-02','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734761,1,1,0,0,'2012-10-15','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735288,1,102,0,0,'2013-01-17','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734913,1,101,0,0,'2012-08-01','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734912,1,101,0,0,'2012-07-31','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735427,1,103,0,0,'2012-11-17','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734760,1,1,0,0,'2012-10-14','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735287,1,102,0,0,'2013-01-16','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734911,1,101,0,0,'2012-07-30','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734759,1,1,0,0,'2012-10-13','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735286,1,102,0,0,'2013-01-15','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735426,1,103,0,0,'2012-11-16','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735285,1,102,0,0,'2013-01-14','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735284,1,102,0,0,'2013-01-13','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734758,1,1,0,0,'2012-10-12','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735283,1,102,0,0,'2013-01-12','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734910,1,101,0,0,'2012-07-29','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734757,1,1,0,0,'2012-10-11','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735282,1,102,0,0,'2013-01-11','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735281,1,102,0,0,'2013-01-10','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735280,1,102,0,0,'2013-01-09','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734756,1,1,0,0,'2012-10-10','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735279,1,102,0,0,'2013-01-08','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735425,1,103,0,0,'2012-11-15','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735278,1,102,0,0,'2013-01-07','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735424,1,103,0,0,'2012-11-14','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734755,1,1,0,0,'2012-10-09','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735277,1,102,0,0,'2013-01-06','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735276,1,102,0,0,'2013-01-05','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734754,1,1,0,0,'2012-10-08','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734909,1,101,0,0,'2012-07-28','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735275,1,102,0,0,'2013-01-04','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735274,1,102,0,0,'2013-01-03','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735423,1,103,0,0,'2012-11-13','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734753,1,1,0,0,'2012-10-07','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735273,1,102,0,0,'2013-01-02','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735272,1,102,0,0,'2013-01-01','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735271,1,102,0,0,'2012-12-31','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734752,1,1,0,0,'2012-10-06','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734751,1,1,0,0,'2012-10-05','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735270,1,102,0,0,'2012-12-30','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735422,1,103,0,0,'2012-11-12','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734908,1,101,0,0,'2012-07-27','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735269,1,102,0,0,'2012-12-29','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735268,1,102,0,0,'2012-12-28','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735267,1,102,0,0,'2012-12-27','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735421,1,103,0,0,'2012-11-11','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734750,1,1,0,0,'2012-10-04','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735420,1,103,0,0,'2012-11-10','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735266,1,102,0,0,'2012-12-26','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734749,1,1,0,0,'2012-10-03','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735265,1,102,0,0,'2012-12-25','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734907,1,101,0,0,'2012-07-26','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735264,1,102,0,0,'2012-12-24','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735419,1,103,0,0,'2012-11-09','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735263,1,102,0,0,'2012-12-23','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735262,1,102,0,0,'2012-12-22','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734748,1,1,0,0,'2012-10-02','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735261,1,102,0,0,'2012-12-21','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734747,1,1,0,0,'2012-10-01','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735260,1,102,0,0,'2012-12-20','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735259,1,102,0,0,'2012-12-19','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735418,1,103,0,0,'2012-11-08','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735258,1,102,0,0,'2012-12-18','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734746,1,1,0,0,'2012-09-30','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734745,1,1,0,0,'2012-09-29','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735257,1,102,0,0,'2012-12-17','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735256,1,102,0,0,'2012-12-16','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735417,1,103,0,0,'2012-11-07','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734906,1,101,0,0,'2012-07-25','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735255,1,102,0,0,'2012-12-15','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734744,1,1,0,0,'2012-09-28','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735416,1,103,0,0,'2012-11-06','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735254,1,102,0,0,'2012-12-14','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735415,1,103,0,0,'2012-11-05','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735253,1,102,0,0,'2012-12-13','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735252,1,102,0,0,'2012-12-12','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734743,1,1,0,0,'2012-09-27','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735251,1,102,0,0,'2012-12-11','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735414,1,103,0,0,'2012-11-04','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735413,1,103,0,0,'2012-11-03','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735250,1,102,0,0,'2012-12-10','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735412,1,103,0,0,'2012-11-02','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735411,1,103,0,0,'2012-11-01','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735249,1,102,0,0,'2012-12-09','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734742,1,1,0,0,'2012-09-26','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735248,1,102,0,0,'2012-12-08','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735247,1,102,0,0,'2012-12-07','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735410,1,103,0,0,'2012-10-31','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735246,1,102,0,0,'2012-12-06','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734905,1,101,0,0,'2012-07-24','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735245,1,102,0,0,'2012-12-05','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735244,1,102,0,0,'2012-12-04','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734904,1,101,0,0,'2012-07-23','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735243,1,102,0,0,'2012-12-03','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735409,1,103,0,0,'2012-10-30','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735242,1,102,0,0,'2012-12-02','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735408,1,103,0,0,'2012-10-29','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735241,1,102,0,0,'2012-12-01','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735240,1,102,0,0,'2012-11-30','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734741,1,1,0,0,'2012-09-25','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735239,1,102,0,0,'2012-11-29','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735407,1,103,0,0,'2012-10-28','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735406,1,103,0,0,'2012-10-27','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735238,1,102,0,0,'2012-11-28','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734903,1,101,0,0,'2012-07-22','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734740,1,1,0,0,'2012-09-24','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735237,1,102,0,0,'2012-11-27','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735236,1,102,0,0,'2012-11-26','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735405,1,103,0,0,'2012-10-26','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735235,1,102,0,0,'2012-11-25','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735234,1,102,0,0,'2012-11-24','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734739,1,1,0,0,'2012-09-23','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735233,1,102,0,0,'2012-11-23','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735404,1,103,0,0,'2012-10-25','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735232,1,102,0,0,'2012-11-22','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735403,1,103,0,0,'2012-10-24','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735231,1,102,0,0,'2012-11-21','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735402,1,103,0,0,'2012-10-23','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735230,1,102,0,0,'2012-11-20','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735229,1,102,0,0,'2012-11-19','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734738,1,1,0,0,'2012-09-22','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734902,1,101,0,0,'2012-07-21','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735228,1,102,0,0,'2012-11-18','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735227,1,102,0,0,'2012-11-17','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735401,1,103,0,0,'2012-10-22','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735226,1,102,0,0,'2012-11-16','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735225,1,102,0,0,'2012-11-15','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735224,1,102,0,0,'2012-11-14','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735400,1,103,0,0,'2012-10-21','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735223,1,102,0,0,'2012-11-13','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735222,1,102,0,0,'2012-11-12','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735399,1,103,0,0,'2012-10-20','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735221,1,102,0,0,'2012-11-11','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734737,1,1,0,0,'2012-09-21','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735398,1,103,0,0,'2012-10-19','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735397,1,103,0,0,'2012-10-18','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735396,1,103,0,0,'2012-10-17','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735220,1,102,0,0,'2012-11-10','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735219,1,102,0,0,'2012-11-09','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735395,1,103,0,0,'2012-10-16','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735218,1,102,0,0,'2012-11-08','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735217,1,102,0,0,'2012-11-07','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734901,1,101,0,0,'2012-07-20','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735394,1,103,0,0,'2012-10-15','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735393,1,103,0,0,'2012-10-14','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735216,1,102,0,0,'2012-11-06','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735215,1,102,6,1,'2012-11-05','TRAINING','TRAINING',NULL,NULL,'N','N','N','N','N','Y',NULL,NULL,NULL,NULL),(43735214,1,102,0,0,'2012-11-04','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735392,1,103,0,0,'2012-10-13','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734900,1,101,0,0,'2012-07-19','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735213,1,102,0,0,'2012-11-03','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735391,1,103,0,0,'2012-10-12','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735212,1,102,0,0,'2012-11-02','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735211,1,102,0,0,'2012-11-01','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735210,1,102,4,1,'2012-10-31','CLIENT SCHEDULE','CLIENT SCHEDULE',NULL,NULL,'N','N','Y','N','N','N',NULL,NULL,NULL,NULL),(43735390,1,103,0,0,'2012-10-11','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735389,1,103,0,0,'2012-10-10','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735209,1,102,0,0,'2012-10-30','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735388,1,103,0,0,'2012-10-09','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734899,1,101,0,0,'2012-07-18','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735387,1,103,0,0,'2012-10-08','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735208,1,102,0,0,'2012-10-29','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735207,1,102,0,0,'2012-10-28','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735206,1,102,0,0,'2012-10-27','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735386,1,103,0,0,'2012-10-07','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735205,1,102,0,0,'2012-10-26','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735204,1,102,0,0,'2012-10-25','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735385,1,103,0,0,'2012-10-06','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735203,1,102,0,0,'2012-10-24','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735202,1,102,0,0,'2012-10-23','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735384,1,103,0,0,'2012-10-05','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735201,1,102,0,0,'2012-10-22','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735383,1,103,0,0,'2012-10-04','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735382,1,103,0,0,'2012-10-03','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735200,1,102,0,0,'2012-10-21','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735199,1,102,0,0,'2012-10-20','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735381,1,103,0,0,'2012-10-02','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735380,1,103,0,0,'2012-10-01','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734898,1,101,0,0,'2012-07-17','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735379,1,103,0,0,'2012-09-30','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735198,1,102,0,0,'2012-10-19','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735197,1,102,0,0,'2012-10-18','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735196,1,102,0,0,'2012-10-17','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735378,1,103,0,0,'2012-09-29','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735377,1,103,0,0,'2012-09-28','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735195,1,102,0,0,'2012-10-16','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735376,1,103,0,0,'2012-09-27','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735375,1,103,0,0,'2012-09-26','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735194,1,102,0,0,'2012-10-15','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735193,1,102,0,0,'2012-10-14','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735192,1,102,0,0,'2012-10-13','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735374,1,103,0,0,'2012-09-25','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735191,1,102,0,0,'2012-10-12','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734897,1,101,0,0,'2012-07-16','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735373,1,103,0,0,'2012-09-24','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735190,1,102,0,0,'2012-10-11','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735372,1,103,0,0,'2012-09-23','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735189,1,102,0,0,'2012-10-10','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735371,1,103,0,0,'2012-09-22','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735370,1,103,0,0,'2012-09-21','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735369,1,103,0,0,'2012-09-20','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735188,1,102,0,0,'2012-10-09','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735187,1,102,0,0,'2012-10-08','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735186,1,102,0,0,'2012-10-07','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735185,1,102,0,0,'2012-10-06','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735368,1,103,0,0,'2012-09-19','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734896,1,101,0,0,'2012-07-15','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735367,1,103,0,0,'2012-09-18','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735184,1,102,0,0,'2012-10-05','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735366,1,103,0,0,'2012-09-17','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735183,1,102,0,0,'2012-10-04','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735182,1,102,0,0,'2012-10-03','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735181,1,102,0,0,'2012-10-02','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735365,1,103,0,0,'2012-09-16','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734895,1,101,0,0,'2012-07-14','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735180,1,102,0,0,'2012-10-01','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735179,1,102,0,0,'2012-09-30','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735364,1,103,0,0,'2012-09-15','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735178,1,102,0,0,'2012-09-29','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735177,1,102,0,0,'2012-09-28','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735176,1,102,0,0,'2012-09-27','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735175,1,102,0,0,'2012-09-26','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735174,1,102,0,0,'2012-09-25','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735173,1,102,0,0,'2012-09-24','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735363,1,103,0,0,'2012-09-14','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735362,1,103,0,0,'2012-09-13','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735172,1,102,0,0,'2012-09-23','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735361,1,103,0,0,'2012-09-12','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735171,1,102,0,0,'2012-09-22','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735170,1,102,0,0,'2012-09-21','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735169,1,102,0,0,'2012-09-20','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735168,1,102,0,0,'2012-09-19','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735167,1,102,0,0,'2012-09-18','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734894,1,101,0,0,'2012-07-13','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734893,1,101,0,0,'2012-07-12','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735166,1,102,0,0,'2012-09-17','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735165,1,102,0,0,'2012-09-16','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735164,1,102,0,0,'2012-09-15','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735163,1,102,0,0,'2012-09-14','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735360,1,103,0,0,'2012-09-11','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735359,1,103,0,0,'2012-09-10','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735358,1,103,0,0,'2012-09-09','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734892,1,101,0,0,'2012-07-11','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735162,1,102,0,0,'2012-09-13','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735161,1,102,0,0,'2012-09-12','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735160,1,102,0,0,'2012-09-11','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735159,1,102,0,0,'2012-09-10','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735357,1,103,0,0,'2012-09-08','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735356,1,103,0,0,'2012-09-07','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735355,1,103,0,0,'2012-09-06','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735158,1,102,0,0,'2012-09-09','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735354,1,103,0,0,'2012-09-05','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735157,1,102,0,0,'2012-09-08','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735353,1,103,0,0,'2012-09-04','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734891,1,101,0,0,'2012-07-10','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735352,1,103,0,0,'2012-09-03','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735156,1,102,0,0,'2012-09-07','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735155,1,102,0,0,'2012-09-06','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735351,1,103,0,0,'2012-09-02','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734890,1,101,0,0,'2012-07-09','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734889,1,101,0,0,'2012-07-08','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735154,1,102,0,0,'2012-09-05','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735153,1,102,0,0,'2012-09-04','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735152,1,102,0,0,'2012-09-03','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735350,1,103,0,0,'2012-09-01','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735151,1,102,0,0,'2012-09-02','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735150,1,102,0,0,'2012-09-01','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735349,1,103,0,0,'2012-08-31','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735348,1,103,0,0,'2012-08-30','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735347,1,103,0,0,'2012-08-29','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735149,1,102,0,0,'2012-08-31','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734888,1,101,0,0,'2012-07-07','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735346,1,103,0,0,'2012-08-28','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735345,1,103,0,0,'2012-08-27','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735148,1,102,0,0,'2012-08-30','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735344,1,103,0,0,'2012-08-26','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735147,1,102,0,0,'2012-08-29','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734887,1,101,0,0,'2012-07-06','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735146,1,102,0,0,'2012-08-28','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735343,1,103,0,0,'2012-08-25','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735342,1,103,0,0,'2012-08-24','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735341,1,103,0,0,'2012-08-23','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734886,1,101,0,0,'2012-07-05','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735145,1,102,0,0,'2012-08-27','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735340,1,103,0,0,'2012-08-22','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735144,1,102,0,0,'2012-08-26','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735143,1,102,0,0,'2012-08-25','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735142,1,102,0,0,'2012-08-24','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735339,1,103,0,0,'2012-08-21','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735141,1,102,0,0,'2012-08-23','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734885,1,101,0,0,'2012-07-04','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735338,1,103,0,0,'2012-08-20','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735337,1,103,0,0,'2012-08-19','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734884,1,101,0,0,'2012-07-03','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735140,1,102,0,0,'2012-08-22','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735336,1,103,0,0,'2012-08-18','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735335,1,103,0,0,'2012-08-17','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735139,1,102,0,0,'2012-08-21','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735334,1,103,0,0,'2012-08-16','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735138,1,102,0,0,'2012-08-20','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735333,1,103,0,0,'2012-08-15','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734883,1,101,0,0,'2012-07-02','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43734736,1,1,0,0,'2012-09-20','ABSENT','ABSENT',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735137,1,102,0,0,'2012-08-19','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735136,1,102,0,0,'2012-08-18','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735332,1,103,0,0,'2012-08-14','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735135,1,102,0,0,'2012-08-17','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735134,1,102,0,0,'2012-08-16','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735331,1,103,0,0,'2012-08-13','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735133,1,102,0,0,'2012-08-15','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735330,1,103,0,0,'2012-08-12','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735132,1,102,0,0,'2012-08-14','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735329,1,103,0,0,'2012-08-11','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735328,1,103,0,0,'2012-08-10','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735131,1,102,0,0,'2012-08-13','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735130,1,102,0,0,'2012-08-12','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735129,1,102,0,0,'2012-08-11','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735327,1,103,0,0,'2012-08-09','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735128,1,102,0,0,'2012-08-10','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735127,1,102,0,0,'2012-08-09','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735126,1,102,0,0,'2012-08-08','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735326,1,103,0,0,'2012-08-08','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735125,1,102,0,0,'2012-08-07','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735325,1,103,0,0,'2012-08-07','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735124,1,102,0,0,'2012-08-06','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735123,1,102,0,0,'2012-08-05','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735122,1,102,0,0,'2012-08-04','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735121,1,102,0,0,'2012-08-03','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735324,1,103,0,0,'2012-08-06','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735120,1,102,0,0,'2012-08-02','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735323,1,103,0,0,'2012-08-05','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735119,1,102,0,0,'2012-08-01','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735322,1,103,0,0,'2012-08-04','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735118,1,102,0,0,'2012-07-31','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735117,1,102,0,0,'2012-07-30','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735321,1,103,0,0,'2012-08-03','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735116,1,102,0,0,'2012-07-29','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735320,1,103,0,0,'2012-08-02','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735115,1,102,0,0,'2012-07-28','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735319,1,103,0,0,'2012-08-01','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735114,1,102,0,0,'2012-07-27','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735113,1,102,0,0,'2012-07-26','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735318,1,103,0,0,'2012-07-31','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735317,1,103,0,0,'2012-07-30','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735112,1,102,0,0,'2012-07-25','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735111,1,102,0,0,'2012-07-24','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735316,1,103,0,0,'2012-07-29','REST DAY','REST DAY',NULL,NULL,'Y','N','N','N','N','N',NULL,NULL,NULL,NULL),(43735110,1,102,0,0,'2012-07-23','09:00:00','18:00:00',NULL,NULL,'N','N','N','N','N','N',NULL,NULL,NULL,NULL);

/*Table structure for table `users_groups` */

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `users_groups` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
