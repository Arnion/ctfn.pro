SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `certificate` (
  `id_certificate` int(11) NOT NULL COMMENT 'ID Certificate',
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
  `date_burned_on_testnet` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата удаления сертификата на testnet'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `certificate`
  ADD PRIMARY KEY (`id_certificate`);


ALTER TABLE `certificate`
  MODIFY `id_certificate` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Certificate';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
