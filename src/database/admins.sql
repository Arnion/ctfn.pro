SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `admins` (
  `id` int(11) NOT NULL COMMENT 'Первичный ключ',
  `role` int(11) NOT NULL DEFAULT '2' COMMENT 'Роль',
  `login` varchar(255) NOT NULL COMMENT 'Логин',
  `password_hash` varchar(255) NOT NULL COMMENT 'Пароль',
  `auth_key` varchar(255) NOT NULL COMMENT 'Идентификатор безопасности для coocies',
  `password_reset_token` varchar(255) NOT NULL COMMENT 'Идентификатор безопасности для смены пароля',
  `name` text NOT NULL COMMENT 'Имя',
  `surname` text NOT NULL COMMENT 'Фамилия',
  `patronumic` text NOT NULL COMMENT 'Отчество',
  `image` text NOT NULL COMMENT 'Изображение',
  `creation_date` datetime NOT NULL COMMENT 'Дата создания аккаунта',
  `email` text NOT NULL COMMENT 'Email',
  `phone` text NOT NULL COMMENT 'Телефон',
  `id_country` int(11) NOT NULL DEFAULT '0' COMMENT 'ID страны',
  `zip_code` int(11) NOT NULL DEFAULT '0' COMMENT 'Индекс',
  `area` text NOT NULL COMMENT 'Область',
  `city` text NOT NULL COMMENT 'Название поселения',
  `address` text NOT NULL COMMENT 'Название адреса',
  `ip_client` varchar(255) NOT NULL COMMENT 'IP адрес',
  `deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Признак удаления',
  `deleted_date` datetime NOT NULL COMMENT 'Дата удаления',
  `ban` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Признак бана',
  `date_ban` datetime NOT NULL COMMENT 'Дата бана',
  `active` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Признак активации',
  `comment` longtext NOT NULL COMMENT 'Дополнительные комментарии'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`) USING BTREE,
  ADD KEY `login` (`login`) USING BTREE,
  ADD KEY `date_create` (`creation_date`) USING BTREE,
  ADD KEY `id_country` (`id_country`) USING BTREE,
  ADD KEY `zip_code` (`zip_code`) USING BTREE,
  ADD KEY `ip_client` (`ip_client`) USING BTREE,
  ADD KEY `deleted` (`deleted`) USING BTREE,
  ADD KEY `ban` (`ban`) USING BTREE,
  ADD KEY `date_ban` (`date_ban`) USING BTREE,
  ADD KEY `active` (`active`) USING BTREE;


ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
