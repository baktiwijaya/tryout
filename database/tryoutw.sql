/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50637
 Source Host           : localhost:3306
 Source Schema         : tryout

 Target Server Type    : MySQL
 Target Server Version : 50637
 File Encoding         : 65001

 Date: 06/11/2019 19:06:11
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
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for master_isitryout
-- ----------------------------
DROP TABLE IF EXISTS `master_isitryout`;
CREATE TABLE `master_isitryout`  (
  `id_isitryout` int(11) NOT NULL AUTO_INCREMENT,
  `id_paket` int(11) NULL DEFAULT NULL,
  `id_tryout` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_isitryout`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of master_isitryout
-- ----------------------------
INSERT INTO `master_isitryout` VALUES (1, 4, 3);
INSERT INTO `master_isitryout` VALUES (2, 5, 3);

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
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of master_soal
-- ----------------------------
INSERT INTO `master_soal` VALUES (1, '<p>Sampai saat ini narkoba masih mengancam masyarakat Indonesia meski Indonesia telah berkomitmen untuk bebas dari narkoba dan HIV/AIDS pada tahun 2015. Hal itu dapat dilihat dari jumlah pengguna narkoba yang terus meningkat setiap tahunnya. Pada tahun 1970 diperkirakan hanya 130.000 orang yang menggunakan narkoba dan pada tahun 2009 terdeteksi 2% penduduk Indonesia pernah bersentuhan dengan narkoba atau meningkat 0,5% dibandingkan tahun sebelumnya. Hal tersebut sangat mengkhawatirkan semua pihak, khususnya Badan Narkotika Nasional (BNN). Dari 2% penduduk yang pernah bersentuhan dengan narkoba tersebut, 60% berusia produktif dan 40% pelajar.</p>\r\n\r\n<p>Awalnya, pengguna narkoba adalah orang dewasa, berusia sekitar 25 tahun dan dari kalangan kelas ekonomi menengah ke atas. Dalam perkembangannya, pengguna narkoba sudah merambah para remaja dan masyarakat kelas menengah ke bawah. Bahkan, gelandangan pun ada yang kecanduan narkoba. Keadaan tersebut sungguh sangat ironis. Kondisi pengguna narkoba di Indonesia pada tahun 2005 &ndash; 2007 dipaparkan sebagai berikut.</p>\r\n\r\n<p style=\"text-align:center\"><strong><img alt=\"3-51\" src=\"https://blog.ruangguru.com/hs-fs/hubfs/3-51.png?width=321&amp;name=3-51.png\" style=\"width:321px\" /></strong></p>\r\n\r\n<p style=\"text-align:center\"><strong>Tabel 1. Pengguna Narkoba di Indonesia Tahun 2005 -2007</strong></p>\r\n\r\n<p>Tabel tersebut menunjukkan bahwa pengguna narkoba semakin meningkat. Untuk mengatasinya perlu upaya sinergis dari semua pihak, khususnya BNN dengan masyarakat. Tanpa sinergi tersebut tidak mungkin bahaya narkoba dapat diatasi.</p>\r\n\r\n<p>Berdasarkan paragraf 1, manakah di bawah ini pernyataan yang <strong>BENAR</strong>?</p>\r\n', 1, '', NULL, NULL, NULL, NULL);
INSERT INTO `master_soal` VALUES (2, '<p><em>Sesuai kalimat kedua pada paragraf pertama.</em></p>\r\n\r\n<p>Berdasarkan paragraf 2, apabila dalam perkembangannya, pengguna narkoba sudah merambah para remaja dan masyarakat kelas menengah ke bawah, manakah di bawah ini simpulan yang <strong>PALING MUNGKIN</strong> benar?</p>\r\n', 1, '', NULL, NULL, NULL, NULL);
INSERT INTO `master_soal` VALUES (3, '<p>Berdasarkan Tabel 1, pada rentang usia berapakah jumlah pengguna narkoba yang pernah mengalami kenaikan jumlah sekitar lebih dari 50%?&nbsp;&nbsp;</p>\r\n', 1, '', NULL, NULL, NULL, NULL);
INSERT INTO `master_soal` VALUES (4, '<p>Saat ini banyak sungai yang tercemar akibat pembuangan limbah secara sembarangan. Padahal, masih banyak penduduk yang masih memanfaatkan air sungai untuk keperluan sehari-hari. Namun, karena menggunakan sungai yang telah tercemar, banyak penduduk yang mengalami masalah kesehatan. Pendekatan geografi yang dapat digunakan untuk mengkaji gejala tersebut adalah pendekatan....</p>\r\n', 2, '', NULL, NULL, NULL, NULL);
INSERT INTO `master_soal` VALUES (5, '<p>Gempa 6,9 SR mengguncang beberapa kota di wilayah Jawa Barat pada 16 Desember 2017 dan menimbulkan peringatan tsunami. Berdasarkan posisi dan kedalamannya, kejadian gempa bumi ini disebabkan karena aktivitas tumbukan Lempeng Indo-Australia terhadap Lempeng Eurasia di selatan Jawa. Aktivitas tektonis antara kedua lempeng tersebut juga mengakibatkan terbentuknya sebaran gunung api di wilayah Sumatra bagian barat dan Jawa bagian selatan. Deskripsi di atas sesuai dengan prinsip....</p>\r\n', 2, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `master_soal` VALUES (6, '<p>Awalnyo&nbsp;tata surya merupakan kabut gas yang panas dan berputar secara sentripetal. Perputaran tersebut membentuk adanya inti kabut yang sangat panas dan besar, dan inti kabut inilah yang kemudian menjadi matahari. Sementara, pada bagian tepi dari kabut mengalami pendinginan dan penyusutan hingga membentuk planet-planet yang ada di tata surya. Pernyataan tersebut merupakan isi dari teori pembentukan tata surya yang dicetuskan oleh&hellip;.</p>\r\n', 4, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `master_soal` VALUES (7, '<p>Kerusaka&nbsp;Daerah Aliran Sungai (DAS) ditandai dengan adanya akumulasi endapan di bagian hilir sungai. Usaha yang paling efektif untuk mengatasi kerusakan tersebut adalah&hellip;.</p>\r\n', 5, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for master_tryout
-- ----------------------------
DROP TABLE IF EXISTS `master_tryout`;
CREATE TABLE `master_tryout`  (
  `id_tryout` int(11) NOT NULL AUTO_INCREMENT,
  `harga_koin` decimal(18, 2) NULL DEFAULT NULL,
  `harga_poin` decimal(18, 2) NULL DEFAULT NULL,
  `start_date` datetime(0) NULL DEFAULT NULL,
  `end_date` datetime(0) NULL DEFAULT NULL,
  `nama_tryout` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_tryout`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of master_tryout
-- ----------------------------
INSERT INTO `master_tryout` VALUES (3, 25000.00, 500.00, '2019-11-15 08:00:00', '2019-11-16 10:00:00', 'Tryout Pertama');

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
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (1, 'Manage Soal', 0, 1, '#', 'icon-pencil', '1', 1);
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
INSERT INTO `menu` VALUES (12, 'Geografi', 1, 1, 'admin/geografi', NULL, '1', 12);
INSERT INTO `menu` VALUES (13, 'Manage Paket Soal', 0, 1, 'admin/paket', 'icon-pencil', '1', 2);
INSERT INTO `menu` VALUES (15, 'Master Tryout', 0, 1, 'admin/tryout', 'icon-pencil', '1', 3);

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
-- Table structure for transaksi_tryout
-- ----------------------------
DROP TABLE IF EXISTS `transaksi_tryout`;
CREATE TABLE `transaksi_tryout`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) NULL DEFAULT NULL,
  `id_tryout` int(11) NULL DEFAULT NULL,
  `id_user` int(11) NULL DEFAULT NULL,
  `is_paid` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `bukti_pembayaran` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `is_valid` char(0) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `test_status` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `marks` decimal(18, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of transaksi_tryout
-- ----------------------------
INSERT INTO `transaksi_tryout` VALUES (1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for user_info
-- ----------------------------
DROP TABLE IF EXISTS `user_info`;
CREATE TABLE `user_info`  (
  `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(35) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `mobile` varchar(35) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `transaction` varchar(35) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `name` varchar(35) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pen_name` varchar(35) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sex` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `blood` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `birth_date` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `photo` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `address_one` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `address_two` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `city` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `state` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `country` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `zip` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `verification_id_no` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `verification_type` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `user_type` int(25) NULL DEFAULT NULL,
  `login_time` int(25) NULL DEFAULT NULL,
  `logout_time` int(25) NULL DEFAULT NULL,
  `ip` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` tinyint(2) NULL DEFAULT NULL,
  `post_ap_status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user_info
-- ----------------------------
INSERT INTO `user_info` VALUES (1, 'administrator@gmail.com', '01751194212', '12345678952', 'e10adc3949ba59abbe56e057f20f883e', 'Bakti Wijaya', 'Bakti', 'male', 'O+', '13-11-2016', './uploads/user/Man.png', '98 Green Road', 'Farmgate', 'Dhaka', 'Dhaka', 'Bangladesh', '1215', 'Just write here your id if you want', '', 1, NULL, 1568017367, NULL, 1, 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user_type
-- ----------------------------
INSERT INTO `user_type` VALUES (1, 'admin', NULL, NULL, NULL, NULL);
INSERT INTO `user_type` VALUES (3, 'user', NULL, NULL, NULL, NULL);
INSERT INTO `user_type` VALUES (4, 'admin_soal', NULL, NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
