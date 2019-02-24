/*
SQLyog Community v13.1.1 (64 bit)
MySQL - 10.1.37-MariaDB : Database - db_spk
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_spk` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_spk`;

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
  `id_spk` int(11) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_alternatif_spk` (`id_spk`),
  CONSTRAINT `FK_alternatif_spk` FOREIGN KEY (`id_spk`) REFERENCES `tbl_spk` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_alternatif` */

insert  into `tbl_alternatif`(`id`,`nama_alternatif`,`keterangan`,`id_spk`,`created_date`,`updated_date`) values 
(15,'Membeli mobil box untuk distribusi barang ke gudang','Membeli mobil box untuk distribusi barang ke gudang	',6,'2019-02-03 16:04:01','2019-02-06 11:12:55'),
(16,'Membeli tanah untuk membangun gudang baru','',6,'2019-02-03 16:04:07','2019-02-03 16:10:34'),
(19,'Maintenance sarana teknologi informasi','',6,'2019-02-03 16:04:23','2019-02-23 20:04:18'),
(20,'Pengembangan produk baru','',6,'2019-02-03 16:04:27','2019-02-03 16:10:53'),
(24,'Davolio','',7,'2019-02-03 16:30:02','2019-02-03 16:33:47'),
(25,'Fuller','',7,'2019-02-03 16:30:07','2019-02-03 16:33:52'),
(26,'Leverling','',7,'2019-02-03 16:30:12','2019-02-03 16:34:01'),
(27,'Peacock','',7,'2019-02-03 16:30:19','2019-02-03 16:34:07'),
(31,'Jamet','',7,'2019-02-03 17:21:52','2019-02-03 17:21:52'),
(32,'Syamsul','',7,'2019-02-03 17:22:00','2019-02-03 17:22:00'),
(33,'Dini','',7,'2019-02-03 17:22:04','2019-02-03 17:22:04'),
(34,'Shela','',7,'2019-02-03 17:22:09','2019-02-03 17:22:09'),
(35,'Chelzea','',7,'2019-02-03 17:22:14','2019-02-03 17:22:14'),
(36,'Indra','',8,'2019-02-03 17:24:06','2019-02-03 17:24:06'),
(37,'Icha','',8,'2019-02-03 17:24:11','2019-02-03 17:24:11'),
(38,'Sariati','',8,'2019-02-03 17:24:16','2019-02-03 17:24:16'),
(39,'Yuniska','',8,'2019-02-03 17:24:22','2019-02-03 17:24:22'),
(40,'Meta','',8,'2019-02-03 17:24:27','2019-02-03 17:24:27'),
(41,'Sidah','',8,'2019-02-03 17:24:33','2019-02-03 17:24:33'),
(42,'Sari Madinah','',8,'2019-02-03 17:24:50','2019-02-03 17:24:50'),
(43,'Rozi','',8,'2019-02-03 17:25:03','2019-02-03 17:25:03'),
(44,'Murti','',8,'2019-02-03 17:25:13','2019-02-03 17:25:13'),
(45,'Afandy','',7,'2019-02-05 02:17:42','2019-02-05 02:17:42'),
(46,'Muhidin','',7,'2019-02-05 02:35:48','2019-02-05 02:35:48'),
(59,'Daihatsu','',9,'2019-02-05 15:20:29','2019-02-05 15:20:29'),
(60,'Jessica','',7,'2019-02-05 15:53:08','2019-02-05 15:53:08'),
(63,'Indra','',7,'2019-02-23 14:26:53','2019-02-23 14:26:53'),
(64,'fafaefae','fae',9,'2019-02-23 17:41:31','2019-02-23 17:41:31'),
(65,'faefeafae','w1431',9,'2019-02-23 17:41:36','2019-02-23 17:41:36'),
(66,'Alex','',10,'2019-02-24 20:04:45','2019-02-24 20:04:45'),
(67,'Harvei','',10,'2019-02-24 20:04:50','2019-02-24 20:04:50'),
(68,'Berto','',10,'2019-02-24 20:04:55','2019-02-24 20:04:55'),
(69,'Paska','',10,'2019-02-24 20:04:59','2019-02-24 20:04:59'),
(70,'Zekson','',10,'2019-02-24 20:05:04','2019-02-24 20:05:04'),
(71,'Mhd Iqbal','',10,'2019-02-24 20:05:13','2019-02-24 20:05:13'),
(72,'Yasir','',10,'2019-02-24 20:05:17','2019-02-24 20:05:17'),
(73,'Bayu Baskoro','',11,'2019-02-25 01:25:57','2019-02-25 01:25:57'),
(74,'Agung Nugraha','',11,'2019-02-25 01:26:06','2019-02-25 01:26:06'),
(75,'Andre Novanto','',11,'2019-02-25 01:26:51','2019-02-25 01:26:51'),
(76,'Fuad Sodiq','',11,'2019-02-25 01:27:00','2019-02-25 01:27:00'),
(77,'Deni Waja','',11,'2019-02-25 01:27:07','2019-02-25 01:27:07'),
(78,'Ahmad Jaelani','',11,'2019-02-25 01:27:15','2019-02-25 01:27:15'),
(79,'Dewi Sandra','',11,'2019-02-25 01:27:21','2019-02-25 01:27:21'),
(80,'Shinta Armelia','',11,'2019-02-25 01:27:29','2019-02-25 01:27:29'),
(81,'Ganjar Prasetyo','',11,'2019-02-25 01:27:38','2019-02-25 01:27:38'),
(82,'Dedi Bawen','',11,'2019-02-25 01:29:08','2019-02-25 01:29:08');

