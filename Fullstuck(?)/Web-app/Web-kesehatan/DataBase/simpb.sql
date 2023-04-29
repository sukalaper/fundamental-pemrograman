/*
Navicat MySQL Data Transfer

Source Server         : MYSQL
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : simpb

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-06-22 22:59:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for detail_insiden
-- ----------------------------
DROP TABLE IF EXISTS `detail_insiden`;
CREATE TABLE `detail_insiden` (
  `id_detail_insiden` int(11) NOT NULL AUTO_INCREMENT,
  `id_insiden` int(11) DEFAULT NULL,
  `nama_korban` varchar(255) DEFAULT NULL,
  `alamat_korban` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `umur` varchar(255) DEFAULT NULL,
  `kondisi` varchar(255) DEFAULT NULL,
  `id_rujuk` int(11) DEFAULT NULL,
  `tindakan` varchar(255) DEFAULT NULL,
  `rawat` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_detail_insiden`),
  KEY `f_insiden` (`id_insiden`),
  KEY `f_rujuk` (`id_rujuk`),
  CONSTRAINT `f_insiden` FOREIGN KEY (`id_insiden`) REFERENCES `insiden` (`id_insiden`),
  CONSTRAINT `f_rujuk` FOREIGN KEY (`id_rujuk`) REFERENCES `rujuk` (`id_rujuk`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of detail_insiden
-- ----------------------------
INSERT INTO `detail_insiden` VALUES ('1', '1', 'Rere', 'Kp Sawah Jawa Timur', 'P', '4', 'Luka Ringan', '0', 'Perban', 'T', 'baim', null, '2016-06-21 12:35:20', '2016-06-21 12:36:14');
INSERT INTO `detail_insiden` VALUES ('2', '1', 'Robi', 'Kp Dadap tangerang', 'L', '8', 'Luka Sedang', '0', 'Perban', 'T', 'baim', null, '2016-06-21 12:38:34', '2016-06-21 12:39:37');
INSERT INTO `detail_insiden` VALUES ('3', '3', 'Wondo', 'bandung selatan', 'L', '32', 'Luka Berat', '5', 'Perban', 'Y', 'baim', null, '2016-06-21 21:10:16', '2016-06-21 21:10:16');
INSERT INTO `detail_insiden` VALUES ('4', '2', 'Ratiuh', 'Jawa timur', 'P', '25', 'Luka Sedang', '2', 'Perban', 'Y', 'baim', null, '2016-06-21 21:11:57', '2016-06-22 22:16:02');
INSERT INTO `detail_insiden` VALUES ('5', '5', 'Juned', 'Kp Pasir angka', 'L', '40', 'Luka Ringan', '0', 'Perban', 'T', 'adji', null, '2016-06-22 21:26:10', '2016-06-22 21:26:10');
INSERT INTO `detail_insiden` VALUES ('6', '4', 'Titin', 'Jl Kadu Jaya', 'P', '5', 'Luka Ringan', '0', 'Perban', 'T', 'adji', null, '2016-06-22 22:00:26', '2016-06-22 22:00:26');

-- ----------------------------
-- Table structure for diagnosa
-- ----------------------------
DROP TABLE IF EXISTS `diagnosa`;
CREATE TABLE `diagnosa` (
  `id_diagnosa` int(11) NOT NULL AUTO_INCREMENT,
  `nama_diagnosa` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id_diagnosa`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of diagnosa
-- ----------------------------
INSERT INTO `diagnosa` VALUES ('1', 'ISPA & Gangguan Pernafasan', '2016-04-30 15:21:40', '2016-05-27 20:06:38', 'baim', 'admin');
INSERT INTO `diagnosa` VALUES ('3', 'Hipertsi', '2016-04-30 15:27:41', '2016-05-27 20:06:58', 'baim', 'admin');
INSERT INTO `diagnosa` VALUES ('4', 'Gastritis & Dyspepsia', '2016-05-08 11:24:33', '2016-05-27 20:07:42', 'baim', 'admin');
INSERT INTO `diagnosa` VALUES ('5', 'Diare', '2016-05-27 20:07:54', '2016-05-27 20:07:54', 'admin', null);
INSERT INTO `diagnosa` VALUES ('6', 'Myalgia - Fatigue', '2016-05-27 20:08:27', '2016-05-27 20:08:27', 'admin', null);
INSERT INTO `diagnosa` VALUES ('7', 'Conjungtivitis & Iritasi Mata', '2016-05-27 20:08:54', '2016-05-27 20:08:54', 'admin', null);
INSERT INTO `diagnosa` VALUES ('8', 'Obs.Febris', '2016-05-27 20:09:04', '2016-05-27 20:09:04', 'admin', null);
INSERT INTO `diagnosa` VALUES ('9', 'Dermatitis', '2016-05-27 20:09:14', '2016-05-27 20:09:14', 'admin', null);
INSERT INTO `diagnosa` VALUES ('10', 'Jantung', '2016-05-27 20:09:20', '2016-05-27 20:09:20', 'admin', null);
INSERT INTO `diagnosa` VALUES ('11', 'Cephalgia', '2016-05-27 20:09:31', '2016-05-27 20:09:31', 'admin', null);
INSERT INTO `diagnosa` VALUES ('12', 'Sakit Gigi', '2016-05-27 20:09:43', '2016-05-27 20:09:43', 'admin', null);
INSERT INTO `diagnosa` VALUES ('13', 'GE', '2016-05-27 20:09:47', '2016-05-27 20:09:47', 'admin', null);
INSERT INTO `diagnosa` VALUES ('14', 'Feringitis', '2016-05-27 20:09:58', '2016-05-27 20:09:58', 'admin', null);
INSERT INTO `diagnosa` VALUES ('15', 'Anemia', '2016-05-27 20:10:06', '2016-05-27 20:10:06', 'admin', null);
INSERT INTO `diagnosa` VALUES ('16', 'Tonsilitis', '2016-05-27 20:10:17', '2016-05-27 20:10:17', 'admin', null);
INSERT INTO `diagnosa` VALUES ('17', 'Parotitis', '2016-05-27 20:10:30', '2016-05-27 20:10:30', 'admin', null);
INSERT INTO `diagnosa` VALUES ('18', 'Kolil Abdomen', '2016-05-27 20:10:46', '2016-05-27 20:10:46', 'admin', null);
INSERT INTO `diagnosa` VALUES ('19', 'Antralgia', '2016-05-27 20:11:01', '2016-05-27 20:11:01', 'admin', null);
INSERT INTO `diagnosa` VALUES ('20', 'Vulnus Lavelatum', '2016-05-27 20:11:19', '2016-05-27 20:11:19', 'admin', null);
INSERT INTO `diagnosa` VALUES ('21', 'Dll', '2016-05-27 20:11:34', '2016-05-27 20:11:34', 'admin', null);

-- ----------------------------
-- Table structure for insiden
-- ----------------------------
DROP TABLE IF EXISTS `insiden`;
CREATE TABLE `insiden` (
  `id_insiden` int(11) NOT NULL AUTO_INCREMENT,
  `id_kecelakaan` int(11) DEFAULT NULL,
  `tgl_insiden` date DEFAULT NULL,
  `jam` varchar(225) DEFAULT NULL,
  `alamat_insiden` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(225) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_poskotis` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_insiden`),
  KEY `f_kecelakaan` (`id_kecelakaan`),
  KEY `f_users` (`created_by`) USING BTREE,
  KEY `f_poskotis` (`id_poskotis`),
  CONSTRAINT `f_kecelakaan` FOREIGN KEY (`id_kecelakaan`) REFERENCES `kecelakaan` (`id_kecelakaan`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of insiden
-- ----------------------------
INSERT INTO `insiden` VALUES ('1', '1', '2016-06-21', '08:00', 'Jl Raya Serang Km 21 Cikupa', 'baim', null, '2016-06-21 12:34:06', '2016-06-21 12:34:06', '2');
INSERT INTO `insiden` VALUES ('2', '2', '2016-06-21', '09:00', 'Jl. Raya Serang Km 45', 'baim', 'baim', '2016-06-21 12:40:34', '2016-06-21 12:41:10', '2');
INSERT INTO `insiden` VALUES ('3', '1', '2016-06-21', '10:00', 'Jl. Raya Serang Km 78 Serang', 'baim', null, '2016-06-21 21:09:25', '2016-06-21 21:09:25', '2');
INSERT INTO `insiden` VALUES ('4', '8', '2016-06-08', '07:00', 'Jl raya Serang ', 'adji', null, '2016-06-22 00:53:04', '2016-06-22 00:53:04', '7');
INSERT INTO `insiden` VALUES ('5', '7', '2016-06-22', '10:00', 'Jl Raya serang', 'adji', null, '2016-06-22 21:25:26', '2016-06-22 21:25:26', '7');

-- ----------------------------
-- Table structure for kecelakaan
-- ----------------------------
DROP TABLE IF EXISTS `kecelakaan`;
CREATE TABLE `kecelakaan` (
  `id_kecelakaan` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_kecelakaan` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_kecelakaan`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kecelakaan
-- ----------------------------
INSERT INTO `kecelakaan` VALUES ('1', 'R4 VS R4', 'Roda 2 ( Mobil ) dengan Roda 4 ( Motor )', 'admin', '0000-00-00 00:00:00', '2016-05-27 21:43:09', '2016-05-27 21:53:38');
INSERT INTO `kecelakaan` VALUES ('2', 'R4 VS R2', 'Roda 4 ( Mobil ) dengan Roda 2 ( Motor )', 'admin', null, '2016-05-27 21:44:51', '2016-05-27 21:44:51');
INSERT INTO `kecelakaan` VALUES ('3', 'R2 VS R2', 'Roda 2 ( Motor ) dengan Roda 2 ( Motor )', 'admin', null, '2016-05-27 21:45:38', '2016-05-27 21:45:38');
INSERT INTO `kecelakaan` VALUES ('4', 'R4 VS Pejalan Kaki', 'Roda 4 ( mobil ) dengan Pejalan Kaki', 'admin', null, '2016-05-27 21:46:09', '2016-05-27 21:46:09');
INSERT INTO `kecelakaan` VALUES ('5', 'R2 VS Pejalan Kaki', 'Roda 2 ( Motor ) dengan Pejalanan kaki', 'admin', null, '2016-05-27 21:46:36', '2016-05-27 21:46:36');
INSERT INTO `kecelakaan` VALUES ('6', 'R4 Tunggal', 'Kecelakaan Mobil Tunggal', 'admin', null, '2016-05-27 21:47:04', '2016-05-27 21:47:04');
INSERT INTO `kecelakaan` VALUES ('7', 'R2 Tunggal', 'kecelakaan Motor Tunggal', 'admin', null, '2016-05-27 21:47:18', '2016-05-27 21:47:18');
INSERT INTO `kecelakaan` VALUES ('8', 'R4 VS Bus', 'Roda 4 ( Mini Bus Mobil ) dengan Bus', 'admin', null, '2016-05-27 21:47:50', '2016-05-27 21:47:50');
INSERT INTO `kecelakaan` VALUES ('9', 'R2 VS Bus', 'Roda 2 ( Motor ) dengan Bus', 'admin', null, '2016-05-27 21:48:12', '2016-05-27 21:48:12');
INSERT INTO `kecelakaan` VALUES ('10', 'Bus Tunggal', 'Kecelakaan Bus', 'baim', null, '2016-06-12 15:26:28', '2016-06-12 15:26:28');
INSERT INTO `kecelakaan` VALUES ('11', 'Bus VS Pejalan Kaki', 'Bus Dengan Pejalan Kaki', 'baim', null, '2016-06-12 15:26:59', '2016-06-12 15:26:59');

-- ----------------------------
-- Table structure for pelkes
-- ----------------------------
DROP TABLE IF EXISTS `pelkes`;
CREATE TABLE `pelkes` (
  `id_pelkes` int(11) NOT NULL AUTO_INCREMENT,
  `nama_korban` varchar(255) DEFAULT NULL,
  `tgl_pemeriksaan` date DEFAULT NULL,
  `alamat_korban` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `umur` varchar(255) DEFAULT NULL,
  `id_rujuk` int(11) DEFAULT NULL,
  `id_diagnosa` int(11) DEFAULT NULL,
  `tindakan` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(225) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_poskotis` int(11) DEFAULT NULL,
  `kondisi` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pelkes`),
  KEY `f_poskotis` (`id_poskotis`),
  KEY `f_diagnosa` (`id_diagnosa`),
  KEY `f_rujuk` (`id_rujuk`),
  CONSTRAINT `f_diagnosa` FOREIGN KEY (`id_diagnosa`) REFERENCES `diagnosa` (`id_diagnosa`),
  CONSTRAINT `f_poskotis` FOREIGN KEY (`id_poskotis`) REFERENCES `poskotis` (`id_poskotis`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pelkes
-- ----------------------------
INSERT INTO `pelkes` VALUES ('1', 'Santo', '2016-06-18', 'Jl Raya Kembangan Jakarta', 'L', '4', '0', '3', 'Obat', 'baim', '2016-06-21 21:41:07', null, '2016-06-22 00:57:03', '6', null);
INSERT INTO `pelkes` VALUES ('2', 'Liusan', '2016-06-17', 'Purwokerto Jawa', 'P', '4', '1', '5', 'Obat', 'baim', '2016-06-21 21:41:41', 'baim', '2016-06-22 22:28:01', '14', 'Rawat Jalan');
INSERT INTO `pelkes` VALUES ('3', 'Gogo', '2016-06-07', 'Jl. Pesanggarahan', 'L', '8', '3', '3', 'Obat', 'baim', '2016-06-21 21:43:02', 'baim', '2016-06-22 22:29:26', '14', '');
INSERT INTO `pelkes` VALUES ('4', 'Lala', '2016-06-08', 'Jakarta', 'P', '4', '0', '6', 'h', 'baim', '2016-06-22 00:29:45', 'baim', '2016-06-22 22:28:30', '14', 'Rawat Jalan');

-- ----------------------------
-- Table structure for poskotis
-- ----------------------------
DROP TABLE IF EXISTS `poskotis`;
CREATE TABLE `poskotis` (
  `id_poskotis` int(11) NOT NULL AUTO_INCREMENT,
  `alamat` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(225) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_poskotis`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of poskotis
-- ----------------------------
INSERT INTO `poskotis` VALUES ('1', 'Dinas Kesehatan Kab. Tangerang', 'baim', 'baim', '2016-05-24 21:43:03', '2016-05-24 22:30:11');
INSERT INTO `poskotis` VALUES ('2', 'Depan Mall Karawaci', 'admin', null, '2016-05-27 14:45:34', '2016-05-27 14:45:34');
INSERT INTO `poskotis` VALUES ('3', 'Pertigaan Bitung', 'admin', null, '2016-05-27 14:45:42', '2016-05-27 14:45:42');
INSERT INTO `poskotis` VALUES ('4', 'Depan Gerbang Citra Raya', 'admin', null, '2016-05-27 14:45:53', '2016-05-27 14:45:53');
INSERT INTO `poskotis` VALUES ('5', 'Depan Gerbang Telaga Bestari', 'admin', null, '2016-05-27 14:46:18', '2016-05-27 14:46:18');
INSERT INTO `poskotis` VALUES ('6', 'Pertigaan Pintu Tol Balaraja Barat', 'admin', null, '2016-05-27 14:46:36', '2016-05-27 14:46:36');
INSERT INTO `poskotis` VALUES ('7', 'Pertigaan Jayanti', 'admin', null, '2016-05-27 14:46:48', '2016-05-27 14:46:48');
INSERT INTO `poskotis` VALUES ('8', 'Jl. Raya Kuta Bumi', 'admin', null, '2016-05-27 14:47:12', '2016-05-27 14:47:12');
INSERT INTO `poskotis` VALUES ('9', 'Depan Wihara  CHO SHU KHONG, Tanjung Kait', 'admin', null, '2016-05-27 14:47:42', '2016-05-27 14:47:42');
INSERT INTO `poskotis` VALUES ('10', 'Tanjung Pasir', 'admin', null, '2016-05-27 14:47:51', '2016-05-27 14:47:51');
INSERT INTO `poskotis` VALUES ('11', 'Objek Wisata Pulo Cangkir', 'admin', null, '2016-05-27 14:48:15', '2016-05-27 14:48:15');
INSERT INTO `poskotis` VALUES ('12', 'Depan Mall AEON', 'admin', null, '2016-05-27 14:48:30', '2016-05-27 14:48:30');
INSERT INTO `poskotis` VALUES ('13', 'Depan Mall Sumarecon', 'admin', null, '2016-05-27 14:48:45', '2016-05-27 14:48:45');
INSERT INTO `poskotis` VALUES ('14', '-', 'baim', null, '2016-06-22 00:32:43', '2016-06-22 00:32:43');

-- ----------------------------
-- Table structure for rujuk
-- ----------------------------
DROP TABLE IF EXISTS `rujuk`;
CREATE TABLE `rujuk` (
  `id_rujuk` int(11) NOT NULL AUTO_INCREMENT,
  `nama_rujuk` varchar(255) NOT NULL,
  `alamat_rujuk` varchar(255) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(225) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `inisial` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_rujuk`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rujuk
-- ----------------------------
INSERT INTO `rujuk` VALUES ('0', '-', '-', 'admin', null, '2016-06-04 22:28:00', '2016-06-22 00:03:31', null);
INSERT INTO `rujuk` VALUES ('1', 'RSU Tangerang', 'Tangerang', 'admin', 'admin', '2016-05-27 20:31:57', '2016-06-21 23:38:37', 'a');
INSERT INTO `rujuk` VALUES ('2', 'RSU Balaraja', 'Balaraja', 'admin', null, '2016-05-27 20:32:44', '2016-06-21 23:38:37', 'a');
INSERT INTO `rujuk` VALUES ('3', 'Siloam Hospital', 'Karawaci', 'admin', null, '2016-05-27 20:33:05', '2016-06-21 23:38:38', 'a');
INSERT INTO `rujuk` VALUES ('4', 'RS Sitanala', 'Tangerang', 'admin', null, '2016-05-27 20:33:18', '2016-06-21 23:38:38', 'a');
INSERT INTO `rujuk` VALUES ('5', 'RS Qadr', 'Balaraja', 'admin', null, '2016-05-27 20:33:33', '2016-06-21 23:38:38', 'a');
INSERT INTO `rujuk` VALUES ('6', 'RS Paramita', 'Balaraja', 'admin', null, '2016-05-27 20:33:47', '2016-06-21 23:38:38', 'a');
INSERT INTO `rujuk` VALUES ('7', 'RS Selaras', 'Bojong Cikupa', 'admin', null, '2016-05-27 20:34:08', '2016-06-21 23:38:39', 'a');
INSERT INTO `rujuk` VALUES ('8', 'RS Mulia Insani', 'Cikupa', 'admin', null, '2016-05-27 20:34:30', '2016-06-21 23:38:39', 'a');
INSERT INTO `rujuk` VALUES ('9', 'Puskesmas Balaraja', 'Balaraja', 'admin', null, '2016-05-27 20:35:03', '2016-06-21 23:38:46', 'b');
INSERT INTO `rujuk` VALUES ('10', 'Puskesmas Cisoka', 'Cisoka', 'admin', null, '2016-05-27 20:35:15', '2016-06-21 23:38:46', 'b');
INSERT INTO `rujuk` VALUES ('11', 'Puskesmas Kresek', 'Kresek', 'admin', null, '2016-05-27 20:35:27', '2016-06-21 23:38:46', 'b');
INSERT INTO `rujuk` VALUES ('12', 'Puskesmas Kronjo', 'kronjo', 'admin', null, '2016-05-27 20:35:44', '2016-06-21 23:38:48', 'b');
INSERT INTO `rujuk` VALUES ('13', 'Puskesmas Spatan ', 'Spantan', 'admin', null, '2016-05-27 20:36:07', '2016-06-21 23:38:47', 'b');
INSERT INTO `rujuk` VALUES ('14', 'Puskesmas Mauk', 'Mauk', 'admin', null, '2016-05-27 20:36:15', '2016-06-21 23:38:50', 'b');
INSERT INTO `rujuk` VALUES ('15', 'Puskesmas Curug', 'Curug', 'admin', null, '2016-05-27 20:36:28', '2016-06-21 23:38:50', 'b');
INSERT INTO `rujuk` VALUES ('16', 'Puskesmas Teluk Naga', 'Teluk Naga', 'admin', null, '2016-05-27 20:36:40', '2016-06-21 23:38:51', 'b');
INSERT INTO `rujuk` VALUES ('17', 'Puskesmas Pasirnangka', 'Pasirnangka', 'admin', null, '2016-05-27 20:36:58', '2016-06-21 23:38:51', 'b');
INSERT INTO `rujuk` VALUES ('18', 'Puskesmas Paku Haji', 'Paku Haji', 'admin', null, '2016-05-27 20:37:08', '2016-06-21 23:38:52', 'b');
INSERT INTO `rujuk` VALUES ('19', 'Puskesmas Jambe', 'Jambe', 'admin', null, '2016-05-27 20:37:24', '2016-06-21 23:38:52', 'b');
INSERT INTO `rujuk` VALUES ('20', 'Puskesmas Caringin', 'Caringin', 'admin', null, '2016-05-27 20:37:32', '2016-06-21 23:38:56', 'b');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `blokir` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `foto_user` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `id_poskotis` int(11) DEFAULT NULL,
  PRIMARY KEY (`username`),
  KEY `f_foskotis` (`id_poskotis`),
  CONSTRAINT `f_foskotis` FOREIGN KEY (`id_poskotis`) REFERENCES `poskotis` (`id_poskotis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('adji', '202cb962ac59075b964b07152d234b70', 'Suto Adji Purnomo S.Kom', 'adji.stt@gmail.com', '08180 7755 023', 'admin', 'N', 'narayana - anak manusia.jpg', '7');
INSERT INTO `users` VALUES ('admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'admin@gmail.com', '021 5998765', 'administrator', 'N', 'avatar.png', '14');
INSERT INTO `users` VALUES ('baim', 'b5bba6e48f6df2b2352990357e641e86', 'Muhammad Ibrohim', 'muhammad.ibrohim01@yahoo.com', '0857-1689-3329', 'administrator', 'N', 'baim.jpg', '14');
INSERT INTO `users` VALUES ('ene', '202cb962ac59075b964b07152d234b70', 'Salwani', 'salwani@gmail.com', '08571236571', 'admin', 'N', 'kab_tangerang.png', '1');
INSERT INTO `users` VALUES ('maman', '202cb962ac59075b964b07152d234b70', 'Maman Abdurahman S.Kom ', 'maman@gmail.com', '082178990076', 'admin', 'N', 'profile-pic.jpg', '13');

-- ----------------------------
-- View structure for v_count_pelkes
-- ----------------------------
DROP VIEW IF EXISTS `v_count_pelkes`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_count_pelkes` AS SELECT
pelkes.id_rujuk,
pelkes.id_diagnosa
FROM
pelkes ;

-- ----------------------------
-- View structure for v_detail_insiden
-- ----------------------------
DROP VIEW IF EXISTS `v_detail_insiden`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_detail_insiden` AS SELECT
detail_insiden.id_detail_insiden AS id_detail_insiden,
detail_insiden.id_insiden AS id_insiden,
detail_insiden.nama_korban AS nama_korban,
detail_insiden.alamat_korban AS alamat_korban,
detail_insiden.jenis_kelamin AS jenis_kelamin,
detail_insiden.umur AS umur,
detail_insiden.kondisi AS kondisi,
detail_insiden.id_rujuk AS id_rujuk,
detail_insiden.created_by AS created_by,
detail_insiden.updated_by AS updated_by,
detail_insiden.created_at AS created_at,
detail_insiden.updated_at AS updated_at,
rujuk.nama_rujuk AS nama_rujuk,
detail_insiden.tindakan AS tindakan,
insiden.id_kecelakaan AS id_kecelakaan,
detail_insiden.rawat,
insiden.id_poskotis
FROM
(((detail_insiden
LEFT JOIN rujuk ON ((detail_insiden.id_rujuk = rujuk.id_rujuk))))
JOIN insiden ON ((detail_insiden.id_insiden = insiden.id_insiden))) ;

-- ----------------------------
-- View structure for v_insiden
-- ----------------------------
DROP VIEW IF EXISTS `v_insiden`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_insiden` AS SELECT
insiden.id_insiden AS id_insiden,
insiden.id_kecelakaan AS id_kecelakaan,
insiden.tgl_insiden AS tgl_insiden,
insiden.jam AS jam,
insiden.alamat_insiden AS alamat_insiden,
insiden.created_by AS created_by,
insiden.updated_by AS updated_by,
insiden.created_at AS created_at,
insiden.updated_at AS updated_at,
kecelakaan.jenis_kecelakaan AS jenis_kecelakaan,
insiden.id_poskotis
from (`insiden` join `kecelakaan` on((`insiden`.`id_kecelakaan` = `kecelakaan`.`id_kecelakaan`)))
order by `insiden`.`tgl_insiden` desc ;

-- ----------------------------
-- View structure for v_jenis_umur
-- ----------------------------
DROP VIEW IF EXISTS `v_jenis_umur`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_jenis_umur` AS SELECT
v_detail_insiden.jenis_kelamin,
v_detail_insiden.id_kecelakaan,
v_detail_insiden.umur,
COUNT(*)
FROM
v_detail_insiden
GROUP BY
v_detail_insiden.umur,v_detail_insiden.jenis_kelamin ;

-- ----------------------------
-- View structure for v_jum
-- ----------------------------
DROP VIEW IF EXISTS `v_jum`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_jum` AS SELECT
insiden.id_kecelakaan AS id_kecelakaan,
kecelakaan.jenis_kecelakaan AS jenis_kecelakaan,
insiden.id_poskotis
from (`insiden` join `kecelakaan`)
where (`insiden`.`id_kecelakaan` = `kecelakaan`.`id_kecelakaan`) ;

-- ----------------------------
-- View structure for v_jumlah
-- ----------------------------
DROP VIEW IF EXISTS `v_jumlah`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_jumlah` AS SELECT
v_jum.id_kecelakaan AS id_kecelakaan,
v_jum.jenis_kecelakaan AS jenis_kecelakaan,
Count(v_jum.id_kecelakaan) AS `COUNT(id_kecelakaan)`,
v_jum.id_poskotis
from `v_jum`
group by `v_jum`.`id_kecelakaan` ;

-- ----------------------------
-- View structure for v_jumlah_kecelakaan
-- ----------------------------
DROP VIEW IF EXISTS `v_jumlah_kecelakaan`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_jumlah_kecelakaan` AS SELECT
insiden.id_kecelakaan,
kecelakaan.jenis_kecelakaan,
Count(insiden.id_kecelakaan),
detail_insiden.id_insiden
FROM
insiden
INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan
INNER JOIN detail_insiden ON detail_insiden.id_insiden = insiden.id_insiden

GROUP BY
kecelakaan.id_kecelakaan ;

-- ----------------------------
-- View structure for v_jumlah_pelkes
-- ----------------------------
DROP VIEW IF EXISTS `v_jumlah_pelkes`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_jumlah_pelkes` AS SELECT
v_pelkes_grafik.id_diagnosa,
v_pelkes_grafik.nama_diagnosa,
Count(v_pelkes_grafik.id_diagnosa),
v_pelkes_grafik.id_poskotis
FROM
v_pelkes_grafik
GROUP BY
v_pelkes_grafik.id_diagnosa ;

-- ----------------------------
-- View structure for v_jum_pelkess
-- ----------------------------
DROP VIEW IF EXISTS `v_jum_pelkess`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_jum_pelkess` AS SELECT
pelkes.id_diagnosa,
diagnosa.nama_diagnosa
FROM
pelkes ,
diagnosa
WHERE
pelkes.id_diagnosa = diagnosa.id_diagnosa ;

-- ----------------------------
-- View structure for v_kondisi
-- ----------------------------
DROP VIEW IF EXISTS `v_kondisi`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost`  VIEW `v_kondisi` AS SELECT
detail_insiden.kondisi,
insiden.id_kecelakaan
FROM
detail_insiden
INNER JOIN insiden ON detail_insiden.id_insiden = insiden.id_insiden
INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan
WHERE
insiden.id_kecelakaan = kecelakaan.id_kecelakaan ;

-- ----------------------------
-- View structure for v_lap_insiden
-- ----------------------------
DROP VIEW IF EXISTS `v_lap_insiden`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_lap_insiden` AS SELECT
detail_insiden.id_detail_insiden AS id_detail_insiden,
detail_insiden.id_insiden AS id_insiden,
detail_insiden.jenis_kelamin AS jenis_kelamin,
detail_insiden.kondisi AS kondisi,
detail_insiden.umur AS umur,
detail_insiden.id_rujuk AS id_rujuk,
detail_insiden.tindakan AS tindakan,
insiden.id_kecelakaan AS id_kecelakaan,
kecelakaan.jenis_kecelakaan AS jenis_kecelakaan,
rujuk.nama_rujuk AS nama_rujuk,
insiden.id_poskotis
from (((`detail_insiden` join `insiden` on((`detail_insiden`.`id_insiden` = `insiden`.`id_insiden`))) join `kecelakaan` on((`insiden`.`id_kecelakaan` = `kecelakaan`.`id_kecelakaan`))) join `rujuk` on((`detail_insiden`.`id_rujuk` = `rujuk`.`id_rujuk`))) ;

-- ----------------------------
-- View structure for v_pelkes
-- ----------------------------
DROP VIEW IF EXISTS `v_pelkes`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_pelkes` AS SELECT
pelkes.id_pelkes,
pelkes.nama_korban,
pelkes.tgl_pemeriksaan,
pelkes.alamat_korban,
pelkes.jenis_kelamin,
pelkes.umur,
pelkes.id_rujuk,
pelkes.id_diagnosa,
pelkes.tindakan,
pelkes.created_by,
pelkes.created_at,
pelkes.updated_by,
pelkes.updated_at,
pelkes.id_poskotis,
pelkes.kondisi,
diagnosa.nama_diagnosa,
rujuk.nama_rujuk
FROM
pelkes
INNER JOIN diagnosa ON pelkes.id_diagnosa = diagnosa.id_diagnosa
INNER JOIN rujuk ON pelkes.id_rujuk = rujuk.id_rujuk ;

-- ----------------------------
-- View structure for v_pelkes_grafik
-- ----------------------------
DROP VIEW IF EXISTS `v_pelkes_grafik`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_pelkes_grafik` AS SELECT
pelkes.id_diagnosa,
diagnosa.nama_diagnosa,
pelkes.id_poskotis
FROM
pelkes ,
diagnosa
WHERE
pelkes.id_diagnosa = diagnosa.id_diagnosa ;

-- ----------------------------
-- View structure for v_rawat
-- ----------------------------
DROP VIEW IF EXISTS `v_rawat`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_rawat` AS SELECT
v_detail_insiden.rawat,
v_detail_insiden.id_kecelakaan
FROM
v_detail_insiden ;

-- ----------------------------
-- View structure for v_rujuk
-- ----------------------------
DROP VIEW IF EXISTS `v_rujuk`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_rujuk` AS SELECT
rujuk.nama_rujuk,
kecelakaan.jenis_kecelakaan,
insiden.id_kecelakaan,
detail_insiden.id_rujuk,
COUNT(detail_insiden.id_rujuk)
FROM
detail_insiden
INNER JOIN insiden ON detail_insiden.id_insiden = insiden.id_insiden
INNER JOIN rujuk ON detail_insiden.id_rujuk = rujuk.id_rujuk
INNER JOIN kecelakaan ON insiden.id_kecelakaan = kecelakaan.id_kecelakaan
GROUP BY
insiden.id_kecelakaan ;

-- ----------------------------
-- View structure for v_users
-- ----------------------------
DROP VIEW IF EXISTS `v_users`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_users` AS select `users`.`username` AS `username`,`users`.`password` AS `password`,`users`.`nama_lengkap` AS `nama_lengkap`,`users`.`email` AS `email`,`users`.`no_telp` AS `no_telp`,`users`.`level` AS `level`,`users`.`blokir` AS `blokir`,`users`.`foto_user` AS `foto_user`,`users`.`id_poskotis` AS `id_poskotis`,`poskotis`.`alamat` AS `alamat` from (`users` left join `poskotis` on((`users`.`id_poskotis` = `poskotis`.`id_poskotis`))) ; ;
