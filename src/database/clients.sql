/*
Navicat MySQL Data Transfer

Source Server         : MySQL Server
Source Server Version : 50505
Source Host           : 148.251.81.84:3306
Source Database       : 001_ctfnpro_db

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2023-05-12 16:36:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `clients`
-- ----------------------------
DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT NULL COMMENT 'Логин',
  `hash` text NOT NULL COMMENT 'Хеш',
  `auth_key` varchar(255) NOT NULL COMMENT 'Идентификатор безопасности для coocies',
  `password_reset_token` varchar(255) NOT NULL COMMENT 'Идентификатор безопасности для смены пароля',
  `name` text COMMENT 'Имя',
  `surname` text COMMENT 'Фамилия',
  `patronumic` text COMMENT 'Отчество',
  `image` text COMMENT 'Изображение',
  `phone` varchar(255) DEFAULT NULL COMMENT 'Телефон',
  `id_country` int(11) NOT NULL DEFAULT '0' COMMENT 'ID страны',
  `zip_code` int(11) NOT NULL DEFAULT '0' COMMENT 'Индекс',
  `area` text COMMENT 'Область',
  `city` text COMMENT 'Название поселения',
  `address` text COMMENT 'Адрес',
  `ip` varchar(255) DEFAULT 'all' COMMENT 'Разрешенные ip',
  `creation_date` datetime NOT NULL COMMENT 'Дата создания аккаунта',
  `ban` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Признак бана',
  `deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Признак удаления',
  `deleted_date` datetime NOT NULL COMMENT 'Дата удаления',
  `ban_date` datetime NOT NULL COMMENT 'Дата блокировки',
  `limit` int(11) NOT NULL DEFAULT '100' COMMENT 'Лимит сообщений',
  `identify` varchar(255) NOT NULL COMMENT 'Идентификатор сервиса',
  `active` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Признак активации',
  `comment` longtext NOT NULL COMMENT 'Дополнительные комментарии',
  `ip_client` varchar(255) NOT NULL COMMENT 'ip клиента',
  `http_token` varchar(255) NOT NULL,
  `verification_token` varchar(255) NOT NULL COMMENT 'Регистрационный токен',
  `forwarding_server` int(11) NOT NULL DEFAULT '0' COMMENT 'Почтовый сервер',
  `email` varchar(255) DEFAULT NULL COMMENT 'Email',
  `registration_service` varchar(255) NOT NULL COMMENT 'Сервис использованный при регистрации',
  `sms_token` int(11) NOT NULL DEFAULT '0' COMMENT 'Код проверки из смс',
  `web_site` text CHARACTER SET utf8mb4 COMMENT 'Веб сайт',
  `identify_name` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT 'Название школы',
  `school_nft_address_testnet` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT 'Адрес контракта школы на Testnet',
  `owner_nft_address_testnet` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT 'Адрес создателя школы на Testnet',
  `school_nft_address_mainnet` varchar(255) NOT NULL COMMENT 'Адрес контракта школы на Mainnet',
  `owner_nft_address_mainnet` varchar(255) NOT NULL COMMENT 'Адрес создателя школы на Mainnet',
  `school_logo` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT 'Логотип школы',
  `employee` text CHARACTER SET utf8mb4 COMMENT 'Должность',
  `is_mainnet` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Флаг работы с токеном в mainnet/testnet',
  `deployed_to_mainnet` tinyint(4) NOT NULL COMMENT 'Флаг деплоя токена в mainnet',
  `deployed_to_testnet` tinyint(4) NOT NULL COMMENT 'Флаг деплоя токена в testnet',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`,`deleted`,`deleted_date`) USING BTREE,
  UNIQUE KEY `email` (`deleted`,`deleted_date`,`email`) USING BTREE,
  UNIQUE KEY `phone` (`phone`,`deleted`,`deleted_date`) USING BTREE,
  KEY `ip` (`ip`) USING BTREE,
  KEY `ban` (`ban`) USING BTREE,
  KEY `deleted` (`deleted`) USING BTREE,
  KEY `creation_date` (`creation_date`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of clients
-- ----------------------------
