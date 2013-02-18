/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.0.95-community : Database - lithefzj_hrisv220111128
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`lithefzj_hrisv220111128` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `lithefzj_hrisv220111128`;

/*Table structure for table `filecourse` */

DROP TABLE IF EXISTS `filecourse`;

CREATE TABLE `filecourse` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(128) default NULL,
  `level_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `filecourse` */

insert  into `filecourse`(`id`,`description`,`level_id`) values (1,'BS Computer Science',NULL),(2,'BS Information Technology',NULL),(3,'BA Communication Arts',NULL),(4,'BS Engineering',NULL),(5,'BS Information Management',NULL),(6,'MS Information Science',NULL);

/*Table structure for table `filedepartment` */

DROP TABLE IF EXISTS `filedepartment`;

CREATE TABLE `filedepartment` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(128) default NULL,
  `dmodified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `filedepartment` */

insert  into `filedepartment`(`id`,`description`,`dmodified`) values (1,'Information Technology','2011-04-29 22:17:25'),(2,'Admin Department','2011-04-29 22:17:34'),(3,'Human Resources','2011-04-29 22:17:44'),(4,'Graphics','2011-04-29 22:17:51'),(5,'Operations','2011-04-29 22:17:58'),(6,'Utility','2011-04-29 22:18:04');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `fileemployeecategory` */

insert  into `fileemployeecategory`(`id`,`description`,`dmodified`) values (1,'Regular','2011-04-30 01:06:36'),(2,'Probationary','2011-04-30 01:06:41');

/*Table structure for table `fileemployeestatus` */

DROP TABLE IF EXISTS `fileemployeestatus`;

CREATE TABLE `fileemployeestatus` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(128) default NULL,
  `dmodified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `fileemployeestatus` */

insert  into `fileemployeestatus`(`id`,`description`,`dmodified`) values (1,'Hired','2011-04-30 01:06:50'),(2,'Resigned','2011-04-30 01:06:54');

/*Table structure for table `fileposition` */

DROP TABLE IF EXISTS `fileposition`;

CREATE TABLE `fileposition` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(128) default NULL,
  `dmodified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `fileposition` */

insert  into `fileposition`(`id`,`description`,`dmodified`) values (1,'Level 1','2011-04-30 01:02:06'),(2,'Level 2','2011-04-30 01:02:14'),(3,'Level 3','2011-04-30 01:02:19');

/*Table structure for table `fileschool` */

DROP TABLE IF EXISTS `fileschool`;

