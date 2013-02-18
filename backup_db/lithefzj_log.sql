/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.0.95-community : Database - lithefzj_log
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`lithefzj_log` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `lithefzj_log`;

/*Table structure for table `GRADESLOG` */

DROP TABLE IF EXISTS `GRADESLOG`;

CREATE TABLE `GRADESLOG` (
  `id` int(11) NOT NULL auto_increment,
  `SCHEDULEIDNO` char(5) default NULL,
  `STUDIDNO` char(10) default NULL,
  `NAME` char(128) default NULL,
  `SUBJCODE` char(50) default NULL,
  `PRELIM` char(128) default '0',
  `MIDTERM` char(128) default '0',
  `FINAL` char(128) default '0',
  `AVERAGE` float default '0',
  `REMARKS` char(64) default NULL,
  `REMAIDNO` char(5) default NULL,
  `DMODIFIED` datetime default NULL,
  `modified_by` char(64) default NULL,
  `ip_address` char(64) default NULL,
  `restore` tinyint(1) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `GRADESLOG` */

insert  into `GRADESLOG`(`id`,`SCHEDULEIDNO`,`STUDIDNO`,`NAME`,`SUBJCODE`,`PRELIM`,`MIDTERM`,`FINAL`,`AVERAGE`,`REMARKS`,`REMAIDNO`,`DMODIFIED`,`modified_by`,`ip_address`,`restore`) values (1,'2795','3F7N010259','AALA, APPLE JOY VIZARRA','Acctg 2','L45sI54kRE4Jor22bW+sfoVm2vGpwgyTJ/j0gugf07Y=','ehepd5gSxHwQ8G1cC1VyQmSBwo5o/ev8AauNMAkCeHk=','ozKpMX6hKLNvGRYi5n1htqoNF1ykl82EbeHVbQrXc+U=',85.33,'PASSED','0','2012-04-09 08:19:50','darryl.anaud','0.0.0.0',0),(2,'11691','W15P011072','BACANI, JOLINA CABUTE','Acctg 2','0','0','0',0,NULL,'0','2012-08-16 00:01:35','darryl.anaud','175.156.193.19',0);

/*Table structure for table `USERLOG` */

DROP TABLE IF EXISTS `USERLOG`;

CREATE TABLE `USERLOG` (
  `id` int(11) NOT NULL auto_increment,
  `username` char(50) default NULL,
  `system_name` char(20) default NULL,
  `login_time` datetime default NULL,
  `logout_time` datetime default NULL,
  `session_id` char(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

/*Data for the table `USERLOG` */

insert  into `USERLOG`(`id`,`username`,`system_name`,`login_time`,`logout_time`,`session_id`) values (1,'darryl.anaud','SWP','2012-11-14 23:32:14','2012-11-14 23:35:08','6319d5ae0c628bbac321c3f954625005'),(2,'darryl.anaud','SWP','2012-11-14 23:35:15','2012-11-14 23:36:51','e8951833318505e0e2086ad8d6672788'),(3,'darryl.anaud','SWP','2012-11-14 23:36:59','2012-11-14 23:38:23','63bb0db0b76d2fc43323f7da460cd677'),(4,'darryl.anaud','SWP','2012-11-14 23:38:52',NULL,'3ba265a704a571feef5722fd18bdef79'),(5,'darryl.anaud','SWP','2012-11-15 00:02:20',NULL,'fc9d6e225432dd9985489be997ccec3a'),(6,'darryl.anaud','SWP','2012-11-15 00:03:03',NULL,'349a29bd7b8bd8be4673f9c739be4957'),(7,'darryl.anaud','SWP','2012-11-15 00:03:13',NULL,'276abcdd5322c7e93f41536df3fc600f'),(8,'darryl.anaud','SWP','2012-11-15 00:03:36',NULL,'4b26ec544c8cba919c132d1a792e6610'),(9,'darryl.anaud','SWP','2012-11-15 00:04:04','2012-11-15 00:04:39','f99b01c62b637017211cf96e8d4189d3'),(10,'darryl.anaud','SWP','2012-11-15 00:04:31','2012-11-15 00:04:39','f99b01c62b637017211cf96e8d4189d3'),(11,'darryl.anaud','SWP','2012-11-15 00:05:05',NULL,'e72b69f30c09b183d28e39dbadfcff1a'),(12,'darryl.anaud','SWP','2012-11-15 00:06:12',NULL,'8fa85b4f4aa7154fa2621a92357eb255'),(13,'darryl.anaud','SWP','2012-11-15 00:16:42',NULL,'b6196c5f1f546fc66285715e28993e6c'),(14,'darryl.anaud','SWP','2012-11-15 00:17:06',NULL,'78509f2385d639e4357a8151e56ec5ad'),(15,'darryl.anaud','SWP','2012-11-15 00:24:01',NULL,'221275ff07dff4463c70527f4bee9eb0'),(16,'apple.aala','SWP','2012-11-19 14:23:24',NULL,'bee54acc697867ef720aadf18f95796f'),(17,'richard.base','SWP','2012-11-19 14:32:14',NULL,'4f8bfb4117af055b76498a6b67c8d648'),(18,'richard.base','SWP','2012-11-20 21:50:52',NULL,'3d33378a5d9883a7e68bc586928c5448'),(19,'darryl.anaud','SWP','2012-11-21 16:29:21','2012-11-21 16:30:13','3357f9fc133e8d903ab6111518586c21'),(20,'darryl.anaud','SWP','2012-11-21 16:30:22',NULL,'aa0834dead8421308c8e8041d0b5289a'),(21,'darryl.anaud','SWP','2012-11-24 13:25:20',NULL,'6d8a086a905ee291180ae1fc71d5e66e'),(22,'apple.aala','SWP','2012-11-24 16:43:12',NULL,'d8db9ae3a001ec60599ca8be71c1efc0'),(23,'richard.base','SWP','2012-11-29 20:42:11',NULL,'c96822b9d9551912614013ea3ea8306a'),(24,'richard.base','SWP','2012-11-29 20:42:24',NULL,'c96822b9d9551912614013ea3ea8306a'),(25,'apple.aala','SWP','2012-11-29 20:45:06',NULL,'5e48c198858311deff64e06154e0408b'),(26,'darryl.anaud','SWP','2012-11-29 21:02:13','2012-11-29 21:04:06','4ccceed1e5407f5141a568b8c6482696'),(27,'apple.aala','SWP','2012-11-29 21:04:13',NULL,'ecb08b713a93cda587148882a74fba0b'),(28,'darryl.anaud','SWP','2012-12-03 00:08:59',NULL,'f5178459b6c07fd4f4baf190c676245a'),(29,'darryl.anaud','SWP','2012-12-03 00:09:08',NULL,'f5178459b6c07fd4f4baf190c676245a'),(30,'apple.aala','SWP','2012-12-06 14:32:51','2012-12-06 14:35:34','f97002457d460ab5a53d3e73fee989e7'),(31,'richard.base','SWP','2012-12-10 23:21:18',NULL,'b7fa3aebd6e82a3db4c86d9948222707'),(32,'darryl.anaud','SWP','2012-12-18 21:56:17',NULL,'c9b2f69491b930524154c9e935854a6b'),(33,'darryl.anaud','SWP','2012-12-18 22:04:01',NULL,'0ebaad4661a7b11371154d7103282f9d'),(34,'darryl.anaud','SWP','2013-01-04 12:37:27',NULL,'d35a5505be698ff648977c9e3d95b163'),(35,'darryl.anaud','SWP','2013-01-04 12:39:43',NULL,'69389a9403fa12d394c0761e5fe2d8a6'),(36,'darryl.anaud','SWP','2013-01-06 12:28:59',NULL,'7541d46b5590eab25c38b5d6bc4ea0a8'),(37,'darryl.anaud','SWP','2013-01-07 02:36:50',NULL,'a87a982220b57f72fe5a5c1b0c9b9a82'),(38,'darryl.anaud','SWP','2013-01-20 21:43:21',NULL,'c2d49fa4452d1e7269121405ed64f97e'),(39,'darryl.anaud','SWP','2013-02-02 10:39:40','2013-02-02 10:40:40','b7f4c6b5f484197218faefc9a7eb1dcd'),(40,'darryl.anaud','SWP','2013-02-07 16:22:04','2013-02-07 16:23:45','0d6cc82ebefa771d2f53f0e212181182'),(41,'richard.base','SWP','2013-02-07 16:23:52','2013-02-07 16:23:55','5076117f9ead6461cd6fecc797dd1f1c'),(42,'apple.aala','SWP','2013-02-07 16:24:07',NULL,'070a22d8c839fe8e92fb07969de85c39'),(43,'richard.base','SWP','2013-02-08 08:55:11',NULL,'1bbfb3cc0a0aa6c5b214e388664a4724'),(44,'apple.aala','SWP','2013-02-08 08:59:46','2013-02-08 09:01:53','f57bee72ab0995de3f732fa9d8b63c1f'),(45,'apple.aala','SWP','2013-02-08 09:02:54',NULL,'a539424e77525e06abe5d562076281ac'),(46,'apple.aala','SWP','2013-02-08 20:50:28','2013-02-08 20:53:33','d52a1bfadbfee7abb33b978a3d4a1627'),(47,'apple.aala','SWP','2013-02-11 10:40:53',NULL,'bdd90e1a38d468a61b27d23fb49575d0');

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL auto_increment,
  `username` char(64) default NULL,
  `password` char(64) default NULL,
  `last_login_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `email` char(64) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`id`,`username`,`password`,`last_login_time`,`email`) values (1,'darryl.anaud','edfd5576c4ebaae7aca1c222d52fa8b4','2012-04-09 13:43:40','darrylanaud@gmail.com'),(2,'richard.base','749db0aaf817610936d88a0e8b12a0da','2012-04-09 14:08:24',''),(3,'maribeth.rivas','dfe763b2460a8b989a92685db027616b','2012-04-09 14:08:43',''),(4,'niz.nolasco','491d437b14193fb6010493da1dc89b41','2012-04-09 14:09:08','');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
