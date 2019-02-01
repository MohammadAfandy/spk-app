/*
SQLyog Community v12.2.0 (64 bit)
MySQL - 10.1.19-MariaDB : Database - db_spk_saw
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_spk_saw` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_spk_saw`;

/*Table structure for table `migration` */

DROP TABLE IF EXISTS `migration`;

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `migration` */

insert  into `migration`(`version`,`apply_time`) values 
('m000000_000000_base',1549005920);

/*Table structure for table `tbl_alternatif` */

DROP TABLE IF EXISTS `tbl_alternatif`;

CREATE TABLE `tbl_alternatif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_alternatif` varchar(100) NOT NULL,
  `keterangan` text,
  `id_spk` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_alternatif` */

insert  into `tbl_alternatif`(`id`,`nama_alternatif`,`keterangan`,`id_spk`,`created_date`,`updated_date`) values 
(2,'Mohammad Afandy','Mohammad Afandy',1,'2019-02-01 16:17:14','2019-02-01 16:20:58'),
(3,'Krisbiyan Nugroho','Krisbiyan Nugroho',1,'2019-02-01 16:21:12','2019-02-01 16:21:12'),
(4,'Dani Putra','Dani Putra',NULL,'2019-02-01 16:21:19','2019-02-01 16:21:19');

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
('dev-role','2',1549009947);

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
('user-permission',2,NULL,NULL,NULL,1549009440,1549009440);

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
('admin-permission','/kriteria/*'),
('admin-permission','/penilaian/*'),
('admin-permission','/site/*'),
('admin-permission','/spk/*'),
('admin-permission','/user/*'),
('admin-role','admin-permission'),
('dev-permission','/*'),
('dev-role','dev-permission');

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

/*Table structure for table `tbl_kriteria` */

DROP TABLE IF EXISTS `tbl_kriteria`;

CREATE TABLE `tbl_kriteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kriteria` varchar(100) NOT NULL,
  `type` int(1) DEFAULT NULL COMMENT '0=cost, 1=benefit',
  `bobot` double NOT NULL DEFAULT '0',
  `id_spk` int(11) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_kriteria` */

insert  into `tbl_kriteria`(`id`,`nama_kriteria`,`type`,`bobot`,`id_spk`,`created_date`,`updated_date`) values 
(1,'Pengalaman Kerja 1',1,0.1,1,'2019-02-01 16:34:02','2019-02-01 17:18:05'),
(2,'Harga',0,0,2,'2019-02-01 16:49:40','2019-02-01 17:18:13'),
(3,'Penampilan 2',1,0.9,1,'2019-02-01 16:50:33','2019-02-01 17:18:05');

/*Table structure for table `tbl_migration` */

DROP TABLE IF EXISTS `tbl_migration`;

CREATE TABLE `tbl_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_migration` */

insert  into `tbl_migration`(`version`,`apply_time`) values 
('m000000_000000_base',1549006560),
('m140506_102106_rbac_init',1549006639),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id',1549006640),
('m180523_151638_rbac_updates_indexes_without_prefix',1549006641);

/*Table structure for table `tbl_penilaian` */

DROP TABLE IF EXISTS `tbl_penilaian`;

CREATE TABLE `tbl_penilaian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_spk` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `penilaian` text NOT NULL COMMENT 'json penilaian',
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_PenilaianPegawai` (`id_alternatif`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_penilaian` */

/*Table structure for table `tbl_penilaian__hapus` */

DROP TABLE IF EXISTS `tbl_penilaian__hapus`;

CREATE TABLE `tbl_penilaian__hapus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_penilaian` int(11) NOT NULL,
  `id_spk` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `penilaian` text NOT NULL COMMENT 'json penilaian',
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_penilaian__hapus` */

/*Table structure for table `tbl_spk` */

DROP TABLE IF EXISTS `tbl_spk`;

CREATE TABLE `tbl_spk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_spk` varchar(250) NOT NULL,
  `keterangan` text,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_spk` */

insert  into `tbl_spk`(`id`,`nama_spk`,`keterangan`,`created_date`,`updated_date`) values 
(1,'Penerimaan Karyawan','Sistem Penunjang Keputusan Penilaian Karyawan','2019-02-01 15:46:13','2019-02-01 15:46:13'),
(2,'Pembelian Handphone','Pembelian Handphone','2019-02-01 16:46:26','2019-02-01 16:46:26');

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password_hash` varchar(250) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `status` smallint(6) DEFAULT '10',
  `auth_key` varchar(250) DEFAULT NULL,
  `password_reset_token` varchar(250) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`id`,`username`,`password_hash`,`email`,`status`,`auth_key`,`password_reset_token`,`created_date`,`updated_date`) values 
(1,'admin','$2y$13$CI7SCLrF8Jn82WmAXc9vh.vECX2vszlNTRfUoq3Oq6HVpV/oWQIr.','admin@spk-saw.com',10,'bCFg6Pr4bXqgeOpVIhaC3PtjQ_EHUdBs',NULL,'2019-02-01 14:46:28','2019-02-01 14:46:28'),
(2,'developer','$2y$13$zjgl/EVWMgxNLXAAglUC4uyisqOaxkEE8h4mVaNZUqNhsfn.U2qie','dev@spk-saw.com',10,'-WO_e6xq8B1jQ15B0QreBWsphVQObkXc',NULL,'2019-02-01 15:27:49','2019-02-01 15:37:40');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