/*Table structure for table `tbl_kriteria` */

DROP TABLE IF EXISTS `tbl_kriteria`;

CREATE TABLE `tbl_kriteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kriteria` varchar(100) NOT NULL,
  `type` tinyint(1) DEFAULT NULL COMMENT '0=cost, 1=benefit',
  `bobot` double NOT NULL DEFAULT '0',
  `crips` text COMMENT 'json crips {nama_crips: nilai}',
  `id_spk` int(11) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_kriteria_spk` (`id_spk`),
  CONSTRAINT `FK_kriteria_spk` FOREIGN KEY (`id_spk`) REFERENCES `tbl_spk` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_kriteria` */

insert  into `tbl_kriteria`(`id`,`nama_kriteria`,`type`,`bobot`,`crips`,`id_spk`,`created_date`,`updated_date`) values 
(26,'Harga',0,0,NULL,6,'2019-02-03 16:05:51','2019-02-24 23:26:29'),
(27,'Nilai investasi 10 tahun ke depan',1,0,NULL,6,'2019-02-03 16:06:14','2019-02-24 23:26:29'),
(28,'Daya dukung terhadap produktivitas perusahaan',1,0,'{\"Kurang Mendukung\":\"1\",\"Cukup Mendukung\":\"2\",\"Sangat Mendukung\":\"3\"}',6,'2019-02-03 16:12:44','2019-02-24 23:26:29'),
(29,'Prioritas kebutuhan',0,0,'{\"Sangat Berprioritas\":\"1\",\"Berprioritas\":\"2\",\"Cukup Berprioritas\":\"3\"}',6,'2019-02-03 16:12:54','2019-02-24 23:26:29'),
(30,'Ketersediaan atau kemudahan',1,0,'{\"Sulit Diperoleh\":\"1\",\"Mudah Diperoleh\":\"2\",\"Sangat Mudah Diperoleh\":\"3\"}',6,'2019-02-03 16:13:04','2019-02-24 23:26:29'),
(31,'Penghasilan Keluarga',1,0,'{\"<= Rp 1.000.000\":\"20\",\"<= Rp 1.500.000\":\"40\",\"<= Rp 3.000.000\":\"60\",\"<= Rp 4.500.000\":\"80\",\"> Rp 4.500.000\":\"100\"}',7,'2019-02-03 16:30:52','2019-02-24 23:26:34'),
(33,'Tanggungan Orang Tua',0,0,'{\"1 Orang\":\"20\",\"2 Orang\":\"40\",\"3 Orang\":\"60\",\"4 Orang\":\"80\",\"> 4 Orang\":\"100\"}',7,'2019-02-03 16:31:10','2019-02-24 23:26:34'),
(35,'Nilai',0,0,'{\"< 2,75\\t\":\"20\",\"< 3\":\"40\",\"< 3,25\":\"60\",\"< 3,5\":\"80\",\">= 3,5\":\"100\"}',7,'2019-02-03 16:31:26','2019-02-24 23:26:34'),
(37,'Tingkah Laku',0,0,'{\"Buruk\":\"25\",\"Cukup\":\"50\",\"Baik\":\"75\",\"Sangat Baik\":\"100\"}',7,'2019-02-03 16:45:55','2019-02-24 23:26:34'),
(38,'Penghasilan Orang Tua',0,0.29,'',8,'2019-02-03 17:25:37','2019-02-25 00:47:34'),
(39,'IPK',1,0.11,'',8,'2019-02-03 17:25:44','2019-02-25 00:47:35'),
(40,'Listrik',0,0.19,NULL,8,'2019-02-03 17:25:52','2019-02-25 00:47:35'),
(41,'Tanggungan Orang Tua',1,0.18,'',8,'2019-02-03 17:26:00','2019-02-25 00:47:35'),
(42,'Organisasi',1,0.23,'',8,'2019-02-03 17:26:07','2019-02-25 00:47:35'),
(45,'Organisasi',0,0,'{\"Kurang Aktif\":\"40\",\"Aktif\":\"60\",\"Aktif Banget\":\"80\",\"Sangat Aktif\":\"100\"}',7,'2019-02-05 00:59:04','2019-02-24 23:26:34'),
(46,'Ukuran',0,0,NULL,9,'2019-02-23 20:01:56','2019-02-25 00:36:12'),
(47,'Harga',1,0,NULL,9,'2019-02-23 20:02:04','2019-02-25 00:36:12'),
(48,'tes pengetahuan (wawasan) sistem informasi',1,5,'',10,'2019-02-24 19:52:36','2019-02-25 00:54:07'),
(49,'praktek instalasi jaringan',1,4,'',10,'2019-02-24 19:52:50','2019-02-25 00:54:07'),
(50,'tes kepribadian',1,4,'',10,'2019-02-24 19:52:57','2019-02-25 00:54:07'),
(51,'tes Manjemen Server',1,3,'',10,'2019-02-24 19:53:11','2019-02-25 00:54:07'),
(58,'IPK',1,3,'{\"3.00 - 3.24\":\"1\",\"3.25 - 3.49\":\"2\",\"3.50 - 3.74\":\"3\",\"3.75 - 3.89\":\"4\",\"3.90 - 4.00\":\"5\"}',11,'2019-02-25 01:29:23','2019-02-25 01:45:51'),
(59,'Pendidikan',1,4,'{\"SMA\":\"1\",\"D1\":\"2\",\"D3\":\"3\",\"S1\":\"4\",\"S2\":\"5\"}',11,'2019-02-25 01:29:40','2019-02-25 01:45:51'),
(60,'Pengalaman Kerja',1,5,'{\"0 Tahun\":\"1\",\"1 Tahun\":\"2\",\"2 Tahun\":\"3\",\"3 Tahun\":\"4\",\">3 Tahun\":\"5\"}',11,'2019-02-25 01:29:48','2019-02-25 01:45:51'),
(61,'Usia',1,5,'{\"18 - 20\":\"1\",\"21 - 22\":\"2\",\"23 - 24\":\"3\",\"25 - 26\":\"4\",\"27 - 28\":\"5\"}',11,'2019-02-25 01:30:22','2019-02-25 01:45:51'),
(62,'Tes Tulis',1,4,'{\"50 - 60\":\"1\",\"61 - 70\":\"2\",\"71 - 80\":\"3\",\"81 - 90\":\"4\",\"91 - 100\":\"5\"}',11,'2019-02-25 01:30:32','2019-02-25 01:45:51'),
(63,'Tes Psikotes',1,4,'{\"50 - 60\":\"1\",\"61 - 70\":\"2\",\"71 - 80\":\"3\",\"81 - 90\":\"4\",\"91 - 100\":\"5\"}',11,'2019-02-25 01:30:39','2019-02-25 01:45:51'),
(64,'Kesehatan',1,4,'{\"Tidak Sehat\":\"1\",\"Kurang Sehat\":\"2\",\"Sehat\":\"3\",\"Sangat Sehat\":\"4\"}',11,'2019-02-25 01:30:49','2019-02-25 01:45:51'),
(65,'Wawancara',1,3,'{\"Kurang\":\"1\",\"Cukup\":\"2\",\"Baik\":\"3\"}',11,'2019-02-25 01:30:57','2019-02-25 01:45:51');

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
  KEY `FK_PenilaianPegawai` (`id_alternatif`),
  KEY `FK_penilaian_spk` (`id_spk`),
  CONSTRAINT `FK_penilaian_alternatif` FOREIGN KEY (`id_alternatif`) REFERENCES `tbl_alternatif` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_penilaian_spk` FOREIGN KEY (`id_spk`) REFERENCES `tbl_spk` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_penilaian` */

