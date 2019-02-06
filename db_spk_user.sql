/*
SQLyog Community v12.2.0 (64 bit)
MySQL - 10.1.19-MariaDB : Database - db_spk_user
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_spk_user` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_spk_user`;

/*Table structure for table `tbl_auth_assignment` */

DROP TABLE IF EXISTS `tbl_auth_assignment`;

CREATE TABLE `tbl_auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `tbl_idx-auth_assignment-user_id` (`user_id`),
  CONSTRAINT `tbl_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `tbl_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_auth_assignment` */

insert  into `tbl_auth_assignment`(`item_name`,`user_id`,`created_at`) values 
('admin-role','1',1549009491),
('dev-role','2',1549009947),
('guest-role','3',1549446580),
('tes-role','4',1549446650);

/*Table structure for table `tbl_auth_item` */

DROP TABLE IF EXISTS `tbl_auth_item`;

CREATE TABLE `tbl_auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `tbl_idx-auth_item-type` (`type`),
  CONSTRAINT `tbl_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `tbl_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_auth_item` */

insert  into `tbl_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values 
('/*',2,NULL,NULL,NULL,1549007879,1549007879),
('/admin/*',2,NULL,NULL,NULL,1549007878,1549007878),
('/admin/assignment/*',2,NULL,NULL,NULL,1549007876,1549007876),
('/admin/assignment/assign',2,NULL,NULL,NULL,1549007876,1549007876),
('/admin/assignment/index',2,NULL,NULL,NULL,1549007876,1549007876),
('/admin/assignment/revoke',2,NULL,NULL,NULL,1549007876,1549007876),
('/admin/assignment/view',2,NULL,NULL,NULL,1549007876,1549007876),
('/admin/default/*',2,NULL,NULL,NULL,1549007876,1549007876),
('/admin/default/index',2,NULL,NULL,NULL,1549007876,1549007876),
('/admin/menu/*',2,NULL,NULL,NULL,1549007876,1549007876),
('/admin/menu/create',2,NULL,NULL,NULL,1549007876,1549007876),
('/admin/menu/delete',2,NULL,NULL,NULL,1549007876,1549007876),
('/admin/menu/index',2,NULL,NULL,NULL,1549007876,1549007876),
('/admin/menu/update',2,NULL,NULL,NULL,1549007876,1549007876),
('/admin/menu/view',2,NULL,NULL,NULL,1549007876,1549007876),
('/admin/permission/*',2,NULL,NULL,NULL,1549007877,1549007877),
('/admin/permission/assign',2,NULL,NULL,NULL,1549007877,1549007877),
('/admin/permission/create',2,NULL,NULL,NULL,1549007877,1549007877),
('/admin/permission/delete',2,NULL,NULL,NULL,1549007877,1549007877),
('/admin/permission/index',2,NULL,NULL,NULL,1549007876,1549007876),
('/admin/permission/remove',2,NULL,NULL,NULL,1549007877,1549007877),
('/admin/permission/update',2,NULL,NULL,NULL,1549007877,1549007877),
('/admin/permission/view',2,NULL,NULL,NULL,1549007877,1549007877),
('/admin/role/*',2,NULL,NULL,NULL,1549007877,1549007877),
('/admin/role/assign',2,NULL,NULL,NULL,1549007877,1549007877),
('/admin/role/create',2,NULL,NULL,NULL,1549007877,1549007877),
('/admin/role/delete',2,NULL,NULL,NULL,1549007877,1549007877),
('/admin/role/index',2,NULL,NULL,NULL,1549007877,1549007877),
('/admin/role/remove',2,NULL,NULL,NULL,1549007877,1549007877),
('/admin/role/update',2,NULL,NULL,NULL,1549007877,1549007877),
('/admin/role/view',2,NULL,NULL,NULL,1549007877,1549007877),
('/admin/route/*',2,NULL,NULL,NULL,1549007877,1549007877),
('/admin/route/assign',2,NULL,NULL,NULL,1549007877,1549007877),
('/admin/route/create',2,NULL,NULL,NULL,1549007877,1549007877),
('/admin/route/index',2,NULL,NULL,NULL,1549007877,1549007877),
('/admin/route/refresh',2,NULL,NULL,NULL,1549007877,1549007877),
('/admin/route/remove',2,NULL,NULL,NULL,1549007877,1549007877),
('/admin/rule/*',2,NULL,NULL,NULL,1549007877,1549007877),
('/admin/rule/create',2,NULL,NULL,NULL,1549007877,1549007877),
('/admin/rule/delete',2,NULL,NULL,NULL,1549007877,1549007877),
('/admin/rule/index',2,NULL,NULL,NULL,1549007877,1549007877),
('/admin/rule/update',2,NULL,NULL,NULL,1549007877,1549007877),
('/admin/rule/view',2,NULL,NULL,NULL,1549007877,1549007877),
('/alternatif/*',2,NULL,NULL,NULL,1549010915,1549010915),
('/alternatif/create',2,NULL,NULL,NULL,1549010915,1549010915),
('/alternatif/delete',2,NULL,NULL,NULL,1549010915,1549010915),
('/alternatif/index',2,NULL,NULL,NULL,1549010914,1549010914),
('/alternatif/update',2,NULL,NULL,NULL,1549010915,1549010915),
('/alternatif/view',2,NULL,NULL,NULL,1549010915,1549010915),
('/debug/*',2,NULL,NULL,NULL,1549007878,1549007878),
('/debug/default/*',2,NULL,NULL,NULL,1549007878,1549007878),
('/debug/default/db-explain',2,NULL,NULL,NULL,1549007878,1549007878),
('/debug/default/download-mail',2,NULL,NULL,NULL,1549007878,1549007878),
('/debug/default/index',2,NULL,NULL,NULL,1549007878,1549007878),
('/debug/default/toolbar',2,NULL,NULL,NULL,1549007878,1549007878),
('/debug/default/view',2,NULL,NULL,NULL,1549007878,1549007878),
('/debug/user/*',2,NULL,NULL,NULL,1549007878,1549007878),
('/debug/user/reset-identity',2,NULL,NULL,NULL,1549007878,1549007878),
('/debug/user/set-identity',2,NULL,NULL,NULL,1549007878,1549007878),
('/gii/*',2,NULL,NULL,NULL,1549007879,1549007879),
('/gii/default/*',2,NULL,NULL,NULL,1549007879,1549007879),
('/gii/default/action',2,NULL,NULL,NULL,1549007878,1549007878),
('/gii/default/diff',2,NULL,NULL,NULL,1549007878,1549007878),
('/gii/default/index',2,NULL,NULL,NULL,1549007878,1549007878),
('/gii/default/preview',2,NULL,NULL,NULL,1549007878,1549007878),
('/gii/default/view',2,NULL,NULL,NULL,1549007878,1549007878),
('/hasil/*',2,NULL,NULL,NULL,1549202228,1549202228),
('/hasil/index',2,NULL,NULL,NULL,1549202228,1549202228),
('/kriteria/*',2,NULL,NULL,NULL,1549012992,1549012992),
('/kriteria/create',2,NULL,NULL,NULL,1549012992,1549012992),
('/kriteria/delete',2,NULL,NULL,NULL,1549012992,1549012992),
('/kriteria/index',2,NULL,NULL,NULL,1549012991,1549012991),
('/kriteria/update',2,NULL,NULL,NULL,1549012992,1549012992),
('/kriteria/view',2,NULL,NULL,NULL,1549012992,1549012992),
('/penilaian/*',2,NULL,NULL,NULL,1549018660,1549018660),
('/penilaian/create',2,NULL,NULL,NULL,1549018660,1549018660),
('/penilaian/delete',2,NULL,NULL,NULL,1549018660,1549018660),
('/penilaian/index',2,NULL,NULL,NULL,1549018659,1549018659),
('/penilaian/update',2,NULL,NULL,NULL,1549018660,1549018660),
('/penilaian/view',2,NULL,NULL,NULL,1549018660,1549018660),
('/site/*',2,NULL,NULL,NULL,1549007879,1549007879),
('/site/about',2,NULL,NULL,NULL,1549007879,1549007879),
('/site/captcha',2,NULL,NULL,NULL,1549007879,1549007879),
('/site/contact',2,NULL,NULL,NULL,1549007879,1549007879),
('/site/error',2,NULL,NULL,NULL,1549007879,1549007879),
('/site/index',2,NULL,NULL,NULL,1549007879,1549007879),
('/site/login',2,NULL,NULL,NULL,1549007879,1549007879),
('/site/logout',2,NULL,NULL,NULL,1549007879,1549007879),
('/spk/*',2,NULL,NULL,NULL,1549010383,1549010383),
('/spk/create',2,NULL,NULL,NULL,1549010382,1549010382),
('/spk/delete',2,NULL,NULL,NULL,1549010383,1549010383),
('/spk/index',2,NULL,NULL,NULL,1549010382,1549010382),
('/spk/update',2,NULL,NULL,NULL,1549010383,1549010383),
('/spk/view',2,NULL,NULL,NULL,1549010382,1549010382),
('/user/*',2,NULL,NULL,NULL,1549009418,1549009418),
('/user/change-password',2,NULL,NULL,NULL,1549010383,1549010383),
('/user/create',2,NULL,NULL,NULL,1549009418,1549009418),
('/user/delete',2,NULL,NULL,NULL,1549009418,1549009418),
('/user/index',2,NULL,NULL,NULL,1549009418,1549009418),
('/user/update',2,NULL,NULL,NULL,1549009418,1549009418),
('/user/view',2,NULL,NULL,NULL,1549009418,1549009418),
('admin-permission',2,'Permission for Administrative Purpose',NULL,NULL,1549009343,1549009343),
('admin-role',1,'Role for Administrative Purpose',NULL,NULL,1549009485,1549009485),
('dev-permission',2,'Permission for Developer',NULL,NULL,1549009515,1549009515),
('dev-role',1,'Role for Developer',NULL,NULL,1549009539,1549009539),
('guest-permission',2,NULL,NULL,NULL,1549009440,1549377088),
('guest-role',1,NULL,NULL,NULL,1549377149,1549377149),
('tes-role',1,NULL,NULL,NULL,1549446631,1549446631);

/*Table structure for table `tbl_auth_item_child` */

DROP TABLE IF EXISTS `tbl_auth_item_child`;

CREATE TABLE `tbl_auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `tbl_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `tbl_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `tbl_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_auth_item_child` */

insert  into `tbl_auth_item_child`(`parent`,`child`) values 
('admin-permission','/admin/*'),
('admin-permission','/alternatif/*'),
('admin-permission','/hasil/*'),
('admin-permission','/kriteria/*'),
('admin-permission','/penilaian/*'),
('admin-permission','/site/*'),
('admin-permission','/spk/*'),
('admin-permission','/user/*'),
('admin-role','admin-permission'),
('dev-permission','/*'),
('dev-role','dev-permission'),
('guest-permission','/alternatif/index'),
('guest-permission','/hasil/index'),
('guest-permission','/kriteria/index'),
('guest-permission','/penilaian/index'),
('guest-permission','/site/*'),
('guest-permission','/spk/index'),
('guest-role','guest-permission'),
('tes-role','guest-role');

/*Table structure for table `tbl_auth_rule` */

DROP TABLE IF EXISTS `tbl_auth_rule`;

CREATE TABLE `tbl_auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_auth_rule` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
