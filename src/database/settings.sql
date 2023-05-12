/*
Navicat MySQL Data Transfer

Source Server         : MySQL Server
Source Server Version : 50505
Source Host           : 148.251.81.84:3306
Source Database       : 001_ctfnpro_db

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2023-05-12 16:37:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `settings`
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id_settings` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Настройки',
  `source` varchar(255) DEFAULT NULL COMMENT 'Ключ настройки',
  `code` text COMMENT 'Код настройки',
  `deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Удалено',
  `deleted_date` datetime DEFAULT NULL COMMENT 'Дата удаления',
  `creation_date` datetime DEFAULT NULL COMMENT 'Дата создания',
  PRIMARY KEY (`id_settings`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of settings
-- ----------------------------
