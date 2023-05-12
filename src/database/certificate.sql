/*
Navicat MySQL Data Transfer

Source Server         : MySQL Server
Source Server Version : 50505
Source Host           : 148.251.81.84:3306
Source Database       : 001_ctfnpro_db

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2023-05-12 16:36:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `certificate`
-- ----------------------------
DROP TABLE IF EXISTS `certificate`;
CREATE TABLE `certificate` (
  `id_certificate` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Certificate',
  `id_client` int(11) NOT NULL DEFAULT '0' COMMENT 'ID Клиента',
  `name` varchar(255) DEFAULT '' COMMENT 'Name',
  `surname` varchar(255) DEFAULT '' COMMENT 'Фамилия',
  `patronumic` varchar(255) DEFAULT NULL COMMENT 'Отчество',
  `number` int(11) NOT NULL DEFAULT '0' COMMENT 'Номер в системе клиента',
  `course` varchar(255) DEFAULT NULL COMMENT 'Курс',
  `creation_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата выпуска',
  `deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Флаг удаления',
  `id_nft_token_testnet` int(11) NOT NULL DEFAULT '0' COMMENT 'ID NFT  Токена на Testnet',
  `id_nft_token_mainnet` int(11) NOT NULL DEFAULT '0' COMMENT 'ID NFT Токена на Mainnet',
  `user_nft_address` varchar(255) DEFAULT NULL COMMENT 'Адрес кошелька пользователя',
  `nft_deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Флаг удаления nft',
  `nft_requested` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Флаг запроса nft',
  `nft_sent` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Флаг отправки nft',
  `hide_persona` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Флаг скрыть имя в сертификате',
  `minted_on_mainnet` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Флаг минтинга сертификата на ',
  `minted_on_testnet` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Флаг минтинга сертификата на testnet',
  `minted_by_contract_mainnet` varchar(255) DEFAULT NULL COMMENT 'Адрес контракта в mainnet, с которого был минт',
  `minted_by_contract_testnet` varchar(255) DEFAULT NULL COMMENT 'Адрес контракта в testnet, с которого был минт',
  `minted_by_address_mainnet` varchar(255) DEFAULT NULL COMMENT 'Адрес который инициировал минт в mainnet',
  `minted_by_address_testnet` varchar(255) DEFAULT NULL COMMENT 'Адрес который инициировал минт в testnet',
  `date_minted_on_mainnet` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата минтинга в mainnet',
  `date_minted_on_testnet` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата минтинга в testnet',
  `burned_on_mainnet` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Флаг удаления сертификата на mainnet',
  `burned_on_testnet` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Флаг удаления сертификата на testnet',
  `date_burned_on_mainnet` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата удаления сертификата на mainnet',
  `date_burned_on_testnet` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата удаления сертификата на testnet',
  PRIMARY KEY (`id_certificate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of certificate
-- ----------------------------
