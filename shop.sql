/*
 Navicat Premium Data Transfer

 Source Server         : mysql_local
 Source Server Type    : MySQL
 Source Server Version : 50721
 Source Host           : localhost:3306
 Source Schema         : shop

 Target Server Type    : MySQL
 Target Server Version : 50721
 File Encoding         : 65001

 Date: 24/01/2019 11:18:49
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for advertising
-- ----------------------------
DROP TABLE IF EXISTS `advertising`;
CREATE TABLE `advertising`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1.Script 2.Image',
  `group` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of advertising
-- ----------------------------
INSERT INTO `advertising` VALUES (2, '1', '/uploads/advertising/2019/01/20190116042808-brand1.png', '2019-01-16 04:22:51', '2019-01-16 04:33:48', 2, 1);
INSERT INTO `advertising` VALUES (5, '2', '/uploads/advertising/2019/01/20190116043217-brand2.png', '2019-01-16 04:32:17', '2019-01-16 04:32:17', 2, 1);
INSERT INTO `advertising` VALUES (6, '3', '/uploads/advertising/2019/01/20190116043356-brand3.png', '2019-01-16 04:33:56', '2019-01-16 04:33:56', 2, 1);
INSERT INTO `advertising` VALUES (7, '4', '/uploads/advertising/2019/01/20190116043402-brand4.png', '2019-01-16 04:34:02', '2019-01-16 04:34:02', 2, 1);
INSERT INTO `advertising` VALUES (8, '5', '/uploads/advertising/2019/01/20190116043408-brand5.png', '2019-01-16 04:34:08', '2019-01-16 04:34:08', 2, 1);
INSERT INTO `advertising` VALUES (9, '6', '/uploads/advertising/2019/01/20190116043414-brand6.png', '2019-01-16 04:34:14', '2019-01-16 04:34:14', 2, 1);

-- ----------------------------
-- Table structure for article_category
-- ----------------------------
DROP TABLE IF EXISTS `article_category`;
CREATE TABLE `article_category`  (
  `article_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  INDEX `article_category_article_id_foreign`(`article_id`) USING BTREE,
  INDEX `article_category_category_id_foreign`(`category_id`) USING BTREE,
  CONSTRAINT `article_category_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `article_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of article_category
-- ----------------------------
INSERT INTO `article_category` VALUES (1, 6);

-- ----------------------------
-- Table structure for article_group
-- ----------------------------
DROP TABLE IF EXISTS `article_group`;
CREATE TABLE `article_group`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `article_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `article_group_article_id_foreign`(`article_id`) USING BTREE,
  INDEX `article_group_group_id_foreign`(`group_id`) USING BTREE,
  CONSTRAINT `article_group_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `article_group_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for article_tag
-- ----------------------------
DROP TABLE IF EXISTS `article_tag`;
CREATE TABLE `article_tag`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `article_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `article_tag_article_id_foreign`(`article_id`) USING BTREE,
  INDEX `article_tag_tag_id_foreign`(`tag_id`) USING BTREE,
  CONSTRAINT `article_tag_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `article_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for articles
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `url_video` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `user_id` int(10) UNSIGNED NOT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `meta_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `meta_keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `articles_slug_unique`(`slug`) USING BTREE,
  INDEX `articles_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `articles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of articles
-- ----------------------------
INSERT INTO `articles` VALUES (1, 'Test', 'test', '/uploads/posts/2019/01/20190116080712-dep-nhat-3.jpg', 'ttttt', NULL, '<p>tttt</p>', 0, 1, NULL, NULL, NULL, 'article', '2019-01-16 08:07:12', '2019-01-16 08:07:12', 1);
INSERT INTO `articles` VALUES (2, 'Giới thiệu', 'gioi-thieu', NULL, 'Giới thiệu', NULL, '<p>Giới thiệu</p>', 0, 1, NULL, NULL, NULL, 'page', '2019-01-24 02:50:00', '2019-01-24 02:50:00', 1);
INSERT INTO `articles` VALUES (3, 'Điều khoản sử dụng', 'dieu-khoan-su-dung', NULL, NULL, NULL, '<p>Điều khoản sử dụng</p>', 0, 1, NULL, NULL, NULL, 'page', '2019-01-24 02:50:09', '2019-01-24 02:50:09', 1);

-- ----------------------------
-- Table structure for attribute_values
-- ----------------------------
DROP TABLE IF EXISTS `attribute_values`;
CREATE TABLE `attribute_values`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `attr_value` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribute_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `attribute_values_attribute_id_foreign`(`attribute_id`) USING BTREE,
  CONSTRAINT `attribute_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for attributes
-- ----------------------------
DROP TABLE IF EXISTS `attributes`;
CREATE TABLE `attributes`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `icon` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `meta_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `meta_keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `sort` tinyint(4) NOT NULL DEFAULT 0,
  `type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1.category 2.catalog',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `category_slug_unique`(`slug`) USING BTREE,
  INDEX `category_parent_id_foreign`(`parent_id`) USING BTREE,
  CONSTRAINT `category_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (1, 'Quan ao', 'quan-ao', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'catalog', '2019-01-15 07:03:03', '2019-01-15 07:03:13', 1);
INSERT INTO `category` VALUES (2, 'Mỹ phẩm', 'my-pham', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'catalog', '2019-01-15 10:00:37', '2019-01-15 10:00:37', 1);
INSERT INTO `category` VALUES (3, 'Qùa tặng', 'qua-tang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'catalog', '2019-01-15 10:00:49', '2019-01-15 10:00:49', 1);
INSERT INTO `category` VALUES (4, 'Quần áo nam', 'quan-ao-nam', 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'catalog', '2019-01-15 10:01:42', '2019-01-15 10:01:42', 1);
INSERT INTO `category` VALUES (5, 'Quần áo nữ', 'quan-ao-nu', 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'catalog', '2019-01-15 10:01:52', '2019-01-15 10:01:52', 1);
INSERT INTO `category` VALUES (6, 'Tin', 'tin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'category', '2019-01-16 08:07:01', '2019-01-16 08:07:01', 1);
INSERT INTO `category` VALUES (7, 'Ao thun', 'ao-thun', 4, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'catalog', '2019-01-18 03:36:02', '2019-01-18 03:36:02', 1);

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of comment
-- ----------------------------
INSERT INTO `comment` VALUES (1, 'Maria Ozawa', '/uploads/comment/2019/01/20190121081711-dep-nhat-3.jpg', 'I have created a dropdown in Excel file using Laravel-Excel library. below is my code for creating dropdown.', '2019-01-21 08:17:11', '2019-01-21 08:17:11');
INSERT INTO `comment` VALUES (2, 'Linh Linh', '/uploads/comment/2019/01/20190121081740-dep-nhat-4.jpg', 'So How to get data from \'variants\' sheet and fill dropdown value of column \'D1\' in \'product\' sheet.', '2019-01-21 08:17:40', '2019-01-21 08:17:40');
INSERT INTO `comment` VALUES (3, 'Huyen', '/uploads/comment/2019/01/20190121082017-beautiful-girls-wallpapers-0.jpg', 't\'s possible to style the sheets and specific cells with help of PHPExcel methods. This package includes a lot of shortcuts (see export documentation)', '2019-01-21 08:20:17', '2019-01-21 08:20:17');

-- ----------------------------
-- Table structure for groups
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES (1, 'Hot Articles', NULL, NULL, 1);
INSERT INTO `groups` VALUES (2, 'Hot Product', NULL, NULL, 1);

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `parent_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `direct` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `route` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `menu_group_id` int(11) NOT NULL,
  `sort` tinyint(4) NOT NULL DEFAULT 0,
  `type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `menu_parent_id_foreign`(`parent_id`) USING BTREE,
  CONSTRAINT `menu_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (1, 'Quan ao', 'quan-ao', NULL, NULL, NULL, 4, 0, 'catalog', '2019-01-18 02:10:32', '2019-01-18 02:10:32');
INSERT INTO `menu` VALUES (5, 'Quần áo nam', 'quan-ao-nam', 1, NULL, NULL, 4, 1, 'catalog', '2019-01-18 02:51:46', '2019-01-18 02:51:50');
INSERT INTO `menu` VALUES (6, 'Quần áo nữ', 'quan-ao-nu', 1, NULL, NULL, 4, 2, 'catalog', '2019-01-18 02:51:46', '2019-01-18 02:51:52');
INSERT INTO `menu` VALUES (9, 'Tin', 'tin', NULL, NULL, NULL, 4, 3, 'category', '2019-01-18 03:00:13', '2019-01-18 03:05:06');
INSERT INTO `menu` VALUES (10, 'Mỹ phẩm', 'my-pham', NULL, NULL, NULL, 4, 1, 'catalog', '2019-01-18 03:04:59', '2019-01-18 03:05:06');
INSERT INTO `menu` VALUES (11, 'Qùa tặng', 'qua-tang', NULL, NULL, NULL, 4, 2, 'catalog', '2019-01-18 03:04:59', '2019-01-18 03:05:06');
INSERT INTO `menu` VALUES (12, 'Ao thun', 'ao-thun', 5, NULL, NULL, 4, 2, 'catalog', '2019-01-18 03:36:16', '2019-01-18 03:36:20');
INSERT INTO `menu` VALUES (13, 'Điều khoản sử dụng', 'dieu-khoan-su-dung', NULL, NULL, NULL, 6, 1, 'page', '2019-01-24 02:50:31', '2019-01-24 02:50:33');
INSERT INTO `menu` VALUES (14, 'Giới thiệu', 'gioi-thieu', NULL, NULL, NULL, 6, 0, 'page', '2019-01-24 02:50:31', '2019-01-24 02:50:31');
INSERT INTO `menu` VALUES (15, 'Quan ao', 'quan-ao', NULL, NULL, NULL, 5, 0, 'catalog', '2019-01-24 04:06:20', '2019-01-24 04:06:20');
INSERT INTO `menu` VALUES (16, 'Quần áo nam', 'quan-ao-nam', 15, NULL, NULL, 5, 1, 'catalog', '2019-01-24 04:06:20', '2019-01-24 04:07:07');
INSERT INTO `menu` VALUES (17, 'Quần áo nữ', 'quan-ao-nu', 15, NULL, NULL, 5, 2, 'catalog', '2019-01-24 04:06:20', '2019-01-24 04:07:08');
INSERT INTO `menu` VALUES (18, 'Mỹ phẩm', 'my-pham', 15, NULL, NULL, 5, 3, 'catalog', '2019-01-24 04:06:20', '2019-01-24 04:07:09');
INSERT INTO `menu` VALUES (19, 'Qùa tặng', 'qua-tang', 15, NULL, NULL, 5, 4, 'catalog', '2019-01-24 04:06:20', '2019-01-24 04:07:10');
INSERT INTO `menu` VALUES (20, 'Quan ao', 'quan-ao', NULL, NULL, NULL, 5, 1, 'catalog', '2019-01-24 04:07:03', '2019-01-24 04:07:10');
INSERT INTO `menu` VALUES (21, 'Quần áo nam', 'quan-ao-nam', 20, NULL, NULL, 5, 2, 'catalog', '2019-01-24 04:07:03', '2019-01-24 04:07:11');
INSERT INTO `menu` VALUES (22, 'Quần áo nữ', 'quan-ao-nu', 20, NULL, NULL, 5, 3, 'catalog', '2019-01-24 04:07:03', '2019-01-24 04:07:12');
INSERT INTO `menu` VALUES (23, 'Mỹ phẩm', 'my-pham', 20, NULL, NULL, 5, 4, 'catalog', '2019-01-24 04:07:03', '2019-01-24 04:07:13');
INSERT INTO `menu` VALUES (24, 'Qùa tặng', 'qua-tang', 20, NULL, NULL, 5, 5, 'catalog', '2019-01-24 04:07:03', '2019-01-24 04:07:14');

-- ----------------------------
-- Table structure for menu_group
-- ----------------------------
DROP TABLE IF EXISTS `menu_group`;
CREATE TABLE `menu_group`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu_group
-- ----------------------------
INSERT INTO `menu_group` VALUES (5, 'Footer Menu', '2019-01-18 02:10:24', '2019-01-18 02:10:24', 1);
INSERT INTO `menu_group` VALUES (4, 'Main Menu', '2019-01-18 02:08:36', '2019-01-18 02:08:36', 1);
INSERT INTO `menu_group` VALUES (6, 'Top Menu', '2019-01-24 02:50:23', '2019-01-24 02:50:23', 1);

-- ----------------------------
-- Table structure for menu_system
-- ----------------------------
DROP TABLE IF EXISTS `menu_system`;
CREATE TABLE `menu_system`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `sort` tinyint(4) NOT NULL DEFAULT 0,
  `show` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1,2',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu_system
-- ----------------------------
INSERT INTO `menu_system` VALUES (1, 'Category', 'icon-grid', 'category', 0, 0, '1,2', 1);
INSERT INTO `menu_system` VALUES (2, 'Create Category', 'icon-plus', 'category.create', 1, 1, '1,2', 1);
INSERT INTO `menu_system` VALUES (3, 'All Category', 'icon-list', 'category.index', 1, 2, '1,2', 1);
INSERT INTO `menu_system` VALUES (4, 'Post', 'icon-book-open', 'post', 0, 0, '1,2', 1);
INSERT INTO `menu_system` VALUES (5, 'Create Post', 'icon-plus', 'post.create', 4, 1, '1,2', 1);
INSERT INTO `menu_system` VALUES (6, 'All Posts', 'icon-list', 'post.index', 4, 2, '1,2', 1);
INSERT INTO `menu_system` VALUES (7, 'Page', 'icon-notebook', 'page', 0, 0, '1,2', 1);
INSERT INTO `menu_system` VALUES (8, 'Create Page', 'icon-plus', 'page.create', 7, 1, '1,2', 1);
INSERT INTO `menu_system` VALUES (9, 'Create Landing Page', 'icon-note', 'page.landing', 7, 1, '1,2', 1);
INSERT INTO `menu_system` VALUES (10, 'All Pages', 'icon-list', 'page.index', 7, 2, '1,2', 1);
INSERT INTO `menu_system` VALUES (11, 'Products', 'icon-handbag', 'product', 0, 0, '1,2', 1);
INSERT INTO `menu_system` VALUES (12, 'Create Product', 'icon-plus', 'product.create', 11, 0, '1,2', 1);
INSERT INTO `menu_system` VALUES (13, 'All Products', 'icon-list', 'product.index', 11, 0, '1,2', 1);
INSERT INTO `menu_system` VALUES (14, 'Attributes', 'icon-tag', 'attributeValue.index', 11, 0, '1,2', 1);
INSERT INTO `menu_system` VALUES (15, 'Users', 'icon-user', 'user', 0, 0, '1', 1);
INSERT INTO `menu_system` VALUES (16, 'Create User', 'icon-user-follow', 'user.create', 15, 1, '1', 1);
INSERT INTO `menu_system` VALUES (17, 'All User', 'icon-users', 'user.index', 15, 2, '1', 1);
INSERT INTO `menu_system` VALUES (18, 'Themes', 'icon-globe', 'setting', 0, 0, '1,2', 1);
INSERT INTO `menu_system` VALUES (19, 'Menu', 'icon-diamond', 'setting.menu', 18, 1, '1,2', 1);
INSERT INTO `menu_system` VALUES (20, 'Setting', 'icon-settings', 'setting.index', 18, 2, '1,2', 1);
INSERT INTO `menu_system` VALUES (21, 'Advertising', 'icon-globe', 'advertising', 0, 0, '1', 1);
INSERT INTO `menu_system` VALUES (22, 'Create Ad Unit', 'icon-plus', 'advertising.create', 21, 1, '1', 1);
INSERT INTO `menu_system` VALUES (23, 'All', 'icon-list', 'advertising.index', 21, 2, '1', 1);
INSERT INTO `menu_system` VALUES (24, 'Comments', 'icon-grid', 'comment', 0, 0, '1,2', 1);
INSERT INTO `menu_system` VALUES (25, 'Create Comment', 'icon-plus', 'comment.create', 24, 0, '1,2', 1);
INSERT INTO `menu_system` VALUES (26, 'All', 'icon-list', 'comment.index', 24, 0, '1,2', 1);

-- ----------------------------
-- Table structure for meta_field
-- ----------------------------
DROP TABLE IF EXISTS `meta_field`;
CREATE TABLE `meta_field`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `key_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `article_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `meta_field_article_id_foreign`(`article_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 72 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (35, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (36, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (37, '2016_06_01_000001_create_oauth_auth_codes_table', 1);
INSERT INTO `migrations` VALUES (38, '2016_06_01_000002_create_oauth_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (39, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1);
INSERT INTO `migrations` VALUES (40, '2016_06_01_000004_create_oauth_clients_table', 1);
INSERT INTO `migrations` VALUES (41, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1);
INSERT INTO `migrations` VALUES (42, '2017_08_16_045421_create_menu_system_table', 1);
INSERT INTO `migrations` VALUES (43, '2017_09_10_220943_create_articles_table', 1);
INSERT INTO `migrations` VALUES (44, '2017_09_10_221006_create_category_table', 1);
INSERT INTO `migrations` VALUES (45, '2017_09_10_221017_create_article_category_table', 1);
INSERT INTO `migrations` VALUES (46, '2017_09_12_165520_create_tags_table', 1);
INSERT INTO `migrations` VALUES (47, '2017_09_12_165607_create_article_tag_table', 1);
INSERT INTO `migrations` VALUES (48, '2017_09_17_092158_create_meta_field_table', 1);
INSERT INTO `migrations` VALUES (49, '2017_09_17_233557_create_groups_table', 1);
INSERT INTO `migrations` VALUES (50, '2017_09_17_233651_create_article_group_table', 1);
INSERT INTO `migrations` VALUES (51, '2017_09_24_212525_create_menu_table', 1);
INSERT INTO `migrations` VALUES (52, '2017_09_24_214045_create_menu_group_table', 1);
INSERT INTO `migrations` VALUES (53, '2017_10_11_103824_create_attributes_table', 1);
INSERT INTO `migrations` VALUES (54, '2017_10_11_103856_create_attribute_values_table', 1);
INSERT INTO `migrations` VALUES (55, '2017_10_11_110139_create_products_table', 1);
INSERT INTO `migrations` VALUES (56, '2017_10_11_110152_create_product_catagory_table', 1);
INSERT INTO `migrations` VALUES (57, '2017_10_11_110226_create_product_tag_table', 1);
INSERT INTO `migrations` VALUES (58, '2017_10_11_110244_create_product_images_table', 1);
INSERT INTO `migrations` VALUES (59, '2017_10_11_110304_create_product_attribute_value_table', 1);
INSERT INTO `migrations` VALUES (60, '2017_10_11_151416_create_orders_table', 1);
INSERT INTO `migrations` VALUES (61, '2017_10_11_151425_create_order_products_table', 1);
INSERT INTO `migrations` VALUES (62, '2017_10_11_155311_create_order_product_details_table', 1);
INSERT INTO `migrations` VALUES (63, '2017_10_11_172231_create_order_product_attributes_table', 1);
INSERT INTO `migrations` VALUES (64, '2017_10_11_172249_create_order_product_attribute_groups_table', 1);
INSERT INTO `migrations` VALUES (65, '2017_10_11_172337_create_order_attribute_images_table', 1);
INSERT INTO `migrations` VALUES (66, '2017_11_13_074422_create_options_table', 1);
INSERT INTO `migrations` VALUES (67, '2019_01_11_022612_create_advertising_table', 1);
INSERT INTO `migrations` VALUES (68, '2019_01_11_230439_add_type_to_advertising_table', 1);
INSERT INTO `migrations` VALUES (69, '2019_01_15_214221_add_group_to_advertising_table', 2);
INSERT INTO `migrations` VALUES (70, '2019_01_16_082027_create_product_group_table', 3);
INSERT INTO `migrations` VALUES (71, '2019_01_20_214103_create_comment_table', 4);

-- ----------------------------
-- Table structure for oauth_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens`  (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NULL DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `expires_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_access_tokens_user_id_index`(`user_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for oauth_auth_codes
-- ----------------------------
DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes`  (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for oauth_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_clients_user_id_index`(`user_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for oauth_personal_access_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_personal_access_clients_client_id_index`(`client_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for oauth_refresh_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens`  (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_refresh_tokens_access_token_id_index`(`access_token_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for options
-- ----------------------------
DROP TABLE IF EXISTS `options`;
CREATE TABLE `options`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of options
-- ----------------------------
INSERT INTO `options` VALUES (1, 'main_menu_id', '4');
INSERT INTO `options` VALUES (2, 'mainCategory', '7');
INSERT INTO `options` VALUES (3, 'selectedCatalog', '7,3');
INSERT INTO `options` VALUES (4, 'how_to_buy', '- Nhấn nút \"Mua ngay\", kiểm tra lại giỏ hàng và nhấn nút \"Thanh toán\". \r\n- Nhập đầy đủ thông tin liên hệ, chọn hình thức thanh toán và giao hàng phù hợp. \r\n- Điền mã số khuyến mại (nếu có) và ấn nút \"Hoàn tất\" chúng tôi sẽ liên hệ lại với bạn ngay để giao hàng.');
INSERT INTO `options` VALUES (5, 'baohanh', '- Bảo hành sản phẩm trong 12 tháng');
INSERT INTO `options` VALUES (6, 'how_to_ship', '- Giao hàng miễn phí nội thành HN');
INSERT INTO `options` VALUES (7, 'meta_title', 'Meta Title');
INSERT INTO `options` VALUES (8, 'meta_description', 'Meta Description');
INSERT INTO `options` VALUES (9, 'top_menu_id', '6');
INSERT INTO `options` VALUES (10, 'hotline', '098.168.8118');
INSERT INTO `options` VALUES (11, 'email', 'hungnv234@gmail.com');
INSERT INTO `options` VALUES (12, 'company_name', 'Công ty cổ phần TNHH Evnbay');
INSERT INTO `options` VALUES (13, 'main_office', 'P714- NƠ 20- KĐT Pháp Vân, Hoàng Mai, Hà Nội');
INSERT INTO `options` VALUES (14, 'footer_menu_id', '5');

-- ----------------------------
-- Table structure for order_attribute_images
-- ----------------------------
DROP TABLE IF EXISTS `order_attribute_images`;
CREATE TABLE `order_attribute_images`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_product_attribute_id` int(10) UNSIGNED NOT NULL,
  `order_product_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `order_attribute_images_order_product_attribute_id_foreign`(`order_product_attribute_id`) USING BTREE,
  INDEX `order_attribute_images_order_product_id_foreign`(`order_product_id`) USING BTREE,
  CONSTRAINT `order_attribute_images_order_product_attribute_id_foreign` FOREIGN KEY (`order_product_attribute_id`) REFERENCES `order_product_attributes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `order_attribute_images_order_product_id_foreign` FOREIGN KEY (`order_product_id`) REFERENCES `order_products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for order_product_attribute_groups
-- ----------------------------
DROP TABLE IF EXISTS `order_product_attribute_groups`;
CREATE TABLE `order_product_attribute_groups`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_product_detail_id` int(10) UNSIGNED NOT NULL,
  `order_product_attribute_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `order_groups_order_sp_details_id`(`order_product_detail_id`) USING BTREE,
  INDEX `order_groups_order_attr_id`(`order_product_attribute_id`) USING BTREE,
  CONSTRAINT `order_groups_order_attr_id` FOREIGN KEY (`order_product_attribute_id`) REFERENCES `order_product_attributes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `order_groups_order_sp_details_id` FOREIGN KEY (`order_product_detail_id`) REFERENCES `order_product_details` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for order_product_attributes
-- ----------------------------
DROP TABLE IF EXISTS `order_product_attributes`;
CREATE TABLE `order_product_attributes`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `attr_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attr_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for order_product_details
-- ----------------------------
DROP TABLE IF EXISTS `order_product_details`;
CREATE TABLE `order_product_details`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_product_id` int(10) UNSIGNED NOT NULL,
  `quantities` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `order_product_details_order_product_id_foreign`(`order_product_id`) USING BTREE,
  CONSTRAINT `order_product_details_order_product_id_foreign` FOREIGN KEY (`order_product_id`) REFERENCES `order_products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for order_products
-- ----------------------------
DROP TABLE IF EXISTS `order_products`;
CREATE TABLE `order_products`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantities` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_sku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `order_products_order_id_foreign`(`order_id`) USING BTREE,
  INDEX `order_products_product_id_foreign`(`product_id`) USING BTREE,
  CONSTRAINT `order_products_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `order_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `total_money` int(11) NOT NULL DEFAULT 0,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `telephone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1.wait confirm 2.approved 3.finish 4.cancel',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `username` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_username_index`(`username`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for product_attribute_value
-- ----------------------------
DROP TABLE IF EXISTS `product_attribute_value`;
CREATE TABLE `product_attribute_value`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `attribute_value_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `attr_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attr_value` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_attribute_value_attribute_value_id_foreign`(`attribute_value_id`) USING BTREE,
  INDEX `product_attribute_value_product_id_foreign`(`product_id`) USING BTREE,
  CONSTRAINT `product_attribute_value_attribute_value_id_foreign` FOREIGN KEY (`attribute_value_id`) REFERENCES `attribute_values` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `product_attribute_value_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for product_category
-- ----------------------------
DROP TABLE IF EXISTS `product_category`;
CREATE TABLE `product_category`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_category_product_id_foreign`(`product_id`) USING BTREE,
  INDEX `product_category_category_id_foreign`(`category_id`) USING BTREE,
  CONSTRAINT `product_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `product_category_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_category
-- ----------------------------
INSERT INTO `product_category` VALUES (4, 3, 7, '2019-01-22 01:53:59', '2019-01-22 01:53:59');
INSERT INTO `product_category` VALUES (5, 4, 7, '2019-01-22 01:54:45', '2019-01-22 01:54:45');
INSERT INTO `product_category` VALUES (6, 5, 7, '2019-01-22 01:55:14', '2019-01-22 01:55:14');
INSERT INTO `product_category` VALUES (7, 2, 7, '2019-01-22 01:55:36', '2019-01-22 01:55:36');
INSERT INTO `product_category` VALUES (8, 1, 7, '2019-01-22 01:55:42', '2019-01-22 01:55:42');
INSERT INTO `product_category` VALUES (11, 6, 3, '2019-01-22 09:46:04', '2019-01-22 09:46:04');
INSERT INTO `product_category` VALUES (12, 7, 3, '2019-01-22 09:46:12', '2019-01-22 09:46:12');

-- ----------------------------
-- Table structure for product_group
-- ----------------------------
DROP TABLE IF EXISTS `product_group`;
CREATE TABLE `product_group`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_group_product_id_foreign`(`product_id`) USING BTREE,
  INDEX `product_group_group_id_foreign`(`group_id`) USING BTREE,
  CONSTRAINT `product_group_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `product_group_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_group
-- ----------------------------
INSERT INTO `product_group` VALUES (1, 2, 2, '2019-01-21 08:39:38', '2019-01-21 08:39:38');
INSERT INTO `product_group` VALUES (2, 1, 2, '2019-01-21 08:39:39', '2019-01-21 08:39:39');
INSERT INTO `product_group` VALUES (3, 3, 2, '2019-01-22 07:00:40', '2019-01-22 07:00:40');

-- ----------------------------
-- Table structure for product_images
-- ----------------------------
DROP TABLE IF EXISTS `product_images`;
CREATE TABLE `product_images`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_images_product_id_foreign`(`product_id`) USING BTREE,
  CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_images
-- ----------------------------
INSERT INTO `product_images` VALUES (5, '/uploads/products/2019/01/20190121082652-p1.jpg', 2);
INSERT INTO `product_images` VALUES (6, '/uploads/products/2019/01/20190121082652-p13.jpg', 2);
INSERT INTO `product_images` VALUES (7, '/uploads/products/2019/01/20190121082652-p18.jpg', 2);
INSERT INTO `product_images` VALUES (8, '/uploads/products/2019/01/20190121082652-p25.jpg', 2);
INSERT INTO `product_images` VALUES (9, '/uploads/products/2019/01/20190121082725-p5.jpg', 1);
INSERT INTO `product_images` VALUES (10, '/uploads/products/2019/01/20190121082725-p6.jpg', 1);
INSERT INTO `product_images` VALUES (11, '/uploads/products/2019/01/20190121082725-p23.jpg', 1);
INSERT INTO `product_images` VALUES (12, '/uploads/products/2019/01/20190121082725-p28.jpg', 1);
INSERT INTO `product_images` VALUES (13, '/uploads/products/2019/01/20190122015318-p5.jpg', 3);
INSERT INTO `product_images` VALUES (14, '/uploads/products/2019/01/20190122015318-p6.jpg', 3);
INSERT INTO `product_images` VALUES (15, '/uploads/products/2019/01/20190122015318-p23.jpg', 3);
INSERT INTO `product_images` VALUES (16, '/uploads/products/2019/01/20190122015318-p28.jpg', 3);
INSERT INTO `product_images` VALUES (17, '/uploads/products/2019/01/20190122015445-p5.jpg', 4);
INSERT INTO `product_images` VALUES (18, '/uploads/products/2019/01/20190122015445-p6.jpg', 4);
INSERT INTO `product_images` VALUES (19, '/uploads/products/2019/01/20190122015445-p23.jpg', 4);
INSERT INTO `product_images` VALUES (20, '/uploads/products/2019/01/20190122015445-p28.jpg', 4);
INSERT INTO `product_images` VALUES (21, '/uploads/products/2019/01/20190122015514-p5.jpg', 5);
INSERT INTO `product_images` VALUES (22, '/uploads/products/2019/01/20190122015514-p6.jpg', 5);
INSERT INTO `product_images` VALUES (23, '/uploads/products/2019/01/20190122015514-p23.jpg', 5);
INSERT INTO `product_images` VALUES (24, '/uploads/products/2019/01/20190122015514-p28.jpg', 5);
INSERT INTO `product_images` VALUES (29, '/uploads/products/2019/01/20190122063119-p3.jpg', 6);
INSERT INTO `product_images` VALUES (30, '/uploads/products/2019/01/20190122063119-p10.jpg', 6);
INSERT INTO `product_images` VALUES (31, '/uploads/products/2019/01/20190122063119-p15.jpg', 6);
INSERT INTO `product_images` VALUES (32, '/uploads/products/2019/01/20190122063119-p17.jpg', 6);
INSERT INTO `product_images` VALUES (33, '/uploads/products/2019/01/20190122063141-p3.jpg', 7);
INSERT INTO `product_images` VALUES (34, '/uploads/products/2019/01/20190122063141-p10.jpg', 7);
INSERT INTO `product_images` VALUES (35, '/uploads/products/2019/01/20190122063142-p15.jpg', 7);
INSERT INTO `product_images` VALUES (36, '/uploads/products/2019/01/20190122063142-p17.jpg', 7);

-- ----------------------------
-- Table structure for product_tag
-- ----------------------------
DROP TABLE IF EXISTS `product_tag`;
CREATE TABLE `product_tag`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_tag_product_id_foreign`(`product_id`) USING BTREE,
  INDEX `product_tag_tag_id_foreign`(`tag_id`) USING BTREE,
  CONSTRAINT `product_tag_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `product_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sku` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `special` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `new_price` int(11) NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `in_stock` tinyint(1) NOT NULL DEFAULT 1,
  `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `meta_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `meta_keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `products_sku_unique`(`sku`) USING BTREE,
  UNIQUE INDEX `products_slug_unique`(`slug`) USING BTREE,
  INDEX `products_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'bemax2020', 'Nước uống đẹp da Be-Max 2020', 'nuoc-uong-dep-da-bemax-2020', NULL, 'Nước uống Be-Max 2020 bổ sung 125 dưỡng chất giúp tăng cường sức đề kháng, tái tạo năng lượng, chống lại gốc tự do gây lão hoá, thiết lập lại mạng lưới collagen bên trong cơ thể giúp tổ chức cấu tạo tế bào trở nên vững chắc và khoẻ mạnh.', '<p><span style=\"color:rgb(64, 64, 64); font-family:tahoma,geneva,sans-serif\">L&agrave;n da trắng s&aacute;ng, căng mịn, cơ thể khỏe mạnh tr&agrave;n đầy năng lượng l&agrave; ti&ecirc;u ch&iacute; đ&aacute;nh gi&aacute; vẽ đẹp của người phụ nữ hiện đại. Bởi sức khỏe tốt gi&uacute;p người phụ nữ c&oacute; đủ năng lượng để ho&agrave;n th&agrave;nh tốt c&ocirc;ng việc ngo&agrave;i x&atilde; hội cũng như chăm lo trọn vẹn cho gia đ&igrave;nh th&acirc;n y&ecirc;u của m&igrave;nh. Để c&oacute; được 2 điều tr&ecirc;n ph&aacute;i đẹp cần phải c&oacute; sự quan t&acirc;m chăm s&oacute;c đ&uacute;ng mức cho sức khỏe v&agrave; sắc đẹp.</span><br />\r\n<br />\r\n<span style=\"color:rgb(64, 64, 64); font-family:tahoma,geneva,sans-serif\">Nước uống đẹp da Be-Max 2020 được sản xuất theo c&ocirc;ng nghệ hiện đại của Nhật bởi C&ocirc;ng ty Be-max với mong muốn phụ nữ hiện đại lu&ocirc;n xinh đẹp, khỏe mạnh v&agrave; hạnh ph&uacute;c hơn trong cuộc sống.</span><br />\r\n<br />\r\n<span style=\"color:rgb(64, 64, 64); font-family:tahoma,geneva,sans-serif\">Sản phẩm l&agrave; sự kết hợp của 125 loại tinh chất l&agrave;m đẹp v&agrave; chống l&atilde;o h&oacute;a, l&agrave; bước đột ph&aacute; trong việc bảo vệ sức khỏe, cải thiện vẻ ngo&agrave;i trẻ trung, xinh đẹp, chống lại gốc tự do g&acirc;y l&atilde;o h&oacute;a, thiết lập mạng lưới collagen b&ecirc;n trong cơ thể gi&uacute;p cấu tạo tế b&agrave;o da trở n&ecirc;n vững chắc, khỏe mạnh.</span></p>', '/uploads/products/2019/01/20190121082725-p5.jpg', 150000, 110000, 1, 1, NULL, NULL, NULL, 0, '2019-01-15 07:07:46', '2019-01-21 08:27:25', NULL, 1);
INSERT INTO `products` VALUES (2, 'copyofbemax20200', 'Floral Print Buttoned', 'floral-print-buttoned', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '<p><span style=\"font-family:open sans,sans-serif\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span><br />\r\n<br />\r\n<span style=\"font-family:open sans,sans-serif\">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span></p>', '/uploads/products/2019/01/20190121082652-p25.jpg', 150000, 90000, 1, 1, NULL, NULL, NULL, 0, '2019-01-15 09:22:11', '2019-01-21 08:26:55', NULL, 1);
INSERT INTO `products` VALUES (3, 'max21', 'Giày nam mới màu trắng', 'giay-nam-moi-mau-trang', NULL, 'Nước uống Be-Max 2020 bổ sung 125 dưỡng chất giúp tăng cường sức đề kháng, tái tạo năng lượng, chống lại gốc tự do gây lão hoá, thiết lập lại mạng lưới collagen bên trong cơ thể giúp tổ chức cấu tạo tế bào trở nên vững chắc và khoẻ mạnh.', '<p><span style=\"color:rgb(64, 64, 64); font-family:tahoma,geneva,sans-serif\">L&agrave;n da trắng s&aacute;ng, căng mịn, cơ thể khỏe mạnh tr&agrave;n đầy năng lượng l&agrave; ti&ecirc;u ch&iacute; đ&aacute;nh gi&aacute; vẽ đẹp của người phụ nữ hiện đại. Bởi sức khỏe tốt gi&uacute;p người phụ nữ c&oacute; đủ năng lượng để ho&agrave;n th&agrave;nh tốt c&ocirc;ng việc ngo&agrave;i x&atilde; hội cũng như chăm lo trọn vẹn cho gia đ&igrave;nh th&acirc;n y&ecirc;u của m&igrave;nh. Để c&oacute; được 2 điều tr&ecirc;n ph&aacute;i đẹp cần phải c&oacute; sự quan t&acirc;m chăm s&oacute;c đ&uacute;ng mức cho sức khỏe v&agrave; sắc đẹp.</span><br />\r\n<br />\r\n<span style=\"color:rgb(64, 64, 64); font-family:tahoma,geneva,sans-serif\">Nước uống đẹp da Be-Max 2020 được sản xuất theo c&ocirc;ng nghệ hiện đại của Nhật bởi C&ocirc;ng ty Be-max với mong muốn phụ nữ hiện đại lu&ocirc;n xinh đẹp, khỏe mạnh v&agrave; hạnh ph&uacute;c hơn trong cuộc sống.</span><br />\r\n<br />\r\n<span style=\"color:rgb(64, 64, 64); font-family:tahoma,geneva,sans-serif\">Sản phẩm l&agrave; sự kết hợp của 125 loại tinh chất l&agrave;m đẹp v&agrave; chống l&atilde;o h&oacute;a, l&agrave; bước đột ph&aacute; trong việc bảo vệ sức khỏe, cải thiện vẻ ngo&agrave;i trẻ trung, xinh đẹp, chống lại gốc tự do g&acirc;y l&atilde;o h&oacute;a, thiết lập mạng lưới collagen b&ecirc;n trong cơ thể gi&uacute;p cấu tạo tế b&agrave;o da trở n&ecirc;n vững chắc, khỏe mạnh.</span></p>', '/uploads/products/2019/01/20190122015318-p28.jpg', 150000, 110000, 1, 1, NULL, NULL, NULL, 0, '2019-01-22 01:53:18', '2019-01-22 01:54:05', NULL, 1);
INSERT INTO `products` VALUES (4, 'max22', 'Giày nam mới màu đỏ', 'giay-nam-moi-mau-do', NULL, 'Nước uống Be-Max 2020 bổ sung 125 dưỡng chất giúp tăng cường sức đề kháng, tái tạo năng lượng, chống lại gốc tự do gây lão hoá, thiết lập lại mạng lưới collagen bên trong cơ thể giúp tổ chức cấu tạo tế bào trở nên vững chắc và khoẻ mạnh.', '<p><span style=\"color:rgb(64, 64, 64); font-family:tahoma,geneva,sans-serif\">L&agrave;n da trắng s&aacute;ng, căng mịn, cơ thể khỏe mạnh tr&agrave;n đầy năng lượng l&agrave; ti&ecirc;u ch&iacute; đ&aacute;nh gi&aacute; vẽ đẹp của người phụ nữ hiện đại. Bởi sức khỏe tốt gi&uacute;p người phụ nữ c&oacute; đủ năng lượng để ho&agrave;n th&agrave;nh tốt c&ocirc;ng việc ngo&agrave;i x&atilde; hội cũng như chăm lo trọn vẹn cho gia đ&igrave;nh th&acirc;n y&ecirc;u của m&igrave;nh. Để c&oacute; được 2 điều tr&ecirc;n ph&aacute;i đẹp cần phải c&oacute; sự quan t&acirc;m chăm s&oacute;c đ&uacute;ng mức cho sức khỏe v&agrave; sắc đẹp.</span><br />\r\n<br />\r\n<span style=\"color:rgb(64, 64, 64); font-family:tahoma,geneva,sans-serif\">Nước uống đẹp da Be-Max 2020 được sản xuất theo c&ocirc;ng nghệ hiện đại của Nhật bởi C&ocirc;ng ty Be-max với mong muốn phụ nữ hiện đại lu&ocirc;n xinh đẹp, khỏe mạnh v&agrave; hạnh ph&uacute;c hơn trong cuộc sống.</span><br />\r\n<br />\r\n<span style=\"color:rgb(64, 64, 64); font-family:tahoma,geneva,sans-serif\">Sản phẩm l&agrave; sự kết hợp của 125 loại tinh chất l&agrave;m đẹp v&agrave; chống l&atilde;o h&oacute;a, l&agrave; bước đột ph&aacute; trong việc bảo vệ sức khỏe, cải thiện vẻ ngo&agrave;i trẻ trung, xinh đẹp, chống lại gốc tự do g&acirc;y l&atilde;o h&oacute;a, thiết lập mạng lưới collagen b&ecirc;n trong cơ thể gi&uacute;p cấu tạo tế b&agrave;o da trở n&ecirc;n vững chắc, khỏe mạnh.</span></p>', '/uploads/products/2019/01/20190122015445-p6.jpg', 150000, 110000, 1, 1, NULL, NULL, NULL, 0, '2019-01-22 01:54:45', '2019-01-22 01:55:11', NULL, 1);
INSERT INTO `products` VALUES (5, 'max23', 'Giày nam mới màu đen', 'giay-nam-moi-mau-den', NULL, 'Nước uống Be-Max 2020 bổ sung 125 dưỡng chất giúp tăng cường sức đề kháng, tái tạo năng lượng, chống lại gốc tự do gây lão hoá, thiết lập lại mạng lưới collagen bên trong cơ thể giúp tổ chức cấu tạo tế bào trở nên vững chắc và khoẻ mạnh.', '<p><span style=\"color:rgb(64, 64, 64); font-family:tahoma,geneva,sans-serif\">L&agrave;n da trắng s&aacute;ng, căng mịn, cơ thể khỏe mạnh tr&agrave;n đầy năng lượng l&agrave; ti&ecirc;u ch&iacute; đ&aacute;nh gi&aacute; vẽ đẹp của người phụ nữ hiện đại. Bởi sức khỏe tốt gi&uacute;p người phụ nữ c&oacute; đủ năng lượng để ho&agrave;n th&agrave;nh tốt c&ocirc;ng việc ngo&agrave;i x&atilde; hội cũng như chăm lo trọn vẹn cho gia đ&igrave;nh th&acirc;n y&ecirc;u của m&igrave;nh. Để c&oacute; được 2 điều tr&ecirc;n ph&aacute;i đẹp cần phải c&oacute; sự quan t&acirc;m chăm s&oacute;c đ&uacute;ng mức cho sức khỏe v&agrave; sắc đẹp.</span><br />\r\n<br />\r\n<span style=\"color:rgb(64, 64, 64); font-family:tahoma,geneva,sans-serif\">Nước uống đẹp da Be-Max 2020 được sản xuất theo c&ocirc;ng nghệ hiện đại của Nhật bởi C&ocirc;ng ty Be-max với mong muốn phụ nữ hiện đại lu&ocirc;n xinh đẹp, khỏe mạnh v&agrave; hạnh ph&uacute;c hơn trong cuộc sống.</span><br />\r\n<br />\r\n<span style=\"color:rgb(64, 64, 64); font-family:tahoma,geneva,sans-serif\">Sản phẩm l&agrave; sự kết hợp của 125 loại tinh chất l&agrave;m đẹp v&agrave; chống l&atilde;o h&oacute;a, l&agrave; bước đột ph&aacute; trong việc bảo vệ sức khỏe, cải thiện vẻ ngo&agrave;i trẻ trung, xinh đẹp, chống lại gốc tự do g&acirc;y l&atilde;o h&oacute;a, thiết lập mạng lưới collagen b&ecirc;n trong cơ thể gi&uacute;p cấu tạo tế b&agrave;o da trở n&ecirc;n vững chắc, khỏe mạnh.</span></p>', '/uploads/products/2019/01/20190122015514-p5.jpg', 150000, 110000, 1, 1, NULL, NULL, NULL, 0, '2019-01-22 01:55:14', '2019-01-22 01:55:25', NULL, 1);
INSERT INTO `products` VALUES (6, 'max24', 'Túi xách nữ hiện đại cá tính', 'tui-xach-nu-hien-dai-ca-tinh', NULL, 'Nước uống Be-Max 2020 bổ sung 125 dưỡng chất giúp tăng cường sức đề kháng, tái tạo năng lượng, chống lại gốc tự do gây lão hoá, thiết lập lại mạng lưới collagen bên trong cơ thể giúp tổ chức cấu tạo tế bào trở nên vững chắc và khoẻ mạnh.', '<p><span style=\"color:rgb(64, 64, 64); font-family:tahoma,geneva,sans-serif\">L&agrave;n da trắng s&aacute;ng, căng mịn, cơ thể khỏe mạnh tr&agrave;n đầy năng lượng l&agrave; ti&ecirc;u ch&iacute; đ&aacute;nh gi&aacute; vẽ đẹp của người phụ nữ hiện đại. Bởi sức khỏe tốt gi&uacute;p người phụ nữ c&oacute; đủ năng lượng để ho&agrave;n th&agrave;nh tốt c&ocirc;ng việc ngo&agrave;i x&atilde; hội cũng như chăm lo trọn vẹn cho gia đ&igrave;nh th&acirc;n y&ecirc;u của m&igrave;nh. Để c&oacute; được 2 điều tr&ecirc;n ph&aacute;i đẹp cần phải c&oacute; sự quan t&acirc;m chăm s&oacute;c đ&uacute;ng mức cho sức khỏe v&agrave; sắc đẹp.</span><br />\r\n<br />\r\n<span style=\"color:rgb(64, 64, 64); font-family:tahoma,geneva,sans-serif\">Nước uống đẹp da Be-Max 2020 được sản xuất theo c&ocirc;ng nghệ hiện đại của Nhật bởi C&ocirc;ng ty Be-max với mong muốn phụ nữ hiện đại lu&ocirc;n xinh đẹp, khỏe mạnh v&agrave; hạnh ph&uacute;c hơn trong cuộc sống.</span><br />\r\n<br />\r\n<span style=\"color:rgb(64, 64, 64); font-family:tahoma,geneva,sans-serif\">Sản phẩm l&agrave; sự kết hợp của 125 loại tinh chất l&agrave;m đẹp v&agrave; chống l&atilde;o h&oacute;a, l&agrave; bước đột ph&aacute; trong việc bảo vệ sức khỏe, cải thiện vẻ ngo&agrave;i trẻ trung, xinh đẹp, chống lại gốc tự do g&acirc;y l&atilde;o h&oacute;a, thiết lập mạng lưới collagen b&ecirc;n trong cơ thể gi&uacute;p cấu tạo tế b&agrave;o da trở n&ecirc;n vững chắc, khỏe mạnh.</span></p>', '/uploads/products/2019/01/20190122063119-p3.jpg', 150000, 110000, 1, 1, NULL, NULL, NULL, 0, '2019-01-22 06:30:27', '2019-01-22 06:31:19', NULL, 1);
INSERT INTO `products` VALUES (7, 'max25', 'Túi xách nữ cá tính màu đen', 'tui-xach-nu-ca-tinh-mau-den', NULL, 'Nước uống Be-Max 2020 bổ sung 125 dưỡng chất giúp tăng cường sức đề kháng, tái tạo năng lượng, chống lại gốc tự do gây lão hoá, thiết lập lại mạng lưới collagen bên trong cơ thể giúp tổ chức cấu tạo tế bào trở nên vững chắc và khoẻ mạnh.', '<p><span style=\"color:rgb(64, 64, 64); font-family:tahoma,geneva,sans-serif\">L&agrave;n da trắng s&aacute;ng, căng mịn, cơ thể khỏe mạnh tr&agrave;n đầy năng lượng l&agrave; ti&ecirc;u ch&iacute; đ&aacute;nh gi&aacute; vẽ đẹp của người phụ nữ hiện đại. Bởi sức khỏe tốt gi&uacute;p người phụ nữ c&oacute; đủ năng lượng để ho&agrave;n th&agrave;nh tốt c&ocirc;ng việc ngo&agrave;i x&atilde; hội cũng như chăm lo trọn vẹn cho gia đ&igrave;nh th&acirc;n y&ecirc;u của m&igrave;nh. Để c&oacute; được 2 điều tr&ecirc;n ph&aacute;i đẹp cần phải c&oacute; sự quan t&acirc;m chăm s&oacute;c đ&uacute;ng mức cho sức khỏe v&agrave; sắc đẹp.</span><br />\r\n<br />\r\n<span style=\"color:rgb(64, 64, 64); font-family:tahoma,geneva,sans-serif\">Nước uống đẹp da Be-Max 2020 được sản xuất theo c&ocirc;ng nghệ hiện đại của Nhật bởi C&ocirc;ng ty Be-max với mong muốn phụ nữ hiện đại lu&ocirc;n xinh đẹp, khỏe mạnh v&agrave; hạnh ph&uacute;c hơn trong cuộc sống.</span><br />\r\n<br />\r\n<span style=\"color:rgb(64, 64, 64); font-family:tahoma,geneva,sans-serif\">Sản phẩm l&agrave; sự kết hợp của 125 loại tinh chất l&agrave;m đẹp v&agrave; chống l&atilde;o h&oacute;a, l&agrave; bước đột ph&aacute; trong việc bảo vệ sức khỏe, cải thiện vẻ ngo&agrave;i trẻ trung, xinh đẹp, chống lại gốc tự do g&acirc;y l&atilde;o h&oacute;a, thiết lập mạng lưới collagen b&ecirc;n trong cơ thể gi&uacute;p cấu tạo tế b&agrave;o da trở n&ecirc;n vững chắc, khỏe mạnh.</span></p>', '/uploads/products/2019/01/20190122063142-p17.jpg', 150000, 110000, 1, 1, NULL, NULL, NULL, 0, '2019-01-22 06:31:41', '2019-01-22 06:32:05', NULL, 1);

-- ----------------------------
-- Table structure for tags
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `tags_slug_unique`(`slug`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `username` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint(1) NOT NULL COMMENT '1.administrator 2.support',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_username_unique`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'hung.nguyen', 'admin', '$2y$10$q7MPSJaKaYYhkKx/m.uUsOKxET3Tho0l5jEnx/lGi3KDepKWhtQKa', 1, NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
