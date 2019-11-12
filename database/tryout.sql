/*
 Navicat Premium Data Transfer

 Source Server         : crud
 Source Server Type    : MySQL
 Source Server Version : 50637
 Source Host           : localhost:3306
 Source Schema         : tryout

 Target Server Type    : MySQL
 Target Server Version : 50637
 File Encoding         : 65001

 Date: 07/11/2019 02:08:55
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for library_isitryout
-- ----------------------------
DROP TABLE IF EXISTS `library_isitryout`;
CREATE TABLE `library_isitryout`  (
  `id_isilibrary` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NULL DEFAULT NULL,
  `id_paket` int(11) NULL DEFAULT NULL,
  `id_jawaban` int(11) NULL DEFAULT NULL,
  `is_true` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_isilibrary`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for library_tryout
-- ----------------------------
DROP TABLE IF EXISTS `library_tryout`;
CREATE TABLE `library_tryout`  (
  `id_library` int(11) NOT NULL AUTO_INCREMENT,
  `id_tryout` int(11) NULL DEFAULT NULL,
  `id_user` int(11) NULL DEFAULT NULL,
  `marks` decimal(5, 2) NULL DEFAULT NULL,
  `test_status` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `start_date` datetime(0) NULL DEFAULT NULL,
  `end_date` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_library`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for master_isipaket
-- ----------------------------
DROP TABLE IF EXISTS `master_isipaket`;
CREATE TABLE `master_isipaket`  (
  `id_isipaket` int(11) NOT NULL AUTO_INCREMENT,
  `id_paket` int(11) NULL DEFAULT NULL,
  `id_soal` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_isipaket`) USING BTREE,
  INDEX `Id Paket`(`id_paket`) USING BTREE,
  INDEX `Soal ID`(`id_soal`) USING BTREE,
  CONSTRAINT `Id Paket` FOREIGN KEY (`id_paket`) REFERENCES `master_paket` (`id_paket`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `Soal ID` FOREIGN KEY (`id_soal`) REFERENCES `master_soal` (`id_soal`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for master_isitryout
-- ----------------------------
DROP TABLE IF EXISTS `master_isitryout`;
CREATE TABLE `master_isitryout`  (
  `id_isitryout` int(11) NOT NULL AUTO_INCREMENT,
  `id_tryout` int(11) NULL DEFAULT NULL,
  `id_paket` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_isitryout`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for master_jawaban
-- ----------------------------
DROP TABLE IF EXISTS `master_jawaban`;
CREATE TABLE `master_jawaban`  (
  `id_jawaban` int(11) NOT NULL AUTO_INCREMENT,
  `label` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_soal` int(11) NULL DEFAULT NULL,
  `nama_jawaban` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `is_true` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `gambar` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `marks` decimal(2, 0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_jawaban`) USING BTREE,
  INDEX `Id Soal`(`id_soal`) USING BTREE,
  CONSTRAINT `Id Soal` FOREIGN KEY (`id_soal`) REFERENCES `master_soal` (`id_soal`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for master_kategori
-- ----------------------------
DROP TABLE IF EXISTS `master_kategori`;
CREATE TABLE `master_kategori`  (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_kategori`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of master_kategori
-- ----------------------------
INSERT INTO `master_kategori` VALUES (1, 'Penalaran Umum');
INSERT INTO `master_kategori` VALUES (2, 'Pemahaman Baca dan Menulis');
INSERT INTO `master_kategori` VALUES (3, 'Pengetahuan dan Pemahamam Umum');
INSERT INTO `master_kategori` VALUES (4, 'Pengetahuan Kuantitatif');
INSERT INTO `master_kategori` VALUES (5, 'Matematika Saintek');
INSERT INTO `master_kategori` VALUES (6, 'Fisika');
INSERT INTO `master_kategori` VALUES (7, 'Kimia');
INSERT INTO `master_kategori` VALUES (8, 'Biologi');
INSERT INTO `master_kategori` VALUES (9, 'Matematika Soshum');
INSERT INTO `master_kategori` VALUES (10, 'Ekonomi');
INSERT INTO `master_kategori` VALUES (11, 'Geografi');

-- ----------------------------
-- Table structure for master_nominal
-- ----------------------------
DROP TABLE IF EXISTS `master_nominal`;
CREATE TABLE `master_nominal`  (
  `id_nominal` int(11) NOT NULL AUTO_INCREMENT,
  `nama_nominal` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nominal` decimal(18, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id_nominal`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for master_paket
-- ----------------------------
DROP TABLE IF EXISTS `master_paket`;
CREATE TABLE `master_paket`  (
  `id_paket` int(255) NOT NULL AUTO_INCREMENT,
  `nama_paket` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_kategori` int(11) NULL DEFAULT NULL,
  `waktu_pengerjaan` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_paket`) USING BTREE,
  INDEX `Id Kategori`(`id_kategori`) USING BTREE,
  CONSTRAINT `Id Kategori` FOREIGN KEY (`id_kategori`) REFERENCES `master_kategori` (`id_kategori`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for master_paketcoin
-- ----------------------------
DROP TABLE IF EXISTS `master_paketcoin`;
CREATE TABLE `master_paketcoin`  (
  `id_paketcoin` int(50) NOT NULL AUTO_INCREMENT,
  `nama_paketcoin` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jumlah_paketcoin` int(100) NULL DEFAULT NULL,
  `harga_paketcoin` decimal(18, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id_paketcoin`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for master_paketpoin
-- ----------------------------
DROP TABLE IF EXISTS `master_paketpoin`;
CREATE TABLE `master_paketpoin`  (
  `id_paketpoin` int(11) NOT NULL AUTO_INCREMENT,
  `id_sosmed` int(11) NULL DEFAULT NULL,
  `nama_paketpoin` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jumlah_paketpoin` int(11) NULL DEFAULT NULL,
  `instruksi_paketpoin` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `end_date` datetime(0) NULL DEFAULT NULL,
  `status` varchar(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `gambar` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_paketpoin`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for master_soal
-- ----------------------------
DROP TABLE IF EXISTS `master_soal`;
CREATE TABLE `master_soal`  (
  `id_soal` int(11) NOT NULL AUTO_INCREMENT,
  `nama_soal` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `kategori` int(11) NULL DEFAULT NULL,
  `topic` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `gambar` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `create_date` datetime(0) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_soal`) USING BTREE,
  INDEX `Id Kategori Pelajaran`(`kategori`) USING BTREE,
  CONSTRAINT `Id Kategori Pelajaran` FOREIGN KEY (`kategori`) REFERENCES `master_kategori` (`id_kategori`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for master_sosmed
-- ----------------------------
DROP TABLE IF EXISTS `master_sosmed`;
CREATE TABLE `master_sosmed`  (
  `id_sosmed` int(11) NOT NULL AUTO_INCREMENT,
  `nama_sosmed` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_sosmed`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for master_tryout
-- ----------------------------
DROP TABLE IF EXISTS `master_tryout`;
CREATE TABLE `master_tryout`  (
  `id_tryout` int(11) NOT NULL AUTO_INCREMENT,
  `nama_tryout` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `harga_koin` decimal(18, 2) NULL DEFAULT NULL,
  `harga_poin` decimal(18, 2) NULL DEFAULT NULL,
  `start_date` datetime(0) NULL DEFAULT NULL,
  `end_date` datetime(0) NULL DEFAULT NULL,
  `status` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_tryout`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `parent` int(11) NULL DEFAULT NULL,
  `role` int(11) NULL DEFAULT NULL,
  `target` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `icon` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_aktif` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `order` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_menu`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (1, 'Manage Soal', 0, 1, '#', 'icon-file-text3', '1', 1);
INSERT INTO `menu` VALUES (2, 'Penalaran Umum', 1, 1, 'admin/penalaran', NULL, '1', 1);
INSERT INTO `menu` VALUES (3, 'Pemahaman Baca dan Menulis', 1, 1, 'admin/pemahaman', NULL, '1', 3);
INSERT INTO `menu` VALUES (4, 'Pengetahuan dan Pemahamam Umum', 1, 1, 'admin/pengetahuan', NULL, '1', 4);
INSERT INTO `menu` VALUES (5, 'Pengetahuan Kuantitatif', 1, 1, 'admin/kuantitatif', NULL, '1', 5);
INSERT INTO `menu` VALUES (6, 'Matematika Saintek', 1, 1, 'admin/saintek', NULL, '1', 6);
INSERT INTO `menu` VALUES (7, 'Fisika', 1, 1, 'admin/fisika', NULL, '1', 7);
INSERT INTO `menu` VALUES (8, 'Kimia', 1, 1, 'admin/kimia', NULL, '1', 8);
INSERT INTO `menu` VALUES (9, 'Biologi', 1, 1, 'admin/biologi', NULL, '1', 9);
INSERT INTO `menu` VALUES (10, 'Matematika Soshum', 1, 1, 'admin/matematikasoshum', NULL, '1', 10);
INSERT INTO `menu` VALUES (11, 'Ekonomi', 1, 1, 'admin/ekonomi', NULL, '1', 11);
INSERT INTO `menu` VALUES (12, 'Geografi', 1, 1, 'admin/geografi', '', '1', 12);
INSERT INTO `menu` VALUES (13, 'Manage Paket Soal', 0, 1, 'admin/paket', 'icon-pencil', '1', 2);
INSERT INTO `menu` VALUES (14, 'Master Tryout', 0, 1, 'admin/tryout', 'icon-pencil', '1', 3);
INSERT INTO `menu` VALUES (15, 'Manage Coin', 0, 1, 'admin/paketcoin', 'icon-coins', '1', 4);
INSERT INTO `menu` VALUES (16, 'Manage Poin', 0, 1, 'admin/paketpoin', 'icon-pencil', '1', 6);
INSERT INTO `menu` VALUES (17, 'Daftar User', 32, 1, 'admin/user', 'icon-users', '1', 8);
INSERT INTO `menu` VALUES (18, 'User Profile', 0, 3, 'user/userprofile', 'icon-users', '1', 1);
INSERT INTO `menu` VALUES (19, 'Kerjakan Tryout', 0, 3, 'user/do_tryout', 'icon-list', '1', 2);
INSERT INTO `menu` VALUES (20, 'Beli Tryout', 0, 3, 'user/beli_tryout', 'icon-list', '1', 3);
INSERT INTO `menu` VALUES (21, 'Coin', 0, 3, 'user/coin', 'icon-coins', '1', 4);
INSERT INTO `menu` VALUES (22, 'Poin', 0, 3, 'user/poin', 'icon-coins', '1', 5);
INSERT INTO `menu` VALUES (23, 'Manage Role', 32, 1, 'admin/Role', 'icon-vcard', '1', 9);
INSERT INTO `menu` VALUES (24, 'Transaksi Coin', 0, 1, '#', 'icon-users', '1', 5);
INSERT INTO `menu` VALUES (25, 'Transaksi Poin', 0, 1, '#', 'icon-users', '1', 7);
INSERT INTO `menu` VALUES (26, 'Verifikasi Coin', 24, 1, 'admin/transaksicoin', 'icon-users', '1', 1);
INSERT INTO `menu` VALUES (27, 'Histori Coin', 24, 1, 'admin/historicoin', 'icon-users', '1', 2);
INSERT INTO `menu` VALUES (28, 'Verifikasi Poin', 25, 1, 'admin/transaksipoin', 'icon-pencil', '1', 1);
INSERT INTO `menu` VALUES (29, 'Histori Poin', 25, 1, 'admin/historipoin', 'icon-pencil', '1', 2);
INSERT INTO `menu` VALUES (30, 'List Admin', 32, 1, 'admin/admin_list', 'icon-users', '1', 3);
INSERT INTO `menu` VALUES (31, 'List User', 32, 1, 'admin/user_list', 'icon-users', '1', 4);
INSERT INTO `menu` VALUES (32, 'Manage User', 0, 1, '#', 'icon-users', '1', 10);

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings`  (
  `id` int(11) NOT NULL,
  `event` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `details` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES (3, 'lang_settings', '{\"latest_news\":\"LATEST NEWS\",\"most_read\":\"MOST POPULAR\",\"whole_country\":\"Whole Country\",\"headline\":\"Headline\",\"home\":\"HOME\",\"such_more_news\":\"Related News\",\"details\":\"Read More\"}');
INSERT INTO `settings` VALUES (4, 'home_page_cat_style', '{\"1\":{\"cat_name\":\"TECHNOLOGY\",\"slug\":\"Technology\",\"max_news\":\"5\",\"category_id\":\"4\",\"status\":\"1\"},\"2\":{\"cat_name\":\"POLITICS\",\"slug\":\"Politics\",\"max_news\":\"5\",\"category_id\":\"8\",\"status\":\"1\"},\"3\":{\"cat_name\":\"VIDEO\",\"slug\":\"Video\",\"max_news\":\"5\",\"category_id\":\"7\",\"status\":\"1\"},\"4\":{\"cat_name\":\"International\",\"slug\":\"International\",\"max_news\":\"5\",\"category_id\":\"16\",\"status\":\"1\"},\"5\":{\"cat_name\":\"HEALTH\",\"slug\":\"Health\",\"max_news\":\"5\",\"category_id\":\"14\",\"status\":\"1\"},\"6\":{\"cat_name\":\"LIFESTYLE\",\"slug\":\"Lifestyle\",\"max_news\":\"5\",\"category_id\":\"5\",\"status\":\"1\"},\"7\":{\"cat_name\":\"TRAVEL\",\"slug\":\"Travel\",\"max_news\":\"5\",\"category_id\":\"2\",\"status\":\"1\"},\"8\":{\"cat_name\":\"SPORTS\",\"slug\":\"Sports\",\"max_news\":\"5\",\"category_id\":\"13\",\"status\":\"1\"},\"9\":{\"cat_name\":\"WORLD\",\"slug\":\"world\",\"max_news\":\"5\",\"category_id\":\"10\",\"status\":\"1\"},\"10\":{\"cat_name\":\"POLITICS\",\"slug\":\"Politics\",\"max_news\":\"5\",\"category_id\":\"8\",\"status\":\"1\"},\"11\":{\"cat_name\":\"EDITOR CHOICE\",\"slug\":\"Editor-Choice\",\"max_news\":\"5\",\"category_id\":\"6\",\"status\":\"1\"},\"12\":{\"cat_name\":\"SCIENCE\",\"slug\":\"science\",\"max_news\":\"5\",\"category_id\":\"11\",\"status\":\"1\"},\"14\":{\"cat_name\":\"BUSINESS\",\"slug\":\"Business\",\"max_news\":\"5\",\"category_id\":\"12\",\"status\":\"1\"},\"15\":{\"cat_name\":\"FOOD\",\"slug\":\"Food\",\"max_news\":\"5\",\"category_id\":\"3\",\"status\":\"1\"},\"13\":{\"cat_name\":\"POLITICS\",\"slug\":\"Politics\",\"max_news\":\"5\",\"category_id\":\"8\",\"status\":\"1\"}}');
INSERT INTO `settings` VALUES (5, 'analytics_code', '');
INSERT INTO `settings` VALUES (6, 'social_sites', '{\"fb\":{\"URL\":\"                                                                                                                                                                                                <div class=\\\"fb-page\\\" data-href=\\\"https:\\/\\/www.facebook.com\\/bdtaskteam\\/?ref=br_rs\\\" data-tabs=\\\"timeline\\\" data-height=\\\"300\\\" data-small-header=\\\"false\\\" data-adapt-container-width=\\\"true\\\" data-hide-cover=\\\"false\\\" data-show-facepile=\\\"true\\\"><blockquote cite=\\\"https:\\/\\/www.facebook.com\\/bdtaskteam\\/?ref=br_rs\\\" class=\\\"fb-xfbml-parse-ignore\\\"><a href=\\\"https:\\/\\/www.facebook.com\\/bdtaskteam\\/?ref=br_rs\\\">Bdtask<\\/a><\\/blockquote><\\/div>                                                                                                                                                                        \",\"h_p\":\"1\",\"c_p\":\"1\",\"d_p\":\"1\"},\"tw\":{\"URL\":\"                                                                                                                                                                                                  <a class=\\\"twitter-timeline\\\" data-height=\\\"280\\\" data-dnt=\\\"true\\\" href=\\\"https:\\/\\/twitter.com\\/TwitterDev\\\">Tweets by TwitterDev<\\/a> <script async src=\\\"\\/\\/platform.twitter.com\\/widgets.js\\\" charset=\\\"utf-8\\\"><\\/script>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      \",\"h_p\":\"1\",\"c_p\":\"1\",\"d_p\":\"1\"},\"gplus\":{\"URL\":\"\",\"c_p\":\"1\",\"d_p\":\"1\"},\"ln\":{\"URL\":\"                                                                                                                                                                                                                                                                                                                                                                                                                                               \",\"c_p\":\"1\",\"d_p\":\"1\"}}');
INSERT INTO `settings` VALUES (7, 'comments_code', '');
INSERT INTO `settings` VALUES (8, 'user_analytics', '{\"user_analytics\":\"inactive\"}');
INSERT INTO `settings` VALUES (10, 'fixed_keyword', '');
INSERT INTO `settings` VALUES (11, 'alexa_code', '');
INSERT INTO `settings` VALUES (12, 'website_title', '{\"website_title\":\"Demo Newspaper\"}');
INSERT INTO `settings` VALUES (13, 'website_footer', '{\"website_footer\":\"14L.E Goulburn St, Sydney 2000NSW Tell: 01922296392 Email: bdtask@gmail.com | Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain  toil and pain\",\"copy_right\":\"<p><a href=\'http:\\/\\/bdtask.com\\/\' class=\'color-1\'>bdtask<\\/a> Theme | All right Reserved 2016<\\/p>\"}');
INSERT INTO `settings` VALUES (14, 'website_logo', '{\"website_logo\":\"uploads\\/images\\/logo.png\"}');
INSERT INTO `settings` VALUES (15, 'website_favicon', '{\"website_favicon\":\"uploads\\/images\\/favicon.png\"}');
INSERT INTO `settings` VALUES (16, 'default_theme', '{\"default_theme\":\"News365-Modern\"}');
INSERT INTO `settings` VALUES (17, 'website_timezone', '{\"website_timezone\":\"Asia\\/Dhaka\"}');
INSERT INTO `settings` VALUES (18, 'prayer_time', '{\"prayer_time\":\"\"}');
INSERT INTO `settings` VALUES (111, 'social_link', '{\"fb\":\"https:\\/\\/www.facebook.com\\/\",\"tw\":\"https:\\/\\/twitter.com\\/\",\"linkd\":\"https:\\/\\/plus.google.com\\/\",\"google\":\"https:\\/\\/plus.google.com\\/\",\"pin\":\"https:\\/\\/au.pinterest.com\\/\",\"vimo\":\"https:\\/\\/vimeo.com\\/\",\"youtube\":\"https:\\/\\/www.youtube.com\\/?gl=CO&hl=es-419\",\"flickr\":\"https:\\/\\/www.flickr.com\\/\",\"vk\":\"https:\\/\\/vk.com\\/\",\"save1\":\"Update\"}');
INSERT INTO `settings` VALUES (112, 'footer_logo', '{\"footer_logo\":\"uploads\\/images\\/footer_logo.png\"}');
INSERT INTO `settings` VALUES (113, 'contact_page_setup', '{\"content\":\"                                                                                                                                                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.<br\\/> Lorem Ipsum has been the industry\'s standard dummy text ever         sssssss   s                                                                                                                                 \",\"address\":\"     14L.E Goulburn St,     <br\\/>Sydney 2000NSWssssssss\",\"phone\":\"+8801620214460\",\"phone_two\":\"+8801821450144\",\"email\":\"bdtask@gmail.com\",\"website\":\"www.companyweb.com\",\"googlemap\":\"                                                                                                                                                                        <iframe src=\\\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m23!1m12!1m3!1d58403.685586307096!2d90.377498600828!3d23.81040657382374!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x3755b8b087026b81%3A0x8fa563bbdd5904c2!2z4Kai4Ka-4KaV4Ka-!3m2!1d23.810332!2d90.4125181!5e0!3m2!1sbn!2sbd!4v1477485026665\\\" width=\\\"100%\\\" height=\\\"300\\\" frameborder=\\\"0\\\" style=\\\"border:0\\\" allowfullscreen><\\/iframe>                                                                                                                                            \",\"save1\":\"Update\"}');

-- ----------------------------
-- Table structure for transaksi_coin
-- ----------------------------
DROP TABLE IF EXISTS `transaksi_coin`;
CREATE TABLE `transaksi_coin`  (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NULL DEFAULT NULL,
  `id_paketcoin` int(11) NULL DEFAULT NULL,
  `gambar` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `verified_by` int(11) NULL DEFAULT NULL,
  `tanggal_pembelian` datetime(0) NULL DEFAULT NULL,
  `tanggal_verifikasi` datetime(0) NULL DEFAULT NULL,
  `tanggal_upload` datetime(0) NULL DEFAULT NULL,
  `note` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `note_admin` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id_transaksi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for transaksi_koinpoin
-- ----------------------------
DROP TABLE IF EXISTS `transaksi_koinpoin`;
CREATE TABLE `transaksi_koinpoin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NULL DEFAULT NULL,
  `total_poin` decimal(18, 2) NULL DEFAULT NULL,
  `total_koin` decimal(18, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for transaksi_poin
-- ----------------------------
DROP TABLE IF EXISTS `transaksi_poin`;
CREATE TABLE `transaksi_poin`  (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NULL DEFAULT NULL,
  `id_paketpoin` int(11) NULL DEFAULT NULL,
  `gambar` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `verified_by` int(11) NULL DEFAULT NULL,
  `tanggal_pembelian` datetime(0) NULL DEFAULT NULL,
  `tanggal_verifikasi` datetime(0) NULL DEFAULT NULL,
  `tanggal_upload` datetime(0) NULL DEFAULT NULL,
  `note` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `note_admin` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id_transaksi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for transaksi_tryout
-- ----------------------------
DROP TABLE IF EXISTS `transaksi_tryout`;
CREATE TABLE `transaksi_tryout`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tryout` int(11) NULL DEFAULT NULL,
  `id_user` int(11) NULL DEFAULT NULL,
  `jumlah_pengurangan` decimal(18, 2) NULL DEFAULT NULL,
  `tipe_beli` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tanggal_beli` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for user_info
-- ----------------------------
DROP TABLE IF EXISTS `user_info`;
CREATE TABLE `user_info`  (
  `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(35) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `no_hp` varchar(35) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `asal_sekolah` varchar(35) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nama_lengkap` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nama_panggilan` varchar(35) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `jenis_kelamin` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tempat_lahir` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tanggal_lahir` datetime(0) NULL DEFAULT NULL,
  `photo` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kampus_impian` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `verification_id_no` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `verification_type` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `user_type` int(25) NULL DEFAULT NULL,
  `login_time` int(25) NULL DEFAULT NULL,
  `logout_time` int(25) NULL DEFAULT NULL,
  `ip` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` tinyint(2) NULL DEFAULT NULL,
  `post_ap_status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user_info
-- ----------------------------
INSERT INTO `user_info` VALUES (1, 'administrator@gmail.com', '01751194212', '12345678952', 'e10adc3949ba59abbe56e057f20f883e', 'Bakti Wijaya', 'Bakti', 'male', 'O+', '0000-00-00 00:00:00', './uploads/user/Man.png', '98 Green Road', 'Just write here your id if you want', '', 1, NULL, 1568017367, NULL, 1, 1);
INSERT INTO `user_info` VALUES (28, 'inul@gmail.com', NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', 'Dadang Kaya', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 0);
INSERT INTO `user_info` VALUES (29, 'ambon@gmail.com', NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', 'Ambon', 'Ambon', 'Situm', NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 0);
INSERT INTO `user_info` VALUES (30, 'gg@gmail.com', NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', 'Archie', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0);
INSERT INTO `user_info` VALUES (31, 'budi@gmail.com', NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 0);
INSERT INTO `user_info` VALUES (32, 'bobi@gmail.com', NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', 'bobi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 0);

-- ----------------------------
-- Table structure for user_type
-- ----------------------------
DROP TABLE IF EXISTS `user_type`;
CREATE TABLE `user_type`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `created_date` datetime(0) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `updated_date` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user_type
-- ----------------------------
INSERT INTO `user_type` VALUES (1, 'admin', NULL, NULL, NULL, NULL);
INSERT INTO `user_type` VALUES (3, 'user', NULL, NULL, NULL, NULL);
INSERT INTO `user_type` VALUES (4, 'admin_soal', NULL, NULL, NULL, NULL);
INSERT INTO `user_type` VALUES (5, 'admin transaksi', 1, '2019-11-02 23:14:21', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
