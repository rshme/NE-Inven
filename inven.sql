/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.1.34-MariaDB : Database - inventaris
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`inventaris` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `inventaris`;

/*Table structure for table `detail_pinjam` */

DROP TABLE IF EXISTS `detail_pinjam`;

CREATE TABLE `detail_pinjam` (
  `id_detail_pinjam` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_peminjaman` int(10) unsigned NOT NULL,
  `id_inventaris` int(10) unsigned NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_detail_pinjam`),
  KEY `detail_pinjam_id_peminjaman_foreign` (`id_peminjaman`),
  KEY `detail_pinjam_id_inventaris_foreign` (`id_inventaris`),
  CONSTRAINT `detail_pinjam_id_inventaris_foreign` FOREIGN KEY (`id_inventaris`) REFERENCES `inventaris` (`id_inventaris`) ON DELETE CASCADE,
  CONSTRAINT `detail_pinjam_id_peminjaman_foreign` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `detail_pinjam` */

insert  into `detail_pinjam`(`id_detail_pinjam`,`id_peminjaman`,`id_inventaris`,`jumlah`,`created_at`,`updated_at`) values 
(1,1,2,10,'2019-10-12 06:56:44','2019-10-13 10:06:18'),
(5,5,1,10,'2019-10-12 21:59:39','2019-10-13 07:07:31');

/*Table structure for table `inventaris` */

DROP TABLE IF EXISTS `inventaris`;

CREATE TABLE `inventaris` (
  `id_inventaris` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_jenis` int(10) unsigned NOT NULL,
  `id_ruang` int(10) unsigned NOT NULL,
  `id_petugas` int(10) unsigned NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi` enum('baik','rusak_ringan','rusak_parah') COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `kode_inventaris` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_register` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_inventaris`),
  KEY `inventaris_id_jenis_foreign` (`id_jenis`),
  KEY `inventaris_id_ruang_foreign` (`id_ruang`),
  KEY `inventaris_id_petugas_foreign` (`id_petugas`),
  CONSTRAINT `inventaris_id_jenis_foreign` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `inventaris_id_petugas_foreign` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `inventaris_id_ruang_foreign` FOREIGN KEY (`id_ruang`) REFERENCES `ruang` (`id_ruang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `inventaris` */

insert  into `inventaris`(`id_inventaris`,`id_jenis`,`id_ruang`,`id_petugas`,`nama`,`kondisi`,`keterangan`,`jumlah`,`kode_inventaris`,`tanggal_register`,`created_at`,`updated_at`) values 
(1,1,1,1,'Laptop ACER','baik','Membeli di BEC',10,'11-1-1-1-1','2019-10-11','2019-10-12 06:56:43','2019-10-13 10:25:49'),
(2,1,1,1,'Laptop Rog','baik','test',10,'12-1-1-1-2','2019-10-12','2019-10-12 08:02:50','2019-10-13 20:39:53'),
(3,2,2,1,'Meja Guru','baik','as',10,'12-2-2-1-3','2019-10-12','2019-10-12 08:03:20','2019-10-14 14:50:37');

/*Table structure for table `jenis` */

DROP TABLE IF EXISTS `jenis`;

CREATE TABLE `jenis` (
  `id_jenis` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_jenis` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_jenis` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `jenis` */

insert  into `jenis`(`id_jenis`,`nama_jenis`,`kode_jenis`,`keterangan`,`created_at`,`updated_at`) values 
(1,'Elektronik','A34ED4E','Jenis Barang Elektronik','2019-10-12 06:56:43','2019-10-13 16:32:46'),
(2,'Peralatan Kelas','A56ED5D','Jenis Barang Peralatan Kelas','2019-10-12 06:56:43','2019-10-12 06:56:43');

/*Table structure for table `level` */

DROP TABLE IF EXISTS `level`;

CREATE TABLE `level` (
  `id_level` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `level` */

insert  into `level`(`id_level`,`nama_level`,`created_at`,`updated_at`) values 
(1,'Administrator','2019-10-12 06:56:42','2019-10-12 06:56:42'),
(2,'Operator','2019-10-12 06:56:42','2019-10-12 06:56:42');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_10_09_112232_create_levels_table',1),
(4,'2019_10_09_112310_create_petugas_table',1),
(5,'2019_10_09_112342_create_pegawais_table',1),
(6,'2019_10_09_112356_create_ruangs_table',1),
(7,'2019_10_09_112409_create_jenis_table',1),
(8,'2019_10_09_112425_create_peminjamen_table',1),
(9,'2019_10_09_112503_create_inventaris_table',1),
(10,'2019_10_09_114335_create_detail_pinjams_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `pegawai` */

DROP TABLE IF EXISTS `pegawai`;

CREATE TABLE `pegawai` (
  `id_pegawai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_pegawai` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pegawai`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pegawai` */

insert  into `pegawai`(`id_pegawai`,`nama_pegawai`,`nip`,`alamat`,`created_at`,`updated_at`) values 
(1,'Beni Rahayu','21342','Jln.Ahmad Yani No.34 Subang','2019-10-12 06:56:42','2019-10-13 18:54:56'),
(2,'Fani Anggraeni','123243','Jln.Anggrek No.12 Subang','2019-10-12 06:56:43','2019-10-13 18:52:45');

/*Table structure for table `peminjaman` */

DROP TABLE IF EXISTS `peminjaman`;

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_pegawai` int(10) unsigned NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status_peminjaman` enum('belum_kembali','sudah_kembali') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_peminjaman`),
  KEY `peminjaman_id_pegawai_foreign` (`id_pegawai`),
  CONSTRAINT `peminjaman_id_pegawai_foreign` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `peminjaman` */

