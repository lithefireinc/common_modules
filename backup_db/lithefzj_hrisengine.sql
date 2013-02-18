/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.0.95-community : Database - lithefzj_hrisengine
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`lithefzj_hrisengine` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `lithefzj_hrisengine`;

/*Table structure for table `am` */

DROP TABLE IF EXISTS `am`;

CREATE TABLE `am` (
  `amidno` int(11) NOT NULL auto_increment,
  `amusrid` varchar(128) NOT NULL,
  `ampwd` varchar(16) NOT NULL,
  `amtype` tinyint(4) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `am_name` varchar(128) default NULL,
  `dmodified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`amidno`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `am` */

insert  into `am`(`amidno`,`amusrid`,`ampwd`,`amtype`,`active`,`am_name`,`dmodified`) values (4,'joemar','password',1,1,'Joemar','2010-04-22 14:57:21'),(2,'ams','password',1,1,'AMS','2010-04-22 14:57:23'),(3,'jay','password',2,1,'JAY','2010-04-22 14:57:26'),(1,'bidder','password',3,1,'ASSIGNER','2010-05-07 09:16:34');

/*Table structure for table `clientinfosheet` */

DROP TABLE IF EXISTS `clientinfosheet`;

CREATE TABLE `clientinfosheet` (
  `clie_idno` int(11) NOT NULL auto_increment,
  `comp_idno` int(11) NOT NULL,
  `fullname` varchar(256) collate latin1_general_ci NOT NULL,
  `dept_idno` int(11) NOT NULL,
  `phone` varchar(32) collate latin1_general_ci default NULL,
  `designation` varchar(256) collate latin1_general_ci NOT NULL,
  `email` varchar(256) collate latin1_general_ci default NULL,
  `jobl_idno` int(11) NOT NULL,
  `ppwr_idno` int(11) NOT NULL,
  `ctyp_idno` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `dmodified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`clie_idno`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `clientinfosheet` */

insert  into `clientinfosheet`(`clie_idno`,`comp_idno`,`fullname`,`dept_idno`,`phone`,`designation`,`email`,`jobl_idno`,`ppwr_idno`,`ctyp_idno`,`active`,`dmodified`) values (5,1242,'Joemar Lamata',1,'2334','designation','email@yahoo.com',1,3,1,1,'2010-03-18 16:30:14'),(6,1242,'Michael Jackson',2,'2356585','Class A list','jason@yahoo.com',1,1,1,1,'2010-03-25 01:19:21'),(7,1655,'Noname DelaCruz',2,'1','1','1',1,1,1,1,'2010-05-07 10:54:12'),(8,1577,'NoName Person',1,'1','1','1',1,1,1,1,'2010-05-07 13:21:03'),(9,1579,'NoName Person',1,'1','1','1',1,1,1,1,'2010-05-07 13:25:29'),(10,1579,'Daniel C. Tolentino',2,'9318101 Ext 217','Administrative Officer IV','bacsec@dswd.gov.ph',4,4,3,1,'2010-05-07 13:28:35'),(11,1442,'TETS',1,'TEST','1','1',1,1,1,1,'2010-08-12 10:52:18'),(12,1386,'Juan dela Cruz',2,'9138888','Consultant','jdc@yahoo.com',4,3,4,1,'2010-08-24 11:52:22');

/*Table structure for table `clients` */

DROP TABLE IF EXISTS `clients`;

CREATE TABLE `clients` (
  `clieidno` int(11) NOT NULL auto_increment,
  `clientname` varchar(256) collate latin1_general_ci NOT NULL default '0',
  `torg_idno` int(11) default NULL,
  `establish_date` date default NULL,
  `ownr_idno` int(11) default NULL,
  `bus_nature` varchar(256) collate latin1_general_ci default NULL,
  `bus_address01` varchar(256) collate latin1_general_ci default NULL,
  `bus_address02` varchar(256) collate latin1_general_ci default NULL,
  `bus_address03` varchar(256) collate latin1_general_ci default NULL,
  `phone` varchar(32) collate latin1_general_ci default NULL,
  `faxno` varchar(32) collate latin1_general_ci default NULL,
  `branchesno` int(11) default NULL,
  `employeesno` int(11) default NULL,
  `email` varchar(256) collate latin1_general_ci default NULL,
  `website` varchar(256) collate latin1_general_ci default NULL,
  `abbr` varchar(256) collate latin1_general_ci default NULL,
  `cltyidno` int(11) default NULL,
  `ctypeidno` int(11) NOT NULL,
  `map` varchar(256) collate latin1_general_ci default NULL,
  `logo` varchar(128) collate latin1_general_ci default NULL,
  `active` tinyint(4) default NULL,
  `dmodified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`clieidno`)
) ENGINE=MyISAM AUTO_INCREMENT=1458 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `clients` */

insert  into `clients`(`clieidno`,`clientname`,`torg_idno`,`establish_date`,`ownr_idno`,`bus_nature`,`bus_address01`,`bus_address02`,`bus_address03`,`phone`,`faxno`,`branchesno`,`employeesno`,`email`,`website`,`abbr`,`cltyidno`,`ctypeidno`,`map`,`logo`,`active`,`dmodified`) values (1,'Office of the President (OP)',0,'0000-00-00',1,'1','1','1','11','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-08-19 17:54:41'),(1052,'Board of Liquidators (BOL)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1053,'Commission on Filipino Overseas (CFO)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1054,'Commission on Higher Education (CHED)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1055,'Games and Amusements Board (GAB)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1056,'Housing and Land Regulatory Board (HLURB)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1057,'Information Technology and E-Commerce Council (ITECC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1058,'National Commission for Culture and the Arts (NCCA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1059,'National Commission on the Role of Filipino Women (NCRFW)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1060,'Philippine Racing Commission (PHILRACOM)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1061,'Presidential Commission for the Urban Poor (PCUP)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1062,'Presidential Commission on Educational Reform (PCER)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1063,'Commission on the Filipino Language (CFL)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-08-19 17:24:59'),(1064,'Philippine Sports Commission (PSC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1065,'Cultural Center of the Philippines (CCP) (GOCC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',0,'2010-08-19 17:25:18'),(1066,'National Historical Institute (NHI)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1067,'Dangerous Drug Board (DDB)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-08-19 17:26:48'),(1068,'National Anti-Poverty Commission (NAPC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1069,'National Solid Waste Management Commission (NSWMC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1070,'National Water Resources Board (NWRB)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1071,'National Youth Commission (NYC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1072,'Optical Media Board (OMB)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1073,'Presidential Anti-Graft Commission (PAGC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1074,'Movie & Television Review & Classification Board (MTRCB)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1075,'Office of the Presidential Adviser on the Peace Process (OPAPP)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1076,'National Computer Center',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1077,'Housing and Urban Development Coordinating Council (HUDCC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1078,'National Commission on Indigenous Peoples (NCIP)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1079,'Professional Regulation Commission (PRC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1080,'National Library of the Philippines (NLP)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1081,'National Statistics Office (NSO)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1082,'Tariff Commission',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1083,'Energy Regulatory Commission (ERC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1084,'Metropolitan Manila Development Authority (MMDA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1085,'National Economic Development Authority (NEDA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1086,'Office of the Press Secretary (OPS)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1087,'Philippine Center on Transnational Crime (PCTC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1088,'Presidential Management Staff (PMS)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1089,'Presidential Legislative Liaison Office (PLLO)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1090,'Commission on Population (POPCOM)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1091,'National Broadcasting Network (NBN)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1092,'National Printing Office (NPO)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1093,'News and Information Bureau (NIB)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1094,'Pambansang Lupon sa Ugnayang Pang-Estadistika (National Statistical Coordination Board) NSCB',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1095,'Philippine Broadcasting Service ? Bureau of Broadcast Services (PBS-BBS)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1096,'Philippine Council for Sustainable Development (PCSD)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1097,'Philippine Council on ASEAN and APEC Cooperation (PCAAC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1098,'Philippine Information Agency (PIA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1099,'Philippine National Volunteer Service Coordinating Agency (PNVSCA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1100,'Philippine News Agency (PNA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1101,'Radio-Television Malaca?ang (RTVM)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1102,'Statistical Research and Training Center (SRTC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1103,'National Telecommunications Commission (NTC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1104,'Philippine Deposit Insurance Corp. (PDIC) (GOCC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',0,'2010-08-19 18:10:27'),(1105,'Technical Education and Skills Development Authority (TESDA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1106,'Commission on Information and Communications Technology (CICT)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1107,'Philippine Postal Corporation (PHILPOST) (GOCC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1108,'Presidential Commission on Good Government (PCGG)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1109,'Office of the Vice President',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1110,'Department of Agriculture (DA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1111,'Agricultural Credit Policy Council (ACPC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1112,'Agricultural Training Institute (ATI)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1113,'Bureau of Agricultural Statistics (BAS)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1114,'Bureau of Fisheries & Aquatic Resources (BFAR)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1115,'Bureau of Postharvest Research and Extension (BPRE)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1116,'Cotton Development Administration (CODA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1117,'Fertilizer and Pesticide Authority (FPA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1118,'Fiber Industry Development Authority (FIDA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1119,'National Agricultural and Fishery Council (NAFC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1120,'National Agricultural and Fishery Council (NAFC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',0,'2010-08-19 17:41:06'),(1121,'National Fisheries Research and Development Institute (NFRDI)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1122,'National Nutrition Council (NNC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1123,'Philippine Carabao Center (PCC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1124,'National Meat Inspection Commission (NMIC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1125,'Bureau of Agricultural Research (BAR)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1126,'Bureau of Animal Industry (BAI)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1127,'Bureau of Plant Industry (BPI)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1128,'Bureau of Soils & Water Management (BSWM)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1129,'Livestock Development Council (LDC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1130,'National Dairy Authority (NDA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1131,'Sugar Regulatory Administration (SRA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1132,'Department of Budget & Management (DBM)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1133,'Department of Education (DepEd)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1134,'Bureau of Elementary Education (BEE)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-08-19 17:12:52'),(1135,'Bureau of Physical Education and School Sports (BPESS) ',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-08-19 17:17:05'),(1136,'Bureau of Secondary Education (BSE)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-08-19 17:10:17'),(1137,'Center for Students and Co-Curricular Affairs (CSCA) ',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-08-19 17:19:19'),(1138,'Educational Development Project Implementing Task Force',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1139,'National Book Development Board (NBDB)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1140,'National Educators Academy of the Philippines',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1141,'National Educational Testing and research Center',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1142,'School Health and Nutrition Center',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1143,'Department of Energy (DOE)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1144,'National Electrification Administration (NEA) (GOCC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',0,'2010-08-19 17:51:14'),(1145,'Energy Regulatory Commission (ERC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',0,'2010-08-19 17:31:40'),(1146,'Philippine National Oil Company (PNOC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1147,'National Power Corporation (NPC) ',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-08-19 17:52:19'),(1148,'National Transmission Corp. (Transco) (GOCC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',0,'2010-08-19 17:53:06'),(1149,'Power Sector Assets and Liabilities Management Corp. (PSALM)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',0,'2010-08-19 18:03:28'),(1150,'Wholesale Electricity Spot Market (WESM)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1151,'Department of Environment and Natural Resources (DENR)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1152,'Ecosystems Research and Development Bureau(ERDB)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1153,'Land Management Bureau (LMB)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1154,'Mines and Geo-Sciences Bureau (MGB)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1155,'National Mapping and Resource Information Authority (NAMRIA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1156,'Protected Areas and wildlife Bureau (PAWB)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1157,'Environmental Management Bureau (EMB)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1158,'Forest Management Bureau',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1159,'Department of Finance (DOF)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1160,'Bureau of Local Government Finance (BLGF)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1161,'Central Board Assessment Appeal (CBAA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1162,'Cooperative Development Authority (CDA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1163,'Fiscal Incentive and Regulatory Board (FIRB)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1164,'National Credit Council  (NCC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1165,'National Tax Research Center (NTRC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1166,'Privatization and Management Office (PMO)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1167,'Securities and Exchange Commission (SEC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1168,'Philippine Export-Import Credit Agency (PHILEXIM)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1169,'Bureau of Internal Revenue (BIR)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1170,'Bureau of Treasury (BTr)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-08-19 17:16:16'),(1171,'Insurance Commission (IC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1172,'Bureau of Customs (BOC) ',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-08-19 17:00:45'),(1173,'Philippine Amusement and Gaming Corporation (PAGCOR) (GOCC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',0,'2010-08-19 17:57:05'),(1174,'Department of Foreign Affairs (DFA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1175,'Office of Undersecretary for International and Economics Relations',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1176,'Office of the Undersecretary for Migrant Worker\'s Affairs',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1177,'Foreign Service Institute (FSI)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1178,'Board of Foreign Service Administration (BFSA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1179,'Board of Foreign Service Examination (BFSE)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1180,'Technical Cooperation Council of the Philippines (TCCP)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1181,'Department of Health (DOH)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1182,'Bureau of Food and Drugs (BFAD)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1183,'National Center for Mental Health (NCMH)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1184,'Research Institute for Tropical Medicine (RITM)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1185,'National Nutrition Council (NNC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',0,'2010-08-19 17:47:16'),(1186,'Philippine National Aids Council',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1187,'Commission on Population ',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',0,'2010-08-19 17:22:06'),(1188,'Philippine Children\'s Medical Center (PCMC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1189,'Philippine Heart Center (PHC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1457,'rivas 3',2,'2010-09-15',2,'fdsf','fdsf','sdfs','fsf','34','23',3,3,'23@yahoo.com','erw','erw',NULL,1,'rdf',NULL,NULL,'2010-09-22 14:17:57'),(1191,'Department of the Interior and Local Government (DILG)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1192,'Bureau of Jail Management and Penology (BJMP)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1193,'Local Government Academy (LGA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1194,'Bureau of Fire Protection (BFP)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-08-19 17:14:08'),(1195,'National Police Commission (NAPOLCOM)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1196,'Philippine National Police (PNP)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1197,'Philippine Public Safety College',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1198,'Department of Justice (DOJ)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1199,'Parole and Probation Administration (PPA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1200,'Bureau of Corrections (BuCor)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-08-19 17:09:24'),(1201,'Commission on the Settlement of Land Problems (COSLAP)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1202,'Office of the Government Corporate Counsel (OGCC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1203,'Office of the Solicitor General (OSG)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1204,'Public Attorney\'s Office (PAO)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1205,'Bureau of Immigration (BI)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-08-19 17:04:20'),(1206,'Land Registration Authority (LRA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1207,'National Bureau of Investigation (NBI)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1208,'Department of Labor and Employment (DOLE)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1209,'Bureau of Labor and Employment Statistics (BLES)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1210,'Bureau of Labor Relations (BLR)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1211,'Bureau of Local Employment (BLE)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1212,'Bureau of Rural Workers (BRW)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1213,'Bureau of Women and Young Workers (BWYW)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1214,'Bureau of Working Conditions (BWC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1215,'Employee\'s Compensation Commission (ECC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1216,'Institute of Labor Studies (ILS)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1217,'National Labor Regulations Commission (NLRC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1218,'National Maritime Polytechnic (NMP)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1219,'National Wages and Productivity Commission (NWPC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1220,'Overseas Workers Welfare Administration (OWWA) (GOCC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',0,'2010-08-19 17:54:57'),(1221,'Philippine Overseas Employment Welfare Administration (POEA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1222,'National Conciliation and Mediation Board (NCMB)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1223,'Occupational Safety and Health Center (OSHC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1224,'Department of National Defense (DND)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1225,'Armed Forces of the Philippines (AFP)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1226,'Philippine Army',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1227,'Philippine Air Force (PAF)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1228,'Philippine Navy',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1229,'Philippine Merchant Marine Academy',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',0,'2010-08-19 18:06:52'),(1230,'Government Arsenal (GA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-08-19 17:34:52'),(1231,'National Disaster Coordinating Council (NDCC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1232,'National Defense College of the Philippines (NDCP)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1233,'Philippine Military Academy (PMA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1234,'Philippine Veterans Affairs Office (PVAO)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1235,'Department of Public Works and Highways (DPWH)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1236,'Bureau of Construction (BOC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1237,'Bureau of Design (BOD)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1238,'Bureau of Equipment (BOE)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1239,'Bureau of Maintenance (BOM)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1240,'Bureau of Research and Standards (BRS)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1241,'Department of Science and Technology (DOST)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1242,'Advanced Science and Technology Institute (ASTI)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',0,'2010-08-11 08:07:27'),(1243,'Food and Nutrition Research Institute (FNRI)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1244,'Forest Products Research and Development Institute (FPRDI)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1245,'Industrial Technology Development Institute (ITDI)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1246,'Metals Industry Research and Development Center (MIRDC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1247,'National Academy of Science and Technology (NAST)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1248,'National Research Council of the Philippines (NRCP)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1249,'Philippine Atmospheric, Geophysical and Astronomical Services Administration (PAGASA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1250,'Philippine Council for Health Research and Development (PCHRD)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1251,'Philippine Council for Industry and Energy Research Development (PCIERD)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1252,'Philippine Institute of Volcanology and Seismology (PHILVOCS)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1253,'Philippine Nuclear Research Institute (PNRI)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1254,'Philippine Science High School (PSHS)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1255,'Philippine Textile Research Institute (PTRI)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1256,'Science Education Institute (SEI)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1257,'Science and Technology Information Institute (STII)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1258,'Technology Application and Promotion Institute (TAPI)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1259,'Philippine Council for Advanced Science and Technology Research and Development (PCASTRD)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1260,'Philippine Council for Agriculture, Forestry and natural Resources Research and Development (PCARRD)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1261,'Philippine Council for Aquatic and Marine Research and Development (PCAMRD)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1262,'Department of Tourism (DOT)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1263,'Intramuros Administration',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1264,'National Parks and Development Committee',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1265,'Philippine Tourism Authority (PHILTOURISM)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1266,'WowPinoy',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1267,'Department of Trade and Industry (DTI)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1268,'Industry and Investment Group (IIG)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1269,'Board of Investment (BOI)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1270,'Bonded Export Marketing Board (BEMB)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1271,'Bureau of Small and Medium Enterprise Development (BSMED)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1272,'Center for International Competitiveness (CIC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1273,'National Development Company (NDC) (GOCC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',0,'2010-08-19 17:49:36'),(1274,'Philippine Economic Zone Authority (PEZA) (GOCC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',0,'2010-08-19 18:09:41'),(1275,'Small Business Guarantee and Finance Corporation (SBGFC) (GOCC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',0,'2010-08-19 18:01:36'),(1276,'International Trade Group (ITG)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1277,'Bureau of Export Trade Promotion (BETP)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1278,'International Coffee Organization Certification Agency (ICO-CA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1279,'Bureau of International Trade Relations (BITR)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1280,'Center for International Trade Exposition & Missions (CITEM)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1281,'Product Development and Design Center of the Philippines (PDDCP)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1282,'Philippine Trade Training Center (PTTC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1283,'Foreign Trade Service Corps (FTSC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1284,'Garments and Textile Board (GTEB)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1285,'Philippine International Trading Corp. (PITC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1286,'Consumer Welfare & Trade Regulation Group (CWTRG)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1287,'Bureau of Domestic Trade (BDT)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1288,'Bureau of Import Services (BIS)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1289,'Bureau of Product Standards (BPS)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1290,'Bureau of Trade Regulation and Consumer Protection (BTRCP)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1291,'Construction Industry Authority of the Philippines (CIAP)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1292,'Philippine Shippers Bureau (PSB)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1293,'Cottage Industry Technology Center (CITC) (GOCC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',0,'2010-08-19 17:23:41'),(1294,'Construction Manpower Development Foundation (CMDF)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1295,'Council for the Welfare of Children (CWC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1296,'Inter-Country Adoption Board (ICAB)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1297,'National Council on Disability Affairs (NCDA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1298,'National Commission on the Role of Filipino Women (NCRFW)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',0,'2010-08-19 17:45:38'),(1299,'National Youth Commission',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',0,'2010-08-19 17:50:53'),(1300,'DOTC-Action Agad Center',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',0,'2010-08-19 17:30:03'),(1301,'Philippine Coast Guard (PCG)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1302,'Air Transportation Office (ATO)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1303,'Land Transportation Office (LTO)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1304,'Maritime Industry Authority (MARINA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1305,'Philippine Merchant Marine Academy (PMMA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1306,'Civil Aeronautics Board (CAB)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1307,'Metro Star Express (MRT3)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-08-19 17:43:42'),(1308,'Land Transportation Franchising and Regulatory Board (LTFRB)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1309,'Manila International Airport Authority (MIAA) (GOCC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',0,'2010-08-19 17:39:34'),(1310,'Senate of the Philippines',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',0,'2010-08-19 18:02:06'),(1311,'House of Representatives (CONGRESS)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-08-19 17:37:02'),(1312,'Autonomous Regional Government in Muslim Mindanao',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1313,'Civil Service Commission (CSC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1314,'Career Executive Service Board (CESBoard)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1315,'Commission on Audit (COA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1316,'Commission on Elections (COMELEC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1317,'Commission on Human Rights (CHR)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1318,'Office of the Ombudsman (OMBUDSMAN)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1319,'Bank of Philippine Islands (BPI)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',2,0,'1','1',1,'2010-08-19 17:02:47'),(1320,'Board of Liquidators (BOL)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',0,'2010-08-19 17:22:34'),(1321,'Cultural Center of the Philippines (CCP)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-08-19 17:26:07'),(1322,'Government Service Insurance System (GSIS)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1323,'Land Bank of the Philippines (LBP)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1324,'Livelihood Corporation (LIVECOR)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1325,'National Food Authority (NFA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1326,'National Home Mortgage Finance Corp. (NHMFC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1327,'Natural Resources Development Corp. (NRDC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1328,'Philippine Export-Import Credit Agency (PHILEXIM)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',0,'2010-08-19 18:08:58'),(1329,'Philippine Export-Import Credit Agency/ Trade and Investment Development Corp. (TIDCORP)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1330,'Philippine Fisheries Development Authority (PFDA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1331,'Philippine International Convention Center (PICC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1332,'Philippine Leisure and Retirement Authority (PLRA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1333,'Philippine Reclamation Authority',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1334,'Power Sector Assets and Liabilities Management Corp. (PSALM)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1335,'Southern Philippines Development Authority (SPDA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1336,'Lung Center of the Philippines (LCP)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-08-19 17:40:38'),(1337,'Masaganang Sakahan, Inc.',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1338,'Metropolitan Waterworks and Sewerage System (MWSS)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1339,'National Agribusiness Corp. (NABC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1340,'National Tobacco Administration (NTA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1341,'Philippine Center for Economic Development (PCED)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1342,'Philippine Charity Sweepstakes Office (PCSO)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1343,'Philippine Crop Insurance Corp. (PCIC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1344,'Philippine Rice Research Institute (PHILRICE)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1345,'PHIVIDEC Industrial Authority',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1346,'Social Security System (SSS)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1347,'Bases Conversion and Development Authority (BCDA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1348,'Investor Relations Office (IRO)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1349,'National Livelihood Support Fund (NLSF)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1350,'National Power Corp. (NAPOCOR)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',0,'2010-08-19 17:50:24'),(1351,'National Transmission Corp. (TRANSCO)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1352,'Philippine Health Insurance Corporation (PhilHealth) (GOCC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',0,'2010-08-19 18:11:10'),(1353,'Technology & Livelihood Resource Center (TLRC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1354,'Development Bank of the Philippines (DBP)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1355,'Home Development Mutual Fund (PAG-IBIG)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1356,'Home Guaranty Corp. (HGC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1357,'National Electrification Administration (NEA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1358,'National Housing Authority (NHA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1359,'Philippine Heart Center (PHC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',0,'2010-08-19 18:08:04'),(1360,'Philippine Institute for Development Studies (PIDS)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1361,'Quedan Rural Credit and Guarantee Corp. (QUEDANCOR)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1362,'Clark Development corp. (CDC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1363,'Cottage Industry Technology Center (CITC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1364,'Manila International Airport Authority (MIAA) ',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1365,'National Development Company (NDC) ',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1366,'Overseas Workers Welfare Administration (OWWA) ',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1367,'Philippine Aerospace Development Corp. (PADC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1368,'Philippine Economic Zone Authority (PEZA) ',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1369,'Philippine National Construction Corporation (PNCC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1370,'Philippine National Oil Company (PNOC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',0,'2010-08-19 18:06:11'),(1371,'Small Business Guarantee and Finance Corporation (SBGFC) ',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1372,'Light Rail Transit Authority (LRTA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1373,'National Irrigation Administration (NIA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1374,'Philippine Convention and Visitors Corp. (PCVC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1375,'Philippine Deposit Insurance Corp. (PDIC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1376,'Philippine National railways (PNR)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1377,'Philippine Ports Authority (PPA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-03-16 19:04:06'),(1378,'Development Academy of the Philippines (DAP)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',1,'2010-03-16 19:04:06'),(1379,'Duty Free Philippines (DFP)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',1,'2010-08-19 17:31:10'),(1380,'Food Terminal Inc., (FTI)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',0,'2010-08-19 17:32:19'),(1381,'Local Water Utilities Administration (LWUA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',1,'2010-03-16 19:04:06'),(1382,'National Kidney and Transplant Institute (NKTI)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',1,'2010-08-19 17:52:46'),(1383,'People\'s Credit and Finance Corp. (PCFC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',0,'2010-08-19 17:55:51'),(1384,'Philippine Amusement and gaming Corp. (PAGCOR)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',0,'2010-08-19 17:56:33'),(1385,'Philippine Coconut Authority (PCA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',1,'2010-03-16 19:04:06'),(1386,'Subic Bay Metropolitan Authority (SBMA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',1,'2010-03-16 19:04:06'),(1387,'Philippine Postal Corp. (Philpost)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',0,'2010-08-19 18:05:22'),(1388,'Sugar Regulatory Administration (SRA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',0,'2010-08-19 18:01:05'),(1389,'Bureau of Fire Protection',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',0,'2010-08-19 16:59:00'),(1390,'Land Registration Authority (LRA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',0,'2010-08-19 17:37:30'),(1391,'Bureau of Customs',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',0,'2010-08-19 16:56:26'),(1392,'Philippine Amusement and Gaming Corporation (PAGCOR)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',1,'2010-08-19 17:58:29'),(1393,'National Conciliation and Mediation Board (NCMB)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',0,'2010-08-19 17:44:36'),(1394,'Local Water Utilities Administration (LWUA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',0,'2010-08-19 17:38:29'),(1395,'Makati City',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',1,'2010-03-16 19:04:06'),(1396,'Occupational Safety and Health Center',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',0,'2010-08-19 17:53:54'),(1397,'Senate of the Philippines',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',1,'2010-03-16 19:04:06'),(1398,'Bureau of Secondary Education',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',0,'2010-08-19 17:07:22'),(1399,'Center for Students & Co-Curricular Affairs',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',0,'2010-08-19 17:17:47'),(1400,'Bureau of Immigration',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',0,'2010-08-19 17:01:27'),(1401,'Commission on Information and Communications Inc.',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',0,'2010-08-19 17:21:27'),(1402,'Presidential Commission on Good Government',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',0,'2010-08-19 18:02:56'),(1403,'National Dairy Authority (NDA)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',0,'2010-08-19 17:46:07'),(1404,'DOTC- Action Agad Center',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',1,'2010-03-16 19:04:06'),(1405,'National Book Development Board',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',0,'2010-08-19 17:42:22'),(1406,'People\'s Credit and Finance Corporation (PCFC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',1,'2010-03-16 19:04:06'),(1407,'Taguig',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',1,'2010-03-16 19:04:06'),(1408,'Food Terminal Incorporated (FTI)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',1,'2010-03-16 19:04:06'),(1409,'Development Academy of the Philippines (DAP)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',0,'2010-08-19 17:29:02'),(1410,'GSIS Family Bank',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',1,'2010-03-16 19:04:06'),(1411,'GSIS Mutual Fund, Inc.',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',1,'2010-03-16 19:04:06'),(1412,'Polytechnic University of the Philippines',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',1,'2010-03-16 19:04:06'),(1413,'Livestock Development Council (LDC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',0,'2010-08-19 17:38:02'),(1414,'Bureau of Soils & water management (BSWM)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',0,'2010-08-19 17:10:27'),(1415,'Department of Education',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',0,'2010-08-19 17:27:14'),(1416,'Philippine Postal Savings Bank',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',1,'2010-03-16 19:04:06'),(1417,'National Bureau of Investigation (NBI)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',0,'2010-08-19 17:43:55'),(1418,'House of Representatives',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',0,'2010-08-19 17:33:00'),(1419,'National Police Commission (NAPOLCOM)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',0,'2010-08-19 17:46:41'),(1420,'Bureau of Elementary Education',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',0,'2010-08-19 16:58:26'),(1421,'Philippine Coast Guard (PCG)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',0,'2010-08-19 17:58:47'),(1422,'Air Transportation Office (ATO)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',0,'2010-08-19 17:48:34'),(1423,'Philippine Postal Corporation (GOCC)',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',0,'2010-08-19 18:04:31'),(1424,'Rizal Technological University',0,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','2',1,0,'1','1',1,'2010-03-16 19:04:06'),(1425,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,0,'2010-07-20 19:15:40'),(1426,'test2',0,'0000-00-00',0,'1','1','1','1','1','1',1,1,'1','1','1',0,0,'1','1',0,'2010-08-19 18:00:02'),(1428,'test',0,'0000-00-00',0,'1','1','1','1','1','1',1,1,'1','1','1',0,0,'1','1',0,'2010-08-12 10:59:22'),(1429,'test3',0,'0000-00-00',0,'1','1','1','1','1','1',1,1,'1','1','1',0,0,'1','1',0,'2010-08-19 17:59:11'),(1430,'test',0,'0000-00-00',0,'1','1','1','1','1','1',1,1,'1','1','1',0,0,'1','1',0,'2010-08-19 17:59:34'),(1431,'Bonded Export Marketing Board (BEMB)',0,'0000-00-00',0,'1','1','1','1','1','1',1,1,'1','1','BEMB',1,0,'1','1',0,'2010-07-20 19:26:05'),(1432,'Bureau of Land Acquisition and Distribution (BLAD)',0,'0000-00-00',0,'1','1','1','1','1','1',1,1,'1','1','BLAD ',1,0,'1','1',1,'2010-05-18 16:07:18'),(1433,'Bureau of Land Development (BLD) ',0,'0000-00-00',0,'1','1','1','1','1','1',1,1,'1','1','BLD ',1,0,'1','1',1,'2010-05-18 16:07:53'),(1434,'Department of Social Welfare and Development (DSWD) ',0,'0000-00-00',0,'1','1','1','1','1','1',1,1,'1','1','DSWD ',1,0,'1','1',1,'2010-05-18 16:08:14'),(1435,'Department of Transportation and Communications (DOTC) ',0,'0000-00-00',0,'1','1','1','1','1','1',1,1,'1','1','DOTC ',1,0,'1','1',1,'2010-05-18 16:08:30'),(1436,'Regional Operations Group (ROG) ',0,'0000-00-00',0,'1','1','1','1','1','1',1,1,'1','1','ROG',1,0,'1','1',1,'2010-05-18 16:08:49'),(1437,'Bureau of Agrarian Legal Assistance (BALA) ',0,'0000-00-00',0,'1','1','1','1','1','1',1,1,'1','1','BALA ',1,0,'1','1',1,'2010-05-18 16:09:41'),(1438,'Bureau of Agrarian Reform Beneficiaries Development (BARBD)',0,'0000-00-00',0,'1','1','1','1','1','1',1,1,'1','1','BARBD',1,0,'1','1',1,'2010-05-18 16:10:22'),(1439,'Bureau of Agrarian Reform Information and Education (BARIE)',0,'0000-00-00',0,'1','1','1','1','1','1',1,1,'1','1','BARIE',1,0,'1','1',1,'2010-05-18 16:10:45'),(1440,'Quezon City Hall',0,'0000-00-00',0,'1','1','1','1','1','1',1,1,'1','1','1',2,0,'1','1',1,'2010-05-20 13:07:24'),(1441,'TEst',1,'0000-00-00',0,'1','1','1','1','1','1',1,1,'1','1','1',0,0,'1','1',0,'2010-08-19 18:00:22'),(1443,'National Grid Corporation of the Philippines (NGCP)',3,'0000-00-00',3,'1','1','1','1','1','1',1,1,'1','1','1',2,0,'1','1',1,'2010-08-20 09:38:05'),(1444,'Philippine Global Communication Corp. (PHILCOM)',3,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',2,0,'1','1',1,'2010-08-20 09:49:22'),(1445,'Paul George Salinas',1,'0000-00-00',0,'1','1','1','1','1','1',1,1,'1','1','1',2,0,'1','1',1,'2010-08-20 09:52:31'),(1446,'Bernard Tiongson',1,'0000-00-00',0,'1','1','1','1','1','1',1,1,'1','1','1',2,0,'1','1',1,'2010-08-20 09:55:13'),(1447,'D&L Industries Inc.',3,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',2,0,'1','1',1,'2010-08-20 09:57:36'),(1448,'Punta Fuego Resort',3,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',2,0,'1','1',1,'2010-08-20 10:03:50'),(1449,'Salvation Army',3,'1969-12-31',2,'1','1','1','1','1','1',1,1,'1@yahoo.com','1','1',2,2,'1','1',1,'2010-09-22 15:13:01'),(1450,'LGU San Fernando City, Pampanga',0,'0000-00-00',0,'1','1','1','1','1','1',1,1,'1','1','1',1,0,'1','1',1,'2010-08-20 10:09:53'),(1451,'Hotel Enterprises of the Phils. (Midas Hotel)',3,'0000-00-00',1,'1','1','1','1','1','1',1,1,'1','1','1',2,0,'1','1',1,'2010-08-20 10:13:38'),(1452,'Build Operate Transfer Center (BOT Center)',0,'0000-00-00',0,'1','4th Floor, G.A. Yupangco Building','339 Sen. Gil Puyat Avenue','Makati City, Philippines, 1200','(632) 896-4697 / 897-6826 / 895-','1',1,1,'info@botcenter.gov.ph','www.botcenter.gov.ph','1',1,0,'1','1',1,'2010-08-25 11:41:23'),(1453,'Stores Speciliast, Inc.',3,'1969-12-31',1,'1','4/F Midland Buendia Bldg.','403 Sen. Gil Puyat Avenue ','Makati City, Philippines, 1200','1','1',1,1,'info@ssigroup.com.ph','www.ssigroup.com.ph','SSI',2,2,'1','1',1,'2010-09-16 08:42:18'),(1454,'University of the Philippines',3,'1969-12-31',3,'1','Diliman, Quezon City','1101, Philippines','1','(632) 981-8500','1',1,1,'1@tr.com','www.upd.edu.ph','UPD',1,1,'1','1',1,'2010-09-22 14:50:31'),(1456,'rivas',2,'2010-09-01',3,'dffd','fs','dfs','dfs','343','342',3,3,'3@ahoo.com','ere','rwrw',NULL,2,'fdsfs',NULL,NULL,'2010-09-22 10:57:51');

/*Table structure for table `contacts` */

DROP TABLE IF EXISTS `contacts`;

CREATE TABLE `contacts` (
  `CONTIDNO` int(11) NOT NULL auto_increment,
  `CONTACTNAME` varchar(256) NOT NULL,
  `CONTACTPOS` varchar(128) NOT NULL,
  `PHONE` varchar(16) NOT NULL,
  `MOBILE` varchar(16) NOT NULL,
  `EMAIL` varchar(64) NOT NULL,
  `CONTACTBIRTHDATE` date NOT NULL,
  `CONREMINDATE` date NOT NULL,
  `CONREMINDER` text NOT NULL,
  `clients_id` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY  (`CONTIDNO`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `contacts` */

insert  into `contacts`(`CONTIDNO`,`CONTACTNAME`,`CONTACTPOS`,`PHONE`,`MOBILE`,`EMAIL`,`CONTACTBIRTHDATE`,`CONREMINDATE`,`CONREMINDER`,`clients_id`,`active`) values (5,'San','San Mig AM','12334','2323','dsdad@yahoo.com','0000-00-00','0000-00-00','',1922,1),(6,'test','test','2134','123','2354@tes.com','0000-00-00','0000-00-00','',1922,1),(7,'Darryl Anaud','IT Manager','3004615','9234477228','yelanaud@yahoo.com','0000-00-00','0000-00-00','',1242,1),(8,'rere','rew','232','232','d@yahoo.com','2010-09-06','2010-09-01','fds',1456,1),(9,'teststs','tetset','234','234','sdf@sdf.com','2010-09-21','2010-09-21','test234',1454,1),(10,'contact','sdsa','32','3232','232@yahoo.com','2010-09-13','2010-09-03','dsd',1449,1),(11,'contact from client','dsd','32','3232','s@yahoo.com','2010-09-05','2010-09-07','sdsa',1449,1),(12,'Gavin porter','PRO','123456','123456','sample@abc.net','1987-04-22','2010-09-23','none',1382,1);

/*Table structure for table `fileacma` */

DROP TABLE IF EXISTS `fileacma`;

CREATE TABLE `fileacma` (
  `ACMAIDNO` int(11) NOT NULL auto_increment,
  `LASTNAME` varchar(50) NOT NULL,
  `FIRSTNAME` varchar(50) NOT NULL,
  `MIDDLENAME` varchar(50) NOT NULL,
  `ACMANAME` varchar(256) NOT NULL,
  `PHONE` varchar(16) default NULL,
  `MOBILE` varchar(16) default NULL,
  `EMAIL` varchar(64) default NULL,
  `ACSTIDNO` int(11) NOT NULL,
  `DMODIFIED` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`ACMAIDNO`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `fileacma` */

insert  into `fileacma`(`ACMAIDNO`,`LASTNAME`,`FIRSTNAME`,`MIDDLENAME`,`ACMANAME`,`PHONE`,`MOBILE`,`EMAIL`,`ACSTIDNO`,`DMODIFIED`) values (3,'Ignacio','Blair Benjamin','C.','Blair Benjamin C. Ignacio','','','',1,'2010-09-26 09:29:46'),(2,'Vega','Mar',' ','Mar   Vega','','','',1,'2010-09-26 09:30:09'),(4,'Dantes','Dexter',' ','Dexter   Dantes','','','',0,'2010-09-26 09:28:36'),(5,'Santiago','Vanessa',' ','Vanessa   Santiago','','','',1,'2010-09-26 09:28:20'),(6,'Balbastre','Grace',' ','Grace   Balbastre','','','',0,'2010-09-26 09:27:47'),(7,'Cabalitan','Shirlyn','DL.','Shirlyn DL. Cabalitan','','','',1,'2010-09-26 09:27:13'),(8,'Repia','Eva','E.','Eva E. Repia','','','',0,'2010-09-26 09:26:17'),(9,'Carlos','Airene',' ','Airene   Carlos','','','',1,'2010-09-26 09:25:50'),(10,'EdaÃ±ol','Maricris','S.','Maricris S. EdaÃ±ol','','','',1,'2010-09-26 09:25:09'),(11,'Arquero','Tiza','A.','Tiza A. Arquero','','','',1,'2010-09-26 09:23:48');

/*Table structure for table `fileacti` */

DROP TABLE IF EXISTS `fileacti`;

CREATE TABLE `fileacti` (
  `ACTIIDNO` int(11) NOT NULL auto_increment,
  `ACTIVITY` varchar(256) default NULL,
  `DMODIFIED` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`ACTIIDNO`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `fileacti` */

insert  into `fileacti`(`ACTIIDNO`,`ACTIVITY`,`DMODIFIED`) values (1,'Bidding','2010-09-20 13:15:53'),(2,'Pre-Bid','2010-09-20 13:16:23'),(3,'None Bidding','2010-09-20 13:17:07');

/*Table structure for table `fileactive` */

DROP TABLE IF EXISTS `fileactive`;

CREATE TABLE `fileactive` (
  `active_idno` bigint(11) NOT NULL auto_increment,
  `active_description` varchar(50) default NULL,
  `date_modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`active_idno`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `fileactive` */

insert  into `fileactive`(`active_idno`,`active_description`,`date_modified`) values (1,'Active','2010-09-13 08:04:16'),(2,'Cancelled','2010-09-13 08:05:07'),(3,'CLOSED Project','2010-09-13 08:05:29');

/*Table structure for table `fileactivitytype` */

DROP TABLE IF EXISTS `fileactivitytype`;

CREATE TABLE `fileactivitytype` (
  `idno` tinyint(10) NOT NULL auto_increment,
  `activity` varchar(128) collate latin1_general_ci default NULL,
  `active` tinyint(10) default NULL,
  `dmodified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`idno`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='activity type';

/*Data for the table `fileactivitytype` */

insert  into `fileactivitytype`(`idno`,`activity`,`active`,`dmodified`) values (1,'Bidding',1,'2010-04-23 14:41:07'),(2,'Pre-Bid',1,'2010-04-23 14:41:19'),(3,'None Bidding',1,'2010-04-30 04:03:31');

/*Table structure for table `fileatth` */

DROP TABLE IF EXISTS `fileatth`;

CREATE TABLE `fileatth` (
  `atthidno` int(11) NOT NULL auto_increment,
  `putyidno` int(11) NOT NULL,
  `atth_title` varchar(256) collate latin1_general_ci NOT NULL,
  `active` tinyint(4) NOT NULL,
  `dmodified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`atthidno`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `fileatth` */

insert  into `fileatth`(`atthidno`,`putyidno`,`atth_title`,`active`,`dmodified`) values (1,1,'Invoice',1,'0000-00-00 00:00:00'),(2,1,'Delivery Receipts',1,'0000-00-00 00:00:00'),(3,2,'Item Control Slip A',1,'0000-00-00 00:00:00'),(4,3,'Letter of Credit',1,'0000-00-00 00:00:00'),(5,3,'Credit Line',1,'0000-00-00 00:00:00'),(6,3,'Manages Check',1,'0000-00-00 00:00:00'),(7,3,'Bank Guarantee',1,'0000-00-00 00:00:00'),(8,3,'Surety Bond',1,'0000-00-00 00:00:00'),(9,3,'GSIS',1,'0000-00-00 00:00:00'),(10,3,'Certificates',1,'0000-00-00 00:00:00'),(11,3,'Importation Docs',1,'0000-00-00 00:00:00'),(12,3,'Accreditation Docs',1,'0000-00-00 00:00:00'),(13,3,'RFQ/Canvass',1,'0000-00-00 00:00:00'),(14,3,'Motion for Reconsideration',1,'0000-00-00 00:00:00'),(15,3,'Letter of Extension',1,'0000-00-00 00:00:00'),(16,3,'Company Profile',1,'0000-00-00 00:00:00'),(17,4,'Official Receipt',1,'0000-00-00 00:00:00'),(18,4,'Billing Statement/SOA',1,'0000-00-00 00:00:00'),(19,4,'Collection Letter',1,'0000-00-00 00:00:00'),(20,4,'Letter of Refund',1,'0000-00-00 00:00:00'),(21,4,'Withholding Tax Cert',1,'0000-00-00 00:00:00'),(22,5,'Item Control Slip B',1,'0000-00-00 00:00:00'),(23,6,'Legal Documents',1,'0000-00-00 00:00:00'),(24,6,'Notary',1,'0000-00-00 00:00:00'),(25,6,'Payroll',1,'0000-00-00 00:00:00'),(26,6,'Documents for Signature',1,'0000-00-00 00:00:00'),(27,6,'General Services',1,'0000-00-00 00:00:00'),(28,6,'Legal Case',1,'0000-00-00 00:00:00'),(29,6,'Check Deposit',1,'0000-00-00 00:00:00'),(30,6,'Gifts',1,'0000-00-00 00:00:00'),(41,11,'Letter of Credit',1,'2010-03-09 08:08:33'),(40,10,'Pull-Out Slip',1,'2010-03-09 08:08:18'),(39,9,'Delivery Receipts',1,'2010-03-09 08:07:45'),(38,9,'Invoice',1,'2010-03-09 08:07:37'),(42,11,'Credit Line',1,'2010-03-09 08:08:39'),(43,11,'Managers Check',1,'2010-03-09 08:08:49'),(44,11,'Bank Guarantee',1,'2010-03-09 08:08:57'),(45,11,'Surety Bond',1,'2010-03-09 08:09:05'),(46,11,'GSIS',1,'2010-03-09 08:09:15'),(47,11,'Certificates',1,'2010-03-09 08:09:21'),(48,11,'Buy Bid Documents',1,'2010-03-09 08:09:30'),(49,11,'Bid Bulletin/Brochures/Manuals',1,'2010-03-09 08:09:43'),(50,11,'Receiving of Clients PO',1,'2010-03-09 08:10:13'),(51,11,'Importation Docs',1,'2010-03-09 08:10:30'),(52,11,'Accreditation Docs',1,'2010-03-09 08:10:44'),(53,11,'RFQ / Canvass',1,'2010-03-09 08:10:53'),(54,11,'Motion for Reconsideration',1,'2010-03-09 08:11:02'),(55,11,'Company Profile',1,'2010-03-09 08:11:08'),(56,12,'Official Receipt',1,'2010-03-09 08:11:16'),(57,12,'Billing Statement/SOA',1,'2010-03-09 08:11:26'),(58,12,'Collection Letter',1,'2010-03-09 08:11:36'),(59,12,'Letter of Refund',1,'2010-03-09 08:11:46'),(60,12,'Witholding Tax Cert',1,'2010-03-09 08:13:52'),(61,13,'Pull-Out Slip ',1,'2010-03-09 08:15:17'),(62,14,'Legal Documents',1,'2010-03-09 08:17:40'),(63,14,'Notary',1,'2010-03-09 08:18:15'),(64,14,'Payroll',1,'2010-03-09 08:18:23'),(65,14,'Documents for Signature',1,'2010-03-09 08:18:31'),(66,14,'General Services',1,'2010-03-09 08:18:38'),(67,14,'Legal Case',1,'2010-03-09 08:18:46'),(68,14,'Check Deposit',1,'2010-03-09 08:18:53'),(69,14,'Gifts',1,'2010-03-09 08:18:58');

/*Table structure for table `filebran` */

DROP TABLE IF EXISTS `filebran`;

CREATE TABLE `filebran` (
  `BRANID` int(11) NOT NULL auto_increment,
  `BRANNAME` varchar(256) NOT NULL,
  `active` tinyint(4) NOT NULL default '1',
  `dmodified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`BRANID`)
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=utf8;

/*Data for the table `filebran` */

insert  into `filebran`(`BRANID`,`BRANNAME`,`active`,`dmodified`) values (2,'DELL',0,'2010-03-05 07:20:52'),(10,'ACER',0,'2010-07-21 07:19:19'),(13,'Intel',0,'2010-07-21 07:19:21'),(14,'Toshiba',1,'0000-00-00 00:00:00'),(15,'HP',1,'0000-00-00 00:00:00'),(16,'Samsung',1,'0000-00-00 00:00:00'),(17,'Mitsuboshi',0,'0000-00-00 00:00:00'),(94,'Belden',1,'2010-09-17 15:05:51'),(95,'Clipsal',1,'2010-09-17 15:06:27'),(93,'IBM',1,'2010-09-17 15:04:22'),(96,'ADC Krone',1,'2010-09-17 15:07:20'),(75,'Cisco Systems',1,'2010-09-17 14:43:38'),(27,'Aberdeen LLC ',1,'2010-03-12 21:40:23'),(28,'ABMX.com ',1,'2010-03-12 21:40:37'),(29,'ABS Computer Technologies ',1,'2010-03-12 21:40:48'),(30,'Dreamcom ',1,'2010-03-12 21:40:55'),(31,'Brunen IT ',1,'2010-03-12 21:41:02'),(32,'eMachines  ',1,'2010-03-12 21:41:16'),(33,'Aigo ',1,'2010-03-12 21:41:24'),(34,'AMAX ',1,'2010-03-12 21:41:29'),(35,'Advantech ',1,'2010-03-12 21:41:36'),(36,'Amazon PC ',1,'2010-03-12 21:41:40'),(37,'Activant Solutions  ',1,'2010-03-12 21:41:46'),(38,'Apple ',1,'2010-03-12 21:41:50'),(39,'AREA Data Systems, Inc ',1,'2010-03-12 21:41:55'),(40,'Area51 Computers ',1,'2010-03-12 21:42:01'),(41,'ASA Computers ',1,'2010-03-12 21:42:06'),(42,'Asus ',1,'2010-03-12 21:42:12'),(43,'Atec ',1,'2010-03-12 21:42:19'),(44,'AtomixPC ',1,'2010-03-12 21:42:24'),(45,'AVADirect ',1,'2010-03-12 21:42:32'),(46,'Averatec ',1,'2010-03-12 21:42:37'),(47,'AXIOO International ',1,'2010-03-12 21:42:43'),(48,'Axiomtek ',1,'2010-03-12 21:42:48'),(49,'Broadberry ',1,'2010-03-12 21:42:52'),(50,'Blackberry ',1,'2010-03-12 21:43:00'),(51,'Belineal ',1,'2010-03-12 21:43:06'),(52,'BenQ ',1,'2010-03-12 21:43:12'),(53,'Blue Spine Design ',1,'2010-03-12 21:43:17'),(54,'Boxx Computers ',1,'2010-03-12 21:43:21'),(55,'Belta ',1,'2010-03-12 21:43:29'),(56,'BuyDirectPC ',1,'2010-03-12 21:43:34'),(57,'# BuyDirectPC # Chassis Plans ',1,'2010-03-12 21:43:41'),(58,'Chiligreen ',1,'2010-03-12 21:43:53'),(59,'Chip PC ',1,'2010-03-12 21:43:58'),(60,'Clevo ',1,'2010-03-13 10:03:05'),(61,'Commodore Gaming ',1,'2010-03-13 10:03:14'),(62,'Compaq ',1,'2010-03-13 10:03:21'),(63,'Compuline ',1,'2010-03-13 10:03:27'),(64,'Cray ',1,'2010-03-13 10:03:32'),(65,'Curkzware ',1,'2010-03-13 10:03:38'),(66,'CyberPower PC ',1,'2010-03-13 10:03:43'),(67,'Dedicated Computing ',1,'2010-03-13 10:03:50'),(76,'Ubiquiti Networks',1,'2010-09-17 14:45:58'),(69,'Branded',1,'2010-03-19 10:13:30'),(70,'Gateway',1,'2010-09-11 14:00:00'),(73,'Orange',1,'2010-09-06 21:58:36'),(77,'Bakbone Software',1,'2010-09-17 14:47:17'),(78,'Kaspersky Lab',1,'2010-09-17 14:47:45'),(79,'Fortinet',1,'2010-09-17 14:48:23'),(80,'Barracuda Networks',1,'2010-09-17 14:49:07'),(81,'Norton',1,'2010-09-17 14:49:51'),(82,'Astaro',1,'2010-09-17 14:50:45'),(83,'Polycom',1,'2010-09-17 14:51:50'),(84,'GFI Software',1,'2010-09-17 14:53:28'),(85,'Symantec',1,'2010-09-17 14:54:52'),(86,'Ruckus Wireless',1,'2010-09-17 14:55:50'),(87,'Emerson',1,'2010-09-17 14:56:15'),(88,'APC',1,'2010-09-17 14:57:05'),(89,'Avaya',1,'2010-09-17 14:58:14'),(90,'Allied Telesis',1,'2010-09-17 14:59:24'),(91,'HP Procurve',1,'2010-09-17 15:00:12'),(92,'Allot Communications',1,'2010-09-17 15:00:38'),(97,'Panduit',1,'2010-09-17 15:07:55'),(98,'Sophos',1,'2010-09-17 15:08:27'),(99,'Axis Communications',1,'2010-09-17 15:09:38'),(100,'Urovo Technology',1,'2010-09-17 15:11:07'),(101,'Firetide',1,'2010-09-17 15:12:10'),(102,'Intermec',1,'2010-09-17 15:12:23'),(103,'Datamax',1,'2010-09-17 15:13:38'),(104,'Cino',1,'2010-09-17 15:13:47');

/*Table structure for table `fileccpu` */

DROP TABLE IF EXISTS `fileccpu`;

CREATE TABLE `fileccpu` (
  `CCPUIDNO` int(11) NOT NULL auto_increment,
  `CCPURPOSE` varchar(256) default NULL,
  `DMODIFIED` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`CCPUIDNO`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `fileccpu` */

insert  into `fileccpu`(`CCPUIDNO`,`CCPURPOSE`,`DMODIFIED`) values (2,'TEST Purpose 02','2010-09-21 10:49:56');

/*Table structure for table `fileclientpurpose` */

DROP TABLE IF EXISTS `fileclientpurpose`;

CREATE TABLE `fileclientpurpose` (
  `fileclientpurposeid` int(2) NOT NULL auto_increment,
  `clientpurpose` varchar(200) NOT NULL,
  `is_delete` tinyint(1) default '0',
  PRIMARY KEY  (`fileclientpurposeid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `fileclientpurpose` */

insert  into `fileclientpurpose`(`fileclientpurposeid`,`clientpurpose`,`is_delete`) values (1,'Meeting',0),(2,'Presentation',0),(3,'Delivery',0),(4,'test',1),(5,'test',1);

/*Table structure for table `fileclty` */

DROP TABLE IF EXISTS `fileclty`;

CREATE TABLE `fileclty` (
  `cltyidno` int(11) NOT NULL auto_increment,
  `client_type` varchar(256) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `dmodified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`cltyidno`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `fileclty` */

insert  into `fileclty`(`cltyidno`,`client_type`,`active`,`dmodified`) values (1,'GOVERMENT',1,'2010-03-09 09:45:14'),(2,'PRIVATE',1,'2010-03-09 09:45:14');

/*Table structure for table `filecompt` */

DROP TABLE IF EXISTS `filecompt`;

CREATE TABLE `filecompt` (
  `ctypeidno` int(5) NOT NULL,
  `ctype` varchar(254) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `filecompt` */

insert  into `filecompt`(`ctypeidno`,`ctype`) values (1,'Government'),(2,'Private');

/*Table structure for table `filecourse` */

DROP TABLE IF EXISTS `filecourse`;

CREATE TABLE `filecourse` (
  `filecourseid` int(2) NOT NULL auto_increment,
  `course` varchar(250) default NULL,
  `is_delete` tinyint(1) default '0',
  PRIMARY KEY  (`filecourseid`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `filecourse` */

insert  into `filecourse`(`filecourseid`,`course`,`is_delete`) values (1,'B.S.B.A. Major in Management Accounting',0),(2,'B.S. in Mathematics',0),(3,'B.S.I.S - Computer Technology',0),(4,'B.S. in Computer Engineering',0),(5,'B.S.C Major in Management',0),(6,'B.S.C Major in Marketing',0),(7,'B.S Information Technology',0),(8,'B.S.in Computer Based Info Sys.',0),(9,'B.S. in Computer Science',0),(10,'B.S. in Accountancy',0),(11,'C.E.T',0),(12,'B.S. Psychology',0),(13,'B.S. Business Administration',0),(14,'B.S. in Computer Management',0),(15,'Bachelor in Hotel and Restaurant Management',0),(16,'B.S. Electrical Engineering',0),(17,'Computer Secretarial',0),(18,'ECE',0),(19,'teset',1),(20,'testxxx',1),(21,'High School Graduate',0);

/*Table structure for table `filectyp` */

DROP TABLE IF EXISTS `filectyp`;

CREATE TABLE `filectyp` (
  `ctyp_idno` tinyint(4) NOT NULL auto_increment,
  `ctyp_name` varchar(256) collate latin1_general_ci NOT NULL,
  `active` tinyint(4) NOT NULL,
  `dmodified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`ctyp_idno`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `filectyp` */

insert  into `filectyp`(`ctyp_idno`,`ctyp_name`,`active`,`dmodified`) values (1,'TECHNICAL',0,'0000-00-00 00:00:00'),(2,'PURCHASING',0,'0000-00-00 00:00:00'),(3,'ADMINISTRATION',0,'0000-00-00 00:00:00'),(4,'CONSULTANT',0,'0000-00-00 00:00:00'),(7,'HR',0,'2010-09-11 14:22:14');

/*Table structure for table `filedept` */

DROP TABLE IF EXISTS `filedept`;

CREATE TABLE `filedept` (
  `dept_idno` tinyint(4) NOT NULL auto_increment,
  `dept_type` varchar(256) collate latin1_general_ci NOT NULL,
  `active` tinyint(4) NOT NULL default '1',
  `dmodified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`dept_idno`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `filedept` */

insert  into `filedept`(`dept_idno`,`dept_type`,`active`,`dmodified`) values (1,'Office Department',1,'2010-09-06 20:28:11'),(2,'Admin Department ',1,'2010-09-06 20:28:17'),(9,'Research',1,'2010-09-06 21:27:03'),(6,'Information Technology',1,'2010-09-06 21:22:56'),(5,'Operations',1,'2010-09-06 20:32:35'),(7,'Human Resource',1,'2010-09-06 21:24:41'),(10,'Graphics Department',1,'2010-09-11 14:59:54'),(12,'Programmers',1,'2010-09-07 11:07:25'),(13,'Outsource',1,'2010-09-07 13:00:18'),(14,'Sales',1,'2010-09-07 21:09:28'),(15,'test departments',0,'2010-11-24 16:07:18');

/*Table structure for table `filedistributor` */

DROP TABLE IF EXISTS `filedistributor`;

CREATE TABLE `filedistributor` (
  `idno` int(10) NOT NULL auto_increment,
  `distributor` varchar(255) default NULL,
  `active` int(10) default '0',
  `dmodified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`idno`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='distributor';

/*Data for the table `filedistributor` */

insert  into `filedistributor`(`idno`,`distributor`,`active`,`dmodified`) values (2,'distributor 4',0,'2010-06-01 01:38:06'),(3,'distributor 1',0,'2010-06-01 02:49:10');

/*Table structure for table `fileducattainment` */

DROP TABLE IF EXISTS `fileducattainment`;

CREATE TABLE `fileducattainment` (
  `fileducattainmentid` int(2) NOT NULL auto_increment,
  `education_attainment` varchar(250) default NULL,
  `is_delete` tinyint(1) default '0',
  PRIMARY KEY  (`fileducattainmentid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `fileducattainment` */

insert  into `fileducattainment`(`fileducattainmentid`,`education_attainment`,`is_delete`) values (1,'High School Diploma',0),(2,'Vocational or Short Course',0),(3,'Bachelors or College Degree ',0);

/*Table structure for table `fileempstatus` */

DROP TABLE IF EXISTS `fileempstatus`;

CREATE TABLE `fileempstatus` (
  `empstatusid` int(2) NOT NULL auto_increment,
  `empstatus` varchar(100) default NULL COMMENT 'employee status',
  `is_Delete` tinyint(1) default '0',
  PRIMARY KEY  (`empstatusid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `fileempstatus` */

insert  into `fileempstatus`(`empstatusid`,`empstatus`,`is_Delete`) values (1,'Hired',0),(2,'Resigned',0),(3,'Terminated',0),(4,'test',1);

/*Table structure for table `filejobl` */

DROP TABLE IF EXISTS `filejobl`;

CREATE TABLE `filejobl` (
  `jobl_idno` tinyint(4) NOT NULL auto_increment,
  `jobl_name` varchar(256) collate latin1_general_ci NOT NULL,
  `active` tinyint(4) NOT NULL,
  `dmodified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`jobl_idno`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `filejobl` */

/*Table structure for table `fileposition` */

DROP TABLE IF EXISTS `fileposition`;

CREATE TABLE `fileposition` (
  `positionid` int(5) NOT NULL auto_increment,
  `position` varchar(150) default NULL,
  `is_delete` tinyint(1) default '0' COMMENT 'if is_delete = 1 this is consider as delete',
  PRIMARY KEY  (`positionid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `fileposition` */

insert  into `fileposition`(`positionid`,`position`,`is_delete`) values (1,'Supervisor',0),(2,'test',1),(3,'Clerk',0),(4,'Programmer',0),(5,'Database Admin',0),(6,'Secretary',0);

/*Table structure for table `fileschool` */

DROP TABLE IF EXISTS `fileschool`;

CREATE TABLE `fileschool` (
  `fileschoolid` int(3) NOT NULL auto_increment,
  `school` varchar(250) default NULL,
  `schooladdress` varchar(255) default NULL,
  `is_delete` tinyint(1) default '0',
  PRIMARY KEY  (`fileschoolid`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

/*Data for the table `fileschool` */

insert  into `fileschool`(`fileschoolid`,`school`,`schooladdress`,`is_delete`) values (1,'Sultan Kudarat Polytechnic State College','Isulan, Sultan Kudarat',0),(2,'STI','Araneta Center, Cubao Quezon City',0),(3,'Rizal Technological University','Cainta Rizal',0),(4,'University of San Carlos','Cebu City',0),(5,'New Era University','No. 9 New Era Avenue, Brgy. New Era, Diliman Q.C',0),(6,'Our Lady of Fatima University','Lagro, Quezon City',0),(7,'De La Salle-Araneta University','Victoneta Ave., Malabon City',0),(8,'STI Cubao','Opulent Bldg cor Edsa Cubao Quezon City',0),(9,'T.I.P Cubao','Aurora Blvd Cubao Quezon CIty',0),(10,'Technological Institute of the Philippines','Cubao, Quezon City',0),(11,'University of La Salette','Dubinan east Santiago City',0),(12,'Lyceum of Batangas','Batangas City',0),(13,'Colegion De San Lorenzo','Congressional Exten. Q.C.',0),(14,'AMA Computer College','Project 8, Quezon City',0),(15,'Arellano University','Legarda,Manila',0),(16,'IETI College of Science and Technology','Marikina City',0),(17,'Bulacan State University','Malolos City, Bulacan',0),(18,'Polytechnic University of the Philippines','Sta. Mesa, Manila',0),(19,'PUP Manila','Sta Mesa, Manila',0),(20,'Colegio de Dagupan','Pangasinan',0),(21,'UST','Manila',0),(22,'T.I.P Q.C.','Quezon City',0),(23,'University of La Salle','Quezon City',0),(24,'Datamex Institute of Computer Technology','Las Pinas',0),(25,'xxxx','street address',1),(26,'testss','tests',1);

/*Table structure for table `filetrainingtype` */

DROP TABLE IF EXISTS `filetrainingtype`;

CREATE TABLE `filetrainingtype` (
  `filetrainingtypeid` int(2) NOT NULL auto_increment,
  `trainingtype` varchar(150) default NULL,
  `is_delete` int(1) default '0',
  PRIMARY KEY  (`filetrainingtypeid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `filetrainingtype` */

insert  into `filetrainingtype`(`filetrainingtypeid`,`trainingtype`,`is_delete`) values (1,'Training',0),(2,'Seminars',0),(3,'test',1),(4,'tests',1),(5,'test training',1);

/*Table structure for table `supplier` */

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier` (
  `SUPPIDNO` int(11) NOT NULL auto_increment,
  `SUPPLIERNAME` varchar(256) NOT NULL,
  `STYPEIDNO` int(11) NOT NULL,
  `ADDRESS01` varchar(256) NOT NULL,
  `ADDRESS02` varchar(256) default NULL,
  `ADDRESS03` varchar(256) default NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `supplier` */

insert  into `supplier`(`SUPPIDNO`,`SUPPLIERNAME`,`STYPEIDNO`,`ADDRESS01`,`ADDRESS02`,`ADDRESS03`,`PHONE`,`FAXNO`,`MOBILE`,`WEBSITE`,`EMAIL`,`LOGO`,`MAP`,`active`,`DMODIFIED`) values (2,'super',0,'ad1','ad2','ad3','1-800-555','21343','1234','sdsdad','sdadad','sdadad','sdsadasd',0,'2010-02-24 09:48:30'),(3,'Nimco',0,'address1','ADDRESS2','ADDRESS3','124','1234','123244','WEBSITE','123244','WEBSITE','email@yahoo.com',1,'2010-03-18 17:30:58'),(4,'ACW Distribution (Phils.), Inc.',0,'23/F The Orient Square','F. Ortigas Jr. Road, Ortigas Center','Pasig City, Philippines','(632) 706-5592','1','(632) 706-5506','http://www.acw-group.com','(632) 706-5506','http://www.acw-group.com','enquiry@acw-group.com.ph',1,'2010-08-20 13:46:20'),(5,'Accent Micro Technologies, Incorporated',0,'14th Floor of Antel Global Corporate Center','Julia Vargas Avenue, Ortigas Centre','Pasig City, Philippines','(632) 323 3888/ ','1','(632) 323 3889/ ','www.amti.com.ph','(632) 323 3889/ 988-9789','www.amti.com.ph','marketing@amti.com.ph',1,'2010-08-20 14:02:08'),(6,'American Technologies, Inc. (ATI)',0,'#5 Ideal St., cor. McCollough','Brgy. Addition Hills','Mandaluyong City, Philippines','(632) 584.0000','1','(632) 584.6868','www.ati.com.ph','(632) 584.6868','www.ati.com.ph','inquiry@ati.com.ph',1,'2010-08-20 14:05:24'),(7,'Anixter International',0,'18/F Multinational Bancorproration Centre','6805 Ayala Avenue','Makati City, Philippines','(632) 845 1570','1','(632) 845 1571','www.anixter.com','(632) 845 1571','www.anixter.com','1',1,'2010-08-20 14:11:52'),(8,'Avesco Marketing Corporation',0,'810 AVESCO Building','Aurora Blvd. corner Yale Street, Cubao','Quezon City, Philippines','(632) 912-8881 t','1','(632) 912-2911 /','www.avesco.com.ph','(632) 912-2911 / 2999 / 2352','www.avesco.com.ph','cubao@avesco.com.ph',1,'2010-08-20 14:14:23'),(9,'Banbros Commercial Inc.',0,'Banbros Corporate Center','No. 32 Pilar cor. Araullo Streets','Addition Hills, San Juan, Metro Manila, Philippines','(632) 727-3009','1','(632) 727-3050 /','www.banbros.ph','(632) 727-3050 / 727-2955','www.banbros.ph','bci_sales@banbros.ph',1,'2010-08-20 14:18:51'),(10,'Bayan Telecommunications Holdings Corporation',0,'Diliman Corporate Center','Bayan Bldg., Malingap cor. Maginhawa Sts.','Teacher\\\'s Village East, Quezon City, Philippines, 1101','(632) 4121212','1','1','www.bayan.com.ph','1','www.bayan.com.ph','1',1,'2010-08-20 14:24:01'),(11,'ComClark Network and Technology Corporation',1,'Reliance Center #99 E.Rodriguez Jr, Ave.','Bo. Ugong Pasig City, Philippines, 1604','','(632) 667-0888','(632) 667-0895','1','www.comclark.com','butch@comclark.com','','1',1,'2010-09-17 16:34:26'),(12,'InfoworX Incorporated',0,'1','1','1','1','1','1','www.worx.com.ph/','1','www.worx.com.ph/','1',1,'2010-08-21 14:27:26'),(13,'Lamco International',1,'Suite 1804 18/F East Tower','PSE Centre Bldg., Exchange Road, Ortigas Center','Pasig City 1605 Philippines','(632) 634-7999 ','1','1','www.lamco.com.ph','info@lamco.com.ph','','1',1,'2010-09-17 16:33:01'),(14,'MSI-ECS Phils., Inc.',1,'Topy II Bldg. ','#3 Economia Street, Libis','Quezon City, 1110, Philippines','(632) 688-3333','(632) 688-3890','1','www.msi-ecs.com.ph','sales@msi-ecs.com.ph','','1',1,'2010-09-17 16:30:42'),(15,'MEC Networks Corporation',1,'23/F 2303 Jollibee Plaza','F.Ortigas Jr. Road, Ortigas Center','Pasig City, 1605, Philippines','(632) 638 9433','(632) 687 2348','1','www.mec.ph','c.guevarra@mec.ph','','1',1,'2010-09-17 16:25:25'),(16,'Saturn Information Technologies, Inc.',1,'Suite 1702 Tower C Gotesco Regency Twin Towers','1129 Concepcion Street, Ermita','Manila, Philippines','(632) 526 7306 ','(632) 526 8710','1','www.saturn.com.ph','sales@saturn.com.ph','','',1,'2010-09-17 16:21:36'),(17,'Microwarehouse, Inc.',1,'4 United Cor. First Sts.','Bgy. Kapitolyo, Pasig City ','Philippines 1600','(632) 637 0474 ','(632) 636 3720','1','www.microwarehouse.com.ph','ifix@microwarehouse.com.ph','','',1,'2010-09-17 16:20:45'),(18,'Mustard Seed Systems Corporation',1,'1001 Summit One Office Tower','530 Shaw Boulevard, Mandaluyong City','Philippines, 1550','(632) 535 7333','(632) 533 2989 ','1','www.mseedsystems.com','sales@mseedsystems.com','','',1,'2010-09-17 16:18:22'),(19,'Comstor Philippines',1,'Unit 2109 Jollibee Plaza','Emarald Ave., Ortigas Centre','Pasig City, Philippines, 1601','(632) 631 2565','1','1','www.comstor.com.ph','sales@comstor.com.ph','','',1,'2010-09-17 16:17:18'),(20,'Wordtext Systems, Inc. (WSI)',1,'7/F SEDCCO I Building, Legaspi Corner Rada Street','Legaspi Village, Makati City','Metro Manila, Philippines, 1229','(632) 858 5555','(632) 817 6430','2','www.wordtext.com.ph','sales@wsiphil.com.ph','','',1,'2010-09-24 17:00:25'),(21,'Xitrix Computer Corporation',1,'Xitrix Corporate Headquarters','23 Detroit Street, Cubao, Quezon City','Metro Manila, Philippines, 1109','(632) 721-9999','(632) 570-8034','1','www.xitrix.net','sales@xitrix.net','','',1,'2010-09-17 16:35:37');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