insert  into `tbl_penilaian`(`id`,`id_spk`,`id_alternatif`,`penilaian`,`created_date`,`updated_date`) values 
(28,6,15,'{\"26\":\"150000000\",\"27\":\"15\",\"28\":\"2\",\"29\":\"2\",\"30\":\"3\"}',NULL,NULL),
(29,6,16,'{\"26\":\"500000000\",\"27\":\"200\",\"28\":\"2\",\"29\":\"3\",\"30\":\"2\"}',NULL,NULL),
(30,6,19,'{\"26\":\"200000000\",\"27\":\"10\",\"28\":\"3\",\"29\":\"1\",\"30\":\"3\"}',NULL,NULL),
(31,6,20,'{\"26\":\"350000000\",\"27\":\"100\",\"28\":\"3\",\"29\":\"1\",\"30\":\"2\"}',NULL,NULL),
(32,7,24,'{\"31\":\"100\",\"33\":\"20\",\"35\":\"80\",\"37\":\"50\",\"45\":\"80\"}',NULL,'2019-02-23 23:45:39'),
(33,7,25,'{\"31\":\"40\",\"33\":\"40\",\"35\":\"40\",\"37\":\"75\",\"45\":\"80\"}',NULL,'2019-02-23 17:07:09'),
(38,8,37,'{\"38\":\"1\",\"39\":\"4\",\"40\":\"4\",\"41\":\"3\",\"42\":\"2\"}',NULL,NULL),
(39,8,38,'{\"38\":\"1\",\"39\":\"4\",\"40\":\"4\",\"41\":\"3\",\"42\":\"2\"}',NULL,NULL),
(40,8,39,'{\"38\":\"1\",\"39\":\"4\",\"40\":\"3\",\"41\":\"4\",\"42\":\"2\"}',NULL,NULL),
(41,8,40,'{\"38\":\"1\",\"39\":\"4\",\"40\":\"4\",\"41\":\"3\",\"42\":\"4\"}',NULL,NULL),
(43,8,41,'{\"38\":\"4\",\"39\":\"4\",\"40\":\"4\",\"41\":\"1\",\"42\":\"1\"}',NULL,NULL),
(44,8,42,'{\"38\":\"1\",\"39\":\"5\",\"40\":\"3\",\"41\":\"1\",\"42\":\"2\"}',NULL,NULL),
(45,8,43,'{\"38\":\"2\",\"39\":\"4\",\"40\":\"3\",\"41\":\"1\",\"42\":\"1\"}',NULL,NULL),
(46,8,44,'{\"38\":\"4\",\"39\":\"4\",\"40\":\"3\",\"41\":\"3\",\"42\":\"2\"}',NULL,NULL),
(49,7,35,'{\"31\":\"100\",\"33\":\"100\",\"35\":\"100\",\"37\":\"100\",\"45\":\"40\"}',NULL,'2019-02-23 17:07:09'),
(50,7,33,'{\"31\":\"60\",\"33\":\"60\",\"35\":\"40\",\"37\":\"75\",\"45\":\"60\"}',NULL,'2019-02-23 17:07:09'),
(51,7,34,'{\"31\":\"80\",\"33\":\"60\",\"35\":\"80\",\"37\":\"100\",\"45\":\"40\"}',NULL,'2019-02-23 17:07:09'),
(54,7,27,'{\"31\":\"40\",\"33\":\"80\",\"35\":\"20\",\"37\":\"75\",\"45\":\"60\"}',NULL,'2019-02-23 17:07:10'),
(55,7,45,'{\"31\":\"20\",\"33\":\"20\",\"35\":\"100\",\"37\":\"75\",\"45\":\"60\"}',NULL,'2019-02-23 17:07:10'),
(56,7,46,'{\"31\":\"40\",\"33\":\"60\",\"35\":\"40\",\"37\":\"50\",\"45\":\"40\"}',NULL,'2019-02-23 17:07:10'),
(69,7,60,'{\"31\":\"100\",\"33\":\"100\",\"35\":\"100\",\"37\":\"25\",\"45\":\"60\"}','2019-02-05 15:56:53','2019-02-23 17:07:10'),
(70,7,32,'{\"31\":\"40\",\"33\":\"60\",\"35\":\"40\",\"37\":\"50\",\"45\":\"60\"}','2019-02-05 21:26:38','2019-02-23 17:07:10'),
(71,7,31,'{\"31\":\"40\",\"33\":\"80\",\"35\":\"60\",\"37\":\"25\",\"45\":\"60\"}','2019-02-23 14:17:49','2019-02-23 17:07:10'),
(72,9,64,'{\"46\":\"100\",\"47\":\"100\"}','2019-02-23 20:02:30','2019-02-23 20:02:30'),
(73,9,59,'{\"46\":\"100\",\"47\":\"100\"}','2019-02-23 20:02:35','2019-02-23 20:02:35'),
(74,9,65,'{\"46\":\"100\",\"47\":\"100\"}','2019-02-23 20:02:41','2019-02-23 20:02:41'),
(75,10,66,'{\"48\":\"70\",\"49\":\"80\",\"50\":\"77\",\"51\":\"65\"}','2019-02-24 20:05:51','2019-02-25 00:59:03'),
(76,10,67,'{\"48\":\"83\",\"49\":\"67\",\"50\":\"72\",\"51\":\"80\"}','2019-02-24 20:06:10','2019-02-25 00:59:46'),
(77,10,68,'{\"48\":\"78\",\"49\":\"72\",\"50\":\"75\",\"51\":\"79\"}','2019-02-24 20:06:26','2019-02-25 00:59:59'),
(78,10,69,'{\"48\":\"79\",\"49\":\"82\",\"50\":\"80\",\"51\":\"67\"}','2019-02-24 20:06:41','2019-02-25 01:00:17'),
(79,10,70,'{\"48\":\"82\",\"49\":\"79\",\"50\":\"79\",\"51\":\"78\"}','2019-02-24 20:06:56','2019-02-25 01:00:31'),
(80,10,71,'{\"48\":\"80\",\"49\":\"77\",\"50\":\"77\",\"51\":\"77\"}','2019-02-24 20:07:12','2019-02-25 01:00:54'),
(81,10,72,'{\"48\":\"79\",\"49\":\"81\",\"50\":\"80\",\"51\":\"69\"}','2019-02-24 20:07:27','2019-02-25 01:01:12'),
(82,11,73,'{\"58\":\"1\",\"59\":\"4\",\"60\":\"2\",\"61\":\"4\",\"62\":\"1\",\"63\":\"3\",\"64\":\"3\",\"65\":\"3\"}','2019-02-25 01:39:46','2019-02-25 01:39:46'),
(83,11,74,'{\"58\":\"2\",\"59\":\"4\",\"60\":\"1\",\"61\":\"2\",\"62\":\"2\",\"63\":\"3\",\"64\":\"3\",\"65\":\"3\"}','2019-02-25 01:40:20','2019-02-25 01:40:20'),
(84,11,75,'{\"58\":\"1\",\"59\":\"3\",\"60\":\"2\",\"61\":\"3\",\"62\":\"2\",\"63\":\"2\",\"64\":\"4\",\"65\":\"3\"}','2019-02-25 01:40:56','2019-02-25 01:40:56'),
(85,11,76,'{\"58\":\"1\",\"59\":\"3\",\"60\":\"2\",\"61\":\"2\",\"62\":\"3\",\"63\":\"4\",\"64\":\"2\",\"65\":\"3\"}','2019-02-25 01:41:25','2019-02-25 01:48:12'),
(86,11,77,'{\"58\":\"1\",\"59\":\"4\",\"60\":\"3\",\"61\":\"3\",\"62\":\"3\",\"63\":\"3\",\"64\":\"3\",\"65\":\"3\"}','2019-02-25 01:41:58','2019-02-25 01:41:58');

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
  `jenis_bobot` tinyint(1) DEFAULT '0' COMMENT '0=preferensi, 1=persen',
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_spk` */

insert  into `tbl_spk`(`id`,`nama_spk`,`keterangan`,`jenis_bobot`,`created_date`,`updated_date`) values 
(6,'Investasi Perusahaan','SPK untuk menentukan Investasi Perusahaan',1,'2019-02-03 16:03:32','2019-02-03 16:09:51'),
(7,'Beasiswa Mahasiswa','SPK untuk menentukan mahasiswa yang menerima beasiswa',1,'2019-02-03 16:29:11','2019-02-03 16:29:11'),
(8,'Penerimaan Mahasiswa Baru','SPK untuk penerimaan mahasiswa baru',1,'2019-02-03 17:23:54','2019-02-25 00:47:34'),
(9,'Pembelian Mobil','SPK Pembelian Mobil',0,'2019-02-05 02:56:17','2019-02-25 00:36:05'),
(10,'Pemilihan Kepala Lab Komputer','Sistem Pendukung Keputusan Pemilihan Kepala Lab Komputer',0,'2019-02-24 19:51:38','2019-02-25 00:48:44'),
(11,'Seleksi Calon Karyawan di BPJS Kesehatan Tasikmalaya','',0,'2019-02-25 01:25:26','2019-02-25 01:25:26');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`id`,`username`,`password_hash`,`email`,`status`,`auth_key`,`password_reset_token`,`created_date`,`updated_date`) values 
(1,'admin','$2y$13$CI7SCLrF8Jn82WmAXc9vh.vECX2vszlNTRfUoq3Oq6HVpV/oWQIr.','admin@spk-saw.com',10,'bCFg6Pr4bXqgeOpVIhaC3PtjQ_EHUdBs',NULL,'2019-02-01 14:46:28','2019-02-01 14:46:28'),
(2,'developer','$2y$13$zjgl/EVWMgxNLXAAglUC4uyisqOaxkEE8h4mVaNZUqNhsfn.U2qie','dev@spk-saw.com',10,'-WO_e6xq8B1jQ15B0QreBWsphVQObkXc',NULL,'2019-02-01 15:27:49','2019-02-05 16:11:04'),
(3,'guest','$2y$13$CNhk6txvbMy.AO/nWkKMLuQ576FQy.50bGY2mTFj.gsST4Anl/jii','guest@spk-app.com',10,'-cGALJaSAADGx_s_Hh629dyJ50qr8lsu',NULL,'2019-02-05 21:27:57','2019-02-05 21:27:57'),
(4,'tes_user','$2y$13$3NkINrgSYsD04YpLw9/D7e1Z5UDsIcA5JDU122dwASD0EuPz5nQLa','pandi@gmail.com',10,'rTtEFoMq-qwZm6FMPmdApRacdH4JGTGX',NULL,'2019-02-06 16:50:01','2019-02-06 16:50:01');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