insert  into `peminjaman`(`id_peminjaman`,`id_pegawai`,`tanggal_pinjam`,`tanggal_kembali`,`status_peminjaman`,`created_at`,`updated_at`) values 
(1,1,'2019-10-12','2019-10-13','sudah_kembali','2019-10-12 06:56:43','2019-10-13 20:39:54'),
(5,2,'2019-10-12','2019-10-13','sudah_kembali','2019-10-12 21:59:39','2019-10-13 10:25:51');

/*Table structure for table `petugas` */

DROP TABLE IF EXISTS `petugas`;

CREATE TABLE `petugas` (
  `id_petugas` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `id_level` int(10) unsigned NOT NULL,
  `nama_petugas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_petugas`),
  KEY `petugas_user_id_foreign` (`user_id`),
  KEY `petugas_id_level_foreign` (`id_level`),
  CONSTRAINT `petugas_id_level_foreign` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`) ON DELETE CASCADE,
  CONSTRAINT `petugas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `petugas` */

insert  into `petugas`(`id_petugas`,`user_id`,`id_level`,`nama_petugas`,`created_at`,`updated_at`) values 
(1,1,1,'Panji Saputra','2019-10-12 06:56:42','2019-10-12 06:56:42'),
(3,4,2,'Emmy Wilson','2019-10-13 22:52:30','2019-10-13 22:52:30');

/*Table structure for table `ruang` */

DROP TABLE IF EXISTS `ruang`;

CREATE TABLE `ruang` (
  `id_ruang` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_ruang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_ruang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_ruang`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `ruang` */

insert  into `ruang`(`id_ruang`,`nama_ruang`,`kode_ruang`,`keterangan`,`created_at`,`updated_at`) values 
(1,'Ruang Elektronika','A349D4D','Ruang Barang Elektronik','2019-10-12 06:56:43','2019-10-13 16:52:54'),
(2,'Ruang Peralatan Kelas','A56RD5D','Ruang Barang Peralatan Kelas','2019-10-12 06:56:43','2019-10-12 06:56:43');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(1,'petugas','$2y$10$8W.A4LMOll5nd8cfkv2iuu.3DT44UjH/viYlRjPHvA9AELBPSVbd.','9pKf9Sw7NfX92LkCXKsPM9zAHlr5gOoXCdIPhA6L9htaF3pPSuLzUXo0EFHW','2019-10-12 06:56:42','2019-10-12 06:56:42'),
(2,'pegawai','$2y$10$oSyQzq4pKh0NpD2fKyCx8ekmz24k3tLvKb0ZhMscrsGJO6KR4YSfG',NULL,'2019-10-12 06:56:42','2019-10-12 06:56:42'),
(4,'petugas2','$2y$10$kVlUhCzWUydb81xVE0AkUuCVMNCOJnUmyMa2M3HdY001JdCUmM96W','lAQ4Fmrc6VZEAj2pMM8MQMdhpVQynA6cJjlxKNHlvksYOohOu6bH7qTAe2tZ','2019-10-13 22:52:30','2019-10-13 22:52:30');

/* Trigger structure for table `detail_pinjam` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `peminjaman` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `peminjaman` AFTER INSERT ON `detail_pinjam` FOR EACH ROW 
    
    BEGIN
    
    UPDATE inventaris.`inventaris` set jumlah = jumlah - NEW.jumlah
    where id_inventaris = NEW.`id_inventaris`;
	
    END */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