CREATE TABLE `fileschool` (
  `id` bigint(20) NOT NULL auto_increment,
  `description` varchar(128) default NULL,
  `abbreviation` varchar(20) default NULL,
  `school_address` varchar(250) default NULL,
  `dmodified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `fileschool` */

insert  into `fileschool`(`id`,`description`,`abbreviation`,`school_address`,`dmodified`) values (1,'University of the Philippines Los Banos','UPLB','Los Banos, Laguna','2011-05-02 06:54:54'),(3,'University of Southeastern Philippines','USEP','Bo. Obrero, Davao City','2011-05-02 07:48:10');

/*Table structure for table `filetrainingtype` */

DROP TABLE IF EXISTS `filetrainingtype`;

CREATE TABLE `filetrainingtype` (
  `id` bigint(20) NOT NULL auto_increment,
  `description` varchar(128) default NULL,
  `dmodified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `filetrainingtype` */

insert  into `filetrainingtype`(`id`,`description`,`dmodified`) values (1,'Training','2011-05-02 20:25:51'),(2,'Seminar','2011-05-02 20:26:02');

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
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

/*Data for the table `module` */

insert  into `module`(`id`,`description`,`link`,`category_id`,`group`,`icon`,`order`,`is_public`) values (1,'Logout','main/logout',1,NULL,'',0,0),(64,'My Request','apps/myRequest',21,NULL,NULL,1,1),(63,'User Profile','user',20,NULL,NULL,2,1),(62,'User Access Control','dashboard/userMatrix',6,NULL,NULL,NULL,0),(61,'Employee Information','hr',19,NULL,NULL,NULL,0),(65,'Approver Setup','approver',21,NULL,NULL,3,0),(66,'Change Password','user/changePassword',20,NULL,NULL,3,1),(67,'Dashboard','dashboard',20,NULL,NULL,1,1),(68,'My Approval','apps/myApproval',21,NULL,NULL,2,0),(69,'Admin Actions','admin/adminActions',23,NULL,NULL,NULL,0),(70,'Setup','admin/setup',23,NULL,NULL,NULL,0);

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
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `module_category` */

insert  into `module_category`(`id`,`description`,`icon`,`order`,`is_public`,`url`) values (1,'ACCESS','/images/icons/key.png',1,0,NULL),(2,'FILE REFERENCE','/images/icons/folder.png',4,0,NULL),(21,'APPLICATION','/images/icons/application_form.png',3,NULL,NULL),(20,'USER','/images/icons/user.png',2,NULL,NULL),(6,'UTILITIES','/images/icons2/hammer_screwdriver.png',6,0,NULL),(8,'SUPPORT','/images/icons/lifebuoy.png',7,1,NULL),(19,'HR','/images/icons/group.png',5,0,NULL),(22,'LOGOUT',NULL,99,1,'main/logout'),(23,'ADMIN','/images/icons2/user_business.png',NULL,0,NULL);

/*Table structure for table `module_group` */

DROP TABLE IF EXISTS `module_group`;

CREATE TABLE `module_group` (
  `id` bigint(20) NOT NULL auto_increment,
  `description` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `module_group` */

insert  into `module_group`(`id`,`description`) values (1,'Administrator'),(7,'HR'),(5,'end-users'),(8,'my approval access');

/*Table structure for table `module_group_access` */

DROP TABLE IF EXISTS `module_group_access`;

CREATE TABLE `module_group_access` (
  `id` bigint(20) NOT NULL auto_increment,
  `group_id` int(20) default NULL,
  `module_id` int(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=145 DEFAULT CHARSET=latin1;

/*Data for the table `module_group_access` */

insert  into `module_group_access`(`id`,`group_id`,`module_id`) values (133,5,64),(132,1,64),(131,7,61),(141,1,62),(140,1,61),(139,1,68),(138,1,65),(142,8,68),(143,1,69),(144,1,70);

/*Table structure for table `module_group_users` */

DROP TABLE IF EXISTS `module_group_users`;

CREATE TABLE `module_group_users` (
  `id` bigint(20) NOT NULL auto_increment,
  `username` varchar(100) default NULL,
  `group_id` int(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `module_group_users` */

insert  into `module_group_users`(`id`,`username`,`group_id`) values (1,'darryl.anaud',1),(5,'maribeth.rivas',7),(7,'richard.base',1),(4,'jmendoza',7),(8,'maribeth.rivas',8),(9,'dean.hall',8),(10,'maribeth.rivas',1);

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
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

/*Data for the table `supplier` */

insert  into `supplier`(`SUPPIDNO`,`SUPPLIERNAME`,`STYPEIDNO`,`ADDRESS01`,`ADDRESS02`,`ADDRESS03`,`PHONE`,`FAXNO`,`MOBILE`,`WEBSITE`,`EMAIL`,`LOGO`,`MAP`,`active`,`DMODIFIED`) values (26,'N/A',3,'1','','','','','','','','','',0,'2011-01-28 21:43:49'),(4,'ACW Distribution (Phils.), Inc.',1,'23/F The Orient Square','F. Ortigas Jr. Road, Ortigas Center','Pasig City, Philippines','(632) 706-5592','(632) 706-5506','','http://www.acw-group.com','enquiry@acw-group.com.ph','','',1,'2011-01-26 03:06:05'),(5,'Accent Micro Technologies, Incorporated',1,'14th Floor of Antel Global Corporate Center','Julia Vargas Avenue, Ortigas Centre','Pasig City, Philippines','(632) 323 3888','(632) 323 3889','','www.amti.com.ph','marketing@amti.com.ph','','',1,'2011-01-26 02:53:56'),(6,'American Technologies, Inc. (ATI)',1,'#5 Ideal St., cor. McCollough','Brgy. Addition Hills','Mandaluyong City, Philippines','(632) 584.0000','1','(632) 584.6868','www.ati.com.ph','inquiry@ati.com.ph','','',1,'2011-01-26 02:58:24'),(7,'Anixter International',1,'18/F Multinational Bancorproration Centre','6805 Ayala Avenue','Makati City, Philippines','(632) 845 1570','(632) 845 1571','','www.anixter.com','Zacarias.Sabado@anixter.com','','1',1,'2011-01-26 03:27:28'),(8,'Avesco Marketing Corporation',1,'810 AVESCO Building','Aurora Blvd. corner Yale Street, Cubao','Quezon City, Philippines','(632) 912-8881 t','(632) 912-2911 /','','www.avesco.com.ph','cubao@avesco.com.ph','','',1,'2011-01-26 03:28:34'),(9,'Banbros Commercial Inc.',1,'Banbros Corporate Center','No. 32 Pilar cor. Araullo Streets','Addition Hills, San Juan, Metro Manila, Philippines','(632) 727-3009','(632) 727-3050 /','','www.banbros.ph','bci_sales@banbros.ph','','',1,'2011-01-26 03:29:18'),(10,'Bayan Telecommunications Holdings Corporation',3,'Diliman Corporate Center','Bayan Bldg., Malingap cor. Maginhawa Sts.','Teacher\\\'s Village East, Quezon City, Philippines, 1101','(632) 4121212','1','1','www.bayan.com.ph','CPApodaca@bayan.com.ph','','1',1,'2011-01-26 02:57:53'),(11,'ComClark Network and Technology Corporation',1,'Reliance Center #99 E.Rodriguez Jr, Ave.','Bo. Ugong Pasig City, Philippines, 1604','','(632) 667-0888','(632) 667-0895','1','www.comclark.com','butch@comclark.com','','1',1,'2010-09-17 04:34:26'),(12,'InfoworX Incorporated',4,'384 B E. Rodriguez Sr. Ave. ','Brgy. Concepcion Quezon City','Philippines','571-9971 to 571-','1','1','www.worx.com.ph/','infoworx@worx.com.ph','','1',1,'2011-01-26 03:34:52'),(13,'Lamco International',1,'Suite 1804 18/F East Tower','PSE Centre Bldg., Exchange Road, Ortigas Center','Pasig City 1605 Philippines','(632) 634-7999 ','1','1','www.lamco.com.ph','info@lamco.com.ph','','1',1,'2010-09-17 04:33:01'),(14,'MSI-ECS Phils., Inc.',1,'Topy II Bldg. ','#3 Economia Street, Libis','Quezon City, 1110, Philippines','(632) 688-3333','(632) 688-3890','1','www.msi-ecs.com.ph','sales@msi-ecs.com.ph','','1',1,'2010-09-17 04:30:42'),(15,'MEC Networks Corporation',1,'23/F 2303 Jollibee Plaza','F.Ortigas Jr. Road, Ortigas Center','Pasig City, 1605, Philippines','(632) 638 9433','(632) 687 2348','1','www.mec.ph','c.guevarra@mec.ph','','1',1,'2010-09-17 04:25:25'),(16,'Saturn Information Technologies, Inc.',1,'Suite 1702 Tower C Gotesco Regency Twin Towers','1129 Concepcion Street, Ermita','Manila, Philippines','(632) 526 7306 ','(632) 526 8710','1','www.saturn.com.ph','sales@saturn.com.ph','','',1,'2010-09-17 04:21:36'),(17,'Microwarehouse, Inc.',1,'4 United Cor. First Sts.','Bgy. Kapitolyo, Pasig City ','Philippines 1600','(632) 637 0474 ','(632) 636 3720','1','www.microwarehouse.com.ph','ifix@microwarehouse.com.ph','','',1,'2010-09-17 04:20:45'),(18,'Mustard Seed Systems Corporation',1,'1001 Summit One Office Tower','530 Shaw Boulevard, Mandaluyong City','Philippines, 1550','(632) 535 7333','(632) 533 2989 ','1','www.mseedsystems.com','sales@mseedsystems.com','','',1,'2010-09-17 04:18:22'),(19,'Comstor Philippines',1,'Unit 2109 Jollibee Plaza','Emarald Ave., Ortigas Centre','Pasig City, Philippines, 1601','(632) 631 2565','1','1','www.comstor.com.ph','sales@comstor.com.ph','','',1,'2010-09-17 04:17:18'),(20,'Wordtext Systems, Inc. (WSI)',1,'7/F SEDCCO I Building, Legaspi Corner Rada Street','Legaspi Village, Makati City','Metro Manila, Philippines, 1229','(632) 858 5555','(632) 817 6430','2','www.wordtext.com.ph','sales@wsiphil.com.ph','','',1,'2010-09-24 05:00:25'),(21,'Xitrix Computer Corporation',1,'Xitrix Corporate Headquarters','23 Detroit Street, Cubao, Quezon City','Metro Manila, Philippines, 1109','(632) 721-9999','(632) 570-8034','1','www.xitrix.net','sales@xitrix.net','','',1,'2010-09-17 04:35:37'),(24,'Technologies Epicenter, Inc.',1,'ACTO Bldg., 137 Aurora Boulevard','Salapan, San Juan City','','732-4279 / 74440','723-4281','','http://www.iti.ph','','','',0,'2011-01-26 02:51:56'),(25,'ISecure Networks, Inc.',1,'G/F Building F. Phoenix Sun Business Park','E. Rodriguez Jr. Ave., Libis Quezon City ','Philippines','709-8090 ','912-7256 ','','www.isn.com.ph','sales@isn.com.ph','','',0,'2011-01-26 03:04:41'),(28,'Transition Systems Philippines Pte Ltd Inc.',1,'Unit 2103, The Orient Square Bldg, F. Ortigas Jr. Road','Ortgias Center, Pasig City ','Philippines, 1605','4709013','4709057','','www.transition-asia.com','iris@transition-asia.com','','',0,'2011-01-30 21:25:42'),(29,'AWS Distribution Phil. Corp.',1,'357 Dr. Jose Fernandez St.','Mandaluyong City','Philippines, 1553','5349062 / 63','5336402','','www.awsgentec.com','elmer@awsgentec.com','','',0,'2011-01-30 21:44:58'),(30,'International MicroVillage, Inc.',1,'8B MEC Building','L.P. Leviste cor. Rufino Streets','Salcedo Village, Makati City, Philippines','7512130-34','7512133','','www.imvphil.com','inquiries@imvphil.com','','',0,'2011-01-30 21:51:59'),(31,'EVI Distribution Inc.',1,'117 F. Sevilla St.','Pedro Cruz, San Juan City','Philippines','7445555','6614225','','www.eviphils.com','info@eviphils.com','','',0,'2011-01-30 21:54:26'),(32,'Microdata Systems and Management Inc.',3,' 	MDS Bldg. 817 J.P. Rizal Street','Makati City,Philippines, 1210','','897-7777 ','897-7444 ','','www.microdata.com.ph','mdsinfo@microdata.com.ph','','',0,'2011-01-30 21:56:54'),(33,'Network Essentials Corporation',1,'173 EDSA, CSP Building','Mandaluyong City, Philippines','1550','7211981 to 83, 7','7279649','','www.netessentials.ph','info@netessentials.ph','','',0,'2011-01-30 22:07:26'),(34,'Keysys Inc.',1,'37 Insurance St., GSIS Village','Project 8, Quezon City','Philippines','9208476 / 77','920-8533 ','','www.keysys.com','info@keysys.com','','',0,'2011-01-30 22:21:28'),(35,'Netpoleon Solutions Pte Ltd ',1,'2901 Antel Global Corporate Centre','#3 Julia Vargas Ave, Ortigas Center','Pasig City, Philippines','6876088','6876971','','www.netpoleons.com','info@netpoleons.com','','',0,'2011-01-30 22:30:36'),(36,'ITrack Solutions, Inc.',3,'Unit 207, 398 Tandang Sora Avenue','Culiat, Quezon City','Philippines, 1116','3476883','3813438','','itracksolutions.net','admin@itracksolutions.net','','',0,'2011-01-30 22:36:44'),(37,'Datumstruct Philippines',1,'3/F Zeta Building','191 Salcedo Street, Legaspi Village, Makati City','Philippines, 1229','8300205/06/07','8122977','','www.datumstruct.com','sales@datumstruct.com','','',0,'2011-01-30 23:33:45'),(38,'i3 Technolgies Corporation',3,'8/F Herrera Tower','V. A. Rufino cor. Valero Sts., Salcedo Village','Makati City, Philippines, 1227','7531000','7533680','','www.i3tech.com.ph','mroque@i3tech.com.ph','','',0,'2011-01-30 23:44:25'),(39,'Alas Group Consulting',3,'5/F Angelus Plaza Building','104 V.A. Rufino Street, Legaspi Village','Makati City, Philippines, 1229','7515115 ','7506191','','www.alasgroup.com ','alasgroup@alasgroup.com','','',0,'2011-01-30 23:47:09'),(40,'Globe Telecom, Inc.',3,'5th Floor, Globe Telecom Plaza 1','Pioneer corner Madison Street','Mandaluyong City, Philippines, 1552 ','7302000','8455515','','www.globe.com.ph','talk@globetel.com.ph','','',0,'2011-02-01 04:21:59'),(41,'Synetcom Philippines, Inc.',1,'3/F Fortress Hill Building','297 Hagdang Bato Libis, Shaw Blvd.','Mandaluyong City, Philippines, 1550','5780371 ','5314535','','www.synetcom.ph','info@synetcom.ph','','',0,'2011-02-02 20:38:13'),(42,'Integrated Security and Automation, Inc. (ISA)',1,'#122 P. Cruz Street','ISA Bldg. Brgy. New Zaniga','Mandaluyong City, Philippines, 1550','5353535 / 532523','2392599','','www.isa.com.ph','info@isa.com.ph','','',0,'2011-02-02 20:57:17'),(43,'Teledatacom Philippines, Inc.',3,'25/F Tycoon Centre ','Pearl Drive, Ortigas Centre','Pasig City, Philippines, 1605','9007100','6363302','','www.teledata.com.sg','TDMarketing@teledata.com.sg','','',0,'2011-02-03 20:09:23'),(44,'Non-Applicable',1,'1','','','','','','','','','',0,'2011-02-03 20:18:52'),(45,'Primover Consultancy Services, Inc.',3,'3/F Erechem Building','Cor. V.A. Rufino and Salcedo Streets','Legaspi Village, Makati City. Philippines, 1229','8152131','8300186',' ','www.primover.com.ph','bernadette.alday@primover.com.ph','','',0,'2011-02-07 21:17:20'),(46,'Ariel F. Corsino',3,'1','','','','','09178929359','','ariel883fm@yahoo.com','','',0,'2011-02-08 03:23:08'),(47,'Metasystems Development, Inc.',3,'Metasystem\'s Bldg.','2 Acacia Lane cor. Shaw Blvd.','Mandaluyong City, Philippines, 1552','5342136','5346038','','www.metadev.com','ntingjuy@metadev.com','','',0,'2011-02-10 02:10:21'),(48,'UR Solutions, Inc.',3,'1/F ACS Plaza','Sen. Gil Puyat Avenue, Salcedo Village','Makati City, Philippines, 1200','8845374','3394033','','www.ursolutions.ph','contact@ursolutions.ph','','',0,'2011-02-10 02:29:48'),(49,'Eaton Industries Pte Ltd',5,'4 Loyang Lane #04-01/02','Singapore 508914','','+65 68251677','+65 68251689','','www.eaton.com','','','',0,'2011-02-10 02:44:12'),(50,'Aluminum Power Marketing Corporation',1,'671 T. Alonzo Street','Sta. Cruz, Manila','Philippines, 1002','7335316','7344326','','','','','',0,'2011-02-10 20:59:49'),(51,'CYO International, Inc.',1,'Suite 501 Greenhills Mansion','No. 37 Annapolis St., San Juan City','Philippines, 1502','7231586','7212386','','www.cyointernational.net','','','',0,'2011-02-10 23:22:54'),(52,'Fil-American Hardware Co., Inc.',4,'923 Aurora Blvd.','Cubao, Quezon City','Philippines, 1109','9125555','9126666','','www.filam.com.ph','sales@filam.com.ph','','',0,'2011-02-10 23:37:31'),(53,'Charles Phillip Tools & Supplies',4,'2146to48 Pedro Gil St.','Sta. Ana, Manila','Philippines','5641996','5631314','','','','','',0,'2011-02-11 00:20:09'),(54,'MGE UPS Systems Phils. Inc.',1,'444-A Edsa Guadalupe','Makati City, Metro Manila','Philippines','8996690','8996551','','www.apc.com','','','',0,'2011-03-02 20:58:56'),(55,'Liteware Computers Corp.',1,'58 Kamias Road','West Kamias, Quezon City','Philippines, 1102','9278241','9257589','','www.liteware.com.ph','sales@liteware.com.ph','','',0,'2011-02-16 04:28:17'),(56,'Ingram Micro Asia Ltd-Phils.',1,'Unit 1708 Jollibee Plaza','Emerald Avenue, Ortigas Center','Pasig City, Philippines','6338902','6356485','','www.ingrammicro.com','lolita.omega@ingrammicro-asia.com','','',0,'2011-02-16 04:36:56'),(57,'Bridge Distribution, Inc.',1,'Phil-Data Building','265 E. Rodriguez Sr. Avenue','Quezon City, Philippines, 1113','7810581','7312008','','','sales@bridgedisty.com','','',0,'2011-02-16 20:26:02'),(58,'NetPlay, Inc.',1,'8/F AIC Center Building','204 Escolta Street, Binondo','Manila, Philippines, 1006','2308755','2308795','','www.npi.ph','info@npi.ph','','',0,'2011-02-16 19:35:24'),(59,'Uplink Information System',1,'Units 915 & 916, City & Land Mega Plaza','ADB Ave., cor. Garnet Road, Ortigas ','Center, Pasig City, Philippines','9106460','6874037 ','','www.uplink.net.ph','admin@uplink.net.ph','','',0,'2011-02-16 20:29:23'),(60,'Lithefire Solutions, Inc.',3,'1','1','1','1','1','1','www.lithefire.com/','richard.base@gmail.com','','',0,'2011-02-18 00:34:29'),(61,'Tricom Dynamics, Inc.',1,'Metro House Building','345 Sen. Gil Puyat Avenue, Makati City','Philippines','8906525','8900698','','www.tricom.com.ph/tdi/index.html','','','',0,'2011-02-21 20:22:56'),(62,'Redwood Ventures, Inc. ',1,'4/F BB Corporate Center','32 Pilar Corner Araullo St., Addition Hills','San Juan, Metro Manila, Philippines','7215630','','','','','','',0,'2011-02-21 20:40:25'),(63,'Tenfold Telecom Construction, Inc.',1,'Pasig City','','','6434149','','','','ttci_99@yahoo.com','','',0,'2011-02-21 20:47:56'),(64,'Telecraft Services Corporation',1,'16th Floor Trafalgar Plaza ','105 H.V. dela Costa Street, Salcedo Village','Makati City, Philippines, 1227 ','8118181','8140133 ','','www.telecraft.com.ph','jhsagun@trends.com.ph','','',0,'2011-02-21 20:51:35'),(65,'CLIXLogic Inc.',1,'88 Don Primitivo St.','Don Antonio Heights, Brgy Holy Spirit','Quezon City, Philippines, 1127','9519661','','','www.CLIXPH.com','','','',0,'2011-02-21 20:55:38'),(66,'Axis Global Technologies, Inc. ',1,'# 20 North Road, cor 3rd Ave.','Cubao, Quezon City','Philippines','7243340','7243353','','www.axisglobal.com','sales@axisglobal.com','','',0,'2011-02-21 21:01:42'),(67,'Canon Marketing (Philippines), Inc. ',1,'7th Floor and Ground Floor, Commerce and Industry Plaza ','(CIP) Bldg, Campus Avenue corner Park Avenue','McKinley Hill, Brgy. Pinagsama, Fort Bonifacio, Taguig City, Philippines, 1634','8849090 ','','','www.canon.com.ph','','','',0,'2011-02-21 21:07:39'),(68,'Dee Wha Liong Electronics Equipment Corp. (DEECO)',4,'605-607 Sales Street','Sta. Cruz, Metro Manila','Philippines','7331749','7331756','','','','','',0,'2011-02-21 21:14:26'),(69,'Henry\'s Camera Photo Supply',4,'310 P. Gomez Street','Quiapo, Manila','Metro Manila, Philippines','3463589','7344018','09228207864','www.henryscameraphoto.com','helpdesk@henryscameraphoto.com','','',0,'2011-02-21 21:17:07'),(70,'We are IT Philippines, Inc. (WIT)',3,'Unit 36, Columbia Tower, Ortigas Avenue','Mandaluyong City, Philippines','','7269817','7446293','','www.philsat.com','sales@philsat.com','','',0,'2011-02-21 22:23:30'),(71,'Schmidt Philippines Inc. ',1,'ALPAP II Bldg.U-906 Madrigal Business Park','Investment Drive cor.Trade Avenue, Ayala Alabang','Muntinlupa City, Philippines, 1780 ','7722301','7722298 ','','www.schmidtelectronics.com','info.ph@schmidtasia.com','','',0,'2011-02-28 19:57:43'),(72,'Masstron Pte Ltd',1,'63 Hillview Avenue, #02-04, Lam Soon Industrial Building','Singapore, 669569','','(65) 6763 0309','(65) 6763 9776','','www.masstron.com','','','',0,'2011-02-28 20:02:32'),(73,'Bizzsecure Philippines, Inc.',1,'2606 Antel Global Corporate Center','3 Julia Vargas Avenue, Ortigas Center','Pasig City, Philippines, 1600 ','4073489','6673802 to 04 lo','','www.bizzsecure.com','contact_ph@bizzsecure.com','','',0,'2011-03-02 20:46:24'),(74,'Malaya Lumber and Construction Supply, Inc.',4,'917 J.P. Rizal Street Corner Makati Avenue','Makati City, Philippines, 1200','',' 8997492 / 89974','8997494','','','','','',0,'2011-03-02 21:40:44'),(75,'Information Technology Supplies Distribution, Inc.',1,'7/F SEDCCO 1 Bldg.','Rada corner Legaspi Streets','Legaspi Village, Makati City, Philippines','8585555','8404183','','www.wordtext.com.ph/iTSDi/','sales@itsdi.com.ph','','',0,'2011-03-03 00:29:53'),(76,'BN Distributors, Inc.',1,'455 Gen. Bautista Street	','San Juan City','Philippines','5840000','5846868','','','','','',0,'2011-03-03 22:02:04'),(77,'PC Express',4,'New Cybertown Computer City','Broadway Centrum','Aurora Blvd, Quezon City','7258888','7264821','','pcx.com.ph','','','',0,'2011-03-08 00:33:09'),(78,'maribeth rivas partner',3,'efsd','fdfd','fdfd','343','3423','343','http://www.sfdf.com','s@yahoo.com','','fdfd',0,'2011-03-31 02:00:15');

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
  KEY `FK_tbl_app_flow_app_type` (`app_type_id`),
  CONSTRAINT `FK_tbl_app_flow_app_type` FOREIGN KEY (`app_type_id`) REFERENCES `tbl_app_type` (`id`),
  CONSTRAINT `FK_tbl_app_flow_emp_group` FOREIGN KEY (`employee_group_id`) REFERENCES `tbl_employee_group` (`id`),
  CONSTRAINT `FK_tbl_app_flow_tree` FOREIGN KEY (`app_tree_id`) REFERENCES `tbl_app_tree` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_app_flow` */

insert  into `tbl_app_flow`(`id`,`employee_group_id`,`app_type_id`,`app_tree_id`) values (1,2,2,2),(2,2,1,3),(3,1,2,1),(4,3,2,4),(5,3,1,4),(6,1,1,1),(8,3,4,5),(9,2,4,6);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_app_group` */

insert  into `tbl_app_group`(`id`,`description`,`date_created`,`time_created`,`date_modified`,`time_modified`,`created_by`,`modified_by`) values (1,'HR_FIRST_APPROVER',NULL,NULL,NULL,NULL,NULL,NULL),(2,'HR_SECOND_APPROVER',NULL,NULL,NULL,NULL,NULL,NULL),(3,'PROG_FIRST_APPROVER',NULL,NULL,NULL,NULL,NULL,NULL),(4,'ALL_EMPLOYEES_FINAL_APPROVER',NULL,NULL,NULL,NULL,NULL,NULL),(5,'PROG_SECOND_APPROVER',NULL,NULL,NULL,NULL,NULL,NULL),(6,'QA_FIRST_APPROVER',NULL,NULL,NULL,NULL,NULL,NULL),(7,'QA_SECOND_APPROVER',NULL,NULL,NULL,NULL,NULL,NULL),(8,'DARRYL',NULL,NULL,NULL,NULL,NULL,NULL);

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
  KEY `FK_tbl_app_group_id` (`app_group_id`),
  CONSTRAINT `FK_tbl_app_group_id` FOREIGN KEY (`app_group_id`) REFERENCES `tbl_app_group` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_app_group_members` */

insert  into `tbl_app_group_members`(`id`,`app_group_id`,`employee_id`,`start_date`,`end_date`,`action_timestamp`,`is_expired`) values (2,3,2,'2011-09-19',NULL,'2011-09-19 05:34:36',0),(3,5,8,'2011-09-19',NULL,'2011-09-19 05:39:49',0),(4,4,8,'2011-09-22',NULL,'2011-09-22 01:30:59',0),(5,4,1,'2011-09-22',NULL,'2011-09-22 01:42:28',0),(7,1,2,'2011-10-26',NULL,'2011-10-26 10:57:44',0),(8,6,2,'2011-10-28',NULL,'2011-10-27 12:13:12',0),(9,6,1,'2011-10-28',NULL,'2011-10-27 12:13:22',0),(10,7,6,'2011-10-28',NULL,'2011-10-27 12:17:36',0),(11,8,1,'2011-11-25',NULL,'2011-11-24 21:13:16',0);

/*Table structure for table `tbl_app_status` */

DROP TABLE IF EXISTS `tbl_app_status`;

CREATE TABLE `tbl_app_status` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(128) default NULL,
  `modified_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `modified_by` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_app_status` */

insert  into `tbl_app_status`(`id`,`description`,`modified_time`,`modified_by`) values (1,'Pending','2011-09-15 03:33:58',NULL),(2,'Approved','2011-09-15 03:34:02',NULL),(3,'Denied','2011-09-15 03:34:05',NULL),(4,'Cancelled','2011-09-15 03:34:10',NULL),(5,'System Void','2011-09-15 08:37:04',NULL);

/*Table structure for table `tbl_app_tree` */

DROP TABLE IF EXISTS `tbl_app_tree`;

CREATE TABLE `tbl_app_tree` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(128) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_app_tree` */

insert  into `tbl_app_tree`(`id`,`description`) values (1,'PROG_LEAVE'),(2,'HR_LEAVE'),(3,'HR_OT'),(4,'QA_LEAVE'),(5,'QA_TRAINING'),(6,'HR_TRAINING');

/*Table structure for table `tbl_app_tree_details` */

DROP TABLE IF EXISTS `tbl_app_tree_details`;

CREATE TABLE `tbl_app_tree_details` (
  `id` int(11) NOT NULL auto_increment,
  `app_tree_id` int(11) default NULL,
  `app_group_id` int(11) default NULL,
  `parent` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_tbl_app_tree_details_app_tree` (`app_tree_id`),
  KEY `FK_tbl_app_tree_details_app_group` (`app_group_id`),
  CONSTRAINT `FK_tbl_app_tree_details_app_group` FOREIGN KEY (`app_group_id`) REFERENCES `tbl_app_group` (`id`),
  CONSTRAINT `FK_tbl_app_tree_details_app_tree` FOREIGN KEY (`app_tree_id`) REFERENCES `tbl_app_tree` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_app_tree_details` */

insert  into `tbl_app_tree_details`(`id`,`app_tree_id`,`app_group_id`,`parent`) values (1,1,3,NULL),(2,1,5,3),(3,2,1,NULL),(4,2,4,1),(5,3,1,NULL),(6,3,4,1),(7,4,6,NULL),(9,4,7,6),(10,5,8,NULL),(11,6,8,NULL);

/*Table structure for table `tbl_app_type` */

DROP TABLE IF EXISTS `tbl_app_type`;

CREATE TABLE `tbl_app_type` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(128) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_app_type` */

insert  into `tbl_app_type`(`id`,`description`) values (1,'OT'),(2,'Leave'),(3,'Training'),(4,'Client Schedule');

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
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_application_audit` */

insert  into `tbl_application_audit`(`id`,`application_pk`,`app_type_id`,`app_type`,`action_timestamp`,`approver_id`,`requestor`,`employee_group_id`,`app_group_id`,`app_tree_id`,`remarks`,`status_id`,`is_active`) values (3,5,2,'Leave','2011-10-28 10:28:22',2,7,2,1,2,'Noted',1,0),(4,6,2,'Leave','2011-10-28 10:12:01',2,7,2,1,2,'Noted.',1,0),(5,7,2,'Leave','2011-10-28 10:49:51',NULL,7,2,1,2,NULL,4,1),(6,8,2,'Leave','2011-10-28 10:41:43',2,7,2,1,2,'Yes!',1,0),(7,9,2,'Leave','2011-11-24 14:03:59',1,5,3,6,4,'Noted',1,0),(10,6,2,'Leave','2011-10-27 21:24:02',1,7,2,4,2,'Approved',2,1),(11,5,2,'Leave','2011-10-28 10:30:20',8,7,2,4,2,'Approved',2,1),(12,8,2,'Leave','2011-10-28 10:42:10',1,7,2,4,2,'no!',3,1),(13,1,1,'OT','2011-10-28 20:26:36',NULL,7,2,1,3,NULL,1,1),(14,10,2,'Leave','2011-11-02 18:59:53',1,3,3,6,4,'Ok!',1,0),(15,2,1,'OT','2011-10-28 21:27:09',2,3,3,6,4,'No OT allowed!',3,1),(16,3,1,'OT','2011-10-28 22:04:16',NULL,3,3,6,4,NULL,4,1),(17,11,2,'Leave','2011-10-29 20:10:26',2,2,1,3,1,'test',3,1),(18,10,2,'Leave','2011-11-02 18:59:53',NULL,3,3,7,4,NULL,1,1),(19,12,2,'Leave','2011-11-03 09:32:46',NULL,2,1,3,1,NULL,1,1),(20,13,2,'Leave','2011-11-11 14:28:15',NULL,1,1,3,1,NULL,4,1),(21,14,2,'Leave','2011-11-24 10:34:19',2,1,1,3,1,'ok',1,0),(22,15,2,'Leave','2011-11-11 14:42:45',NULL,1,1,3,1,NULL,4,1),(23,14,2,'Leave','2011-11-24 10:36:37',8,1,1,5,1,'approve',2,1),(24,16,2,'Leave','2011-11-24 12:41:45',NULL,1,1,3,1,NULL,4,1),(25,17,2,'Leave','2011-11-26 10:15:37',NULL,1,1,3,1,NULL,4,1),(26,18,2,'Leave','2011-11-26 10:15:31',NULL,1,1,3,1,NULL,4,1),(27,19,2,'Leave','2011-11-24 13:14:35',NULL,1,1,3,1,NULL,4,1),(28,20,2,'Leave','2011-11-24 12:54:44',NULL,1,1,3,1,NULL,4,1),(29,21,2,'Leave','2011-11-24 13:24:37',NULL,1,1,3,1,NULL,4,1),(30,9,2,'Leave','2011-11-24 14:07:01',6,5,3,7,4,'Approved',2,1),(31,4,1,'OT','2011-11-24 14:10:43',NULL,3,3,6,4,NULL,1,1),(32,22,2,'Leave','2011-11-24 22:29:22',NULL,7,2,1,2,NULL,1,1),(33,1,4,'Client Schedule','2011-11-25 15:17:14',1,3,3,8,5,'Ok',2,1),(34,2,4,'Client Schedule','2011-11-25 15:53:34',NULL,3,3,8,5,NULL,1,1),(35,3,4,'Client Schedule','2011-11-25 16:16:30',NULL,3,3,8,5,NULL,1,1),(36,4,4,'Client Schedule','2011-11-25 22:23:43',NULL,7,2,8,6,NULL,1,1),(37,23,2,'Leave','2011-11-26 11:36:38',2,5,3,6,4,'approved',1,0),(38,23,2,'Leave','2011-11-26 11:39:13',6,5,3,7,4,'noted',2,1),(39,24,2,'Leave','2011-11-26 11:38:01',1,5,3,6,4,'Ok.',1,0),(40,24,2,'Leave','2011-11-26 11:39:24',6,5,3,7,4,'noted',2,1);

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
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_call_log` */

insert  into `tbl_call_log`(`id`,`employee_id`,`call_log_type_id`,`date_from`,`date_to`,`portion`,`no_days`,`date_requested`,`requested_by`,`modified_by`,`reason`,`leave_filed`) values (6,8,1,'2011-11-26','2011-11-26','WHOLE DAY',1,'2011-11-26',8,NULL,'Test',0),(4,3,1,'2011-11-25','2011-11-25','WHOLE DAY',1,'2011-11-25',1,NULL,'test',0),(3,1,1,'2011-11-25','2011-11-25','WHOLE DAY',1,'2011-11-25',1,1,'Headache',0),(5,2,1,'2011-11-26','2011-11-26','WHOLE DAY',1,'2011-11-25',1,NULL,'1234567',0);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_client_schedule` */

insert  into `tbl_client_schedule`(`id`,`employee_id`,`date_scheduled`,`time_in`,`time_out`,`type`,`client_id`,`contact_person_id`,`purpose_id`,`date_requested`,`agenda`) values (1,3,'2011-11-26','08:00:00','12:00:00','Client',1110,308,1,'2011-11-25','Meeting'),(2,3,'2011-11-25','08:00:00','12:00:00','Client',1242,86,12,'2011-11-25','1234'),(3,3,'2011-11-26','13:00:00','17:00:00','Client',1319,16,20,'2011-11-25','Test'),(4,7,'2011-11-26','13:30:00','18:30:00','Client',1482,54,12,'2011-11-25','Test');

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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_educational_background` */

insert  into `tbl_educational_background`(`id`,`employee_id`,`school_id`,`course_id`,`date_start`,`date_end`) values (7,1,1,1,'2011-04-01','2011-05-31'),(8,1,3,6,'2011-05-01','2011-05-31'),(5,6,3,6,'2011-05-05','2011-05-21'),(9,7,3,6,'2011-11-02','2011-11-25'),(10,3,1,4,'1990-06-01','1994-01-01');

/*Table structure for table `tbl_employee_group` */

DROP TABLE IF EXISTS `tbl_employee_group`;

CREATE TABLE `tbl_employee_group` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(128) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_employee_group` */

insert  into `tbl_employee_group`(`id`,`description`) values (1,'PROGRAMMERS'),(2,'HR'),(3,'QA Engineers');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_employee_group_members` */

insert  into `tbl_employee_group_members`(`id`,`employee_group_id`,`employee_id`,`start_date`,`end_date`,`action_timestamp`) values (1,1,1,'2011-09-23',NULL,'2011-10-25 08:41:58'),(2,1,2,'2011-09-23',NULL,'2011-09-23 00:44:12'),(3,2,7,'2011-10-21',NULL,'2011-10-21 04:38:10'),(4,3,5,'2011-10-28',NULL,'2011-10-27 12:12:03'),(5,3,3,'2011-10-28',NULL,'2011-10-27 12:12:09'),(6,3,4,'2011-10-28',NULL,'2011-10-27 12:12:18');

/*Table structure for table `tbl_employee_info` */

DROP TABLE IF EXISTS `tbl_employee_info`;

CREATE TABLE `tbl_employee_info` (
  `id` int(11) NOT NULL auto_increment,
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
  `department` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `salary` varchar(50) default NULL,
  `employee_category` int(11) NOT NULL,
  `employee_status` int(11) NOT NULL,
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
  `ACTIVATED` tinyint(1) default '1',
  PRIMARY KEY  (`id`),
  KEY `FK_tbl_employee_info_dept` (`department`),
  KEY `FK_tbl_employee_info_emca` (`employee_category`),
  KEY `FK_tbl_employee_info_emst` (`employee_status`),
  KEY `FK_tbl_employee_info_posi` (`position`),
  CONSTRAINT `FK_tbl_employee_info_department` FOREIGN KEY (`department`) REFERENCES `filedepartment` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_employee_info` */

insert  into `tbl_employee_info`(`id`,`lastname`,`firstname`,`middlename`,`gender`,`civil_status`,`email`,`birthdate`,`birth_place`,`address`,`provincial_address`,`fathers_name`,`fathers_occupation`,`mothers_name`,`mothers_occupation`,`citizenship`,`spouse_name`,`spouse_occupation`,`childrens_name`,`telephone`,`mobile`,`department`,`position`,`salary`,`employee_category`,`employee_status`,`sss`,`tin`,`date_hired`,`date_resigned`,`reason`,`emergency_contact`,`emergency_phone`,`emergency_address`,`username`,`password`,`is_delete`,`ACTIVATED`) values (1,'Anaud','Darryl','Campos','M','Single','darrylanaud@gmail.com','2011-04-30','Cotabato City','Dumanlas, Buhangin, Davao City','','Virgilio Anaud','COO','Concepcion Anaud','Housewife','filipino','','',NULL,'3004615','09234477228',1,1,'30000',1,1,'','','2011-04-25',NULL,'','','','','darryl.anaud','25d55ad283aa400af464c76d713c07ad',0,1),(2,'Rivas','Maribeth','G','F','Single','leighsparadise@gmail.com','2011-04-30','Davao City','Davao City','','abn','ab','ab','ab','Filipino','','',NULL,'','',4,1,'25000',1,1,'','','2011-04-30',NULL,'','','','','maribeth.rivas','25d55ad283aa400af464c76d713c07ad',0,1),(3,'Enova','John','E','M','Single','john.enova@gmail.com','2011-04-30','sample','Davao City','sample','Da','sdf','sdf','fsdfdsf','Filipino',NULL,NULL,NULL,NULL,'09234412356',1,1,'25000',1,1,NULL,NULL,'2011-04-26',NULL,NULL,NULL,NULL,NULL,'john.enova','25d55ad283aa400af464c76d713c07ad',0,1),(4,'Piatos','Edmund','Arellano','M','Married','eapiatos@yahoo.com','2011-04-30','davao','Davao City',NULL,'a','a','a','a','Filipino',NULL,NULL,NULL,NULL,NULL,1,2,NULL,1,1,NULL,NULL,'2011-04-27',NULL,NULL,NULL,NULL,NULL,'edmund.piatos','25d55ad283aa400af464c76d713c07ad',0,1),(5,'Mendoza','Jasmine','T','F','Married','jm@yahoo.com','2011-04-30','davao city','Davao City Philippines',NULL,'a','a','a','a','Filipino',NULL,NULL,NULL,NULL,NULL,1,3,NULL,1,1,NULL,NULL,'2011-04-28',NULL,NULL,NULL,NULL,NULL,'jasmine.mendoza','25d55ad283aa400af464c76d713c07ad',0,1),(6,'Hall','Dean','William','M','Single','wqewq@yahoo.com','1981-05-25','davao','test','test','test','test','test','test','filipino','test','test','test','234-6978','+639278350960',4,1,'60000',2,1,'48787-45487','45445-88978-7878','2011-05-02','2011-02-16','rerere','ere','212478','erer','dean.hall','25d55ad283aa400af464c76d713c07ad',0,1),(7,'test employee','test employee','test employee','M','Single','test@yahoo.com','1987-03-21','test','Test Address',NULL,'test father','test occu','test mother','test occu','Filipino',NULL,NULL,NULL,'1234','1234',1,1,'20000',2,1,'1234','1234','2011-09-19',NULL,NULL,'test emergency','1234','test emergency address','test.employee','25d55ad283aa400af464c76d713c07ad',0,1),(8,'base','richard','test','M','Married','richard.base@gmail.com','1980-04-01','Davao City','Test','Test','test','test','test','test','Filipino','test','test','test','test','test',1,3,'123456',1,1,NULL,NULL,'2011-09-12',NULL,NULL,NULL,NULL,NULL,'richard.base','25d55ad283aa400af464c76d713c07ad',0,1);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_employee_info_copy` */

insert  into `tbl_employee_info_copy`(`id`,`lastname`,`firstname`,`middlename`,`gender`,`civil_status`,`email`,`birthdate`,`birth_place`,`address`,`provincial_address`,`fathers_name`,`fathers_occupation`,`mothers_name`,`mothers_occupation`,`citizenship`,`spouse_name`,`spouse_occupation`,`childrens_name`,`telephone`,`mobile`,`department`,`position`,`salary`,`employee_category`,`employee_status`,`sss`,`tin`,`date_hired`,`date_resigned`,`reason`,`emergency_contact`,`emergency_phone`,`emergency_address`,`username`,`password`,`is_delete`) values (1,'Anaud','Darryl','Campos','M','Single','darrylanaud@gmail.com','2011-04-30','Cotabato City','Dumanlas, Buhangin, Davao City','','Virgilio Anaud','COO','Concepcion Anaud','Housewife','filipino','','',NULL,'3004615','09234477228',1,1,'30000',1,1,'','','2011-04-25',NULL,'','','','','darryl.anaud','098f6bcd4621d373cade4e832627b4f6',0),(2,'Rivas','Maribeth','G','F','Single','leighsparadise@gmail.com','2011-04-30','Davao City','Davao City','','abn','ab','ab','ab','Filipino','','',NULL,'','',4,1,'25000',1,1,'','','2011-04-30',NULL,'','','','','maribeth.rivas','25d55ad283aa400af464c76d713c07ad',1),(3,'Enova','John','E','M','Single','john.enova@gmail.com','2011-04-30','sample','Davao City','sample','Da','sdf','sdf','fsdfdsf','Filipino',NULL,NULL,NULL,NULL,'09234412356',1,1,'25000',1,1,NULL,NULL,'2011-04-26',NULL,NULL,NULL,NULL,NULL,'john.enova','25d55ad283aa400af464c76d713c07ad',0),(4,'Piatos','Edmund','Arellano','M','Married','eapiatos@yahoo.com','2011-04-30','davao','Davao City',NULL,'a','a','a','a','Filipino',NULL,NULL,NULL,NULL,NULL,1,2,NULL,1,1,NULL,NULL,'2011-04-27',NULL,NULL,NULL,NULL,NULL,'edmund.piatos','25d55ad283aa400af464c76d713c07ad',0),(5,'Mendoza','Jasmine','T','F','Married','jm@yahoo.com','2011-04-30','davao city','Davao City Philippines',NULL,'a','a','a','a','Filipino',NULL,NULL,NULL,NULL,NULL,1,3,NULL,1,1,NULL,NULL,'2011-04-28',NULL,NULL,NULL,NULL,NULL,'jmendoza','6c42264bad29e6ac66b833f6f1921068',0),(6,'Hall','Dean','William','M','Single','wqewq@yahoo.com','1981-05-25','davao','test','test','test','test','test','test','filipino','test','test','test','234-6978','+639278350960',4,1,'60000',2,1,'48787-45487','45445-88978-7878','2011-05-02','2011-02-16','rerere','ere','212478','erer','dean.hall','25d55ad283aa400af464c76d713c07ad',0);

/*Table structure for table `tbl_employee_leave_credits` */

DROP TABLE IF EXISTS `tbl_employee_leave_credits`;

CREATE TABLE `tbl_employee_leave_credits` (
  `id` int(11) NOT NULL auto_increment,
  `employee_id` int(11) NOT NULL,
  `vacation_leave` float default NULL,
  `sick_leave` float default NULL,
  `paternity_leave` float default NULL,
  `maternity_leave` float default NULL,
  `unpaid_sick_leave` float default NULL,
  `unpaid_vacation_leave` float default NULL,
  `emergency_leave` float default NULL,
  `year` char(4) default NULL,
  `DCREATED` date default NULL,
  `TCREATED` time default NULL,
  `DMODIFIED` date default NULL,
  `TMODIFIED` time default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_employee_leave_credits` */

insert  into `tbl_employee_leave_credits`(`id`,`employee_id`,`vacation_leave`,`sick_leave`,`paternity_leave`,`maternity_leave`,`unpaid_sick_leave`,`unpaid_vacation_leave`,`emergency_leave`,`year`,`DCREATED`,`TCREATED`,`DMODIFIED`,`TMODIFIED`) values (1,1,15,15,NULL,0,5,5,5,'2011',NULL,NULL,NULL,NULL),(2,3,15,15,NULL,NULL,5,5,5,'2011',NULL,NULL,NULL,NULL),(3,5,15,15,NULL,30,5,5,5,'2011',NULL,NULL,NULL,NULL);

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
  KEY `FK_tbl_employment_history_employee_id` (`employee_id`),
  CONSTRAINT `FK_tbl_employment_history_employee` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee_info` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_employment_history` */

insert  into `tbl_employment_history`(`id`,`employee_id`,`company`,`company_address`,`position`,`date_start`,`date_end`,`reason_for_leaving`) values (1,1,'concentrix','davao','jr. programmer','2009-08-03','2011-04-01','personal'),(2,3,'bioskin','davao','programmer','2008-04-01','2009-05-01','personal'),(4,1,'Lithefire Solutions Inc.','Manila','Web Developer','2011-04-01',NULL,NULL),(5,6,'Teste','fasfds','etesf','2011-05-08','2011-05-31','sdfsd'),(6,6,'Beth company','davao','IT president','2011-05-04','2011-04-25','bored'),(7,7,'microsoft','silicon valley','manager','2011-11-10','2011-11-25','low salary');

/*Table structure for table `tbl_leave_application` */

DROP TABLE IF EXISTS `tbl_leave_application`;

CREATE TABLE `tbl_leave_application` (
  `id` int(11) NOT NULL auto_increment,
  `employee_id` int(11) default NULL,
  `date_from` date default NULL,
  `date_to` date default NULL,
  `no_days` float default NULL,
  `leave_type` int(11) default NULL,
  `date_requested` date default NULL,
  `reason` varchar(128) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_leave_application` */

insert  into `tbl_leave_application`(`id`,`employee_id`,`date_from`,`date_to`,`no_days`,`leave_type`,`date_requested`,`reason`) values (5,7,'2011-10-26','2011-10-26',1,1,'2011-10-26','Test'),(6,7,'2011-11-01','2011-11-02',2,1,'2011-10-26','Kalag Kalag'),(7,7,'2011-11-03','2011-11-03',1,1,'2011-10-27','Test'),(8,7,'2011-10-31','2011-10-31',1,1,'2011-10-27','Test'),(9,5,'2011-11-03','2011-11-04',2,1,'2011-10-28','Family Vacation'),(10,3,'2011-11-02','2011-11-04',3,1,'2011-10-28','Vacation'),(11,2,'2011-11-02','2011-11-04',3,1,'2011-10-29','test reason'),(12,2,'2011-11-11','2011-11-11',0.5,1,'2011-11-03','Test'),(13,1,'2011-10-12','2011-11-11',31,1,'2011-11-11','Test'),(14,1,'2011-11-12','2011-11-12',0.5,1,'2011-11-11','test'),(15,1,'2011-11-18','2011-11-24',7,1,'2011-11-11','test'),(16,1,'2011-11-28','2011-11-29',2,1,'2011-11-24','Vacation'),(17,1,'2011-11-23','2011-11-23',1,2,'2011-11-24','Headache'),(18,1,'2011-11-21','2011-11-21',1,3,'2011-11-24','Test'),(19,1,'2011-11-18','2011-11-24',7,1,'2011-11-24','1234'),(20,1,'2011-11-20','2011-11-20',0.5,1,'2011-11-24','12345'),(21,1,'2011-11-30','2011-12-01',2,4,'2011-11-24','1234'),(22,7,'2011-11-09','2011-11-09',1,2,'2011-11-24','This is a test.'),(23,5,'2011-11-25','2011-11-25',0.5,2,'2011-11-26','fever'),(24,5,'2011-11-30','2011-11-30',1,1,'2011-11-26','Wedding');

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_leave_type` */

insert  into `tbl_leave_type`(`id`,`description`,`ACTIVATED`,`dcreated`,`tcreated`,`dmodified`,`tmodified`) values (1,'Vacation Leave',1,NULL,NULL,NULL,NULL),(2,'Sick Leave',1,NULL,NULL,NULL,NULL),(3,'Emergency Leave',1,NULL,NULL,NULL,NULL),(4,'Unpaid Vacation Leave',1,NULL,NULL,NULL,NULL),(5,'Unpaid Sick Leave',1,NULL,NULL,NULL,NULL),(6,'Maternity Leave',0,NULL,NULL,NULL,NULL),(7,'Paternity Leave',0,NULL,NULL,NULL,NULL);

/*Table structure for table `tbl_logs` */

DROP TABLE IF EXISTS `tbl_logs`;

CREATE TABLE `tbl_logs` (
  `id` bigint(20) NOT NULL auto_increment,
  `userId` bigint(20) NOT NULL,
  `actionType` varchar(50) NOT NULL,
  `time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=458 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_logs` */

insert  into `tbl_logs`(`id`,`userId`,`actionType`,`time`) values (1,1,'LOGIN','0000-00-00 00:00:00'),(2,1,'LOGIN','0000-00-00 00:00:00'),(3,1,'LOGIN','0000-00-00 00:00:00'),(4,1,'LOGIN','0000-00-00 00:00:00'),(5,1,'LOGOUT','0000-00-00 00:00:00'),(6,1,'LOGOUT','0000-00-00 00:00:00'),(7,1,'LOGIN','0000-00-00 00:00:00'),(8,1,'LOGOUT','0000-00-00 00:00:00'),(9,1,'LOGIN','0000-00-00 00:00:00'),(10,1,'LOGOUT','0000-00-00 00:00:00'),(11,1,'LOGIN','0000-00-00 00:00:00'),(12,1,'LOGOUT','0000-00-00 00:00:00'),(13,1,'LOGIN','0000-00-00 00:00:00'),(14,1,'LOGOUT','0000-00-00 00:00:00'),(15,1,'LOGIN','0000-00-00 00:00:00'),(16,1,'LOGOUT','0000-00-00 00:00:00'),(17,1,'LOGIN','0000-00-00 00:00:00'),(18,0,'LOGOUT','0000-00-00 00:00:00'),(19,1,'LOGIN','0000-00-00 00:00:00'),(20,1,'LOGOUT','0000-00-00 00:00:00'),(21,1,'LOGIN','0000-00-00 00:00:00'),(22,2,'LOGIN','0000-00-00 00:00:00'),(23,1,'LOGOUT','0000-00-00 00:00:00'),(24,2,'LOGIN','0000-00-00 00:00:00'),(25,2,'LOGIN','0000-00-00 00:00:00'),(26,2,'LOGOUT','0000-00-00 00:00:00'),(27,2,'LOGIN','0000-00-00 00:00:00'),(28,1,'LOGIN','0000-00-00 00:00:00'),(29,1,'LOGIN','0000-00-00 00:00:00'),(30,2,'LOGIN','0000-00-00 00:00:00'),(31,1,'LOGIN','0000-00-00 00:00:00'),(32,1,'LOGIN','0000-00-00 00:00:00'),(33,1,'LOGOUT','0000-00-00 00:00:00'),(34,1,'LOGIN','0000-00-00 00:00:00'),(35,1,'LOGOUT','0000-00-00 00:00:00'),(36,1,'LOGIN','0000-00-00 00:00:00'),(37,1,'LOGOUT','0000-00-00 00:00:00'),(38,1,'LOGIN','0000-00-00 00:00:00'),(39,1,'LOGOUT','0000-00-00 00:00:00'),(40,1,'LOGIN','0000-00-00 00:00:00'),(41,1,'LOGOUT','0000-00-00 00:00:00'),(42,1,'LOGIN','0000-00-00 00:00:00'),(43,1,'LOGOUT','0000-00-00 00:00:00'),(44,2,'LOGIN','0000-00-00 00:00:00'),(45,2,'LOGOUT','0000-00-00 00:00:00'),(46,1,'LOGIN','0000-00-00 00:00:00'),(47,1,'LOGOUT','0000-00-00 00:00:00'),(48,1,'LOGIN','0000-00-00 00:00:00'),(49,1,'LOGIN','0000-00-00 00:00:00'),(50,1,'LOGOUT','0000-00-00 00:00:00'),(51,2,'LOGIN','0000-00-00 00:00:00'),(52,2,'LOGOUT','0000-00-00 00:00:00'),(53,1,'LOGIN','0000-00-00 00:00:00'),(54,1,'LOGOUT','0000-00-00 00:00:00'),(55,1,'LOGIN','0000-00-00 00:00:00'),(56,2,'LOGIN','0000-00-00 00:00:00'),(57,2,'LOGIN','0000-00-00 00:00:00'),(58,2,'LOGOUT','0000-00-00 00:00:00'),(59,1,'LOGIN','0000-00-00 00:00:00'),(60,1,'LOGIN','0000-00-00 00:00:00'),(61,1,'LOGOUT','2011-06-15 21:54:17'),(62,1,'LOGIN','2011-06-16 01:02:04'),(63,1,'LOGIN','2011-06-16 06:42:28'),(64,1,'LOGIN','2011-06-16 06:43:40'),(65,1,'LOGOUT','2011-06-16 06:46:14'),(66,1,'LOGIN','2011-06-16 06:46:31'),(67,1,'LOGIN','2011-06-16 12:55:06'),(68,1,'LOGIN','2011-06-16 13:50:22'),(69,1,'LOGIN','2011-06-18 02:42:50'),(70,1,'LOGIN','2011-06-24 04:33:07'),(71,1,'LOGIN','2011-06-25 22:02:37'),(72,1,'LOGOUT','2011-06-25 22:32:07'),(73,2,'LOGIN','2011-06-25 22:32:18'),(74,1,'LOGIN','2011-07-07 03:59:04'),(75,1,'LOGOUT','2011-07-07 04:07:58'),(76,1,'LOGIN','2011-07-07 04:08:08'),(77,1,'LOGOUT','2011-07-07 04:23:51'),(78,1,'LOGIN','2011-07-07 04:24:03'),(79,1,'LOGOUT','2011-07-07 04:24:51'),(80,1,'LOGIN','2011-07-07 04:25:02'),(81,1,'LOGIN','2011-07-10 22:32:08'),(82,1,'LOGIN','2011-07-14 07:55:28'),(83,1,'LOGOUT','2011-07-14 07:58:37'),(84,1,'LOGIN','2011-07-14 08:16:40'),(85,1,'LOGIN','2011-07-18 23:45:05'),(86,1,'LOGIN','2011-07-19 06:48:45'),(87,1,'LOGIN','2011-07-19 11:47:02'),(88,1,'LOGIN','2011-07-19 21:05:44'),(89,1,'LOGIN','2011-07-25 20:28:59'),(90,1,'LOGOUT','2011-07-25 20:49:59'),(91,1,'LOGIN','2011-07-25 21:42:00'),(92,1,'LOGIN','2011-07-25 22:08:46'),(93,1,'LOGIN','2011-07-25 22:10:44'),(94,1,'LOGOUT','2011-07-25 22:51:07'),(95,1,'LOGIN','2011-08-07 22:50:44'),(96,1,'LOGOUT','2011-08-07 22:51:45'),(97,1,'LOGIN','2011-08-07 22:56:31'),(98,1,'LOGOUT','2011-08-07 23:00:24'),(99,1,'LOGIN','2011-08-07 23:00:31'),(100,1,'LOGOUT','2011-08-07 23:11:40'),(101,2,'LOGIN','2011-08-07 23:11:53'),(102,2,'LOGOUT','2011-08-07 23:12:03'),(103,1,'LOGIN','2011-08-07 23:14:33'),(104,1,'LOGOUT','2011-08-07 23:14:49'),(105,1,'LOGIN','2011-08-07 23:14:59'),(106,1,'LOGOUT','2011-08-07 23:16:00'),(107,3,'LOGIN','2011-08-07 23:16:16'),(108,3,'LOGOUT','2011-08-08 00:46:10'),(109,1,'LOGIN','2011-08-08 01:12:54'),(110,1,'LOGOUT','2011-08-08 01:14:00'),(111,1,'LOGIN','2011-08-09 00:13:53'),(112,1,'LOGIN','2011-08-11 10:46:31'),(113,2,'LOGIN','2011-08-14 19:58:06'),(114,1,'LOGIN','2011-08-14 20:01:25'),(115,1,'LOGIN','2011-08-15 21:54:52'),(116,2,'LOGIN','2011-08-31 06:32:43'),(117,2,'LOGIN','2011-08-31 12:55:47'),(118,1,'LOGIN','2011-09-02 03:23:23'),(119,1,'LOGOUT','2011-09-02 05:03:49'),(120,2,'LOGIN','2011-09-02 05:04:15'),(121,2,'LOGIN','2011-09-02 22:31:00'),(122,1,'LOGIN','2011-09-13 07:10:19'),(123,1,'LOGIN','2011-09-13 19:58:26'),(124,1,'LOGOUT','2011-09-13 20:09:54'),(125,1,'LOGIN','2011-09-13 20:10:21'),(126,1,'LOGIN','2011-09-14 08:28:37'),(127,1,'LOGOUT','2011-09-14 09:12:57'),(128,1,'LOGIN','2011-09-14 09:13:05'),(129,1,'LOGIN','2011-09-15 00:30:50'),(130,1,'LOGOUT','2011-09-15 00:33:12'),(131,2,'LOGIN','2011-09-15 00:33:22'),(132,1,'LOGIN','2011-09-16 03:59:21'),(133,1,'LOGIN','2011-09-18 01:01:40'),(134,1,'LOGOUT','2011-09-18 02:04:03'),(135,1,'LOGIN','2011-09-18 02:04:11'),(136,1,'LOGOUT','2011-09-18 02:08:55'),(137,1,'LOGOUT','2011-09-18 02:08:56'),(138,1,'LOGOUT','2011-09-18 02:08:57'),(139,1,'LOGOUT','2011-09-18 02:08:57'),(140,1,'LOGIN','2011-09-18 02:09:07'),(141,1,'LOGOUT','2011-09-18 02:13:31'),(142,1,'LOGIN','2011-09-18 02:13:48'),(143,1,'LOGOUT','2011-09-18 04:26:53'),(144,2,'LOGIN','2011-09-18 04:27:08'),(145,2,'LOGOUT','2011-09-18 04:28:51'),(146,1,'LOGIN','2011-09-18 04:29:01'),(147,1,'LOGOUT','2011-09-18 06:47:56'),(148,7,'LOGIN','2011-09-18 06:49:50'),(149,7,'LOGOUT','2011-09-18 06:51:28'),(150,7,'LOGIN','2011-09-18 06:51:41'),(151,7,'LOGOUT','2011-09-18 07:38:51'),(152,1,'LOGIN','2011-09-18 07:39:00'),(153,1,'LOGOUT','2011-09-18 07:41:32'),(154,7,'LOGIN','2011-09-18 07:41:49'),(155,7,'LOGOUT','2011-09-18 07:44:19'),(156,1,'LOGIN','2011-09-18 07:44:40'),(157,1,'LOGOUT','2011-09-18 07:45:22'),(158,7,'LOGIN','2011-09-18 07:45:32'),(159,1,'LOGIN','2011-09-18 21:32:55'),(160,2,'LOGIN','2011-09-18 21:49:25'),(161,2,'LOGOUT','2011-09-18 21:58:46'),(162,1,'LOGIN','2011-09-19 03:28:02'),(163,1,'LOGOUT','2011-09-19 03:57:08'),(164,1,'LOGIN','2011-09-19 03:59:08'),(165,7,'LOGIN','2011-09-19 04:11:15'),(166,7,'LOGOUT','2011-09-19 04:13:05'),(167,1,'LOGIN','2011-09-22 01:29:02'),(168,1,'LOGIN','2011-09-23 00:28:57'),(169,7,'LOGIN','2011-09-25 19:48:24'),(170,7,'LOGIN','2011-09-27 00:15:32'),(171,7,'LOGIN','2011-09-28 01:25:14'),(172,1,'LOGIN','2011-09-28 06:12:25'),(173,1,'LOGIN','2011-09-28 10:15:05'),(174,1,'LOGIN','2011-09-28 21:36:10'),(175,1,'LOGOUT','2011-09-28 21:41:46'),(176,1,'LOGIN','2011-09-28 22:37:14'),(177,0,'LOGOUT','2011-09-29 02:00:57'),(178,1,'LOGIN','2011-10-14 00:35:56'),(179,1,'LOGIN','2011-10-19 00:43:42'),(180,1,'LOGIN','2011-10-19 01:01:58'),(181,1,'LOGIN','2011-10-19 12:07:01'),(182,2,'LOGIN','2011-10-20 05:00:34'),(183,1,'LOGIN','2011-10-20 11:47:14'),(184,1,'LOGIN','2011-10-21 04:21:16'),(185,1,'LOGIN','2011-10-21 22:56:13'),(186,1,'LOGIN','2011-10-22 05:01:46'),(187,1,'LOGIN','2011-10-22 07:25:24'),(188,1,'LOGIN','2011-10-23 00:32:32'),(189,1,'LOGIN','2011-10-23 10:12:59'),(190,1,'LOGIN','2011-10-23 13:17:08'),(191,1,'LOGIN','2011-10-24 00:23:18'),(192,1,'LOGIN','2011-10-25 08:01:20'),(193,1,'LOGIN','2011-10-26 13:04:06'),(194,1,'LOGOUT','2011-10-26 15:46:38'),(195,7,'LOGIN','2011-10-26 15:47:04'),(196,7,'LOGIN','2011-10-26 20:24:40'),(197,7,'LOGOUT','2011-10-26 23:57:56'),(198,7,'LOGIN','2011-10-26 23:58:12'),(199,0,'LOGOUT','2011-10-27 00:22:45'),(200,7,'LOGIN','2011-10-27 00:22:54'),(201,7,'LOGOUT','2011-10-27 00:23:08'),(202,2,'LOGIN','2011-10-27 00:23:17'),(203,2,'LOGOUT','2011-10-27 00:33:31'),(204,1,'LOGIN','2011-10-27 00:33:39'),(205,1,'LOGOUT','2011-10-27 00:47:43'),(206,1,'LOGIN','2011-10-27 00:47:49'),(207,1,'LOGOUT','2011-10-27 02:56:59'),(208,7,'LOGIN','2011-10-27 02:57:08'),(209,1,'LOGIN','2011-10-27 11:59:33'),(210,1,'LOGOUT','2011-10-27 12:00:09'),(211,7,'LOGIN','2011-10-27 12:00:23'),(212,7,'LOGOUT','2011-10-27 12:00:42'),(213,2,'LOGIN','2011-10-27 12:00:53'),(214,2,'LOGOUT','2011-10-27 12:01:02'),(215,1,'LOGIN','2011-10-27 12:01:10'),(216,1,'LOGOUT','2011-10-27 12:02:41'),(217,2,'LOGIN','2011-10-27 12:03:04'),(218,2,'LOGOUT','2011-10-27 12:07:44'),(219,7,'LOGIN','2011-10-27 12:08:01'),(220,2,'LOGIN','2011-10-27 13:59:54'),(221,2,'LOGOUT','2011-10-27 14:09:19'),(222,1,'LOGIN','2011-10-27 14:09:25'),(223,1,'LOGOUT','2011-10-27 14:15:18'),(224,2,'LOGIN','2011-10-27 14:15:28'),(225,2,'LOGOUT','2011-10-27 14:25:15'),(226,2,'LOGIN','2011-10-27 21:49:29'),(227,2,'LOGOUT','2011-10-28 01:09:11'),(228,5,'LOGIN','2011-10-28 01:10:44'),(229,5,'LOGOUT','2011-10-28 01:10:57'),(230,1,'LOGIN','2011-10-28 01:11:07'),(231,1,'LOGOUT','2011-10-28 01:14:27'),(232,5,'LOGIN','2011-10-28 01:14:36'),(233,5,'LOGOUT','2011-10-28 01:15:39'),(234,1,'LOGIN','2011-10-28 01:15:53'),(235,1,'LOGOUT','2011-10-28 01:17:59'),(236,5,'LOGIN','2011-10-28 01:18:08'),(237,5,'LOGOUT','2011-10-28 01:18:50'),(238,2,'LOGIN','2011-10-28 01:19:01'),(239,2,'LOGOUT','2011-10-28 01:19:15'),(240,1,'LOGIN','2011-10-28 01:19:26'),(241,1,'LOGOUT','2011-10-28 01:19:39'),(242,1,'LOGIN','2011-10-28 01:20:59'),(243,1,'LOGOUT','2011-10-28 01:21:15'),(244,2,'LOGIN','2011-10-28 01:21:43'),(245,2,'LOGIN','2011-10-28 08:21:29'),(246,2,'LOGOUT','2011-10-28 10:12:16'),(247,1,'LOGIN','2011-10-28 10:12:24'),(248,1,'LOGOUT','2011-10-28 10:17:10'),(249,7,'LOGIN','2011-10-28 10:17:19'),(250,7,'LOGOUT','2011-10-28 10:27:24'),(251,2,'LOGIN','2011-10-28 10:27:51'),(252,2,'LOGOUT','2011-10-28 10:28:27'),(253,8,'LOGIN','2011-10-28 10:28:36'),(254,8,'LOGOUT','2011-10-28 10:30:30'),(255,7,'LOGIN','2011-10-28 10:31:57'),(256,7,'LOGOUT','2011-10-28 10:37:53'),(257,2,'LOGIN','2011-10-28 10:38:08'),(258,2,'LOGOUT','2011-10-28 10:41:46'),(259,1,'LOGIN','2011-10-28 10:41:55'),(260,1,'LOGOUT','2011-10-28 10:42:15'),(261,7,'LOGIN','2011-10-28 10:42:28'),(262,7,'LOGIN','2011-10-28 11:07:32'),(263,7,'LOGIN','2011-10-28 13:37:12'),(264,7,'LOGIN','2011-10-28 16:12:15'),(265,7,'LOGOUT','2011-10-28 18:11:42'),(266,7,'LOGIN','2011-10-28 18:12:41'),(267,7,'LOGIN','2011-10-28 18:15:54'),(268,7,'LOGOUT','2011-10-28 18:16:35'),(269,1,'LOGIN','2011-10-28 18:16:43'),(270,7,'LOGIN','2011-10-28 18:22:02'),(271,7,'LOGOUT','2011-10-28 18:22:13'),(272,1,'LOGIN','2011-10-28 18:23:00'),(273,7,'LOGIN','2011-10-28 19:15:19'),(274,7,'LOGOUT','2011-10-28 19:16:10'),(275,2,'LOGIN','2011-10-28 19:16:23'),(276,2,'LOGOUT','2011-10-28 19:17:08'),(277,7,'LOGIN','2011-10-28 19:38:00'),(278,7,'LOGOUT','2011-10-28 20:13:28'),(279,7,'LOGIN','2011-10-28 20:13:41'),(280,7,'LOGOUT','2011-10-28 20:30:35'),(281,2,'LOGIN','2011-10-28 20:30:44'),(282,2,'LOGOUT','2011-10-28 20:38:53'),(283,3,'LOGIN','2011-10-28 20:39:03'),(284,3,'LOGOUT','2011-10-28 20:40:59'),(285,1,'LOGIN','2011-10-28 20:41:14'),(286,1,'LOGOUT','2011-10-28 20:41:45'),(287,3,'LOGIN','2011-10-28 20:41:54'),(288,3,'LOGOUT','2011-10-28 20:42:35'),(289,2,'LOGIN','2011-10-28 20:43:32'),(290,2,'LOGOUT','2011-10-28 21:27:13'),(291,3,'LOGIN','2011-10-28 21:27:22'),(292,3,'LOGOUT','2011-10-28 22:05:23'),(293,1,'LOGIN','2011-10-28 22:05:51'),(294,2,'LOGIN','2011-10-29 20:08:24'),(295,2,'LOGOUT','2011-10-29 20:10:50'),(296,2,'LOGIN','2011-10-29 20:17:00'),(297,2,'LOGOUT','2011-10-29 20:18:41'),(298,7,'LOGIN','2011-11-02 14:31:59'),(299,7,'LOGOUT','2011-11-02 14:33:23'),(300,1,'LOGIN','2011-11-02 18:59:27'),(301,2,'LOGIN','2011-11-03 09:21:01'),(302,2,'LOGIN','2011-11-03 10:54:24'),(303,2,'LOGOUT','2011-11-03 10:54:37'),(304,8,'LOGIN','2011-11-03 10:54:49'),(305,2,'LOGIN','2011-11-03 19:39:53'),(306,2,'LOGOUT','2011-11-03 19:41:22'),(307,7,'LOGIN','2011-11-03 19:41:40'),(308,7,'LOGOUT','2011-11-03 19:42:35'),(309,1,'LOGIN','2011-11-03 19:42:48'),(310,8,'LOGIN','2011-11-03 22:10:32'),(311,1,'LOGIN','2011-11-11 14:24:38'),(312,1,'LOGIN','2011-11-13 20:45:41'),(313,1,'LOGIN','2011-11-18 15:15:36'),(314,1,'LOGIN','2011-11-18 17:56:31'),(315,8,'LOGIN','2011-11-18 19:44:59'),(316,1,'LOGIN','2011-11-19 10:25:11'),(317,1,'LOGIN','2011-11-21 14:07:52'),(318,8,'LOGIN','2011-11-21 14:47:21'),(319,1,'LOGIN','2011-11-21 15:28:57'),(320,1,'LOGOUT','2011-11-21 15:56:50'),(321,8,'LOGIN','2011-11-23 00:25:35'),(322,8,'LOGIN','2011-11-23 17:10:54'),(323,1,'LOGIN','2011-11-23 19:20:53'),(324,1,'LOGIN','2011-11-24 09:48:41'),(325,1,'LOGOUT','2011-11-24 10:27:55'),(326,1,'LOGIN','2011-11-24 10:28:07'),(327,1,'LOGOUT','2011-11-24 10:33:40'),(328,2,'LOGIN','2011-11-24 10:33:56'),(329,2,'LOGOUT','2011-11-24 10:34:27'),(330,6,'LOGIN','2011-11-24 10:34:39'),(331,6,'LOGOUT','2011-11-24 10:34:49'),(332,1,'LOGIN','2011-11-24 10:35:01'),(333,1,'LOGOUT','2011-11-24 10:35:34'),(334,6,'LOGIN','2011-11-24 10:35:46'),(335,6,'LOGOUT','2011-11-24 10:36:06'),(336,8,'LOGIN','2011-11-24 10:36:15'),(337,8,'LOGOUT','2011-11-24 10:36:42'),(338,1,'LOGIN','2011-11-24 10:36:51'),(339,1,'LOGOUT','2011-11-24 12:44:57'),(340,2,'LOGIN','2011-11-24 12:45:12'),(341,2,'LOGOUT','2011-11-24 12:47:14'),(342,1,'LOGIN','2011-11-24 12:47:26'),(343,1,'LOGOUT','2011-11-24 13:58:41'),(344,3,'LOGIN','2011-11-24 13:58:52'),(345,3,'LOGOUT','2011-11-24 14:01:08'),(346,1,'LOGIN','2011-11-24 14:01:36'),(347,1,'LOGOUT','2011-11-24 14:04:03'),(348,6,'LOGIN','2011-11-24 14:04:15'),(349,6,'LOGOUT','2011-11-24 14:07:07'),(350,5,'LOGIN','2011-11-24 14:08:12'),(351,5,'LOGOUT','2011-11-24 14:09:43'),(352,3,'LOGIN','2011-11-24 14:09:57'),(353,3,'LOGOUT','2011-11-24 14:10:49'),(354,1,'LOGIN','2011-11-24 14:11:02'),(355,1,'LOGIN','2011-11-24 19:57:52'),(356,1,'LOGOUT','2011-11-24 20:01:34'),(357,3,'LOGIN','2011-11-24 20:01:51'),(358,8,'LOGIN','2011-11-24 20:26:27'),(359,8,'LOGOUT','2011-11-24 22:20:50'),(360,7,'LOGIN','2011-11-24 22:20:58'),(361,3,'LOGIN','2011-11-25 11:04:44'),(362,3,'LOGOUT','2011-11-25 11:10:04'),(363,1,'LOGIN','2011-11-25 11:10:11'),(364,1,'LOGOUT','2011-11-25 11:11:05'),(365,1,'LOGIN','2011-11-25 11:11:21'),(366,1,'LOGOUT','2011-11-25 11:23:36'),(367,3,'LOGIN','2011-11-25 11:23:48'),(368,3,'LOGOUT','2011-11-25 11:24:30'),(369,1,'LOGIN','2011-11-25 11:24:45'),(370,1,'LOGOUT','2011-11-25 11:25:18'),(371,3,'LOGIN','2011-11-25 11:25:29'),(372,3,'LOGOUT','2011-11-25 11:53:19'),(373,1,'LOGIN','2011-11-25 11:57:02'),(374,1,'LOGOUT','2011-11-25 12:04:04'),(375,3,'LOGIN','2011-11-25 12:04:12'),(376,3,'LOGOUT','2011-11-25 14:20:30'),(377,1,'LOGIN','2011-11-25 14:20:38'),(378,1,'LOGOUT','2011-11-25 15:17:23'),(379,3,'LOGIN','2011-11-25 15:17:41'),(380,3,'LOGOUT','2011-11-25 15:40:36'),(381,1,'LOGIN','2011-11-25 15:40:45'),(382,1,'LOGOUT','2011-11-25 15:41:28'),(383,3,'LOGIN','2011-11-25 15:41:38'),(384,3,'LOGOUT','2011-11-25 16:07:33'),(385,1,'LOGIN','2011-11-25 16:07:51'),(386,1,'LOGOUT','2011-11-25 16:08:15'),(387,3,'LOGIN','2011-11-25 16:08:42'),(388,3,'LOGOUT','2011-11-25 16:10:43'),(389,1,'LOGIN','2011-11-25 16:13:36'),(390,1,'LOGOUT','2011-11-25 16:13:51'),(391,3,'LOGIN','2011-11-25 16:14:01'),(392,7,'LOGIN','2011-11-25 16:36:45'),(393,1,'LOGIN','2011-11-25 18:37:16'),(394,1,'LOGOUT','2011-11-25 18:40:58'),(395,3,'LOGIN','2011-11-25 18:41:55'),(396,3,'LOGOUT','2011-11-25 18:51:23'),(397,1,'LOGIN','2011-11-25 18:52:51'),(398,1,'LOGIN','2011-11-25 21:40:03'),(399,1,'LOGIN','2011-11-25 21:45:00'),(400,1,'LOGIN','2011-11-25 21:46:39'),(401,1,'LOGIN','2011-11-25 21:49:13'),(402,1,'LOGIN','2011-11-25 21:56:04'),(403,1,'LOGIN','2011-11-25 21:56:39'),(404,1,'LOGIN','2011-11-25 21:58:23'),(405,1,'LOGIN','2011-11-25 22:04:50'),(406,1,'LOGIN','2011-11-25 22:05:26'),(407,1,'LOGIN','2011-11-25 22:18:22'),(408,7,'LOGIN','2011-11-25 22:22:07'),(409,1,'LOGIN','2011-11-25 22:25:32'),(410,1,'LOGIN','2011-11-25 22:29:16'),(411,1,'LOGIN','2011-11-25 22:33:55'),(412,1,'LOGIN','2011-11-25 22:36:47'),(413,1,'LOGIN','2011-11-25 22:41:44'),(414,1,'LOGIN','2011-11-25 22:47:52'),(415,1,'LOGIN','2011-11-25 23:01:26'),(416,1,'LOGOUT','2011-11-25 23:54:59'),(417,8,'LOGIN','2011-11-25 23:55:08'),(418,8,'LOGOUT','2011-11-26 00:10:42'),(419,1,'LOGIN','2011-11-26 00:10:49'),(420,1,'LOGOUT','2011-11-26 00:12:56'),(421,8,'LOGIN','2011-11-26 00:39:20'),(422,8,'LOGOUT','2011-11-26 00:40:10'),(423,8,'LOGIN','2011-11-26 00:40:19'),(424,8,'LOGOUT','2011-11-26 01:03:12'),(425,8,'LOGIN','2011-11-26 01:03:51'),(426,1,'LOGIN','2011-11-26 10:12:41'),(427,2,'LOGIN','2011-11-26 10:15:01'),(428,1,'LOGOUT','2011-11-26 11:30:16'),(429,3,'LOGIN','2011-11-26 11:30:25'),(430,3,'LOGOUT','2011-11-26 11:33:23'),(431,5,'LOGIN','2011-11-26 11:33:34'),(432,5,'LOGOUT','2011-11-26 11:35:56'),(433,2,'LOGIN','2011-11-26 11:36:08'),(434,2,'LOGOUT','2011-11-26 11:36:41'),(435,5,'LOGIN','2011-11-26 11:36:55'),(436,5,'LOGOUT','2011-11-26 11:37:31'),(437,1,'LOGIN','2011-11-26 11:37:41'),(438,1,'LOGOUT','2011-11-26 11:38:05'),(439,6,'LOGIN','2011-11-26 11:38:18'),(440,6,'LOGOUT','2011-11-26 11:39:38'),(441,5,'LOGIN','2011-11-26 11:39:50'),(442,5,'LOGOUT','2011-11-26 11:40:44'),(443,1,'LOGIN','2011-11-26 11:40:53'),(444,1,'LOGIN','2011-11-26 16:25:37'),(445,1,'LOGOUT','2011-11-26 16:30:27'),(446,8,'LOGIN','2011-11-26 16:31:09'),(447,8,'LOGOUT','2011-11-26 16:32:01'),(448,1,'LOGIN','2011-11-26 16:32:14'),(449,1,'LOGIN','2011-11-26 20:24:15'),(450,1,'LOGIN','2011-11-26 22:52:34'),(451,1,'LOGIN','2011-11-27 23:31:57'),(452,1,'LOGIN','2011-11-28 09:56:36'),(453,8,'LOGIN','2011-11-28 13:17:01'),(454,1,'LOGIN','2011-11-28 13:58:58'),(455,1,'LOGIN','2011-11-28 14:02:59'),(456,1,'LOGOUT','2011-11-28 14:04:27'),(457,1,'LOGIN','2011-11-28 14:05:18');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_memo` */

insert  into `tbl_memo`(`id`,`employee_id`,`date_requested`,`date_effective`,`reason`,`requested_by`,`modified_by`,`DCREATED`,`TCREATED`,`DMODIFIED`,`TMODIFIED`) values (1,1,'2011-11-26','2011-11-28','No further absences',1,1,'2011-11-26','12:38:04','2011-11-26','14:16:11');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_notification` */

insert  into `tbl_notification`(`id`,`employee_id`,`message`,`date_requested`,`requested_by`,`modified_by`,`DCREATED`,`TCREATED`,`DMODIFIED`,`TMODIFIED`) values (1,0,'Merry Christmas','2011-11-26',1,1,'2011-11-26','14:09:52','2011-11-26','14:27:40'),(4,0,'Happy Holidays!','2011-11-26',8,NULL,'2011-11-26','16:31:47','2011-11-26','16:31:47'),(5,0,'test','2011-11-28',1,NULL,'2011-11-28','09:58:06','2011-11-28','09:58:06');

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ot_application` */

insert  into `tbl_ot_application`(`id`,`employee_id`,`date_from`,`date_to`,`reason`,`date_requested`,`no_hours`) values (1,7,'2011-10-28 17:00:00','2011-10-28 18:00:00','Reason','2011-10-28','1.00'),(2,3,'2011-10-28 17:00:00','2011-10-28 20:00:00','OT','2011-10-28','3.00'),(3,3,'2011-10-27 17:00:00','2011-10-27 18:00:00','Test','2011-10-28','1.00'),(4,3,'2011-11-23 17:00:00','2011-11-23 18:00:00','OT','2011-11-24','1.00');

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
  `DCREATED` date default NULL,
  `TCREATED` time default NULL,
  `DMODIFIED` date default NULL,
  `TMODIFIED` time default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_suspension` */

insert  into `tbl_suspension`(`id`,`employee_id`,`date_from`,`date_to`,`portion`,`no_days`,`date_requested`,`requested_by`,`modified_by`,`reason`,`DCREATED`,`TCREATED`,`DMODIFIED`,`TMODIFIED`) values (1,2,'2011-11-26','2011-11-26','WHOLE DAY',1,'2011-11-26',1,1,'Suspended ka!','2011-11-26','20:38:00','2011-11-26','20:43:34'),(2,3,'2011-11-28','2011-11-28','WHOLE DAY',1,'2011-11-26',1,1,'punishment','2011-11-26','20:46:32','2011-11-26','20:47:32');

/*Table structure for table `tbl_training` */

DROP TABLE IF EXISTS `tbl_training`;

CREATE TABLE `tbl_training` (
  `id` bigint(20) NOT NULL auto_increment,
  `employee_id` bigint(20) NOT NULL,
  `training_type_id` bigint(20) default NULL,
  `date_start` date default NULL,
  `date_end` date default NULL,
  `start_time` time default NULL,
  `end_time` time default NULL,
  `supplier_id` bigint(20) default NULL,
  `location` varchar(250) default NULL,
  `title` varchar(128) default NULL,
  `details` varchar(250) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_training` */

insert  into `tbl_training`(`id`,`employee_id`,`training_type_id`,`date_start`,`date_end`,`start_time`,`end_time`,`supplier_id`,`location`,`title`,`details`) values (2,6,2,'2011-05-12','2011-05-08','03:15:00','00:45:00',5,'14th Floor of Antel Global Corporate Center\nJulia Vargas Avenue, Ortigas Centre\nPasig City, Philippines','technical training','blahblah'),(3,7,2,'2011-11-23','2011-11-26','04:00:00','07:30:00',4,'23/F The Orient Square\nF. Ortigas Jr. Road, Ortigas Center\nPasig City, Philippines','Training 101','test');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
