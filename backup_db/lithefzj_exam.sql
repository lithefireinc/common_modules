/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.0.95-community : Database - lithefzj_exam
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`lithefzj_exam` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `lithefzj_exam`;

/*Table structure for table `exam` */

DROP TABLE IF EXISTS `exam`;

CREATE TABLE `exam` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) default NULL,
  `description` varchar(150) default NULL,
  `timeopen` datetime default NULL,
  `timeclose` datetime default NULL,
  `timePerQuestion` int(4) default NULL,
  `timePerTest` int(5) default NULL,
  `facultyId` int(11) default NULL,
  `DCREATED` datetime default NULL,
  `DMODIFIED` datetime default NULL,
  `IS_DELETE` tinyint(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `exam` */

insert  into `exam`(`id`,`name`,`description`,`timeopen`,`timeclose`,`timePerQuestion`,`timePerTest`,`facultyId`,`DCREATED`,`DMODIFIED`,`IS_DELETE`) values (1,'exam1','description1',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL);

/*Table structure for table `examSession` */

DROP TABLE IF EXISTS `examSession`;

CREATE TABLE `examSession` (
  `id` int(11) NOT NULL auto_increment,
  `dateTaken` varchar(45) default NULL,
  `exam_id` int(11) default NULL,
  `examinee_id` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `examSession` */

/*Table structure for table `examinee` */

DROP TABLE IF EXISTS `examinee`;

CREATE TABLE `examinee` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(45) default NULL,
  `username` varchar(45) default NULL,
  `password` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `examinee` */

/*Table structure for table `faculty` */

DROP TABLE IF EXISTS `faculty`;

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `faculty` */

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
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `module` */

insert  into `module`(`id`,`description`,`link`,`category_id`,`group`,`icon`,`order`,`is_public`) values (1,'User Matrix','userMatrix',1,NULL,NULL,NULL,0),(2,'User Administration','userMatrix/administration',1,NULL,NULL,NULL,0),(3,'Change Password',NULL,2,NULL,NULL,NULL,1),(8,'Exam Classifications','examclassifications',5,NULL,NULL,NULL,0),(9,'Question Classifications','questionclassifications',5,NULL,NULL,NULL,0),(10,'Scaffolding','userMatrix/scaffolding',1,NULL,NULL,NULL,0),(16,'FILEEXCL','FILEEXCL',10,NULL,NULL,NULL,1),(15,'FILEEXCL','FILEEXCL',9,NULL,NULL,NULL,1);

/*Table structure for table `module_category` */

DROP TABLE IF EXISTS `module_category`;

CREATE TABLE `module_category` (
  `id` bigint(20) NOT NULL auto_increment,
  `description` varchar(50) default NULL,
  `icon` varchar(50) default NULL,
  `order` int(10) default NULL,
  `is_public` tinyint(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `module_category` */

insert  into `module_category`(`id`,`description`,`icon`,`order`,`is_public`) values (1,'USER MATRIX','/images/icons2/hammer_screwdriver.png',NULL,0),(2,'MY ACCOUNT','/images/icons/user.png',NULL,1),(3,'FACILITIES','/images/icons/package.png',NULL,NULL),(4,'MANAGE LIBRARIES','/images/icons/package.png',NULL,1),(5,'FILEREFERENCE','/images/icons/folder.png',NULL,0),(9,'FILEEXCL','/images/icons/application.png',NULL,1),(10,'FILEEXCL','/images/icons/application.png',NULL,1);

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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `module_group_access` */

insert  into `module_group_access`(`id`,`group_id`,`module_id`) values (1,1,1),(2,1,2),(3,1,4),(4,2,4),(5,1,5),(6,3,5),(7,3,4),(8,1,6),(9,1,8),(10,1,9),(11,1,10),(12,1,11);

/*Table structure for table `module_group_users` */

DROP TABLE IF EXISTS `module_group_users`;

CREATE TABLE `module_group_users` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `username` varchar(100) default NULL,
  `group_id` int(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `module_group_users` */

insert  into `module_group_users`(`id`,`user_id`,`username`,`group_id`) values (1,1,'darryl.anaud',1),(2,NULL,'richard.base',1),(3,NULL,'maribeth.rivas',1),(4,NULL,'niz.nolasco',1),(5,NULL,'apple.aala',2),(6,NULL,'test.admin',3),(7,NULL,'greg',1);

/*Table structure for table `question` */

DROP TABLE IF EXISTS `question`;

CREATE TABLE `question` (
  `id` int(11) NOT NULL auto_increment,
  `question_categories_id` int(11) default NULL,
  `exam_id` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `question` */

/*Table structure for table `question_answers` */

DROP TABLE IF EXISTS `question_answers`;

CREATE TABLE `question_answers` (
  `id` int(11) NOT NULL auto_increment,
  `question_id` int(11) default NULL,
  `correct_flag` tinyint(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `question_answers` */

/*Table structure for table `question_categories` */

DROP TABLE IF EXISTS `question_categories`;

CREATE TABLE `question_categories` (
  `id` int(11) NOT NULL auto_increment,
  `category` varchar(45) default NULL,
  `description` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `question_categories` */

insert  into `question_categories`(`id`,`category`,`description`) values (1,'category1','description1'),(2,'category2','description2');

/*Table structure for table `table_sample_1` */

DROP TABLE IF EXISTS `table_sample_1`;

CREATE TABLE `table_sample_1` (
  `id` bigint(11) NOT NULL auto_increment,
  `description` char(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `table_sample_1` */

/*Table structure for table `tbl_exam_classification` */

DROP TABLE IF EXISTS `tbl_exam_classification`;

CREATE TABLE `tbl_exam_classification` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(45) default NULL,
  `code` varchar(45) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `code_UNIQUE` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_exam_classification` */

insert  into `tbl_exam_classification`(`id`,`description`,`code`) values (4,'fdsaa','ex002');

/*Table structure for table `tbl_question_classification` */

DROP TABLE IF EXISTS `tbl_question_classification`;

CREATE TABLE `tbl_question_classification` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(45) default NULL,
  `code` varchar(45) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `code_UNIQUE` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_question_classification` */

insert  into `tbl_question_classification`(`id`,`description`,`code`) values (4,'Multiple Choice','qc0001'),(5,'Yes or No','qc0002'),(6,'test','qc0003'),(7,'a1','12111'),(8,'321','123');

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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`id`,`username`,`password`,`salt`,`user_type_code`,`STUDCODE`,`STUDIDNO`,`ADVICODE`,`ADVIIDNO`,`PARECODE`,`PAREIDNO`,`dmodified`,`modified_by`) values (1,'darryl.anaud','916cb67aa119d20627f839ad29a5068bbee2ca83',NULL,'ADMIN',NULL,NULL,NULL,NULL,NULL,NULL,'2012-05-01 09:19:07',NULL),(2,'richard.base','cee8da72db7d001cb40ae3314887380cc4a6882e',NULL,'ADMIN',NULL,NULL,NULL,NULL,NULL,NULL,'2012-05-02 16:52:53',NULL),(3,'maribeth.rivas','1409957c57942079d4139f6c8cdf647d4b32cfc2',NULL,'ADMIN',NULL,NULL,NULL,NULL,NULL,NULL,'2012-05-02 16:52:31',NULL),(5,'niz.nolasco','37e5c9b2528b6c6e8fc4da450626efd0d77f669f',NULL,'ADMIN',NULL,NULL,NULL,NULL,NULL,NULL,'2012-05-02 16:52:43',NULL),(12,'apple.aala','85ecc3653e1fbee400eefba07b9adc2d7b79e62e',NULL,'STUD',287,'3F7N010259',NULL,NULL,NULL,NULL,'2012-05-04 06:30:28',NULL),(13,'test.admin','14fb1e49a92d35e952854a9f4a9740252025b0d5',NULL,'ADMIN',NULL,NULL,NULL,NULL,NULL,NULL,'2012-07-31 02:25:20',NULL),(14,'greg','62fd1ecd141171aa41a7b0986c83882b3e3bb743',NULL,'ADMIN',NULL,NULL,NULL,NULL,NULL,NULL,'2012-11-29 21:47:13',NULL);

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

/*Table structure for table `test_table` */

DROP TABLE IF EXISTS `test_table`;

CREATE TABLE `test_table` (
  `id` int(11) NOT NULL,
  `test` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `test_table` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
